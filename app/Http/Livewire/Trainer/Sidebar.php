<?php

namespace App\Http\Livewire\Trainer;

use Livewire\Component;

class Sidebar extends Component
{
    public $currentSection = 'dashboard';

    protected $listeners = ['sectionChanged' => 'updateSection'];

    public function changeSection($section)
    {
        $this->currentSection = $section;
        $this->emit('navigateTo', $section);
    }

    public function updateSection($section)
    {
        $this->currentSection = $section;
    }

    public function render()
    {
        return view('livewire.trainer.sidebar');
    }
}
