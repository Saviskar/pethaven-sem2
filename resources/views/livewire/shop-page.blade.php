<div>
    {{-- Include Navigation Bar Component --}}
    <livewire:navigation-bar />

    {{-- Main Content --}}
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            {{-- Breadcrumb --}}
            <div class="mb-6">
                <nav class="flex items-center space-x-2 text-sm">
                    <a href="{{ route('home') }}" class="text-rose-600 hover:text-rose-700 font-medium transition-colors">Shop</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-600 capitalize">{{ $currentTitle }}</span>
                </nav>
            </div>

            {{-- Page Title --}}
            <h1 class="text-4xl font-bold text-gray-900 mb-8 capitalize">{{ $currentTitle }}</h1>

            {{-- Category Filter Buttons --}}
            <div class="flex flex-wrap gap-3 mb-8">
                <button 
                    wire:click="selectCategory(null)"
                    class="px-6 py-2 rounded-full font-medium transition-all duration-200 {{ $selectedCategory === null ? 'bg-gray-900 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All
                </button>
                @foreach($categories as $category)
                    <button 
                        wire:click="selectCategory({{ $category->id }})"
                        class="px-6 py-2 rounded-full font-medium transition-all duration-200 {{ $selectedCategory == $category->id ? 'bg-gray-900 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            {{-- Products Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @forelse($products as $product)
                    <a href="{{ route('product.detail', $product) }}" 
                       class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        
                        {{-- Product Image --}}
                        <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-50 overflow-hidden">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Product Info --}}
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-1 group-hover:text-rose-600 transition-colors">
                                {{ $product->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mb-2">{{ $product->category->name }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">LKR {{ number_format($product->price, 2) }}</span>
                                @if($product->stock > 0)
                                    <span class="text-xs text-green-600 font-medium">In Stock</span>
                                @else
                                    <span class="text-xs text-red-600 font-medium">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">No Products Found</h3>
                        <p class="text-gray-500">Try selecting a different category</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="flex justify-center">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    <x-footer />
</div>
