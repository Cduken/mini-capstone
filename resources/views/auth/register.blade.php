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
                <i class='bx bx-lock-alt absolute right-3 top-9 z-10 text-gray-400 text-lg' id="lock-icon-password"></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="password"
                    class="block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200 pr-10"
                    type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                <button type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 hidden"
                    id="toggle-button-password" onclick="togglePassword(event, 'password')">
                    <i class='bx bx-show' id="eye-icon-password"></i>
                </button>
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
                <i class='bx bx-check-shield absolute right-3 top-9 z-10 text-gray-400 text-lg'
                    id="lock-icon-confirm"></i>
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="password_confirmation"
                    class="block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 input-focus transition duration-200 pr-10"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="••••••••" />
                <button type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 hidden"
                    id="toggle-button-confirm" onclick="togglePassword(event, 'password_confirmation')">
                    <i class='bx bx-show' id="eye-icon-confirm"></i>
                </button>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Function to initialize password toggle for a given input ID
            function setupPasswordToggle(inputId) {
                const passwordInput = document.getElementById(inputId);
                const suffix = inputId === 'password' ? 'password' : 'confirm'; // Use 'confirm' for confirmation
                const lockIcon = document.getElementById(`lock-icon-${suffix}`);
                const toggleButton = document.getElementById(`toggle-button-${suffix}`);
                const eyeIcon = document.getElementById(`eye-icon-${suffix}`);

                // When password field gains focus
                passwordInput.addEventListener('focus', () => {
                    lockIcon.classList.add('hidden');
                    toggleButton.classList.remove('hidden');
                });

                // When password field loses focus
                passwordInput.addEventListener('blur', (event) => {
                    if (!toggleButton.contains(event.relatedTarget)) {
                        lockIcon.classList.remove('hidden');
                        toggleButton.classList.add('hidden');
                        eyeIcon.classList.remove('bx-hide');
                        eyeIcon.classList.add('bx-show');
                        passwordInput.type = 'password';
                    }
                });

                // Prevent button click from blurring input
                toggleButton.addEventListener('mousedown', (event) => {
                    event.preventDefault();
                });
            }

            // Toggle password visibility
            window.togglePassword = function(event, inputId) {
                event.preventDefault();
                const passwordInput = document.getElementById(inputId);
                const suffix = inputId === 'password' ? 'password' :
                'confirm'; // Use 'confirm' for confirmation
                const eyeIcon = document.getElementById(`eye-icon-${suffix}`);

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('bx-show');
                    eyeIcon.classList.add('bx-hide');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('bx-hide');
                    eyeIcon.classList.add('bx-show');
                }
                passwordInput.focus();
            };

            // Setup toggle for both password fields
            setupPasswordToggle('password');
            setupPasswordToggle('password_confirmation');
        });
    </script>
</x-guest-layout>
