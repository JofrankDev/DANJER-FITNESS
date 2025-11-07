<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class Students extends Component
{
    public $students = [];
    public $searchTerm = '';

    public function mount()
    {
        $this->loadStudents();
    }

    public function loadStudents()
    {
        $trainer = Auth::user()->trainer;

        if (!$trainer) {
            $this->students = [];
            return;
        }

        // Obtener todos los IDs de sesiones del entrenador
        $sessionIds = $trainer->sessions()->pluck('id')->toArray();

        if (empty($sessionIds)) {
            $this->students = [];
            return;
        }

        $query = Client::with('user')
            ->whereHas('sessions', function ($q) use ($sessionIds) {
                $q->whereIn('sessions.id', $sessionIds);
            })
            ->withCount([
                'sessions as classes_taken' => function ($q) use ($sessionIds) {
                    $q->whereIn('sessions.id', $sessionIds)
                      ->where('client_sessions.attendance', true);
                },
                'sessions as classes_reserved' => function ($q) use ($sessionIds) {
                    $q->whereIn('sessions.id', $sessionIds)
                      ->whereIn('client_sessions.status', ['reserved', 'confirmed']);
                }
            ]);

        if ($this->searchTerm) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('lastname', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            });
        }

        $this->students = $query->get();
    }

    public function updatedSearchTerm()
    {
        $this->loadStudents();
    }

    public function render()
    {
        return view('livewire.trainer.students');
    }
}
