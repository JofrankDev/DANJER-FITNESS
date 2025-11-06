<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $name;
    public $lastname;
    public $email;
    public $phone;
    public $dni;
    public $editMode = false;
    public $reservedClasses = []; // Clases reservadas del usuario autenticado

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->dni = $user->dni;
        // Cargar clases reservadas al inicializar el componente
    }

    public function toggleEdit()
    {
        $this->editMode = !$this->editMode;

        if (!$this->editMode) {
            // Si salimos del modo edición sin guardar, restauramos los valores
            $this->mount();
        }
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'dni' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'phone' => $this->phone,
            'dni' => $this->dni,
        ]);

        $this->editMode = false;
        session()->flash('message', 'Perfil actualizado exitosamente!');
    }




    public function render()
    {
        return view('livewire.dashboard.profile');
    }
}
