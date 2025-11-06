<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Trainer;

class TrainersList extends Component
{
    public $trainers = [];

    public function mount()
    {
        $this->trainers = Trainer::with('user')->get();
    }

    public function render()
    {
        return view('livewire.dashboard.trainers-list');
    }
}
