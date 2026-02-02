<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
    @for ($i = 0; $i < 4; $i++)
        <div class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
            <!-- Image Skeleton -->
            <div class="aspect-square w-full bg-gray-200 animate-pulse relative overflow-hidden">
                <!-- Optional: Add a subtle shine effect or icon placeholder if desired, but simple gray is standard -->
            </div>

            <!-- Content Skeleton -->
            <div class="p-4">
                <!-- Title Skeleton -->
                <div class="h-6 bg-gray-200 rounded w-3/4 mb-2 animate-pulse"></div>

                <!-- Category Skeleton -->
                <div class="h-4 bg-gray-200 rounded w-1/2 mb-4 animate-pulse"></div>

                <!-- Price and Stock Skeleton -->
                <div class="flex items-center justify-between">
                    <div class="h-7 bg-gray-200 rounded w-24 animate-pulse"></div>
                    <div class="h-4 bg-gray-200 rounded w-16 animate-pulse"></div>
                </div>
            </div>
        </div>
    @endfor
</div>
