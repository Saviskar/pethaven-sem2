<div class="min-h-screen bg-gray-50">
    <!-- Navigation Header -->
    @livewire('navigation-bar')

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="{{ route('my-orders') }}" class="hover:text-rose-600 transition-colors">My Orders</a>
            <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-medium">Order #{{ $order->id }}</span>
        </nav>

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Order Details</h1>
            <div class="flex items-center gap-4">
                 <span class="text-sm text-gray-500">Placed on {{ $order->created_at->format('M d, Y') }}</span>
                 <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if($order->status === 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status === 'shipped') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Items Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Product</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Price</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Quantity</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-16 h-16 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden">
                                            @if($item->product->image)
                                                <img src="{{ url('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                            @elseif($item->product->images && count($item->product->images) > 0)
                                                 <img src="{{ url('storage/' . $item->product->images[0]) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $item->product->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">${{ number_format($item->unit_price_at_order, 2) }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">${{ number_format($item->unit_price_at_order * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary Footer -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                <div class="w-full max-w-sm ml-auto space-y-3">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>${{ number_format($order->items->sum(fn($i) => $i->unit_price_at_order * $i->quantity), 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span>$5.00</span> 
                    </div>
                    <div class="border-t border-gray-200 pt-3 flex justify-between text-xl font-bold text-gray-900">
                        <span>Total</span>
                        <span>${{ number_format($order->items->sum(fn($i) => $i->unit_price_at_order * $i->quantity) + 5, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
