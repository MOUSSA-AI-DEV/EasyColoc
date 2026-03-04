<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyColoc') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        /* Custom scrollbar for modern feel */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">
    <!-- Left Sidebar -->
    <aside
        class="w-72 bg-white/70 backdrop-blur-xl border-r border-slate-200/60 flex flex-col justify-between hidden lg:flex shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20">
        <div>
            <!-- Logo Section -->
            <div class="h-24 flex items-center px-8 border-b border-slate-100">
                <div
                    class="relative flex items-center justify-center w-10 h-10 mr-4 rounded-xl shadow-lg bg-gradient-to-br from-emerald-500 via-teal-500 to-green-500 overflow-hidden group">
                    <div class="absolute inset-0 bg-white/20 group-hover:bg-transparent transition-colors duration-300">
                    </div>
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5">
                        </path>
                    </svg>
                </div>
                <!-- Ballet of Colors Branding -->
                <div class="flex flex-col">
                    <span
                        class="text-2xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-lime-600">
                        EasyColoc
                    </span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-5 space-y-2.5 mt-2">
                <p class="px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Main Menu</p>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3.5 bg-gradient-to-r from-emerald-50 to-teal-50 text-teal-700 rounded-2xl font-semibold transition-all shadow-[0_4px_12px_rgba(236,72,153,0.08)] border border-emerald-100/50">
                    <div class="p-1.5 mr-3 bg-white rounded-lg shadow-sm text-emerald-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </div>
                    Dashboard
                </a>

                <a href="{{ route('colocations.index') }}"
                    class="flex items-center px-4 py-3.5 text-slate-500 hover:bg-slate-50 hover:text-slate-800 rounded-2xl font-medium transition-all group">
                    <div
                        class="p-1.5 mr-3 rounded-lg text-slate-400 group-hover:bg-white group-hover:text-blue-500 group-hover:shadow-sm transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    Colocations
                </a>

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3.5 text-slate-500 hover:bg-slate-50 hover:text-slate-800 rounded-2xl font-medium transition-all group">
                        <div
                            class="p-1.5 mr-3 rounded-lg text-slate-400 group-hover:bg-white group-hover:text-blue-500 group-hover:shadow-sm transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        Administration
                    </a>
                @endif
            </nav>
        </div>

        <!-- User Profile (Bottom) -->
        <div class="p-6 border-t border-slate-100 bg-gradient-to-b from-transparent to-slate-50/50">
            <div class="flex items-center p-3 rounded-2xl hover:bg-white hover:shadow-md transition-all cursor-pointer">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(substr(auth()->user()->name, 0, 1)) }}&background=10b981&color=fff&font-size=0.35&bold=true"
                        alt="{{ auth()->user()->name }}"
                        class="w-11 h-11 rounded-xl shadow-sm border-2 border-white object-cover">
                    <div
                        class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full">
                    </div>
                </div>
                <div class="ml-3 flex-1 overflow-hidden">
                    <p class="text-sm font-bold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate font-medium">{{ auth()->user()->reputation ?? 0 }}
                        Reputation</p>
                </div>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4">
                    </path>
                </svg>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

        <!-- Abstract Background Elements -->
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-20 transform translate-x-1/3 -translate-y-1/3 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-teal-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-20 transform -translate-x-1/3 translate-y-1/3 pointer-events-none">
        </div>

        <!-- Top Header -->
        <header
            class="h-24 bg-white/60 backdrop-blur-xl border-b border-slate-200/60 flex items-center justify-between px-8 lg:px-10 z-10 sticky top-0">
            <div class="flex items-center">
                <!-- Mobile menu button -->
                <button class="lg:hidden p-2 mr-4 text-slate-500 hover:bg-slate-100 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <div>
                    <h1 class="text-2xl font-bold text-slate-800">@yield('title', 'Dashboard')</h1>
                </div>
            </div>

            <div class="flex items-center gap-5">
                @if (!auth()->user()->activeColocation())
                    <a href="{{ route('colocations.create') }}"
                        class="hidden sm:flex items-center px-5 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-bold hover:shadow-md hover:border-emerald-200 transition-all group">
                        <svg class="w-4 h-4 mr-2 text-emerald-500 group-hover:rotate-90 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Create Colocation
                    </a>
                @endif

                <div class="h-8 w-px bg-slate-200"></div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') ?? '#' }}" class="m-0">
                    @csrf
                    <button type="submit"
                        class="group flex items-center px-6 py-2.5 rounded-xl text-sm font-bold text-white shadow-lg shadow-emerald-500/25 transition-all hover:shadow-emerald-500/40 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                        style="background: linear-gradient(135deg, #f43f5e, #8b5cf6, #3b82f6); background-size: 200% 200%; animate: gradient 5s ease infinite;">
                        <span>Logout</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Scrollable Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-8 lg:p-10 relative z-0">
            <div class="max-w-7xl mx-auto space-y-10">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                {{ $slot }}
            </div>

            <!-- Footer spacing -->
            <div class="h-10"></div>
        </main>
    </div>
</body>

</html>
