<div class="min-h-screen bg-gray-50">
    <!-- Navigation Header -->
    @livewire('navigation-bar')

    <!-- Cart Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Page Title -->
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        @if(count($cartItems) > 0)
            <!-- Cart Table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Product</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Price</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Quantity</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Total</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($cartItems as $productId => $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <!-- Product Info -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-4">
                                            <!-- Product Image -->
                                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center overflow-hidden flex-shrink-0">
                                                @if(isset($item['image_url']) && $item['image_url'])
                                                    <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            <!-- Product Name -->
                                            <span class="font-medium text-gray-900">{{ $item['name'] }}</span>
                                        </div>
                                    </td>

                                    <!-- Price -->
                                    <td class="px-6 py-4">
                                        <span class="text-rose-600 font-semibold">LKR {{ number_format($item['price'], 2) }}</span>
                                    </td>

                                    <!-- Quantity Controls -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <!-- Decrement Button -->
                                            <button 
                                                wire:click="updateQuantity({{ $productId }}, 'decrement')"
                                                @if($item['quantity'] <= 1) disabled @endif
                                                class="w-8 h-8 rounded-lg bg-gradient-to-br from-white to-gray-50 border-2 border-gray-200 hover:border-rose-400 hover:from-rose-50 hover:to-rose-100 disabled:border-gray-200 disabled:cursor-not-allowed disabled:from-gray-100 disabled:to-gray-100 shadow-sm hover:shadow-md disabled:shadow-none transition-all duration-300 flex items-center justify-center group"
                                            >
                                                <svg class="w-4 h-4 text-gray-600 group-hover:text-rose-600 group-disabled:text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/>
                                                </svg>
                                            </button>

                                            <!-- Quantity Display -->
                                            <span class="w-12 text-center font-bold text-gray-900">{{ $item['quantity'] }}</span>

                                            <!-- Increment Button -->
                                            <button 
                                                wire:click="updateQuantity({{ $productId }}, 'increment')"
                                                class="w-8 h-8 rounded-lg bg-rose-500 hover:bg-rose-600 shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center group"
                                            >
                                                <svg class="w-5 h-5 text-white transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>

                                    <!-- Item Total -->
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-900">LKR {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                    </td>

                                    <!-- Remove Button -->
                                    <td class="px-6 py-4">
                                        <button 
                                            wire:click="removeItem({{ $productId }})"
                                            class="text-red-600 hover:text-red-800 font-medium transition-colors"
                                        >
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Cart Total -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex justify-end items-center">
                        <span class="text-lg font-semibold text-gray-700 mr-4">Total:</span>
                        <span class="text-2xl font-bold text-gray-900">LKR {{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end items-center gap-4">
                <button 
                    wire:click="clearCart"
                    class="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200"
                >
                    Clear Cart
                </button>
                @auth
                    <a 
                        href="{{ route('checkout') }}"
                        class="px-8 py-3 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200 inline-block text-center"
                    >
                        Checkout
                    </a>
                @else
                    <a 
                        href="{{ route('checkout') }}"
                        class="px-8 py-3 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200 inline-block text-center"
                    >
                        Login to Checkout
                    </a>
                @endauth
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="bg-white rounded-2xl shadow-lg p-16 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                <p class="text-gray-600 mb-6">Add some products to get started!</p>
                <a 
                    href="{{ route('home') }}" 
                    class="inline-block px-8 py-3 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200"
                >
                    Continue Shopping
                </a>
            </div>
        @endif
    </section>
</div>
