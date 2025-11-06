<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Plan;

class Plans extends Component
{
    public $plans = [];
    public $currentPlan = 'Básico';

    public function mount()
    {
        $this->plans = Plan::all();
        // Aquí cargarías el plan actual del usuario autenticado
        $this->currentPlan = 'Básico';
    }

    public function changePlan($planId)
    {
        // Aquí implementarás la lógica de cambio de plan
        session()->flash('message', 'Plan cambiado exitosamente!');
    }

    public function render()
    {
        return view('livewire.dashboard.plans');
    }
}
