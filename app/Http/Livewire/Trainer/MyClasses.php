<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Session;
use Carbon\Carbon;

class MyClasses extends Component
{
    public $filter = 'upcoming'; // upcoming, today, past, all
    public $classes = [];
    public $selectedClass = null;
    public $showStudentsModal = false;

    public function mount()
    {
        $this->loadClasses();
    }

    public function loadClasses()
    {
        $trainer = Auth::user()->trainer;

        if (!$trainer) {
            $this->classes = [];
            return;
        }

        $query = $trainer->sessions()
            ->with(['clients.user', 'room', 'classType'])
            ->orderBy('date')
            ->orderBy('start_datetime');

        switch ($this->filter) {
            case 'upcoming':
                $query->where('date', '>', Carbon::today())
                      ->where('status', 'scheduled');
                break;
            case 'today':
                $query->whereDate('date', Carbon::today());
                break;
            case 'past':
                $query->where('date', '<', Carbon::today());
                break;
            case 'all':
                // No filter
                break;
        }

        $this->classes = $query->get();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->loadClasses();
    }

    public function viewStudents($sessionId)
    {
        $this->selectedClass = Session::with(['clients.user', 'classType', 'room'])
            ->findOrFail($sessionId);
        $this->showStudentsModal = true;
    }

    public function closeModal()
    {
        $this->showStudentsModal = false;
        $this->selectedClass = null;
    }

    public function toggleAttendance($sessionId, $clientId)
    {
        $session = Session::findOrFail($sessionId);
        $client = $session->clients()->where('client_id', $clientId)->first();

        if ($client) {
            $newAttendance = !$client->pivot->attendance;
            $session->clients()->updateExistingPivot($clientId, [
                'attendance' => $newAttendance,
            ]);

            session()->flash('message', 'Asistencia actualizada correctamente.');
            $this->loadClasses();

            if ($this->selectedClass && $this->selectedClass->id == $sessionId) {
                $this->selectedClass = Session::with(['clients.user', 'classType', 'room'])
                    ->findOrFail($sessionId);
            }

            $this->emit('classUpdated');
        }
    }

    public function render()
    {
        return view('livewire.trainer.my-classes');
    }
}
