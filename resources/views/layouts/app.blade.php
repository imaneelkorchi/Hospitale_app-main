<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .glass-sidebar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(226, 232, 240, 0.8);
        }
        .nav-link-active {
            background: linear-gradient(to right, rgba(6, 78, 59, 0.1), transparent);
            color: #064e3b;
            border-left: 4px solid #064e3b;
        }
    </style>
</head>
<body class="h-full font-sans antialiased text-slate-900">
    @auth
    <div class="flex h-full overflow-hidden">
        <!-- Sidebar -->
        <aside class="hidden md:flex md:flex-col w-72 glass-sidebar transition-all duration-300">
            <div class="flex flex-col flex-grow pt-6 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-6 mb-8">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-medical-primary text-white shadow-lg mr-3">
                        <i data-lucide="plus-circle" class="w-6 h-6"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-medical-primary">Zenith<span class="text-medical-secondary">Health</span></span>
                </div>

                <nav class="flex-1 px-4 space-y-1">
                    <p class="px-3 mb-2 text-xs font-semibold tracking-wider text-slate-400 uppercase">General</p>
                    
                    @if(auth()->user()->role === 'admin')
                        <x-nav-item href="{{ route('admin.dashboard') }}" icon="layout-dashboard" label="Dashboard" />
                        <x-nav-item href="{{ route('admin.doctors.index') }}" icon="users" label="Doctors" />
                        <x-nav-item href="{{ route('admin.invoices.index') }}" icon="credit-card" label="Invoices" />
                        <x-nav-item href="{{ route('patients.index') }}" icon="user-round" label="Patients" />
                        <x-nav-item href="{{ route('appointments.index') }}" icon="calendar" label="Appointments" />
                        <x-nav-item href="{{ route('medical_records.index') }}" icon="clipboard-list" label="Medical Records" />
                    @endif

                    @if(auth()->user()->role === 'medecin')
                        <x-nav-item href="{{ route('medecin.dashboard') }}" icon="layout-dashboard" label="Physician Dashboard" />
                        <x-nav-item href="{{ route('patients.index') }}" icon="user-round" label="My Patients" />
                        <x-nav-item href="{{ route('appointments.index') }}" icon="calendar" label="Schedule" />
                        <x-nav-item href="{{ route('medical_records.index') }}" icon="clipboard-list" label="Patient Records" />
                    @endif

                    @if(auth()->user()->role === 'patient')
                        <x-nav-item href="{{ route('patient.dashboard') }}" icon="home" label="My Health" />
                        <x-nav-item href="{{ route('patient.appointments.create') }}" icon="calendar-plus" label="Book Visit" />
                        <x-nav-item href="{{ route('patient.medical_records') }}" icon="history" label="My Records" />
                    @endif
                </nav>

                <div class="p-4 mt-auto">
                    <div class="p-4 rounded-2xl bg-slate-100 border border-slate-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-medical-primary font-bold mr-3 border border-slate-200">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ ucfirst(auth()->user()->role) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden relative">
            <!-- Topbar -->
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 h-20 flex items-center justify-between px-8 sticky top-0 z-10">
                <div class="flex items-center">
                    <button class="md:hidden p-2 rounded-lg hover:bg-slate-100 mr-4">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <h1 class="text-xl font-bold text-slate-800">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- <div class="hidden sm:flex items-center px-4 py-2 rounded-full bg-slate-100 border border-slate-200">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400 mr-2"></i>
                        <input type="text" placeholder="Search..." class="bg-transparent border-none focus:ring-0 text-sm w-48">
                    </div> -->
                    
                    <!-- <button class="p-2 rounded-full hover:bg-slate-100 relative">
                        <i data-lucide="bell" class="w-5 h-5 text-slate-600"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button> -->

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button class="flex items-center px-4 py-2 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto p-8 bg-slate-50/50">
                @if(session('success'))
                    <div class="mb-6 flex items-center p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
                        <i data-lucide="check-circle" class="w-5 h-5 mr-3 text-emerald-500"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 flex items-center p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
                        <i data-lucide="alert-circle" class="w-5 h-5 mr-3 text-red-500"></i>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="animate-in fade-in slide-in-from-bottom-4 duration-500">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    @else
        <div class="min-h-screen">
            @yield('content')
        </div>
    @endauth

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>

