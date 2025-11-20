<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Sidebar extends Component
{
    public $currentSection = 'dashboard';

    public function changeSection($section)
    {
        $this->currentSection = $section;
        $this->emitTo('admin.dashboard', 'sectionChanged', $section);
    }

    public function render()
    {
        return view('livewire.admin.sidebar');
    }
}
