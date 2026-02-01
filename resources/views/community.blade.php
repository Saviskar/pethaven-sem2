<x-guest-layout>
    @livewire('navigation-bar')
    <div class="bg-gray-50 min-h-screen font-sans">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-rose-50 border-b border-rose-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                        Join the <span class="text-rose-500">Pet Haven Community</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-700 max-w-2xl mx-auto mb-10">
                        Connect with fellow pet lovers, share your stories, and find the best advice for your furry friends.
                    </p>
                    <div class="flex justify-center gap-4">
                        <button class="bg-rose-500 hover:bg-rose-600 text-white font-bold py-3 px-8 rounded-full shadow-lg transform hover:scale-105 transition-all duration-200">
                            Join Now
                        </button>
                        <button class="bg-white hover:bg-gray-100 text-gray-700 font-bold py-3 px-8 rounded-full shadow-md border border-gray-200 transition-all duration-200">
                            Explore Topics
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-rose-200/50 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 w-96 h-96 bg-amber-200/50 rounded-full blur-3xl"></div>
        </div>

        <!-- Community Stats -->
        <div class="py-12 bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="p-6">
                        <div class="text-4xl font-extrabold text-rose-500 mb-2">15k+</div>
                        <div class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Members</div>
                    </div>
                    <div class="p-6">
                        <div class="text-4xl font-extrabold text-rose-500 mb-2">5k+</div>
                        <div class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Topics</div>
                    </div>
                    <div class="p-6">
                        <div class="text-4xl font-extrabold text-rose-500 mb-2">24/7</div>
                        <div class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Support</div>
                    </div>
                    <div class="p-6">
                        <div class="text-4xl font-extrabold text-rose-500 mb-2">4.9</div>
                        <div class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Rating</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Discussions -->
        <div class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Trending Discussions</h2>
                        <p class="text-gray-600 mt-2">See what everyone is talking about today.</p>
                    </div>
                    <a href="#" class="text-rose-600 hover:text-rose-700 font-semibold flex items-center gap-1 group">
                        View all 
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Discussion Card 1 -->
                    @for ($i = 1; $i <= 3; $i++)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="px-3 py-1 text-xs font-bold text-rose-600 bg-rose-100 rounded-full">
                                    Training Tips
                                </span>
                                <span class="text-sm text-gray-400">2h ago</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-rose-500 transition-colors cursor-pointer">
                                How to train a Golden Retriever puppy?
                            </h3>
                            <p class="text-gray-600 mb-6 line-clamp-3">
                                I just got a new puppy and I'm looking for some advice on potty training and basic commands. Any tips?
                            </p>
                            <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-200"></div>
                                    <span class="text-sm font-medium text-gray-700">Sarah J.</span>
                                </div>
                                <div class="flex items-center gap-4 text-gray-400 text-sm">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                        12
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        24
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>



        <!-- Join CTA -->
        <div class="py-20 relative overflow-hidden">
             <div class="absolute inset-0 bg-rose-50 transform skew-y-3 origin-bottom-right z-0"></div>
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="rounded-3xl bg-gradient-to-r from-rose-500 to-rose-600 px-6 py-16 shadow-2xl sm:px-16 md:pt-20 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                    <div class="mx-auto text-center lg:mx-0 lg:flex-auto lg:py-16 lg:text-left">
                        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Ready to dive in?<br>Start your journey today.</h2>
                        <p class="mt-6 text-lg leading-8 text-rose-100">Join thousands of other pet owners who are sharing their experiences and learning from each other.</p>
                        <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                            <a href="#" class="rounded-full bg-white px-8 py-3.5 text-sm font-bold text-rose-600 shadow-sm hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transition-all transform hover:scale-105">Get started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-guest-layout>
