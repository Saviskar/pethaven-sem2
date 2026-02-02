<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
    @for ($i = 0; $i < 4; $i++)
        <div class="overflow-hidden bg-white dark:bg-card-dark rounded-lg shadow sm:p-6 border border-border-light dark:border-border-dark">
            <x-skeleton class="h-4 w-24 mb-2" />
            <x-skeleton class="h-8 w-16" />
        </div>
    @endfor
</div>
