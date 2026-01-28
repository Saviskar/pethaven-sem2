<div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium text-text-light dark:text-text-dark">{{ $title }}</h3>

        <p class="mt-1 text-sm text-text-muted-light dark:text-text-muted-dark">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
