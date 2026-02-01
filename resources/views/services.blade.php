<x-guest-layout>
    @livewire('navigation-bar')
    <div class="bg-gray-50 min-h-screen font-sans">
        <!-- Hero Section -->
        <div class="bg-white border-b border-gray-200 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10 text-center">
                <span class="inline-block px-4 py-1.5 rounded-full bg-rose-100 text-rose-600 text-sm font-bold tracking-wide mb-6">
                    PREMIUM PET CARE
                </span>
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 tracking-tight mb-8">
                    World Class Services <br>For Your <span class="bg-clip-text text-transparent bg-gradient-to-r from-rose-500 to-amber-500">Best Friend</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-10 leading-relaxed">
                    From grooming to training, we offer a comprehensive range of premium services to keep your pets happy and healthy.
                </p>
                <div class="flex justify-center">
                    <button class="bg-rose-500 hover:bg-rose-600 text-white font-bold py-4 px-10 rounded-full shadow-lg shadow-rose-200 transition-all transform hover:scale-105">
                        Book an Appointment
                    </button>
                </div>
            </div>
            
             <!-- Soft Gradients -->
            <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-amber-50 via-gray-50 to-transparent opacity-60 z-0"></div>
             <div class="absolute bottom-0 left-0 w-full h-1/2 bg-[radial-gradient(ellipse_at_bottom_left,_var(--tw-gradient-stops))] from-rose-50 via-gray-50 to-transparent opacity-60 z-0"></div>
        </div>

        <!-- Services Grid -->
        <div class="py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                     <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Services</h2>
                     <div class="w-16 h-1 bg-rose-500 mx-auto rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-3 gap-10">
                    <!-- Service 1 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="w-16 h-16 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-amber-600 transition-colors">Grooming Spa</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Treat your pet to a luxurious spa day. Our certified groomers provide bathing, styling, and nail care using organic products.
                        </p>
                        <a href="#" class="text-amber-600 font-bold hover:text-amber-700 flex items-center gap-2">
                            Learn more 
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                    
                    <!-- Service 2 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="w-16 h-16 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-rose-600 transition-colors">Veterinary Care</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                             Comprehensive health checkups, vaccinations, and emergency care from our team of experienced and compassionate veterinarians.
                        </p>
                        <a href="#" class="text-rose-600 font-bold hover:text-rose-700 flex items-center gap-2">
                            Learn more 
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>

                    <!-- Service 3 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="w-16 h-16 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-orange-600 transition-colors">Training Academy</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            From puppy basics to advanced behavioral training, our experts help build a strong, lasting bond between you and your pet.
                        </p>
                        <a href="#" class="text-orange-600 font-bold hover:text-orange-700 flex items-center gap-2">
                            Learn more 
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <x-footer />
</x-guest-layout>
