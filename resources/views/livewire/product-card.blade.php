<div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
    <!-- Product Image -->
    <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
        @if($product->image_url)
            <img 
                src="{{ $product->image_url }}" 
                alt="{{ $product->name }}" 
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
            />
        @else
            <!-- Placeholder if no image -->
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-20 h-20 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
        @endif
    </div>

    <!-- Product Details -->
    <div class="p-5">
        <!-- Category Badge -->
        <div class="mb-3">
            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
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
                {{ $product->category->name }}
            </span>
        </div>

        <!-- Product Name -->
        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-rose-600 transition-colors">
            {{ $product->name }}
        </h3>

        <!-- Product Description -->
        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
            {{ $product->description }}
        </p>

        <!-- Price and Stock -->
        <div class="flex items-center justify-between">
            <div>
                <span class="text-2xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
            </div>
            
            @if($product->stock > 0)
                <span class="text-xs text-green-600 font-medium">
                    {{ $product->stock }} in stock
                </span>
            @else
                <span class="text-xs text-red-600 font-medium">
                    Out of stock
                </span>
            @endif
        </div>

        <!-- Add to Cart Button -->
        <button class="mt-4 w-full bg-rose-500 hover:bg-rose-600 text-white font-semibold py-3 rounded-lg transition-colors duration-200 transform hover:scale-105">
            Add to Cart
        </button>
    </div>
</div>
