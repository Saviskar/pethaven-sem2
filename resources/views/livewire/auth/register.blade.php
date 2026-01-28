<div>
    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
        @csrf

        <!-- Username -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-900 mb-2">
                Username
            </label>
            <input 
                id="name" 
                name="name" 
                type="text" 
                wire:model="name"
                required 
                autofocus
                autocomplete="name"
                placeholder="Enter your username"
                class="appearance-none relative block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all"
            >
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">
                Email Address
            </label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                wire:model="email"
                required
                autocomplete="username"
                placeholder="Enter your email address"
                class="appearance-none relative block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all"
            >
        </div>

        <!-- Mobile Number -->
        <div>
            <label for="mobile" class="block text-sm font-medium text-gray-900 mb-2">
                Mobile Number
            </label>
            <input 
                id="mobile" 
                name="mobile" 
                type="tel" 
                wire:model="mobile"
                required
                placeholder="Enter your mobile number"
                class="appearance-none relative block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all"
            >
        </div>

        <!-- Province -->
        <div>
            <label for="province_id" class="block text-sm font-medium text-gray-900 mb-2">
                Province
            </label>
            <select 
                id="province_id" 
                name="province_id" 
                wire:model.live="province_id"
                required
                class="appearance-none relative block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all"
            >
                <option value="">Select a province</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- City -->
        <div>
            <label for="city_id" class="block text-sm font-medium text-gray-900 mb-2">
                City
            </label>
            <select 
                id="city_id" 
                name="city_id" 
                wire:model="city_id"
                required
                class="appearance-none relative block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all"
            >
                <option value="">Select a city</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Address Line -->
        <div>
            <label for="address_line" class="block text-sm font-medium text-gray-900 mb-2">
                Address Line
            </label>
            <input 
                id="address_line" 
                name="address_line" 
                type="text" 
                wire:model="address_line"
                required
                placeholder="Enter your street address"
                class="appearance-none relative block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all"
            >
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-900 mb-2">
                Password
            </label>
            <input 
                id="password" 
                name="password" 
                type="password" 
                wire:model="password"
                required
                autocomplete="new-password"
                placeholder="Enter your password"
                class="appearance-none relative block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all"
            >
        </div>

        <!-- Password Confirmation -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-900 mb-2">
                Confirm Password
            </label>
            <input 
                id="password_confirmation" 
                name="password_confirmation" 
                type="password" 
                wire:model="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirm your password"
                class="appearance-none relative block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all"
            >
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <!-- Terms and Privacy Policy -->
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input 
                        id="terms" 
                        name="terms" 
                        type="checkbox" 
                        wire:model="terms"
                        required
                        class="h-4 w-4 text-rose-600 focus:ring-rose-500 border-gray-300 rounded"
                    >
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms" class="text-gray-700">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-rose-600 hover:text-rose-500 underline">Terms of Service</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-rose-600 hover:text-rose-500 underline">Privacy Policy</a>',
                        ]) !!}
                    </label>
                </div>
            </div>
        @endif

        <!-- Submit Button -->
        <div>
            <button 
                type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-rose-500 hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all transform hover:scale-[1.02]"
            >
                Create Account
            </button>
        </div>

        <!-- Sign In Link -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-rose-500 transition-colors">
                Already have an account? <span class="underline font-medium">Sign in</span>
            </a>
        </div>
    </form>
</div>
