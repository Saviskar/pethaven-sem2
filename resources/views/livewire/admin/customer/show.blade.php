<x-slot name="header">
    Customer Details: {{ $user->name }}
</x-slot>

<div class="space-y-6">
    <!-- Customer Profile -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Profile Information
            </h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <div class="flex items-center mb-6">
                 <div class="flex-shrink-0 h-20 w-20">
                    <img class="h-20 w-20 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                </div>
                <div class="ml-6">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">Member since {{ $user->created_at->format('F d, Y') }}</p>
                </div>
            </div>
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                        Email Address
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $user->email }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                        Phone Number
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $user->mobile ?? 'N/A' }}
                    </dd>
                </div>
                 <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">
                        Saved Addresses
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if($user->addresses->count() > 0)
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($user->addresses as $address)
                                    <li>
                                        {{ $address->address_line }}, {{ $address->city->name ?? '' }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-400 italic">No saved addresses</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
             <h3 class="text-lg leading-6 font-medium text-gray-900">
                Order History
            </h3>
        </div>
        <div class="border-t border-gray-200">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                         @if($user->orders->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Order ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($user->orders as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    #{{ $order->id }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $order->created_at->format('M d, Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
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
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">View Order</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="px-6 py-4 text-center text-gray-500 italic">
                                No orders found for this customer.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('admin.customers.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Back to Customers
        </a>
    </div>
</div>
