<nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-rose-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <span class="text-xl font-bold text-gray-900">Pet Haven</span>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('shop') }}" class="text-gray-700 hover:text-rose-500 font-medium transition-colors">Shop</a>
                <a href="#" class="text-gray-700 hover:text-rose-500 font-medium transition-colors">Services</a>
                <a href="#" class="text-gray-700 hover:text-rose-500 font-medium transition-colors">Community</a>
            </div>

            <!-- Right Side Icons -->
            <div class="flex items-center space-x-4">
                <!-- Hamburger Menu Button (Mobile) -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-600 hover:text-rose-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Cart -->
                <a href="{{ route('cart') }}" class="hidden sm:block relative bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-gray-700 font-medium transition-colors">
                    Cart
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-rose-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- User Icon -->
                <button class="hidden sm:block text-gray-600 hover:text-rose-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="md:hidden border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('shop') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-rose-500 hover:bg-gray-50 transition-colors">Shop</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-rose-500 hover:bg-gray-50 transition-colors">Services</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-rose-500 hover:bg-gray-50 transition-colors">Community</a>
                
                <!-- Mobile Cart & User Links -->
                <div class="sm:hidden pt-2 border-t border-gray-200 space-y-1">
                    <a href="{{ route('cart') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-rose-500 hover:bg-gray-50 transition-colors">
                        Cart
                        @if($cartCount > 0)
                            <span class="ml-2 bg-rose-500 text-white text-xs font-bold rounded-full px-2 py-1">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-rose-500 hover:bg-gray-50 transition-colors">Profile</a>
                </div>
            </div>
        </div>
    </div>
</nav>
