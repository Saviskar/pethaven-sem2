<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside class="w-64 bg-white border-r border-gray-200 flex-shrink-0 hidden md:flex md:flex-col">
                <div class="p-6">
                    <h1 class="text-lg font-semibold tracking-tight text-gray-900">Pet Supplies Co.</h1>
                </div>
                
                <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md group {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-red-500' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- Products -->
                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md group {{ request()->routeIs('admin.products.*') ? 'bg-red-50 text-red-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                         <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.products.*') ? 'text-red-500' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Products
                    </a>

                    <!-- Orders -->
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md group {{ request()->routeIs('admin.orders.*') ? 'bg-red-50 text-red-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.orders.*') ? 'text-red-500' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Orders
                    </a>

                    <!-- Customers -->
                    <!-- Customers -->
                     <a href="{{ route('admin.customers.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md group {{ request()->routeIs('admin.customers.*') ? 'bg-red-50 text-red-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.customers.*') ? 'text-red-500' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Customers
                    </a>

                    <!-- Promotions -->
                    <a href="{{ route('admin.promotions.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md group {{ request()->routeIs('admin.promotions.*') ? 'bg-red-50 text-red-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.promotions.*') ? 'text-red-500' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Promotions
                    </a>
                </nav>

                <div class="p-4 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-50 hover:text-gray-900 group">
                             <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out
                        </a>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                     @if (isset($header))
                        <div class="flex justify-between items-end mb-8">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $header }}</h1>
                            </div>
                            @if (isset($actions))
                                <div class="flex space-x-3">
                                    {{ $actions }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Flash Message -->
                    @if (session()->has('message'))
                        <div class="mb-4 p-4 rounded-md bg-green-50 text-green-700 border border-green-200">
                            {{ session('message') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>
