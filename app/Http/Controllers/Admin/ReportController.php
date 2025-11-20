<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Support\Facades\View;

class ReportController extends Controller
{
    public function downloadMembershipReport()
    {
        // Obtener datos del reporte
        $report = $this->getMembershipReport();
        
        // Intentar generar PDF con dompdf
        if (class_exists('Dompdf\Dompdf')) {
            return $this->generatePDF($report);
        } else {
            // Si no está instalado dompdf, mostrar en pantalla
            return response()->json([
                'message' => 'DOMPDF no está instalado. Para descargar PDFs, ejecuta: composer require barryvdh/laravel-dompdf',
                'data' => $report
            ]);
        }
    }

    private function getMembershipReport()
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

    private function generatePDF($report)
    {
        $html = View::make('reports.membership-report', [
            'report' => $report['data'],
            'summary' => $report['summary']
        ])->render();
        
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        return $dompdf->download('membership-report-' . now()->format('Y-m-d-H-i-s') . '.pdf');
    }
}
