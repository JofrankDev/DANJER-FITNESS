<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Plan;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Support\Facades\View;

class Reports extends Component
{
    public $reportType = 'memberships';
    public $generatingReport = false;

    public function getMembershipReport()
    {
        $plans = Plan::with('memberships.client.user')->get();
        
        $reportData = [];
        $totalActiveUsers = 0;
        $totalInactiveUsers = 0;
        $totalMemberships = 0;
        
        foreach ($plans as $plan) {
            $totalMembers = $plan->memberships()->count();
            $activeMembers = $plan->memberships()->where('status', 1)->count();
            $inactiveMembers = $totalMembers - $activeMembers;
            
            $activeRatio = $totalMembers > 0 ? round(($activeMembers / $totalMembers) * 100) : 0;
            
            $reportData[] = [
                'id' => $plan->id,
                'name' => $plan->type,
                'price' => $plan->price,
                'total_users' => $totalMembers,
                'active_users' => $activeMembers,
                'inactive_users' => $inactiveMembers,
                'active_ratio' => $activeRatio,
            ];
            
            $totalActiveUsers += $activeMembers;
            $totalInactiveUsers += $inactiveMembers;
            $totalMemberships += $totalMembers;
        }
        
        return [
            'data' => $reportData,
            'summary' => [
                'active_users' => $totalActiveUsers,
                'inactive_users' => $totalInactiveUsers,
                'total_memberships' => $totalMemberships,
            ]
        ];
    }

    public function generateReport()
    {
        // Método vacío - el botón no hace nada
    }

    public function render()
    {
        $report = $this->getMembershipReport();
        
        return view('livewire.admin.reports', [
            'reportData' => $report['data'],
            'summary' => $report['summary'],
        ]);
    }
}

