<div class="min-h-screen bg-gray-50">
    <!-- Navigation Header -->
    @livewire('navigation-bar')

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="{{ route('cart') }}" class="hover:text-rose-600 transition-colors">Cart</a>
            <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-medium">Checkout</span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left Column: User Details Form -->
            <div>
                <form wire:submit.prevent="placeOrder" class="space-y-8">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-base font-medium text-gray-900">Name</label>
                        <input 
                            wire:model="name"
                            type="text" 
                            id="name" 
                            placeholder="Enter your name"
                            class="w-full px-4 py-3 rounded-lg border-gray-200 focus:border-rose-500 focus:ring-rose-500 shadow-sm transition-colors text-gray-900 placeholder-gray-400"
                        >
                        @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-base font-medium text-gray-900">Email</label>
                        <input 
                            wire:model="email"
                            type="email" 
                            id="email" 
                            placeholder="Enter your email"
                            class="w-full px-4 py-3 rounded-lg border-gray-200 focus:border-rose-500 focus:ring-rose-500 shadow-sm transition-colors text-gray-900 placeholder-gray-400"
                        >
                        @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Billing Address -->
                    <div class="space-y-2">
                        <label for="address" class="block text-base font-medium text-gray-900">Billing Address</label>
                        <input 
                            wire:model="address"
                            type="text" 
                            id="address" 
                            placeholder="Enter your billing address"
                            class="w-full px-4 py-3 rounded-lg border-gray-200 focus:border-rose-500 focus:ring-rose-500 shadow-sm transition-colors text-gray-900 placeholder-gray-400"
                        >
                        @error('address') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="space-y-8">
                <h2 class="text-xl font-bold text-gray-900">Order Summary</h2>

                <div class="space-y-6">
                    @foreach($cartItems as $item)
                        <div class="flex items-center space-x-4">
                            <!-- Product Image -->
                            <div class="w-16 h-16 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden">
                                @if(isset($item['image_url']) && $item['image_url'])
                                    <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Product Details -->
                            <div class="flex-1">
                                <h3 class="text-base font-medium text-gray-900">{{ $item['name'] }}</h3>
                                <p class="text-sm text-gray-500">Quantity: {{ $item['quantity'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Totals -->
                <div class="pt-6 border-t border-gray-200 space-y-4">
                    <div class="flex justify-between text-base text-gray-600">
                        <span>Subtotal</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-base text-gray-600">
                        <span>Shipping</span>
                        <span>${{ number_format($shipping, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold text-gray-900 pt-4">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <!-- COD Note -->
                <p class="text-sm text-gray-500">
                    Cash on Delivery (COD) is available for orders below $100. Please have the exact amount ready upon delivery.
                </p>

                <!-- Place Order Button -->
                <button 
                    wire:click="placeOrder"
                    class="w-full bg-rose-500 hover:bg-rose-600 text-white font-bold py-4 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                >
                    Place Order
                </button>
            </div>
        </div>
    </section>
</div>
