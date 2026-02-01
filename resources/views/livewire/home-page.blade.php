<div class="min-h-screen bg-gray-50">
    <!-- Navigation Header -->
    @livewire('navigation-bar')

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
                <a href="{{ route('shop') }}" class="inline-block bg-rose-500 hover:bg-rose-600 text-white font-semibold px-8 py-3 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200">
                    Shop Now
                </a>
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
    <x-footer />
</div>
