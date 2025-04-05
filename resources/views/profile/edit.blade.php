<x-app-layout>
    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Profile Settings</h1>
                    <p class="text-gray-500 mt-1">Manage your account information and security settings</p>
                </div>
                <div class="text-sm text-gray-500 bg-gray-50 px-3 py-2 rounded-lg">
                    Last updated: {{ now()->format('M d, Y') }}
                </div>
            </div>

            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            @if ($user->avatar)
                                <img class="h-12 w-12 rounded-full object-cover border-2 border-white shadow-sm"
                                    src="{{ asset('images/' . $user->avatar) }}" alt="{{ $user->name }}">
                            @else
                                <div
                                    class="h-12 w-12 rounded-full bg-indigo-100 border-2 border-white flex items-center justify-center text-indigo-600 font-bold text-xl shadow-sm">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h2>
                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Profile Form -->
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                    class="divide-y divide-gray-100">
                    @csrf
                    @method('patch')

                    <!-- Personal Information Section -->
                    <div class="px-6 py-5 space-y-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class='bx bx-user-circle text-indigo-500 mr-2'></i>
                                Personal Information
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">Update your basic profile details</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div>
                                <x-input-label for="name" :value="__('Full Name')" class="mb-2" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-user text-gray-400'></i>
                                    </div>
                                    <x-text-input id="name" name="name" type="text"
                                        class="block w-full pl-10" :value="old('name', $user->name)" required autofocus
                                        autocomplete="name" />
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <!-- Email Field -->
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" class="mb-2" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-envelope text-gray-400'></i>
                                    </div>
                                    <x-text-input id="email" name="email" type="email"
                                        class="block w-full pl-10" :value="old('email', $user->email)" required autocomplete="email" />
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <!-- Avatar Upload -->
                            <div class="md:col-span-2">
                                <x-input-label for="avatar" :value="__('Profile Picture')" class="mb-2" />
                                <div class="flex items-center space-x-6">
                                    <div class="shrink-0">
                                        @if ($user->avatar)
                                            <img id="preview-avatar"
                                                class="h-20 w-20 rounded-full object-cover border-2 border-gray-200 shadow-sm"
                                                src="{{ asset('images/' . $user->avatar) }}"
                                                alt="Current profile photo">
                                        @else
                                            <div id="preview-avatar"
                                                class="h-20 w-20 rounded-full bg-gray-100 border-2 border-gray-200 flex items-center justify-center text-gray-500 font-bold text-2xl shadow-sm">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <label class="block w-full">
                                        <span class="sr-only">Choose profile photo</span>
                                        <input type="file" name="avatar" id="avatar" accept="image/*"
                                            class="block w-full text-sm text-gray-600
                                                      file:mr-4 file:py-2.5 file:px-4
                                                      file:rounded-lg file:border-0
                                                      file:text-sm file:font-medium
                                                      file:bg-indigo-50 file:text-indigo-700
                                                      hover:file:bg-indigo-100
                                                      file:transition-colors file:duration-150">
                                        <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF (Max 2MB)</p>
                                        <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                                    </label>
                                </div>
                            </div>

                            <!-- Email Verification -->
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div class="md:col-span-2">
                                    <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-100">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <i class='bx bx-error text-yellow-500 text-xl'></i>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-yellow-800">Your email is unverified
                                                </h3>
                                                <div class="mt-2 text-sm text-yellow-700">
                                                    <p>
                                                        You need to verify your email address to access all features.
                                                    <form id="send-verification" method="post"
                                                        action="{{ route('verification.send') }}" class="inline">
                                                        @csrf
                                                        <button type="submit"
                                                            class="text-yellow-600 hover:text-yellow-500 underline ml-1">
                                                            Click here to resend verification
                                                        </button>
                                                    </form>
                                                    </p>
                                                    @if (session('status') === 'verification-link-sent')
                                                        <p class="mt-2 text-green-600 flex items-center">
                                                            <i class='bx bx-check-circle mr-1'></i> Verification link
                                                            sent!
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="px-6 py-4 bg-gray-50 flex justify-end">
                        <x-primary-button class="flex items-center px-6 py-3">
                            <i class='bx bx-save mr-2'></i> Save Changes
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Password Update Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class='bx bx-lock-alt text-blue-500 mr-2'></i>
                        Password & Security
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">Update your password to keep your account secure</p>
                </div>

                <!-- Password Form -->
                <form method="post" action="{{ route('password.update') }}" class="divide-y divide-gray-100">
                    @csrf
                    @method('put')

                    <div class="px-6 py-5 space-y-6">
                        <div class="space-y-6">
                            <!-- Current Password -->
                            <div>
                                <x-input-label for="update_password_current_password" :value="__('Current Password')"
                                    class="mb-2" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-key text-gray-400'></i>
                                    </div>
                                    <x-text-input id="update_password_current_password" name="current_password"
                                        type="password" class="block w-full pl-10" autocomplete="current-password"  />
                                </div>
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- New Password -->
                                <div>
                                    <x-input-label for="update_password_password" :value="__('New Password')" class="mb-2" />
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class='bx bx-lock text-gray-400'></i>
                                        </div>
                                        <x-text-input id="update_password_password" name="password" type="password"
                                            class="block w-full pl-10" autocomplete="new-password"  />
                                    </div>
                                    <p class="mt-2 text-xs text-gray-500">Minimum 8 characters with at least one
                                        special character</p>
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')"
                                        class="mb-2" />
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class='bx bx-check-shield text-gray-400'></i>
                                        </div>
                                        <x-text-input id="update_password_password_confirmation"
                                            name="password_confirmation" type="password" class="block w-full pl-10"
                                            autocomplete="new-password"  />
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Success Message -->
                        @if (session('status') === 'password-updated')
                            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                class="p-4 bg-green-50 rounded-lg border border-green-100 flex items-start">
                                <i class='bx bx-check-circle text-green-500 text-xl mr-3'></i>
                                <div>
                                    <h3 class="text-sm font-medium text-green-800">Password updated successfully!</h3>
                                    <p class="mt-1 text-sm text-green-700">Your new password has been saved.</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Form Actions -->
                    <div class="px-6 py-4 bg-gray-50 flex justify-end">
                        <x-primary-button class="flex items-center px-6 py-3">
                            <i class='bx bx-refresh mr-2'></i> Update Password
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Account Deletion Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-5 border-b border-red-100">
                    <h3 class="text-lg font-medium text-red-800 flex items-center">
                        <i class='bx bx-error text-red-500 mr-2'></i>
                        Danger Zone
                    </h3>
                    <p class="mt-1 text-sm text-red-600">Permanent actions that cannot be undone</p>
                </div>

                <!-- Content -->
                <div class="px-6 py-5 space-y-4">
                    <div class="p-4 bg-red-50 rounded-lg border border-red-100">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class='bx bx-error-circle text-red-500 text-xl'></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Delete your account</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p>Once your account is deleted, all of its resources and data will be permanently
                                        erased.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-danger-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        class="flex items-center px-6 py-3">
                        <i class='bx bx-trash mr-2'></i> Delete Account
                    </x-danger-button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-start">
                <div class="flex-shrink-0 bg-red-100 p-2 rounded-full">
                    <i class='bx bx-error text-red-600 text-xl'></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-medium text-gray-900">Confirm Account Deletion</h2>
                    <p class="mt-1 text-sm text-gray-600">
                        This action cannot be undone. All your data will be permanently removed from our servers.
                        Please enter your password to confirm you want to permanently delete your account.
                    </p>
                </div>
            </div>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Your Password') }}" class="sr-only" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class='bx bx-lock-open text-gray-400'></i>
                    </div>
                    <x-text-input id="password" name="password" type="password" class="block w-full pl-10"
                        placeholder="{{ __('Enter password to confirm') }}" />
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-4 py-2.5">
                    Cancel
                </x-secondary-button>

                <x-danger-button class="flex items-center px-4 py-2.5">
                    <i class='bx bx-trash mr-2'></i> Delete Account
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    <!-- Avatar Preview Script -->
    <script>
        document.getElementById('avatar').addEventListener('change', function(e) {
            const preview = document.getElementById('preview-avatar');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // If preview is an image
                    if (preview.tagName === 'IMG') {
                        preview.src = e.target.result;
                    }
                    // If preview is a div (initial state)
                    else {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className =
                        'h-20 w-20 rounded-full object-cover border-2 border-gray-200 shadow-sm';
                        preview.parentNode.replaceChild(img, preview);
                        img.id = 'preview-avatar';
                    }
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
