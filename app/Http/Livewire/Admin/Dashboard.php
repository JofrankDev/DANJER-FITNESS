<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public $currentSection = 'dashboard';

    protected $listeners = ['sectionChanged'];

    public function sectionChanged($section)
    {
        $this->currentSection = $section;
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
