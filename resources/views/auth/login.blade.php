<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200"
        :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <div class="flex items-center justify-between relative">
                <x-input-label for="email" :value="__('Email Address')" class="block text-sm font-medium text-gray-700" />
                <i class='bx bx-envelope absolute right-2 top-[40px] z-10 text-gray-400'></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="email"
                    class="block w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
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
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition duration-150"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div>
            <x-primary-button
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                <i class='bx bx-log-in-circle mr-2'></i> {{ __('Sign In') }}
            </x-primary-button>
        </div>



    </form>
</x-guest-layout>
