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
                <i class='bx bx-lock-alt absolute right-2 top-[40px] z-10 text-gray-400' id="lock-icon"></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="password"
                    class="block w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200 pr-10"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <button type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 hidden"
                    id="toggle-button" onclick="togglePassword(event)">
                    <i class='bx bx-show' id="eye-icon"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Admin Code (Hidden by default) -->
        <div id="admin-code-container" class="hidden">
            <div class="flex items-center justify-between relative">
                <x-input-label for="admin_code" :value="__('Admin Code')" class="block text-sm font-medium text-gray-700" />
                <i class='bx bx-key absolute right-2 top-[40px] z-10 text-gray-400'></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="admin_code"
                    class="block w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200"
                    type="password" name="admin_code" placeholder="Enter admin code" />
            </div>
            <x-input-error :messages="$errors->get('admin_code')" class="mt-2 text-sm text-red-600" />
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
                <i class='bx bx-log-in-circle mr-2 '></i> {{ __('Sign In') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passwordInput = document.getElementById('password');
            const lockIcon = document.getElementById('lock-icon');
            const toggleButton = document.getElementById('toggle-button');
            const eyeIcon = document.getElementById('eye-icon');
            const emailInput = document.getElementById('email');
            const adminCodeContainer = document.getElementById('admin-code-container');

            // Check if email is admin email
            emailInput.addEventListener('blur', async () => {
                if (!emailInput.value) return;
                
                try {
                    const response = await fetch('/check-admin-email', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ email: emailInput.value })
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                    if (data.isAdmin) {
                        adminCodeContainer.classList.remove('hidden');
                    } else {
                        adminCodeContainer.classList.add('hidden');
                    }
                } catch (error) {
                    console.error('Error checking admin status:', error);
                    // Hide admin code field on error
                    adminCodeContainer.classList.add('hidden');
                }
            });

            // When password field gains focus
            passwordInput.addEventListener('focus', () => {
                lockIcon.classList.add('hidden');
                toggleButton.classList.remove('hidden');
            });

            // When password field loses focus
            passwordInput.addEventListener('blur', (event) => {
                // Only hide toggle button if the focus isn't moving to the toggle button
                if (!toggleButton.contains(event.relatedTarget)) {
                    lockIcon.classList.remove('hidden');
                    toggleButton.classList.add('hidden');
                    // Reset eye icon to show state and password to hidden
                    eyeIcon.classList.remove('bx-hide');
                    eyeIcon.classList.add('bx-show');
                    passwordInput.type = 'password';
                }
            });

            // Toggle password visibility
            window.togglePassword = function(event) {
                event.preventDefault(); // Prevent default button behavior
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('bx-show');
                    eyeIcon.classList.add('bx-hide');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('bx-hide');
                    eyeIcon.classList.add('bx-show');
                }
                passwordInput.focus(); // Keep focus on the input after clicking
            };

            // Ensure toggle button click doesn't blur the input unnecessarily
            toggleButton.addEventListener('mousedown', (event) => {
                event.preventDefault(); // Prevent mousedown from causing blur
            });
        });
    </script>
</x-guest-layout>
