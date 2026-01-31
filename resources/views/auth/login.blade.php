<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <!-- Navigation Header -->
    <!-- Navigation Header -->
    @livewire('navigation-bar')

    <!-- Main Content - Centered Login Form -->
    <div class="min-h-[calc(100vh-73px)] flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-sm">
            <!-- Welcome Back Heading -->
            <h1 class="text-3xl font-bold text-gray-900 text-center mb-8">Welcome back</h1>
            
            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="text-sm text-red-600">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Status Message -->
            @session('status')
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <p class="text-sm text-green-600">{{ $value }}</p>
                </div>
            @endsession
            
            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="Email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                    />
                </div>
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900 mb-2">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                    />
                </div>
                
                <!-- Forgot Password Link -->
                @if (Route::has('password.request'))
                    <div class="text-left">
                        <a href="{{ route('password.request') }}" class="text-sm text-red-600 hover:text-red-700 transition underline">
                            Forgot password?
                        </a>
                    </div>
                @endif
                
                <!-- Login Button -->
                <button 
                    type="submit" 
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-sm"
                >
                    Log in
                </button>
                
                <!-- Create Account Link -->
                @if (Route::has('register'))
                    <div class="text-center pt-2">
                        <span class="text-sm text-gray-600">New to Pet Haven? </span>
                        <a href="{{ route('register') }}" class="text-sm text-red-600 hover:text-red-700 transition underline font-medium">
                            Create an account
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>
