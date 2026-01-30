<div class="min-h-screen bg-gray-50">
    <!-- Navigation Header -->
    @livewire('navigation-bar')

    <!-- Product Detail Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ $backUrl }}" class="inline-flex items-center text-gray-600 hover:text-rose-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Products
            </a>
        </div>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Product Content -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                <!-- Product Image -->
                <div class="relative">
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl overflow-hidden">
                        @if($product->image_url)
                            <img 
                                src="{{ $product->image_url }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-cover"
                            />
                        @else
                            <!-- Placeholder if no image -->
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-32 h-32 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Information -->
                <div class="flex flex-col">
                    <!-- Product Name -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        {{ $product->name }}
                    </h1>

                    <!-- Rating and Reviews -->
                    <div class="flex items-center mb-4">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= 4)
                                    <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                @elseif($i == 5)
                                    <svg class="w-5 h-5 text-amber-400" viewBox="0 0 24 24">
                                        <defs>
                                            <linearGradient id="half-star">
                                                <stop offset="50%" stop-color="#FBBF24"/>
                                                <stop offset="50%" stop-color="#D1D5DB"/>
                                            </linearGradient>
                                        </defs>
                                        <path fill="url(#half-star)" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <span class="ml-2 text-sm text-gray-600">4.5 • 120 reviews</span>
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-900">LKR {{ number_format($product->price, 2) }}</span>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <p class="text-gray-700 leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Category Badge -->
                    <div class="mb-6">
                        <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full
                            @if(str_contains(strtolower($product->category->name), 'dog'))
                                bg-amber-100 text-amber-800
                            @elseif(str_contains(strtolower($product->category->name), 'cat'))
                                bg-teal-100 text-teal-800
                            @elseif(str_contains(strtolower($product->category->name), 'food'))
                                bg-green-100 text-green-800
                            @elseif(str_contains(strtolower($product->category->name), 'toy'))
                                bg-purple-100 text-purple-800
                            @elseif(str_contains(strtolower($product->category->name), 'grooming'))
                                bg-pink-100 text-pink-800
                            @else
                                bg-blue-100 text-blue-800
                            @endif
                        ">
                            Category: {{ $product->category->name }}
                        </span>
                    </div>

                    <!-- Stock Status -->
                    <div class="mb-6">
                        @if($product->stock > 0)
                            <div class="flex items-center text-green-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold">In Stock ({{ $product->stock }} available)</span>
                            </div>
                        @else
                            <div class="flex items-center text-red-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold">Out of Stock</span>
                            </div>
                        @endif
                    </div>

                    <!-- Quantity Selector -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Quantity</label>
                        <div class="flex items-center gap-3">
                            <!-- Decrement Button -->
                            <button 
                                wire:click="decrementQuantity"
                                @if($quantity <= 1 || $product->stock <= 0) disabled @endif
                                class="w-10 h-10 rounded-lg bg-gradient-to-br from-white to-gray-50 border-2 border-gray-200 hover:border-rose-400 hover:from-rose-50 hover:to-rose-100 disabled:border-gray-200 disabled:cursor-not-allowed disabled:from-gray-100 disabled:to-gray-100 shadow-sm hover:shadow-md disabled:shadow-none transition-all duration-300 flex items-center justify-center group transform hover:scale-105 active:scale-95"
                            >
                                <svg class="w-5 h-5 text-gray-600 group-hover:text-rose-600 group-disabled:text-gray-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/>
                                </svg>
                            </button>

                            <!-- Quantity Display -->
                            <div class="relative">
                                <input 
                                    type="text" 
                                    value="{{ $quantity }}" 
                                    readonly
                                    class="w-16 h-10 text-center text-xl font-bold text-gray-900 bg-gradient-to-b from-white to-gray-50 border-2 border-gray-200 rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-rose-400 focus:border-rose-400 transition-all duration-200"
                                />
                            </div>

                            <!-- Increment Button -->
                            <button 
                                wire:click="incrementQuantity"
                                @if($quantity >= $product->stock || $product->stock <= 0) disabled @endif
                                class="w-10 h-10 rounded-lg bg-rose-500 hover:bg-rose-600 disabled:bg-gray-300 disabled:cursor-not-allowed shadow-md hover:shadow-lg disabled:shadow-sm transition-all duration-300 flex items-center justify-center group transform hover:scale-105 active:scale-95"
                            >
                                <svg class="w-6 h-6 text-white group-disabled:text-gray-600 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                        
                        @if($product->stock > 0)
                            <p class="text-xs text-gray-500 mt-2.5 flex items-center">
                                <svg class="w-3 h-3 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ $product->stock }} available
                            </p>
                        @endif
                    </div>

                    <!-- Add to Cart Button -->
                    <div class="mt-auto">
                        <button 
                            wire:click="addToCart"
                            @if($product->stock <= 0) disabled @endif
                            class="w-full bg-rose-500 hover:bg-rose-600 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-bold py-4 px-8 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200 text-lg"
                        >
                            @if($product->stock > 0)
                                Add to Cart
                            @else
                                Out of Stock
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
