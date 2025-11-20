<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Client;
use App\Models\Membership;
use App\Models\Plan;

class MembershipManagement extends Component
{
    public $searchTerm = '';
    public $confirmingMembershipChange = false;
    public $selectedClientId = null;
    public $selectedPlanId = null;
    public $membershipStatus = 'active';
    public $currentMembership = null;

    // Panel para crear nuevo plan
    public $showCreatePlanModal = false;
    public $newPlanType = '';
    public $newPlanPrice = '';
    public $newPlanDescription = '';

    public function getClients()
    {
        return User::whereHas('client')
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('lastname', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('dni', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            })
            ->get();
    }

    public function getPlans()
    {
        return Plan::all();
    }

    public function getMembershipStatus($clientId)
    {
        $membership = Client::find($clientId)?->memberships()->latest()->first();
        return $membership ? $membership->status : 'sin_membresía';
    }

    public function getUserMembership($userId)
    {
        $client = User::find($userId)?->client;
        return $client?->memberships()->latest()->first();
    }

    public function getUserClient($userId)
    {
        return User::find($userId)?->client;
    }

    public function confirmMembershipChange($clientId)
    {
        $this->selectedClientId = $clientId;
        $client = Client::find($clientId);
        $this->currentMembership = $client?->memberships()->latest()->first();
        
        if ($this->currentMembership) {
            $this->selectedPlanId = $this->currentMembership->plan_id;
            $this->membershipStatus = $this->currentMembership->status ? 'active' : 'inactive';
        }
        
        $this->confirmingMembershipChange = true;
    }

    public function saveMembership()
    {
        if (!$this->selectedClientId) {
            return;
        }

        $client = Client::find($this->selectedClientId);

        if ($this->selectedPlanId) {
            // Actualizar o crear membresía
            $membership = $client->memberships()->latest()->first();
            
            $status = $this->membershipStatus === 'active' ? 1 : 0;
            
            if ($membership) {
                $membership->update([
                    'plan_id' => $this->selectedPlanId,
                    'status' => $status,
                ]);
            } else {
                Membership::create([
                    'client_id' => $this->selectedClientId,
                    'plan_id' => $this->selectedPlanId,
                    'status' => $status,
                ]);
            }
        } else {
            // Quitar membresía (si existe)
            $membership = $client->memberships()->latest()->first();
            if ($membership) {
                $membership->delete();
            }
        }

        $this->cancelMembershipChange();
    }

    public function removeMembership($clientId)
    {
        $client = Client::find($clientId);
        $membership = $client->memberships()->latest()->first();
        
        if ($membership) {
            $membership->delete();
        }
    }

    public function cancelMembershipChange()
    {
        $this->confirmingMembershipChange = false;
        $this->selectedClientId = null;
        $this->selectedPlanId = null;
        $this->membershipStatus = 'active';
        $this->currentMembership = null;
    }

    public function openCreatePlanModal()
    {
        $this->showCreatePlanModal = true;
    }

    public function closeCreatePlanModal()
    {
        $this->showCreatePlanModal = false;
        $this->newPlanType = '';
        $this->newPlanPrice = '';
        $this->newPlanDescription = '';
    }

    public function createPlan()
    {
        $this->validate([
            'newPlanType' => 'required|string|max:255',
            'newPlanPrice' => 'required|numeric|min:0',
            'newPlanDescription' => 'nullable|string',
        ]);

        Plan::create([
            'type' => $this->newPlanType,
            'price' => $this->newPlanPrice,
            'description' => $this->newPlanDescription,
        ]);

        $this->closeCreatePlanModal();
    }

    public function deletePlan($planId)
    {
        Plan::find($planId)?->delete();
    }

    public function render()
    {
        return view('livewire.admin.membership-management', [
            'clients' => $this->getClients(),
            'plans' => $this->getPlans(),
        ]);
    }
}
