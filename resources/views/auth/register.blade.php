<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Form Header -->
        {{-- <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Create Your Account</h2>
            <p class="mt-2 text-sm text-gray-600">Join our community today</p>
        </div> --}}

        <!-- Name -->
        <div>
            <div class="flex items-center justify-between relative">
                <x-input-label for="name" :value="__('Name')" class="block text-sm font-medium text-gray-700" />
                <i class='bx bx-user absolute right-2 top-[40px] z-10 text-gray-400'></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="name"
                    class="block w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="Name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Email Address -->
        <div>
            <div class="flex items-center justify-between relative">
                <x-input-label for="email" :value="__('Email Address')" class="block text-sm font-medium text-gray-700" />
                <i class='bx bx-envelope absolute right-2 top-[40px] z-10 text-gray-400'></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="email"
                    class="block w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200"
                    type="email" name="email" :value="old('email')" required autocomplete="email"
                    placeholder="Email" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between relative">
                <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
                <i class='bx bx-lock-alt absolute right-2 top-[40px] z-10 text-gray-400'></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="password"
                    class="block w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200"
                    type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <div class="mt-1 text-xs text-gray-500">
                <p>Minimum 8 characters with at least one number or special character</p>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div>
            <div class="flex items-center justify-between  relative">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                    class="block text-sm font-medium text-gray-700" />
                <i class='bx bx-check-shield absolute right-2 top-[40px] z-10 text-gray-400'></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="password_confirmation"
                    class="block w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Terms Agreement -->
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="terms" name="terms" type="checkbox"
                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" required>
            </div>
            <div class="ml-3 text-sm">
                <label for="terms" class="font-medium text-gray-700">I agree to the</label>
                <a href="#" class="text-indigo-600 hover:text-indigo-500">Terms of Service</a> and
                <a href="#" class="text-indigo-600 hover:text-indigo-500">Privacy Policy</a>
            </div>
        </div>

        <!-- Submit Button -->
        <div>
            <x-primary-button
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                <i class='bx bx-user-plus mr-2'></i> {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <!-- Login Link -->
        <div class="text-center text-sm text-gray-600 mt-4">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}"
                class="font-medium text-indigo-600 hover:text-indigo-800 ml-1 transition duration-150">
                {{ __('Sign in') }}
            </a>
        </div>

        <!-- Social Login (Optional) -->
        {{-- <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">
                        Or sign up with
                    </span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
                <a href="#"
                    class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                    <i class='bx bxl-google text-red-500'></i>
                    <span class="ml-2">Google</span>
                </a>
                <a href="#"
                    class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                    <i class='bx bxl-facebook text-blue-600'></i>
                    <span class="ml-2">Facebook</span>
                </a>
            </div> --}}
        </div>
    </form>
</x-guest-layout>
