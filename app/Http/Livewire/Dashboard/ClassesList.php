<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Session;
use App\Models\ClassType;
use Carbon\Carbon;

class ClassesList extends Component
{
    public $view = 'types'; // 'types' o 'sessions'
    public $selectedClassType = null;
    public $classTypes = [];
    public $sessions = [];
    public $userReservations = [];

    public function mount()
    {
        $this->loadClassTypes();
    }

    public function loadClassTypes()
    {
        $this->classTypes = ClassType::withCount([
            'sessions' => function ($query) {
                $query->where('date', '>=', Carbon::now()->toDateString())
                      ->where('status', 'scheduled');
            }
        ])->get();
    }

    public function selectClassType($classTypeId)
    {
        $this->selectedClassType = ClassType::findOrFail($classTypeId);
        $this->view = 'sessions';
        $this->loadSessions();
        $this->loadUserReservations();
    }

    public function backToTypes()
    {
        $this->view = 'types';
        $this->selectedClassType = null;
        $this->sessions = [];
        $this->loadClassTypes();
        
    }

    public function loadSessions()
    {
        if (!$this->selectedClassType) {
            return;
        }
        
        $this->sessions = Session::with(['trainer.user', 'room', 'classType'])
            ->where('class_type_id', $this->selectedClassType->id)
            ->where('date', '>=', Carbon::now()->toDateString())
            ->where('status', 'scheduled')
            ->orderBy('date')
            ->orderBy('start_datetime')
            ->get();
    }

    public function loadUserReservations()
    {   
        
        $client = auth()->user()->client ?? null;

        if ($client) {
            $this->userReservations = $client->sessions()
                ->wherePivotIn('status', ['reserved', 'confirmed'])
                ->pluck('session_id')
                ->toArray();
        }
    }

    public function reserveClass($sessionId)
    {
        try {
            $session = Session::findOrFail($sessionId);

            // Obtener el cliente del usuario autenticado
            $client = auth()->user()->client;

            if (!$client) {
                session()->flash('error', 'No tienes un perfil de cliente asociado.');
                return;
            }

            // Verificar si ya tiene una reserva para esta sesión
            $existingReservation = $client->sessions()->where('session_id', $sessionId)->first();

            if ($existingReservation) {
                if ($existingReservation->pivot->status === 'cancelled') {
                    // Reactivar reserva cancelada
                    $client->sessions()->updateExistingPivot($sessionId, [
                        'status' => 'reserved',
                        'reserved_at' => now(),
                        'cancelled_at' => null,
                    ]);
                    session()->flash('message', '¡Reserva reactivada exitosamente!');
                } else {
                    session()->flash('error', 'Ya tienes una reserva para esta clase.');
                    return;
                }
            } else {
                // Verificar capacidad disponible
                $currentReservations = $session->clients()
                    ->wherePivotIn('status', ['reserved', 'confirmed'])
                    ->count();

                if ($currentReservations >= $session->capacity) {
                    session()->flash('error', 'Esta clase está llena. No hay cupos disponibles.');
                    return;
                }

                // Crear nueva reserva
                $client->sessions()->attach($sessionId, [
                    'status' => 'reserved',
                    'attendance' => false,
                    'reserved_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                session()->flash('message', '¡Clase reservada exitosamente!');
            }

            $this->loadSessions();
            $this->loadUserReservations();

            // Emitir evento para actualizar estadísticas
            $this->emit('reservationUpdated');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al reservar la clase: ' . $e->getMessage());
        }
    }

    public function cancelReservation($sessionId)
    {
        try {
            $client = auth()->user()->client;

            if (!$client) {
                session()->flash('error', 'No tienes un perfil de cliente asociado.');
                return;
            }

            $reservation = $client->sessions()->where('session_id', $sessionId)->first();

            if (!$reservation) {
                session()->flash('error', 'No tienes una reserva para esta clase.');
                return;
            }

            if ($reservation->pivot->status === 'completed') {
                session()->flash('error', 'No puedes cancelar una clase ya completada.');
                return;
            }

            // Cancelar la reserva
            $client->sessions()->updateExistingPivot($sessionId, [
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);

            session()->flash('message', 'Reserva cancelada exitosamente.');
            $this->loadSessions();
            $this->loadUserReservations();

            // Emitir evento para actualizar estadísticas
            $this->emit('reservationUpdated');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al cancelar la reserva: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.dashboard.classes-list');
    }
}
