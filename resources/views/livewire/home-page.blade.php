<div class="min-h-screen bg-gray-50">
    <!-- Navigation Header -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-rose-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span class="text-xl font-bold text-gray-900">Pet Haven</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-rose-500 font-medium transition-colors">Shop</a>
                    <a href="#" class="text-gray-700 hover:text-rose-500 font-medium transition-colors">Services</a>
                    <a href="#" class="text-gray-700 hover:text-rose-500 font-medium transition-colors">Community</a>
                </div>

                <!-- Right Side Icons -->
                <div class="flex items-center space-x-4">
                    <!-- Search Icon (Desktop) -->
                    <button class="hidden md:block text-gray-600 hover:text-rose-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>

                    <!-- Cart -->
                    <a href="#" class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-gray-700 font-medium transition-colors">
                        Cart
                    </a>

                    <!-- User Icon -->
                    <button class="text-gray-600 hover:text-rose-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-gray-200 via-gray-300 to-gray-200 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="relative z-10 text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                    Welcome to Pet Haven
                </h1>
                <p class="text-lg md:text-xl text-gray-700 mb-8 max-w-3xl mx-auto">
                    Your one-stop shop for all your pet's needs. Explore our wide range of products and services.
                </p>
                <button class="bg-rose-500 hover:bg-rose-600 text-white font-semibold px-8 py-3 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200">
                    Shop Now
                </button>
            </div>

            <!-- Hero Image Placeholder (using gradient as background) -->
            <div class="absolute inset-0 flex items-center justify-center opacity-20">
                <div class="flex space-x-8">
                    <div class="w-64 h-64 bg-amber-400 rounded-full blur-3xl"></div>
                    <div class="w-64 h-64 bg-rose-400 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Bar Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        <div class="bg-rose-50 rounded-xl shadow-lg p-6">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search products" 
                    class="w-full pl-12 pr-4 py-4 bg-white border-0 rounded-lg focus:ring-2 focus:ring-rose-500 focus:outline-none text-gray-700 placeholder-gray-400"
                />
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if(count($featuredProducts) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($featuredProducts as $product)
                    @livewire('product-card', ['product' => $product], key($product->id))
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No products found</h3>
                <p class="text-gray-500">Try adjusting your search to find what you're looking for.</p>
            </div>
        @endif
    </section>
</div>
