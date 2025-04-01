<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Profile Settings') }}
            </h2>
            <div class="text-sm text-gray-500">
                {{ __('Last updated: ') }} {{ now()->format('M d, Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Information Card -->
            <div class="p-6 bg-white shadow-lg rounded-xl border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class='bx bx-user-circle text-indigo-600 mr-2 text-xl'></i>
                        {{ __('Personal Information') }}
                    </h3>
                    <div class="h-px flex-1 bg-gray-200 mx-4"></div>
                    <div class="text-indigo-600 text-sm font-medium">{{ __('Required') }}</div>
                </div>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" :value="__('Full Name')" class="mb-1" />
                            <div class="relative">
                                <x-text-input id="name" name="name" type="text"
                                    class="w-full pl-10"
                                    :value="old('name', $user->name)"
                                    required autofocus autocomplete="name" />
                                <i class='bx bx-user absolute left-3 top-3 text-gray-400'></i>
                            </div>
                            <x-input-error class="mt-1 text-xs" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email Address')" class="mb-1" />
                            <div class="relative">
                                <x-text-input id="email" name="email" type="email"
                                    class="w-full pl-10"
                                    :value="old('email', $user->email)"
                                    required autocomplete="email" />
                                <i class='bx bx-envelope absolute left-3 top-3 text-gray-400'></i>
                            </div>
                            <x-input-error class="mt-1 text-xs" :messages="$errors->get('email')" />

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2 text-sm text-yellow-600 bg-yellow-50 p-2 rounded-md">
                                    {{ __('Your email is unverified.') }}
                                    <button form="send-verification" class="underline text-yellow-700 hover:text-yellow-800 ml-1">
                                        {{ __('Resend verification') }}
                                    </button>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-1 text-green-600">
                                            {{ __('Verification link sent!') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <x-primary-button class="flex items-center">
                            <i class='bx bx-save mr-2'></i> {{ __('Update Profile') }}
                        </x-primary-button>
                    </div>
                </form>
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
            </div>

            <!-- Password Update Card -->
            <div class="p-6 bg-white shadow-lg rounded-xl border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class='bx bx-lock-alt text-indigo-600 mr-2 text-xl'></i>
                        {{ __('Password & Security') }}
                    </h3>
                    <div class="h-px flex-1 bg-gray-200 mx-4"></div>
                    <div class="text-indigo-600 text-sm font-medium">{{ __('Recommended') }}</div>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('put')

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="mb-1" />
                            <div class="relative">
                                <x-text-input id="update_password_current_password" name="current_password"
                                    type="password" class="w-full pl-10"
                                    autocomplete="current-password" />
                                <i class='bx bx-key absolute left-3 top-3 text-gray-400'></i>
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1 text-xs" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="update_password_password" :value="__('New Password')" class="mb-1" />
                                <div class="relative">
                                    <x-text-input id="update_password_password" name="password"
                                        type="password" class="w-full pl-10"
                                        autocomplete="new-password" />
                                    <i class='bx bx-lock absolute left-3 top-3 text-gray-400'></i>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Minimum 8 characters with special character</p>
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1 text-xs" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="mb-1" />
                                <div class="relative">
                                    <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                        type="password" class="w-full pl-10"
                                        autocomplete="new-password" />
                                    <i class='bx bx-check-shield absolute left-3 top-3 text-gray-400'></i>
                                </div>
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1 text-xs" />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <div>
                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                    class="text-sm text-green-600 flex items-center">
                                    <i class='bx bx-check-circle mr-1'></i> {{ __('Password updated successfully!') }}
                                </p>
                            @endif
                        </div>
                        <x-primary-button class="flex items-center">
                            <i class='bx bx-refresh mr-2'></i> {{ __('Update Password') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Account Deletion Card -->
            <div class="p-6 bg-white shadow-lg rounded-xl border border-red-100 bg-red-50">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-red-800 flex items-center">
                        <i class='bx bx-trash text-red-600 mr-2 text-xl'></i>
                        {{ __('Danger Zone') }}
                    </h3>
                    <div class="h-px flex-1 bg-red-200 mx-4"></div>
                    <div class="text-red-600 text-sm font-medium">{{ __('Permanent') }}</div>
                </div>

                <div class="space-y-4">
                    <p class="text-sm text-red-700">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently erased.') }}
                    </p>

                    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="flex items-center">
                        <i class='bx bx-trash mr-2'></i> {{ __('Delete Account') }}
                    </x-danger-button>
                </div>

                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class='bx bx-error-circle text-red-500 mr-2'></i>
                            {{ __('Confirm Account Deletion') }}
                        </h2>

                        <p class="mt-2 text-sm text-gray-600">
                            {{ __('This action cannot be undone. All your data will be permanently removed from our servers.') }}
                        </p>

                        <div class="mt-6">
                            <x-input-label for="password" value="{{ __('Your Password') }}" class="mb-1" />
                            <div class="relative">
                                <x-text-input id="password" name="password" type="password"
                                    class="w-full pl-10" placeholder="{{ __('Enter password to confirm') }}" />
                                <i class='bx bx-lock-open absolute left-3 top-3 text-gray-400'></i>
                            </div>
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1 text-xs" />
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <x-secondary-button x-on:click="$dispatch('close')" class="px-4">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-danger-button class="flex items-center px-4">
                                <i class='bx bx-trash mr-2'></i> {{ __('Delete Account') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>
    </div>
</x-app-layout>
