<x-slot name="header">
    Dashboard
</x-slot>

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
    <!-- Stat 1 -->
    <div class="overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Total Orders</dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($totalOrders) }}</dd>
    </div>

    <!-- Stat 2 -->
    <div class="overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Total Revenue</dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">${{ number_format($totalRevenue, 2) }}</dd>
    </div>

    <!-- Stat 3 -->
    <div class="overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Active Products</dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($activeProducts) }}</dd>
    </div>

     <!-- Stat 4 -->
    <div class="overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Active Promotions</dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($activePromotions) }}</dd>
    </div>
</div>
