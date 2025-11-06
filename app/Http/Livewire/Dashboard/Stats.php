<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Stats extends Component
{
    public $reservedClasses = 0;
    public $completedClasses = 0;
    public $monthlyClasses = 0;
    public $currentPlan = 'Sin plan';

    protected $listeners = ['reservationUpdated' => 'loadStats'];

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $user = Auth::user();
        $client = $user->client;

        if ($client) {
            // Clases reservadas (estados: reserved o confirmed)
            $this->reservedClasses = $client->sessions()
                ->wherePivotIn('status', ['reserved', 'confirmed'])
                ->count();

            // Clases completadas (estado: completed y asistencia verdadera)
            $this->completedClasses = $client->sessions()
                ->wherePivot('status', 'completed')
                ->wherePivot('attendance', true)
                ->count();

            // Clases de este mes (reservadas o completadas)
            $this->monthlyClasses = $client->sessions()
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->wherePivotIn('status', ['reserved', 'confirmed', 'completed'])
                ->count();

            // Plan actual (obtener la membresía activa más reciente)
            $activeMembership = $client->memberships()
                ->where('status', 'active')
                ->latest()
                ->first();

            if ($activeMembership && $activeMembership->plan) {
                $this->currentPlan = $activeMembership->plan->name;
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.stats');
    }
}
