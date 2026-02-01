@props(['placeholder' => 'Search products'])

<div class="bg-rose-50 rounded-xl shadow-lg p-6">
    <div class="relative">
        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input 
            type="text" 
            placeholder="{{ $placeholder }}" 
            {{ $attributes->merge(['class' => 'w-full pl-12 pr-4 py-4 bg-white border-0 rounded-lg focus:ring-2 focus:ring-rose-500 focus:outline-none text-gray-700 placeholder-gray-400']) }}
        />
    </div>
</div>
