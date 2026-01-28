<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-theme-light dark:bg-theme-dark">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-card-dark shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] overflow-hidden sm:rounded-xl">
        {{ $slot }}
    </div>
</div>
