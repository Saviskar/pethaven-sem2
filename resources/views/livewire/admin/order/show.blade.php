<x-slot name="header">
    Order #{{ $order->id }}
</x-slot>

<div class="space-y-6">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Order Details
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    {{ $order->created_at->format('F d, Y \a\t h:i A') }}
                </p>
            </div>
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                {{ match($order->status) {
                    'delivered' => 'bg-green-100 text-green-800',
                    'processing' => 'bg-yellow-100 text-yellow-800',
                    'shipped' => 'bg-blue-100 text-blue-800',
                    'cancelled' => 'bg-red-100 text-red-800',
                    default => 'bg-gray-100 text-gray-800'
                } }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                        Customer Name
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $order->user->name ?? 'Unknown Customer' }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                        Email Address
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $order->user->email ?? 'N/A' }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                        Phone Number
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $order->user->mobile ?? 'N/A' }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                         Total Items
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $order->items->sum('quantity') }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                        Delivery Address
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if($order->user && $order->user->addresses->isNotEmpty())
                            @php $address = $order->user->addresses->first(); @endphp
                            {{ $address->address_line }}<br>
                            {{ $address->city->name ?? '' }}
                        @else
                            <span class="text-gray-400 italic">No address found</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($item->product && $item->product->image_url)
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $item->product->image_url }}" alt="">
                                                @else
                                                     <div class="h-10 w-10 rounded-full bg-gray-200"></div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->product->name ?? 'Product Deleted' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">${{ number_format($item->unit_price_at_order, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->quantity }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">${{ number_format($item->unit_price_at_order * $item->quantity, 2) }}</div>
                                    </td>
                                </tr>
                            @endforeach
                             <!-- Total Row -->
                            <tr class="bg-gray-50">
                                <td colspan="3" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                                    Total Amount:
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    ${{ number_format($order->items->sum(fn($item) => $item->unit_price_at_order * $item->quantity), 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('admin.orders.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Back to Orders
        </a>
    </div>
</div>
