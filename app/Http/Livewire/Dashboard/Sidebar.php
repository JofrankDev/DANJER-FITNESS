<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Sidebar extends Component
{
    public $currentSection = 'dashboard';

    protected $listeners = ['sectionChanged' => 'updateSection'];

    public function updateSection($section)
    {
        $this->currentSection = $section;
    }

    public function changeSection($section)
    {
        $this->currentSection = $section;
        $this->emit('navigateTo', $section);
    }

    public function render()
    {
        return view('livewire.dashboard.sidebar');
    }
}
