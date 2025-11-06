@props(['title' => 'Dashboard', 'pageTitle' => 'Dashboard'])

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} - DANJER FITNESS</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-livewire.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap"
        rel="stylesheet">
    @livewireStyles
</head>

<body>
    <!-- Sidebar -->
    <livewire:dashboard.sidebar />

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="mobile-toggle" id="mobileToggle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <h1 class="page-title">{{ $pageTitle }}</h1>
            </div>
            <div class="header-right">
                <div class="user-info">
                    <div class="user-avatar">
                        <span>{{ substr(Auth::user()->name, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}</span>
                    </div>
                    <div class="user-details">
                        <span class="user-name">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                        <span class="user-role">Miembro</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
    <script src="{{ asset('js/dashboard-livewire.js') }}"></script>
    @stack('scripts')
</body>

</html>
