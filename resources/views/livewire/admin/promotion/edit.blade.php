<x-slot name="header">
    Edit Promotion
</x-slot>

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="update">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <!-- Title -->
                        <div class="col-span-6 sm:col-span-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" wire:model="title" id="title" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Percentage -->
                        <div class="col-span-6 sm:col-span-4">
                            <label for="percentage" class="block text-sm font-medium text-gray-700">Percentage Discount</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" step="0.01" wire:model="percentage" id="percentage" class="focus:ring-red-500 focus:border-red-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">%</span>
                                </div>
                            </div>
                             @error('percentage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-span-6 sm:col-span-4">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="status" wire:model="status" type="checkbox" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="status" class="font-medium text-gray-700">Active</label>
                                    <p class="text-gray-500">Enable this promotion immediately.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Products -->
                        <div class="col-span-6">
                            <label for="products" class="block text-sm font-medium text-gray-700">Applicable Products</label>
                            <div class="mt-1 border border-gray-300 rounded-md p-4 h-64 overflow-y-auto bg-white">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($products as $product)
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="product-{{ $product->id }}" wire:model="selectedProducts" value="{{ $product->id }}" type="checkbox" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="product-{{ $product->id }}" class="font-medium text-gray-700">{{ $product->name }}</label>
                                                <p class="text-gray-500">LKR {{ $product->price }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Hold Ctrl (Windows) or Command (Mac) to select multiple products.</p>
                             @error('selectedProducts') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Update
                    </button>
                    <a href="{{ route('admin.promotions.index') }}" class="ml-2 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
