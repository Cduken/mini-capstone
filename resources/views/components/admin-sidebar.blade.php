<div x-data="{ open: true, activeGroup: null }" class="flex">
    <!-- Sidebar Overlay (for mobile) -->
    <div x-show="open" @click="open = false"
        class="fixed inset-0 bg-gradient-to-br from-gray-900/90 to-blue-900/40 backdrop-blur-md z-20 lg:hidden"
        x-transition></div>

    <!-- Sidebar -->
    <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed lg:relative z-30 w-80 min-h-screen bg-gradient-to-b from-gray-950 to-blue-950 border-r border-blue-800/30 text-white p-6 space-y-10 flex flex-col transition-all duration-300 shadow-[5px_0_25px_rgba(30,58,138,0.15)]"
        :class="{ '-translate-x-full lg:translate-x-0': !open }">

        <!-- Sidebar Header -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div
                    class="p-3 rounded-full bg-blue-600/80 shadow-[0_0_15px_rgba(30,58,138,0.5)] border border-blue-400/40">
                    <i
                        class='bx bx-grid-alt text-2xl text-blue-100 transform rotate-45 transition-transform duration-300 hover:rotate-0'></i>
                </div>
                <div>
                    <h2
                        class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-cyan-300 tracking-tight">
                        Admin Interface
                    </h2>
                    <p class="text-xs text-blue-400/70 mt-1">Control Hub</p>
                </div>
            </div>
            <button @click="open = false"
                class="lg:hidden p-2 rounded-full bg-blue-800/50 hover:bg-blue-700/60 transition-all duration-200">
                <i class='bx bx-x text-2xl text-blue-300 hover:text-white'></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto custom-scrollbar space-y-2">
            <ul class="space-y-3">
                <!-- Home -->
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center p-2 rounded-2xl transition-all duration-300 group hover:bg-blue-900/50 hover:shadow-[0_0_10px_rgba(30,58,138,0.3)] {{ request()->routeIs('home') ? 'bg-blue-900/70 border-l-4 border-blue-400' : '' }}">
                        <div
                            class="p-2 mr-4 rounded-full bg-blue-800/40 group-hover:bg-blue-600/50 transition-all duration-300 group-hover:scale-110">
                            <i class='bx bx-home-alt-2 text-xl text-blue-400 group-hover:text-blue-300'></i>
                        </div>
                        <span class="font-semibold text-blue-200 group-hover:text-white tracking-wide">Home</span>
                        <div class="ml-auto w-2 h-2 rounded-full bg-blue-500 animate-pulse"></div>
                    </a>
                </li>

                <!-- Dashboard -->
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-2 rounded-2xl transition-all duration-300 group hover:bg-blue-900/50 hover:shadow-[0_0_10px_rgba(30,58,138,0.3)] {{ request()->routeIs('admin.dashboard') ? 'bg-blue-900/70 border-l-4 border-blue-400' : '' }}">
                        <div
                            class="p-2 mr-4 rounded-full bg-blue-800/40 group-hover:bg-blue-600/50 transition-all duration-300 group-hover:scale-110">
                            <i class='bx bx-tachometer text-xl text-blue-400 group-hover:text-blue-300'></i>
                        </div>
                        <span class="font-semibold text-blue-200 group-hover:text-white tracking-wide">Dashboard</span>
                        <i class='bx bx-chevron-right text-blue-400/60 ml-auto group-hover:text-blue-300'></i>
                    </a>
                </li>

                <!-- Products Section -->
                <li x-data="{ expanded: {{ request()->routeIs('admin.products.*') ? 'true' : 'false' }} }" class="relative">
                    <button @click="expanded = !expanded"
                        class="w-full flex items-center p-2 rounded-2xl transition-all duration-300 group hover:bg-blue-900/50 hover:shadow-[0_0_10px_rgba(30,58,138,0.3)]">
                        <div
                            class="p-2 mr-4 rounded-full bg-blue-800/40 group-hover:bg-blue-600/50 transition-all duration-300 group-hover:scale-110">
                            <i class='bx bx-box text-xl text-blue-400 group-hover:text-blue-300'></i>
                        </div>
                        <span class="font-semibold text-blue-200 group-hover:text-white tracking-wide">Products</span>
                        <i class='bx bx-chevron-down text-blue-400/60 ml-auto transform transition-transform duration-300 group-hover:text-blue-300'
                            :class="{ 'rotate-180': expanded }"></i>
                    </button>

                    <!-- Sublist -->
                    <ul x-show="expanded" x-collapse
                        class="ml-6 pl-4 border-l-2 border-blue-800/40 space-y-2 mt-2 transition-all duration-300 origin-top">
                        <li>
                            <a href="{{ route('admin.products.index') }}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-900/40 hover:shadow-sm text-sm {{ request()->routeIs('admin.products.index') ? 'text-blue-300' : 'text-blue-400 hover:text-blue-200' }}">
                                <i class='bx bx-list-check mr-3 text-blue-400'></i>
                                <span>All Products</span>
                                <span
                                    class="ml-auto text-xs bg-blue-900/60 px-2 py-1 rounded-full text-blue-300">{{ App\Models\Product::count() }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- User Management -->
                <li>
                    <a href="{{ route('admin.users') }}"
                        class="flex items-center p-2 rounded-2xl transition-all duration-300 group hover:bg-blue-900/50 hover:shadow-[0_0_10px_rgba(30,58,138,0.3)] {{ request()->routeIs('admin.users') ? 'bg-blue-900/70 border-l-4 border-blue-400' : '' }}">
                        <div
                            class="p-2 mr-4 rounded-full bg-blue-800/40 group-hover:bg-blue-600/50 transition-all duration-300 group-hover:scale-110">
                            <i class='bx bx-user text-xl text-blue-400 group-hover:text-blue-300'></i>
                        </div>
                        <span class="font-semibold text-blue-200 group-hover:text-white tracking-wide">User
                            Management</span>
                        <span
                            class="ml-auto text-xs bg-blue-700/50 text-blue-300 px-2 py-1 rounded-full animate-pulse">{{ App\Models\User::count() }}</span>
                    </a>
                </li>

                <!-- Profile Settings -->
                <li>
                    <button onclick="openModal('profile-settings-modal')"
                        class="w-full flex items-center p-2 rounded-2xl transition-all duration-300 group hover:bg-blue-900/50 hover:shadow-[0_0_10px_rgba(30,58,138,0.3)]">
                        <div
                            class="p-2 mr-4 rounded-full bg-blue-800/40 group-hover:bg-blue-600/50 transition-all duration-300 group-hover:scale-110">
                            <i class='bx bx-cog text-xl text-blue-400 group-hover:text-blue-300'></i>
                        </div>
                        <span class="font-semibold text-blue-200 group-hover:text-white tracking-wide">Profile
                            Settings</span>
                        <i class='bx bx-chevron-right text-blue-400/60 ml-auto group-hover:text-blue-300'></i>
                    </button>
                </li>
            </ul>
        </nav>

        <!-- User Profile Section -->
        <div class="pt-6 mt-auto border-t border-blue-800/40">
            <div
                class="flex items-center justify-between p-4 rounded-2xl transition-all duration-300 hover:bg-blue-900/50 hover:shadow-[0_0_10px_rgba(30,58,138,0.3)] group cursor-pointer">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        @if (auth()->user()->avatar && file_exists(public_path('images/' . auth()->user()->avatar)))
                            <img id="profile-image"
                                class="profile-image w-12 h-12 rounded-full border-2 border-blue-500/50 group-hover:border-blue-400 transition-all duration-300 shadow-[0_0_8px_rgba(30,58,138,0.4)]"
                                src="{{ asset('images/' . auth()->user()->avatar) }}" alt="Profile photo">
                        @else
                            <div
                                class="profile-image w-12 h-12 rounded-full border-2 border-blue-500/50 group-hover:border-blue-400 transition-all duration-300 bg-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-[0_0_8px_rgba(30,58,138,0.4)]">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                        @endif
                        <div
                            class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-cyan-400 border-2 border-gray-950 animate-pulse">
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-blue-200 group-hover:text-white profile-name-display">
                            {{ auth()->user()->name }}</p>
                        <p class="text-xs text-blue-400/70 truncate group-hover:text-blue-300 profile-email-display">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="p-2 rounded-full bg-blue-800/50 hover:bg-rose-600/50 text-blue-400 hover:text-rose-300 transition-all duration-300 hover:rotate-45">
                        <i class='bx bx-log-out text-xl'></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <button @click="open = !open"
        class="fixed bottom-8 left-8 z-20 p-4 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-full shadow-[0_0_20px_rgba(30,58,138,0.5)] hover:shadow-[0_0_25px_rgba(30,58,138,0.7)] transition-all lg:hidden group"
        x-transition>
        <i class='bx bx-menu text-2xl text-blue-100 group-hover:text-white group-hover:rotate-90 transition-transform duration-300'
            x-show="!open"></i>
        <i class='bx bx-x text-2xl text-blue-100 group-hover:text-white group-hover:rotate-180 transition-transform duration-300'
            x-show="open"></i>
    </button>

    <!-- Profile Settings Modal (Updated) -->
    <div id="profile-settings-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
        <div @click="closeModal('profile-settings-modal')"
            class="fixed inset-0 bg-gradient-to-br from-gray-900/90 to-blue-900/50 backdrop-blur-lg transition-opacity duration-300">
        </div>

        <div class="relative bg-gradient-to-br from-gray-950 to-blue-950 rounded-3xl shadow-[0_0_30px_rgba(30,58,138,0.3)] w-full max-w-md max-h-screen overflow-hidden border border-blue-800/40"
            id="profile-settings-modal-content">

            <!-- Modal Header -->
            <div
                class="bg-gradient-to-r from-blue-700 to-cyan-700 px-4 py-3 flex items-center justify-between shadow-[0_4px_15px_rgba(30,58,138,0.2)]">
                <div class="flex items-center space-x-3">
                    <div class="p-1 bg-blue-800/50 rounded-full shadow-[0_0_10px_rgba(30,58,138,0.5)]">
                        <i class='bx bx-user-pin text-xl text-blue-200'></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-blue-100 tracking-tight">Profile Editor</h3>
                        <p class="text-xs text-blue-300/80">Customize Your Details</p>
                    </div>
                </div>
                <button onclick="closeModal('profile-settings-modal')"
                    class="p-1 rounded-full bg-blue-800/50 hover:bg-blue-700/60 text-blue-300 hover:text-white transition-all duration-300 transform hover:rotate-90">
                    <i class='bx bx-x text-xl'></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 overflow-y-auto max-h-[calc(100vh-12rem)]">
                <form id="profile-settings-form" method="post" action="{{ route('profile.update') }}"
                    enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('patch')

                    <!-- Avatar Upload -->
                    <div class="flex flex-col items-center">
                        <div class="relative group">
                            <div
                                class="relative h-24 w-24 rounded-full overflow-hidden border-4 border-blue-700/50 shadow-[0_0_15px_rgba(30,58,138,0.4)] transition-all duration-300 group-hover:border-blue-600">
                                @if (auth()->user()->avatar)
                                    <img id="profile-preview" class="h-full w-full object-cover"
                                        src="{{ asset('images/' . auth()->user()->avatar) }}" alt="Profile photo">
                                @else
                                    <div id="profile-preview"
                                        class="h-full w-full bg-gradient-to-br from-blue-600 to-cyan-600 flex items-center justify-center text-blue-100 font-bold text-3xl">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <label for="profile-avatar"
                                class="absolute bottom-0 right-0 bg-blue-600 p-2 rounded-full shadow-[0_0_10px_rgba(30,58,138,0.5)] cursor-pointer hover:bg-blue-500 transition-all duration-300 group-hover:scale-110">
                                <i class='bx bx-camera text-blue-100 text-lg'></i>
                                <input type="file" id="profile-avatar" name="avatar" accept="image/*"
                                    class="hidden">
                            </label>
                        </div>
                        <p class="mt-2 text-xs text-blue-400/80 text-center">Upload a new avatar (optional)</p>
                        <x-input-error class="mt-1 text-center text-blue-300" :messages="$errors->get('avatar')" />
                    </div>

                    <!-- Name Field -->
                    <div>
                        <label for="profile-name"
                            class="block text-sm font-semibold text-blue-200 mb-1 flex items-center">
                            <i class='bx bx-user mr-2 text-blue-400'></i> Full Name
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-id-card text-blue-500/70'></i>
                            </div>
                            <input id="profile-name" name="name" type="text"
                                class="block w-full pl-10 pr-3 py-2 text-sm bg-gray-900/50 text-blue-100 border border-blue-800/50 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-blue-600/50"
                                value="{{ old('name', auth()->user()->name) }}" required autofocus
                                placeholder="Enter your name">
                        </div>
                        <x-input-error class="mt-1 text-blue-300" :messages="$errors->get('name')" />
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="profile-email"
                            class="block text-sm font-semibold text-blue-200 mb-1 flex items-center">
                            <i class='bx bx-envelope mr-2 text-blue-400'></i> Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-at text-blue-500/70'></i>
                            </div>
                            <input id="profile-email" name="email" type="email"
                                class="block w-full pl-10 pr-3 py-2 text-sm bg-gray-900/50 text-blue-100 border border-blue-800/50 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-blue-600/50"
                                value="{{ old('email', auth()->user()->email) }}" required
                                placeholder="Enter your email">
                        </div>
                        <x-input-error class="mt-1 text-blue-300" :messages="$errors->get('email')" />
                    </div>

                    <!-- Password Change Section -->
                    <div x-data="{ showPasswordFields: false }" class="space-y-3">
                        <button type="button" @click="showPasswordFields = !showPasswordFields"
                            class="flex items-center text-sm font-semibold text-blue-400 hover:text-blue-300 transition-all duration-200">
                            <i class='bx bx-lock-alt mr-2'></i>
                            <span x-text="showPasswordFields ? 'Hide Password Fields' : 'Update Password'"></span>
                            <i class='bx bx-chevron-down ml-2 transform transition-transform duration-300'
                                :class="{ 'rotate-180': showPasswordFields }"></i>
                        </button>

                        <div x-show="showPasswordFields" x-collapse class="space-y-3">
                            <!-- Current Password -->
                            <div>
                                <label for="current_password"
                                    class="block text-sm font-semibold text-blue-200 mb-1 flex items-center">
                                    <i class='bx bx-key mr-2 text-blue-400'></i> Current Password
                                </label>
                                <div class="relative">
                                    <input type="password" name="current_password" id="current_password"
                                        class="w-full pl-10 pr-3 py-2 text-sm bg-gray-900/50 text-blue-100 border border-blue-800/50 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-blue-600/50"
                                        placeholder="Enter current password">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-lock-alt text-blue-500/70'></i>
                                    </div>
                                </div>
                                <x-input-error class="mt-1 text-blue-300" :messages="$errors->get('current_password')" />
                            </div>

                            <!-- New Password -->
                            <div>
                                <label for="password"
                                    class="block text-sm font-semibold text-blue-200 mb-1 flex items-center">
                                    <i class='bx bx-key mr-2 text-blue-400'></i> New Password
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        class="w-full pl-10 pr-3 py-2 text-sm bg-gray-900/50 text-blue-100 border border-blue-800/50 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-blue-600/50"
                                        placeholder="Enter new password">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-lock-open text-blue-500/70'></i>
                                    </div>
                                </div>
                                <x-input-error class="mt-1 text-blue-300" :messages="$errors->get('password')" />
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-semibold text-blue-200 mb-1 flex items-center">
                                    <i class='bx bx-key mr-2 text-blue-400'></i> Confirm Password
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="w-full pl-10 pr-3 py-2 text-sm bg-gray-900/50 text-blue-100 border border-blue-800/50 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-blue-600/50"
                                        placeholder="Confirm new password">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-check-circle text-blue-500/70'></i>
                                    </div>
                                </div>
                                <x-input-error class="mt-1 text-blue-300" :messages="$errors->get('password_confirmation')" />
                            </div>
                        </div>
                    </div>

                    <!-- Email Verification Status -->
                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                        <div class="p-3 bg-blue-900/40 rounded-xl border border-blue-700/50 flex items-start">
                            <i class='bx bx-error-circle text-blue-400 mt-0.5 mr-2'></i>
                            <div>
                                <p class="text-sm text-blue-300">
                                    Your email is unverified. Check your inbox for the verification link.
                                </p>
                                <form id="send-verification" method="post"
                                    action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit"
                                        class="text-blue-400 hover:text-blue-300 text-xs underline mt-1 inline-flex items-center">
                                        Resend verification email
                                        <i class='bx bx-send ml-1'></i>
                                    </button>
                                </form>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-1 text-xs text-blue-200 flex items-center">
                                        <i class='bx bx-check-circle mr-1'></i> Verification link sent!
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Modal Footer -->
                    <div class="pt-4 flex justify-end space-x-3 border-t border-blue-800/40">
                        <button type="button" onclick="closeModal('profile-settings-modal')"
                            class="px-4 py-2 text-sm bg-gray-900/50 text-blue-300 rounded-xl hover:bg-gray-800/70 transition-all duration-300 flex items-center shadow-[0_0_10px_rgba(30,58,138,0.2)]">
                            <i class='bx bx-x mr-1'></i> Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-xl hover:from-blue-700 hover:to-cyan-700 transition-all duration-300 flex items-center shadow-[0_0_15px_rgba(30,58,138,0.4)] hover:shadow-[0_0_20px_rgba(30,58,138,0.6)]">
                            <i class='bx bx-save mr-1'></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div id="profile-update-notification"
        class="hidden fixed top-4 right-4 z-[9999] w-80 transition-all duration-500 ease-[cubic-bezier(0.68,-0.55,0.265,1.55)] translate-x-[120%]">
        <div
            class="bg-gradient-to-br from-gray-950 to-blue-950 rounded-xl shadow-[0_0_20px_rgba(30,58,138,0.3)] overflow-hidden border border-blue-700/40">
            <div class="p-4 flex items-center bg-gradient-to-r from-blue-600 to-cyan-600">
                <div class="flex-shrink-0 p-2 bg-blue-800/50 rounded-full shadow-[0_0_10px_rgba(30,58,138,0.5)]">
                    <i class='bx bx-check-circle text-xl text-blue-100'></i>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm text-blue-100 mt-1">Profile updated successfully</p>
                </div>
                <button onclick="closeNotification()" class="ml-4 text-blue-300 hover:text-white transition-colors">
                    <i class='bx bx-x text-xl'></i>
                </button>
            </div>
            <div class="p-4">
                <div class="flex items-center text-blue-300">
                    <i class='bx bx-check-shield text-xl mr-2'></i>
                    <span class="text-sm font-medium">Your changes have been saved</span>
                </div>
            </div>
            <div class="h-1.5 bg-blue-900/50 w-full">
                <div id="notification-progress" class="h-full bg-blue-500 transition-all duration-3000 ease-linear">
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(30, 58, 138, 0.1);
            border-radius: 12px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #1e3a8a, #22d3ee);
            border-radius: 12px;
            opacity: 0.8;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #1e40af, #06b6d4);
            opacity: 1;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        .animate-float {
            animation: float 2.5s ease-in-out infinite;
        }

        @keyframes modalEnter {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes modalExit {
            from {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

            to {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
            }
        }

        .animate-\[modalEnter_0\.3s_ease-out\] {
            animation: modalEnter 0.3s ease-out;
        }

        .animate-\[modalExit_0\.3s_ease-in\] {
            animation: modalExit 0.3s ease-in;
        }

        #profile-update-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            width: 320px;
            transform: translateX(120%);
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .notification-slide-in {
            animation: slideInRight 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
        }

        .notification-slide-out {
            animation: slideOutRight 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(120%);
            }

            to {
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(120%);
            }
        }
    </style>

    <script>
        // Modal Handling
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            const content = document.getElementById(modalId + '-content');
            if (content) {
                content.classList.add('animate-[modalEnter_0.3s_ease-out]');
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;

            const content = document.getElementById(modalId + '-content');
            if (content) {
                content.classList.add('animate-[modalExit_0.3s_ease-in]');
            }

            setTimeout(() => {
                modal.classList.add('hidden');
                if (content) {
                    content.classList.remove('animate-[modalEnter_0.3s_ease-out]',
                        'animate-[modalExit_0.3s_ease-in]');
                }
                document.body.style.overflow = 'auto';
            }, 250);
        }

        function showNotification() {
            const notification = document.getElementById('profile-update-notification');
            const progressBar = document.getElementById('notification-progress');

            if (notification && progressBar) {
                notification.classList.remove('hidden', 'notification-slide-out');
                notification.classList.add('notification-slide-in');

                progressBar.style.width = '0%';
                setTimeout(() => {
                    progressBar.style.width = '100%';
                }, 50);

                setTimeout(() => {
                    closeNotification();
                }, 3000);
            }
        }

        function closeNotification() {
            const notification = document.getElementById('profile-update-notification');
            if (notification) {
                notification.classList.remove('notification-slide-in');
                notification.classList.add('notification-slide-out');

                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 500);
            }
        }

        // Profile Form Submission
        document.getElementById('profile-settings-form')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bx bx-loader bx-spin mr-1"></i> Saving...';
            }

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.ok ? response.json() : response.json().then(err => {
                    throw err;
                }))
                .then(data => {
                    if (data.success) {
                        if (data.user) {
                            document.querySelectorAll('.profile-name-display').forEach(el => el.textContent =
                                data.user.name);
                            document.querySelectorAll('.profile-email-display').forEach(el => el.textContent =
                                data.user.email);

                            const avatarElements = document.querySelectorAll(
                                '.profile-image, #profile-image, #profile-preview');
                            avatarElements.forEach(img => {
                                if (img.tagName === 'IMG') {
                                    img.src = data.user.avatar ? data.user.avatar + '?t=' + new Date()
                                        .getTime() : '';
                                } else if (!data.user.avatar) {
                                    img.innerHTML =
                                        `<div class="h-full w-full bg-gradient-to-br from-blue-600 to-cyan-600 flex items-center justify-center text-blue-100 font-bold text-3xl">${data.user.name.charAt(0).toUpperCase()}</div>`;
                                }
                            });

                            if (form.querySelector('#current_password').value) {
                                form.querySelector('#current_password').value = '';
                                form.querySelector('#password').value = '';
                                form.querySelector('#password_confirmation').value = '';
                            }
                        }

                        setTimeout(() => {
                            if (submitBtn) {
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = '<i class="bx bx-save mr-1"></i> Save Changes';
                            }
                            closeModal('profile-settings-modal');
                            showNotification();
                        }, 1500);
                    } else {
                        handleFormErrors(data.errors);
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = '<i class="bx bx-save mr-1"></i> Save Changes';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    handleFormErrors(error.errors || {
                        general: [error.message || 'An error occurred']
                    });
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="bx bx-save mr-1"></i> Save Changes';
                    }
                });
        });

        function handleFormErrors(errors) {
            document.querySelectorAll('.error-message').forEach(el => el.remove());

            if (errors) {
                Object.entries(errors).forEach(([field, messages]) => {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (input) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message text-xs text-red-400 mt-1 flex items-center';
                        errorDiv.innerHTML =
                            `<i class='bx bx-error-circle mr-1 text-xs'></i> ${messages.join('<br>')}`;
                        const parent = input.closest('div');
                        if (parent) parent.appendChild(errorDiv);
                    }
                });
            }
        }

        // Avatar Preview
        document.getElementById('profile-avatar')?.addEventListener('change', function(e) {
            const preview = document.getElementById('profile-preview');
            const file = e.target.files?.[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (preview?.tagName === 'IMG') {
                        preview.src = e.target.result;
                    } else {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-full w-full object-cover';
                        preview?.parentNode?.replaceChild(img, preview);
                        img.id = 'profile-preview';
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Initialize modals and close on escape
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('[id$="-modal"]:not(.hidden)').forEach(modal => {
                        closeModal(modal.id);
                    });
                }
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('bg-gradient-to-br')) {
                    document.querySelectorAll('[id$="-modal"]:not(.hidden)').forEach(modal => {
                        closeModal(modal.id);
                    });
                }
            });
        });
    </script>
</div>
