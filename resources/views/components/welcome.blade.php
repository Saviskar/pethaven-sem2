<div class="p-6 lg:p-8 bg-white dark:bg-card-dark border-b border-border-light dark:border-border-dark">
    <div class="flex items-center gap-4">
        <x-application-logo class="block h-12 w-auto" />
        <h1 class="text-2xl font-medium text-text-light dark:text-text-dark">
            Welcome back, {{ Auth::user()->name }}!
        </h1>
    </div>

    <p class="mt-4 text-text-muted-light dark:text-text-muted-dark leading-relaxed">
        Manage your pet's needs, track orders, and explore the latest products for your furry friends.
    </p>
</div>

<div class="bg-theme-light dark:bg-theme-dark bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8">
    <!-- Shop Now -->
    <div class="bg-white dark:bg-card-dark p-6 rounded-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] transition hover:scale-[1.02]">
        <div class="flex items-center">
            <div class="p-2 bg-rose-100 dark:bg-rose-900/30 rounded-lg">
                <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h2 class="ms-3 text-lg font-semibold text-text-light dark:text-text-dark">Shop Products</h2>
        </div>

        <p class="mt-4 text-sm text-text-muted-light dark:text-text-muted-dark">
            Browse our wide selection of premium pet food, toys, and accessories.
        </p>

        <a href="{{ route('shop') }}" class="mt-4 inline-flex items-center text-sm font-semibold text-rose-500 hover:text-rose-600">
            Start Shopping <span class="ml-1">&rarr;</span>
        </a>
    </div>

    <!-- My Orders (Placeholder) -->
    <div class="bg-white dark:bg-card-dark p-6 rounded-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] transition hover:scale-[1.02]">
        <div class="flex items-center">
             <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h2 class="ms-3 text-lg font-semibold text-text-light dark:text-text-dark">Recent Orders</h2>
        </div>

        <p class="mt-4 text-sm text-text-muted-light dark:text-text-muted-dark">
            View your order history and track current shipments.
        </p>

        <!-- Link to Orders if it exists, otherwise just Profile -->
        <a href="{{ route('my-orders') }}" class="mt-4 inline-flex items-center text-sm font-semibold text-orange-500 hover:text-orange-600">
            View Orders <span class="ml-1">&rarr;</span>
        </a>
    </div>

    <!-- Community/Profile -->
    <div class="bg-white dark:bg-card-dark p-6 rounded-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] transition hover:scale-[1.02]">
        <div class="flex items-center">
            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h2 class="ms-3 text-lg font-semibold text-text-light dark:text-text-dark">Your Profile</h2>
        </div>

        <p class="mt-4 text-sm text-text-muted-light dark:text-text-muted-dark">
            Update your profile and manage your account settings.
        </p>

        <a href="{{ route('profile.show') }}" class="mt-4 inline-flex items-center text-sm font-semibold text-blue-500 hover:text-blue-600">
            Manage Account <span class="ml-1">&rarr;</span>
        </a>
    </div>
</div>
