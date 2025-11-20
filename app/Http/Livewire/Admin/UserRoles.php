<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Administrator;
use App\Models\Trainer;
use App\Models\Client;
use App\Models\ClassType;

class UserRoles extends Component
{
    public $searchTerm = '';
    public $confirmingRoleChange = false;
    public $selectedUserId = null;
    public $newRole = null;
    public $selectedSpeciality = null;
    public $selectedYearsExperience = 0;
    public $showSpecialityModal = false;

    public function getUsers()
    {
        return User::where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('lastname', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('dni', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
            ->get();
    }

    public function getSpecialities()
    {
        return ClassType::all();
    }

    public function getUserRole($userId)
    {
        if (Administrator::where('user_id', $userId)->exists()) {
            return 'administrator';
        }
        if (Trainer::where('user_id', $userId)->exists()) {
            return 'trainer';
        }
        if (Client::where('user_id', $userId)->exists()) {
            return 'client';
        }
        return 'sin_rol';
    }

    public function confirmRoleChange($userId, $newRole)
    {
        $this->selectedUserId = $userId;
        $this->newRole = $newRole;
        
        // Si es entrenador, mostrar modal de especialidad
        if ($newRole === 'trainer') {
            $this->showSpecialityModal = true;
        } else {
            $this->confirmingRoleChange = true;
        }
    }

    public function selectSpeciality($specialityId)
    {
        $this->selectedSpeciality = $specialityId;
        $this->showSpecialityModal = false;
        $this->confirmingRoleChange = true;
    }

    public function confirmTrainerDetails()
    {
        if (!$this->selectedSpeciality) {
            return;
        }
        
        $this->showSpecialityModal = false;
        $this->confirmingRoleChange = true;
    }

    public function cancelRoleChange()
    {
        $this->confirmingRoleChange = false;
        $this->showSpecialityModal = false;
        $this->selectedUserId = null;
        $this->newRole = null;
        $this->selectedSpeciality = null;
        $this->selectedYearsExperience = 0;
    }

    public function changeUserRole()
    {
        if (!$this->selectedUserId || !$this->newRole) {
            return;
        }

        $user = User::find($this->selectedUserId);
        if (!$user) {
            $this->cancelRoleChange();
            return;
        }

        // Eliminar roles existentes
        Administrator::where('user_id', $this->selectedUserId)->delete();
        Trainer::where('user_id', $this->selectedUserId)->delete();
        Client::where('user_id', $this->selectedUserId)->delete();

        // Asignar nuevo rol
        if ($this->newRole === 'administrator') {
            Administrator::create(['user_id' => $this->selectedUserId]);
        } elseif ($this->newRole === 'trainer') {
            $speciality = ClassType::find($this->selectedSpeciality);
            Trainer::create([
                'user_id' => $this->selectedUserId,
                'speciality' => $speciality?->name ?? 'General',
                'years_of_experience' => $this->selectedYearsExperience ?? 0
            ]);
        } elseif ($this->newRole === 'client') {
            Client::create(['user_id' => $this->selectedUserId]);
        }

        $this->cancelRoleChange();
    }

    public function render()
    {
        return view('livewire.admin.user-roles', [
            'users' => $this->getUsers(),
            'specialities' => $this->getSpecialities(),
        ]);
    }
}
