<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Membership Report - DANJER FITNESS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background: white;
        }
        
        .container {
            padding: 20px;
            max-width: 100%;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1e3c72;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #1e3c72;
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #666;
            font-size: 12px;
        }
        
        .summary-section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .summary-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-left: 4px solid #1e3c72;
            padding: 15px;
            page-break-inside: avoid;
        }
        
        .summary-card h3 {
            color: #1e3c72;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        
        .summary-card .value {
            font-size: 28px;
            font-weight: bold;
            color: #1e3c72;
        }
        
        .summary-card .subtitle {
            font-size: 11px;
            color: #666;
            margin-top: 5px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            page-break-inside: avoid;
        }
        
        thead {
            background-color: #1e3c72;
            color: white;
        }
        
        th {
            padding: 12px;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
        }
        
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #dee2e6;
            font-size: 11px;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .percentage-bar {
            background-color: #e9ecef;
            height: 20px;
            border-radius: 3px;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .percentage-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
            font-weight: bold;
            transition: width 0.3s ease;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #1e3c72;
            text-align: center;
            color: #666;
            font-size: 11px;
        }
        
        .generated-date {
            margin-bottom: 10px;
        }
        
        @page {
            margin: 20px;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>DANJER FITNESS - Membership Report</h1>
            <p>Generated on {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>
        </div>
        
        <div class="summary-section">
            <div class="summary-grid">
                <div class="summary-card">
                    <h3>Total Plans</h3>
                    <div class="value">{{ count($report) }}</div>
                </div>
                <div class="summary-card">
                    <h3>Active Users</h3>
                    <div class="value">{{ $summary['active_users'] ?? 0 }}</div>
                </div>
                <div class="summary-card">
                    <h3>Inactive Users</h3>
                    <div class="value">{{ $summary['inactive_users'] ?? 0 }}</div>
                </div>
                <div class="summary-card">
                    <h3>Total Memberships</h3>
                    <div class="value">{{ $summary['total_memberships'] ?? 0 }}</div>
                </div>
            </div>
        </div>
        
        <div class="summary-section">
            <table>
                <thead>
                    <tr>
                        <th>Plan Name</th>
                        <th>Price</th>
                        <th>Total Users</th>
                        <th>Active</th>
                        <th>Inactive</th>
                        <th>Active Ratio</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($report as $plan)
                        <tr>
                            <td><strong>{{ $plan['name'] ?? 'N/A' }}</strong></td>
                            <td>${{ number_format($plan['price'] ?? 0, 2) }}</td>
                            <td>{{ $plan['total_users'] ?? 0 }}</td>
                            <td><span class="badge badge-success">{{ $plan['active_users'] ?? 0 }}</span></td>
                            <td><span class="badge badge-danger">{{ $plan['inactive_users'] ?? 0 }}</span></td>
                            <td>
                                <div class="percentage-bar">
                                    <div class="percentage-bar-fill" style="width: {{ $plan['active_ratio'] ?? 0 }}%">
                                        {{ round($plan['active_ratio'] ?? 0) }}%
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #999;">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <div class="generated-date">
                <strong>Report Generated:</strong> {{ \Carbon\Carbon::now()->format('F j, Y \a\t g:i A') }}
            </div>
            <p>&copy; 2024 DANJER FITNESS. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
