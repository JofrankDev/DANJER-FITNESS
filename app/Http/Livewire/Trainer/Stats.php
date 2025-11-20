<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Stats extends Component
{
    public $scheduledClasses = 0;
    public $totalStudents = 0;
    public $todayClasses = 0;
    public $completedClasses = 0;

    protected $listeners = ['classUpdated' => 'loadStats'];

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $trainer = Auth::user()->trainer;

        if ($trainer) {
            // Clases programadas (futuras)
            $this->scheduledClasses = $trainer->sessions()
                ->where('date', '>=', Carbon::now()->toDateString())
                ->where('status', 'scheduled')
                ->count();

            // Total de estudiantes únicos que han tomado sus clases
            $this->totalStudents = $trainer->sessions()
                ->with('clients')
                ->get()
                ->pluck('clients')
                ->flatten()
                ->unique('id')
                ->count();

            // Clases de hoy
            $this->todayClasses = $trainer->sessions()
                ->whereDate('date', Carbon::today())
                ->count();

            // Clases completadas
            $this->completedClasses = $trainer->sessions()
                ->where('status', 'completed')
                ->count();
        }
    }

    public function render()
    {
        return view('livewire.trainer.stats');
    }
}
