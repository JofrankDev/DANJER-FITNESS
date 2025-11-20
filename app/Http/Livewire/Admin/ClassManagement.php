<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Session;
use App\Models\Trainer;
use App\Models\Room;
use App\Models\ClassType;

class ClassManagement extends Component
{
    public $searchTerm = '';
    public $showCreateModal = false;
    public $confirmingDelete = false;
    public $selectedSessionId = null;

    // Formulario
    public $trainerId = '';
    public $roomId = '';
    public $classTypeId = '';
    public $sessionName = '';
    public $sessionDescription = '';
    public $capacity = '';
    public $startDatetime = '';
    public $durationMinutes = '';
    public $status = 'scheduled';

    public function getSessions()
    {
        return Session::where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
            ->orWhereHas('trainer', function($query) {
                $query->whereHas('user', function($q) {
                    $q->where('name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('lastname', 'like', '%' . $this->searchTerm . '%');
                });
            })
            ->get();
    }

    public function getTrainers()
    {
        return Trainer::with('user')->get();
    }

    public function getRooms()
    {
        return Room::all();
    }

    public function getClassTypes()
    {
        return ClassType::all();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = false;
    }

    public function resetForm()
    {
        $this->trainerId = '';
        $this->roomId = '';
        $this->classTypeId = '';
        $this->sessionName = '';
        $this->sessionDescription = '';
        $this->capacity = '';
        $this->startDatetime = '';
        $this->durationMinutes = '';
        $this->status = 'scheduled';
    }

    public function createSession()
    {
        $this->validate([
            'trainerId' => 'required|exists:trainers,id',
            'roomId' => 'required|exists:rooms,id',
            'classTypeId' => 'required|exists:class_types,id',
            'sessionName' => 'required|string|max:255',
            'capacity' => 'required|numeric|min:1',
            'startDatetime' => 'required|date_format:Y-m-d\TH:i',
            'durationMinutes' => 'required|numeric|min:1',
        ]);

        // Dividir el datetime en date (Y-m-d) y start_datetime (H:i)
        $dateTime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $this->startDatetime);
        
        Session::create([
            'trainer_id' => $this->trainerId,
            'room_id' => $this->roomId,
            'class_type_id' => $this->classTypeId,
            'name' => $this->sessionName,
            'description' => $this->sessionDescription,
            'capacity' => $this->capacity,
            'date' => $dateTime->format('Y-m-d'),
            'start_datetime' => $dateTime->format('H:i'),
            'duration_minutes' => $this->durationMinutes,
            'status' => $this->status,
        ]);

        $this->closeCreateModal();
    }

    public function editSession($sessionId)
    {
        $session = Session::find($sessionId);
        if ($session) {
            $this->selectedSessionId = $sessionId;
            $this->trainerId = $session->trainer_id;
            $this->roomId = $session->room_id;
            $this->classTypeId = $session->class_type_id;
            $this->sessionName = $session->name;
            $this->sessionDescription = $session->description;
            $this->capacity = $session->capacity;
            
            // Obtener la fecha como string y formatearla
            $date = $session->date instanceof \Carbon\Carbon ? $session->date->format('Y-m-d') : $session->date;
            // Obtener la hora, eliminando segundos si los hay
            $time = is_string($session->start_datetime) ? substr($session->start_datetime, 0, 5) : $session->start_datetime;
            
            $this->startDatetime = $date . 'T' . $time;
            $this->durationMinutes = $session->duration_minutes;
            $this->status = $session->status;
            $this->showCreateModal = true;
        }
    }

    public function updateSession()
    {
        $this->validate([
            'trainerId' => 'required|exists:trainers,id',
            'roomId' => 'required|exists:rooms,id',
            'classTypeId' => 'required|exists:class_types,id',
            'sessionName' => 'required|string|max:255',
            'capacity' => 'required|numeric|min:1',
            'startDatetime' => 'required|date_format:Y-m-d\TH:i',
            'durationMinutes' => 'required|numeric|min:1',
        ]);

        $session = Session::find($this->selectedSessionId);
        if ($session) {
            // Dividir el datetime en date (Y-m-d) y start_datetime (H:i)
            $dateTime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $this->startDatetime);
            
            $session->update([
                'trainer_id' => $this->trainerId,
                'room_id' => $this->roomId,
                'class_type_id' => $this->classTypeId,
                'name' => $this->sessionName,
                'description' => $this->sessionDescription,
                'capacity' => $this->capacity,
                'date' => $dateTime->format('Y-m-d'),
                'start_datetime' => $dateTime->format('H:i'),
                'duration_minutes' => $this->durationMinutes,
                'status' => $this->status,
            ]);
        }

        $this->closeCreateModal();
    }

    public function confirmDelete($sessionId)
    {
        $this->selectedSessionId = $sessionId;
        $this->confirmingDelete = true;
    }

    public function deleteSession()
    {
        Session::find($this->selectedSessionId)?->delete();
        $this->confirmingDelete = false;
        $this->selectedSessionId = null;
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = false;
        $this->selectedSessionId = null;
    }

    public function render()
    {
        return view('livewire.admin.class-management', [
            'sessions' => $this->getSessions(),
            'trainers' => $this->getTrainers(),
            'rooms' => $this->getRooms(),
            'classTypes' => $this->getClassTypes(),
        ]);
    }
}

