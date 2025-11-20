<div>
    <div class="reports-container">
        <!-- Panel Principal -->
        <div class="reports-main">
            <div class="reports-header">
                <h2>Reportes del Sistema</h2>
            </div>

            <div class="reports-content">
                <h3 class="report-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="2" x2="12" y2="22"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Reporte de Membresías
                </h3>

                <p class="report-description">
                    Este reporte muestra estadísticas detalladas sobre los planes de membresía, 
                    incluyendo la cantidad de usuarios por plan y su estado (activo/inactivo).
                </p>

                @if(!$reportData || count($reportData) == 0)
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 5 7 13 17 13 17 5"></polyline>
                        </svg>
                        <p>No hay datos disponibles para generar el reporte</p>
                    </div>
                @else
                    <div class="reports-table-container">
                        <table class="reports-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plan</th>
                                    <th>Precio</th>
                                    <th>Total de Usuarios</th>
                                    <th>Usuarios Activos</th>
                                    <th>Usuarios Inactivos</th>
                                    <th>% Activos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reportData as $index => $report)
                                    <tr>
                                        <td>
                                            <span class="report-number">{{ $index + 1 }}</span>
                                        </td>
                                        <td>
                                            <strong class="plan-name">{{ $report['name'] }}</strong>
                                        </td>
                                        <td>
                                            <span class="price-badge">${{ number_format($report['price'], 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="total-badge">{{ $report['total_users'] }}</span>
                                        </td>
                                        <td>
                                            <span class="active-badge">{{ $report['active_users'] }}</span>
                                        </td>
                                        <td>
                                            <span class="inactive-badge">{{ $report['inactive_users'] }}</span>
                                        </td>
                                        <td>
                                            <div class="percentage-bar">
                                                <div class="percentage-fill" style="width: {{ $report['active_ratio'] }}%"></div>
                                                <span class="percentage-text">{{ $report['active_ratio'] }}%</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Resumen General -->
                    <div class="reports-summary">
                        <div class="summary-card">
                            <div class="summary-icon total">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"></path>
                                </svg>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Total de Planes</span>
                                <span class="summary-value">{{ count($reportData) }}</span>
                            </div>
                        </div>

                        <div class="summary-card">
                            <div class="summary-icon active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                </svg>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Total de Usuarios Activos</span>
                                <span class="summary-value">{{ $summary['active_users'] ?? 0 }}</span>
                            </div>
                        </div>

                        <div class="summary-card">
                            <div class="summary-icon inactive">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                </svg>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Total de Usuarios Inactivos</span>
                                <span class="summary-value">{{ $summary['inactive_users'] ?? 0 }}</span>
                            </div>
                        </div>

                        <div class="summary-card">
                            <div class="summary-icon users">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                </svg>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Total de Membresías</span>
                                <span class="summary-value">{{ $summary['total_memberships'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Panel Lateral: Opciones de Reporte -->
        <div class="reports-sidebar">
            <div class="report-options-card">
                <h3>Opciones de Reporte</h3>
                <p class="options-subtitle">Genera y descarga reportes en diferentes formatos</p>

                <div class="report-option">
                    <label class="option-label">
                        <input type="radio" wire:model.lazy="reportType" value="memberships" checked>
                        <span class="option-text">Reporte de Membresías</span>
                    </label>
                    <p class="option-description">Estadísticas de planes y usuarios</p>
                </div>

                <button class="btn btn-primary btn-block mt-4" 
                        wire:click="generateReport"
                        wire:loading.attr="disabled"
                        class="generate-report-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span wire:loading.remove>Generar Reporte</span>
                    <span wire:loading>Generando...</span>
                </button>

                <div class="help-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    Los reportes se descargarán en formato PDF
                </div>
            </div>
        </div>
    </div>
</div>
