<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <div class="flex items-center justify-between relative">
                <x-input-label for="name" :value="__('Name')" class="block text-sm font-medium text-gray-700" />
                <i class='bx bx-user absolute right-3 top-9 z-10 text-gray-400 text-lg'></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="name"
                    class="block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="Name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Email Address -->
        <div>
            <div class="flex items-center justify-between relative">
                <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700" />
                <i class='bx bx-envelope absolute right-3 top-9 z-10 text-gray-400 text-lg'></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="email"
                    class="block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200"
                    type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="Email" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between relative">
                <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
                <i class='bx bx-lock-alt absolute right-3 top-9 z-10 text-gray-400 text-lg'></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="password"
                    class="block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200"
                    type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <div class="mt-1 text-xs text-gray-500">
                <p>8+ chars with number/special char</p>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div>
            <div class="flex items-center justify-between relative">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                    class="block text-sm font-medium text-gray-700" />
                <i class='bx bx-check-shield absolute right-3 top-9 z-10 text-gray-400 text-lg'></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="password_confirmation"
                    class="block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Terms Agreement -->
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="terms" name="terms" type="checkbox"
                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" required>
            </div>
            <div class="ml-3 text-xs">
                <label for="terms" class="text-gray-700">I agree to the</label>
                <a href="#" class="text-indigo-600 hover:text-indigo-500">Terms</a> and
                <a href="#" class="text-indigo-600 hover:text-indigo-500">Privacy Policy</a>
            </div>
        </div>

        <!-- Submit Button -->
        <div>
            <x-primary-button
                class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                <i class='bx bx-user-plus mr-2'></i> {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <!-- Login Link -->
        <div class="text-center text-sm text-gray-600 mt-3">
            {{ __('Already registered?') }}
            <a href="{{ route('login') }}"
                class="font-medium text-purple-600 hover:text-purple-500 ml-1 transition duration-150">
                {{ __('Sign in') }}
            </a>
        </div>
    </form>
</x-guest-layout>
