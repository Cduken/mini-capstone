<div x-data="{ open: true, activeGroup: null }" class="flex">
    <!-- Sidebar Overlay (for mobile) - Enhanced with gradient -->
    <div x-show="open" @click="open = false"
        class="fixed inset-0 bg-gradient-to-br from-gray-900/80 to-indigo-900/30 backdrop-blur-sm z-20 lg:hidden"
        x-transition></div>

    <!-- Premium Add Product Modal -->
    <div id="add-product-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm hidden">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300 ease-out"
            id="add-product-modal-content">
            <!-- Modal Header -->
            <div
                class="border-b border-gray-200 px-5 py-4 flex items-center justify-between bg-gradient-to-r from-indigo-600 to-purple-600 rounded-t-xl">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                        <i class='bx bx-package text-white text-lg'></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Add New Product</h3>
                </div>
                <button onclick="closeModal('add-product-modal')"
                    class="p-1 rounded-full hover:bg-white/10 transition-colors text-white hover:text-gray-200">
                    <i class='bx bx-x text-xl'></i>
                </button>
            </div>

            <!-- Modal Body - Optimized Size -->
            <div class="p-5">
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-4">
                        <!-- Product Name -->
                        <div>
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                                <i class='bx bx-rename mr-2 text-indigo-500 text-sm'></i> Product Name
                            </label>
                            <div class="relative">
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                    placeholder="Enter product name">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-text text-gray-400 text-sm'></i>
                                </div>
                            </div>
                            @error('title')
                                <p class="mt-1 text-xs text-red-600 flex items-center">
                                    <i class='bx bx-error-circle mr-1 text-xs'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category"
                                class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                                <i class='bx bx-category mr-2 text-indigo-500 text-sm'></i> Category
                            </label>
                            <div class="relative">
                                <select name="category" id="category"
                                    class="w-full pl-9 pr-8 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 appearance-none bg-white">
                                    <option value="">Select a category</option>
                                    <option value="Phone" {{ old('category') == 'Phone' ? 'selected' : '' }}>Phone
                                    </option>
                                    <option value="Tablet" {{ old('category') == 'Tablet' ? 'selected' : '' }}>Tablet
                                    </option>
                                    <option value="Laptop" {{ old('category') == 'Laptop' ? 'selected' : '' }}>Laptop
                                    </option>
                                    <option value="Watch" {{ old('category') == 'Watch' ? 'selected' : '' }}>Watch
                                    </option>
                                    <option value="Airpods" {{ old('category') == 'Airpods' ? 'selected' : '' }}>Airpods
                                    </option>
                                    <option value="Desktop" {{ old('category') == 'Desktop' ? 'selected' : '' }}>Desktop
                                    </option>
                                    <option value="Camera" {{ old('category') == 'Camera' ? 'selected' : '' }}>Camera
                                    </option>
                                    <option value="Accessories"
                                        {{ old('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-category text-gray-400 text-sm'></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class='bx bx-chevron-down text-gray-400 text-sm'></i>
                                </div>
                            </div>
                            @error('category')
                                <p class="mt-1 text-xs text-red-600 flex items-center">
                                    <i class='bx bx-error-circle mr-1 text-xs'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price"
                                class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                                <i class='bx bx-dollar mr-2 text-indigo-500 text-sm'></i> Price
                            </label>
                            <div class="relative">
                                <input type="text" name="price" id="price" value="{{ old('price') }}"
                                    class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="0.00">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">$</span>
                                </div>
                            </div>
                            @error('price')
                                <p class="mt-1 text-xs text-red-600 flex items-center">
                                    <i class='bx bx-error-circle mr-1 text-xs'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label for="image"
                                class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                                <i class='bx bx-image mr-2 text-indigo-500 text-sm'></i> Product Image
                            </label>
                            <div
                                class="mt-1 flex justify-center px-4 pt-5 pb-5 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="image"
                                            class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="image" name="image" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 5MB</p>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-xs text-red-600 flex items-center">
                                    <i class='bx bx-error-circle mr-1 text-xs'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Stock Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                                <i class='bx bx-check-shield mr-2 text-indigo-500 text-sm'></i> Stock Status
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <label
                                    class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors {{ old('inStock') == '1' ? 'border-indigo-500 bg-indigo-50' : 'border-gray-300' }}">
                                    <input type="radio" name="inStock" value="1"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500"
                                        {{ old('inStock') == '1' ? 'checked' : '' }}>
                                    <div>
                                        <span class="block text-sm font-medium text-gray-700">In Stock</span>
                                    </div>
                                    <i class='bx bx-check-circle text-lg ml-auto text-green-500'></i>
                                </label>
                                <label
                                    class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors {{ old('inStock') == '0' ? 'border-indigo-500 bg-indigo-50' : 'border-gray-300' }}">
                                    <input type="radio" name="inStock" value="0"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500"
                                        {{ old('inStock') == '0' ? 'checked' : '' }}>
                                    <div>
                                        <span class="block text-sm font-medium text-gray-700">Out of Stock</span>
                                    </div>
                                    <i class='bx bx-x-circle text-lg ml-auto text-red-500'></i>
                                </label>
                            </div>
                            @error('inStock')
                                <p class="mt-1 text-xs text-red-600 flex items-center">
                                    <i class='bx bx-error-circle mr-1 text-xs'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal('add-product-modal')"
                            class="px-4 py-2.5 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors flex items-center">
                            <i class='bx bx-x mr-1.5'></i> Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2.5 text-sm bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all shadow-md flex items-center">
                            <i class='bx bx-save mr-1.5'></i> Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Premium Sidebar Design (unchanged from previous version) -->
    <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed lg:relative z-30 w-72 min-h-screen bg-gray-900 border-r border-gray-800/50 text-white p-5 space-y-8 flex flex-col transition-all duration-300 shadow-[5px_0_15px_0_rgba(0,0,0,0.2)]"
        :class="{ '-translate-x-full lg:translate-x-0': !open }">

        <!-- Sidebar Header - Premium Design -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="p-2.5 rounded-xl bg-gradient-to-br from-indigo-600 to-purple-600 shadow-lg border border-indigo-400/20 flex items-center justify-center">
                    <i class='bx bxs-dashboard text-xl text-indigo-100'></i>
                </div>
                <div>
                    <h2
                        class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 to-purple-300 tracking-tight">
                        Admin Console
                    </h2>
                    <p class="text-xs text-indigo-300/60 mt-0.5">Management Portal</p>
                </div>
            </div>
            <button @click="open = false"
                class="lg:hidden p-1.5 rounded-lg hover:bg-gray-800/50 transition-all duration-200 hover:rotate-90">
                <i class='bx bx-x text-xl text-indigo-200/70 hover:text-white'></i>
            </button>
        </div>

        <!-- Premium Navigation Menu -->
        <nav class="flex-1 overflow-y-auto custom-scrollbar space-y-1.5">
            <ul class="space-y-2">
                <!-- Home -->
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center p-3 rounded-xl transition-all duration-200 group hover:bg-gray-800/50 hover:shadow-lg hover:shadow-indigo-500/10 {{ request()->routeIs('home') ? 'bg-gradient-to-r from-indigo-500/10 to-purple-500/10 border-l-2 border-indigo-400' : '' }}">
                        <div
                            class="p-2 mr-3 rounded-lg bg-gray-800/50 group-hover:bg-indigo-600/20 transition-all duration-300 group-hover:rotate-6">
                            <i class='bx bxs-home text-lg text-indigo-400 group-hover:text-indigo-300'></i>
                        </div>
                        <span class="font-medium text-gray-300 group-hover:text-white tracking-wide">Home</span>
                        <div class="ml-auto w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></div>
                    </a>
                </li>

                <!-- Dashboard -->
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-3 rounded-xl transition-all duration-200 group hover:bg-gray-800/50 hover:shadow-lg hover:shadow-purple-500/10 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-indigo-500/10 to-purple-500/10 border-l-2 border-indigo-400' : '' }}">
                        <div
                            class="p-2 mr-3 rounded-lg bg-gray-800/50 group-hover:bg-purple-600/20 transition-all duration-300 group-hover:-rotate-6">
                            <i class='bx bxs-dashboard text-lg text-purple-400 group-hover:text-purple-300'></i>
                        </div>
                        <span class="font-medium text-gray-300 group-hover:text-white tracking-wide">Dashboard</span>
                        <i class='bx bx-chevron-right text-indigo-400/50 ml-auto group-hover:text-indigo-300'></i>
                    </a>
                </li>

                <!-- Products Section - Enhanced -->
                <li x-data="{ expanded: {{ request()->routeIs('admin.products.*') ? 'true' : 'false' }} }" class="relative">
                    <button @click="expanded = !expanded"
                        class="w-full flex items-center p-3 rounded-xl transition-all duration-200 group hover:bg-gray-800/50 hover:shadow-lg hover:shadow-cyan-500/10">
                        <div
                            class="p-2 mr-3 rounded-lg bg-gray-800/50 group-hover:bg-cyan-600/20 transition-all duration-300 group-hover:rotate-12">
                            <i class='bx bx-package text-lg text-cyan-400 group-hover:text-cyan-300'></i>
                        </div>
                        <span class="font-medium text-gray-300 group-hover:text-white tracking-wide">Products</span>
                        <i class='bx bx-chevron-down text-indigo-400/50 ml-auto transform transition-transform duration-200 group-hover:text-indigo-300'
                            :class="{ 'rotate-180': expanded }"></i>
                    </button>

                    <!-- Sublist with elegant animation -->
                    <ul x-show="expanded" x-collapse
                        class="ml-4 pl-5 border-l-2 border-gray-800/50 space-y-2 mt-2 transition-all duration-300 origin-top">
                        <li>
                            <a href="{{ route('admin.products.index') }}"
                                class="flex items-center p-2.5 rounded-lg transition-all duration-200 hover:bg-gray-800/50 hover:shadow-sm hover:shadow-cyan-500/5 text-sm {{ request()->routeIs('admin.products.index') ? 'text-cyan-300' : 'text-gray-400 hover:text-cyan-200' }}">
                                <i class='bx bx-list-ul mr-3 text-sm text-cyan-400'></i>
                                <span>All Products</span>
                                <span
                                    class="ml-auto text-xs bg-cyan-900/50 px-2 py-1 rounded-full text-cyan-300">{{ App\Models\Product::count() }}</span>
                            </a>
                        </li>
                        <li>
                            <button onclick="openModal('add-product-modal')"
                                class="w-full flex items-center p-2.5 rounded-lg transition-all duration-200 hover:bg-gray-800/50 hover:shadow-sm hover:shadow-emerald-500/5 text-sm text-gray-400 hover:text-emerald-300">
                                <i class='bx bx-plus-circle mr-3 text-sm text-emerald-400'></i>
                                <span>Add New</span>
                                <i class='bx bx-chevron-right text-xs ml-auto text-indigo-400/50'></i>
                            </button>
                        </li>
                    </ul>
                </li>

                <!-- User Management -->
                <li>
                    <a href="{{ route('admin.users') }}"
                        class="flex items-center p-3 rounded-xl transition-all duration-200 group hover:bg-gray-800/50 hover:shadow-lg hover:shadow-amber-500/10 {{ request()->routeIs('admin.users') ? 'bg-gradient-to-r from-indigo-500/10 to-purple-500/10 border-l-2 border-indigo-400' : '' }}">
                        <div
                            class="p-2 mr-3 rounded-lg bg-gray-800/50 group-hover:bg-amber-600/20 transition-all duration-300 group-hover:-rotate-12">
                            <i class='bx bx-user text-lg text-amber-400 group-hover:text-amber-300'></i>
                        </div>
                        <span class="font-medium text-gray-300 group-hover:text-white tracking-wide">User
                            Management</span>
                        <span
                            class="ml-auto text-xs bg-rose-500/20 text-rose-300 px-2 py-1 rounded-full animate-pulse">{{ App\Models\User::count() }}</span>
                    </a>
                </li>

                <li>
                    <button onclick="openModal('profile-settings-modal')"
                        class="w-full flex items-center p-3 rounded-xl transition-all duration-200 group hover:bg-gray-800/50 hover:shadow-lg hover:shadow-amber-500/10">
                        <div
                            class="p-2 mr-3 rounded-lg bg-gray-800/50 group-hover:bg-amber-600/20 transition-all duration-300 group-hover:-rotate-12">
                            <i class='bx bx-cog text-lg text-amber-400 group-hover:text-amber-300'></i>
                        </div>
                        <span class="font-medium text-gray-300 group-hover:text-white tracking-wide">Profile
                            Settings</span>
                        <i class='bx bx-chevron-right text-indigo-400/50 ml-auto group-hover:text-indigo-300'></i>
                    </button>
                </li>
            </ul>
        </nav>

        <!-- Premium User Profile Section -->
        <div class="pt-4 mt-auto border-t border-gray-800/50">
            <div
                class="flex items-center justify-between p-3 rounded-xl transition-all duration-300 hover:bg-gray-800/50 hover:shadow-lg hover:shadow-indigo-500/10 group cursor-pointer">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <img id="profile-image"
                            class="w-10 h-10 rounded-xl border-2 border-indigo-500/50 group-hover:border-indigo-400 transition-all duration-300"
                            src="{{ asset('images/' . auth()->user()->avatar) }}"
                            onerror="this.src='{{ asset('images/default-avatar.png') }}'" alt="Profile photo">
                        <div
                            class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-400 border-2 border-gray-900 animate-pulse">
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-200 group-hover:text-white">{{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-indigo-300/60 truncate group-hover:text-indigo-200">Admin Account</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="p-2 rounded-lg transition-all duration-300 hover:bg-gray-800 text-gray-400 hover:text-rose-400 hover:rotate-12">
                        <i class='bx bx-log-out-circle text-xl'></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Premium Floating Action Button -->
    <button @click="open = !open"
        class="fixed bottom-6 left-6 z-20 p-4 bg-gradient-to-br from-indigo-600 to-purple-600 backdrop-blur-sm rounded-xl shadow-2xl hover:shadow-indigo-500/30 transition-all lg:hidden group"
        x-transition>
        <i class='bx bx-menu text-xl text-indigo-100 group-hover:text-white group-hover:rotate-90 transition-transform duration-300'
            x-show="!open"></i>
        <i class='bx bx-x text-xl text-indigo-100 group-hover:text-white group-hover:rotate-180 transition-transform duration-300'
            x-show="open"></i>
    </button>
</div>

<!-- Enhanced Profile Settings Modal -->
<div id="profile-settings-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <!-- Backdrop with gradient and blur -->
    <div @click="closeModal('profile-settings-modal')"
        class="fixed inset-0 bg-gradient-to-br from-gray-900/80 to-indigo-900/30 backdrop-blur-sm transition-opacity duration-300">
    </div>

    <!-- Modal Container -->
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 ease-out overflow-hidden"
        id="profile-settings-modal-content">
        <!-- Modal Header with Gradient -->
        <div
            class="border-b border-white/10 px-6 py-5 flex items-center justify-between bg-gradient-to-r from-indigo-600 to-purple-600">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                    <i class='bx bx-user-circle text-white text-xl'></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Profile Settings</h3>
                    <p class="text-xs text-indigo-200/80">Update your account details</p>
                </div>
            </div>
            <button onclick="closeModal('profile-settings-modal')"
                class="p-1.5 rounded-full hover:bg-white/10 transition-colors text-white hover:text-gray-200 transform hover:rotate-90 transition-transform">
                <i class='bx bx-x text-xl'></i>
            </button>
        </div>

        <!-- Loading Overlay (hidden by default) -->
        <div id="profile-loading-overlay"
            class="absolute inset-0 bg-white/80 backdrop-blur-sm flex items-center justify-center hidden z-10">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div>
        </div>

        <!-- Success Message (hidden by default) -->
        <div id="profile-success-message" class="hidden p-4 bg-emerald-50 border-b border-emerald-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class='bx bx-check-circle text-emerald-500 text-xl'></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-emerald-800">Profile updated successfully!</p>
                </div>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <form id="profile-settings-form" method="post" action="{{ route('profile.update') }}"
                enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('patch')

                <!-- Avatar Upload Section -->
                <div class="flex flex-col items-center">
                    <div class="relative group">
                        <div
                            class="relative h-24 w-24 rounded-full overflow-hidden border-4 border-white shadow-lg ring-2 ring-indigo-500/30">
                            @if (auth()->user()->avatar)
                                <img id="profile-preview" class="h-full w-full object-cover"
                                    src="{{ asset('images/' . auth()->user()->avatar) }}" alt="Profile photo">
                            @else
                                <div id="profile-preview"
                                    class="h-full w-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center text-indigo-600 font-bold text-4xl">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <label for="profile-avatar"
                            class="absolute -bottom-2 -right-2 bg-white p-2.5 rounded-full shadow-lg cursor-pointer hover:bg-gray-50 transition-all group-hover:scale-110">
                            <i class='bx bx-camera text-indigo-600 text-lg'></i>
                            <input type="file" id="profile-avatar" name="avatar" accept="image/*"
                                class="hidden">
                        </label>
                    </div>
                    <p class="mt-3 text-xs text-gray-500 text-center">Click on camera to upload new photo</p>
                    <x-input-error class="mt-2 text-center" :messages="$errors->get('avatar')" />
                </div>

                <!-- Name Field -->
                <div>
                    <label for="profile-name" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-user mr-2 text-indigo-500'></i> Full Name
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-id-card text-gray-400'></i>
                        </div>
                        <input id="profile-name" name="name" type="text"
                            class="block w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            value="{{ old('name', auth()->user()->name) }}" required autofocus>
                    </div>
                    <x-input-error class="mt-1" :messages="$errors->get('name')" />
                </div>

                <!-- Email Field -->
                <div>
                    <label for="profile-email" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-envelope mr-2 text-indigo-500'></i> Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-at text-gray-400'></i>
                        </div>
                        <input id="profile-email" name="email" type="email"
                            class="block w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                    <x-input-error class="mt-1" :messages="$errors->get('email')" />
                </div>

                <!-- Email Verification Status -->
                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div class="p-3 bg-amber-50 rounded-lg border border-amber-100 flex items-start">
                        <i class='bx bx-error-circle text-amber-500 mt-0.5 mr-2'></i>
                        <div>
                            <p class="text-sm text-amber-700">
                                Your email is unverified. Click the verification link sent to your email.
                            </p>
                            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit"
                                    class="text-amber-600 hover:text-amber-500 text-xs underline mt-1 inline-flex items-center">
                                    Resend verification email
                                    <i class='bx bx-send ml-1'></i>
                                </button>
                            </form>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-1 text-xs text-emerald-600 flex items-center">
                                    <i class='bx bx-check-circle mr-1'></i> Verification link sent!
                                </p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Modal Footer -->
                <div class="pt-3 flex justify-end space-x-3 border-t border-gray-100">
                    <button type="button" onclick="closeModal('profile-settings-modal')"
                        class="px-5 py-2.5 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors flex items-center">
                        <i class='bx bx-x mr-1.5'></i> Cancel
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all shadow-md hover:shadow-lg flex items-center">
                        <i class='bx bx-save mr-1.5'></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
        height: 5px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.02);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #6366f1, #8b5cf6);
        border-radius: 10px;
        opacity: 0.6;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #7c3aed, #9333ea);
        opacity: 1;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .shadow-glow {
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
    }

    .hover\:shadow-glow:hover {
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
    }

    @keyframes modalEnter {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
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
            transform: translateY(20px) scale(0.95);
        }
    }
</style>

<script>
    // Modal Handling Functions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) {
            console.error(`Modal with ID ${modalId} does not exist.`);
            return;
        }

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        const content = document.getElementById(modalId + '-content');
        if (content) {
            content.classList.add('animate-[modalEnter_0.3s_ease-out]');
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) {
            console.error(`Modal with ID ${modalId} does not exist.`);
            return;
        }

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

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('bg-black/30')) {
            const openModals = document.querySelectorAll('.bg-black/30:not(.hidden)');
            openModals.forEach(modal => {
                closeModal(modal.id);
            });
        }
    });

    // Profile avatar preview
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
                    img.className = 'h-24 w-24 rounded-full object-cover border-4 border-white shadow-md';
                    preview?.parentNode?.replaceChild(img, preview);
                    img.id = 'profile-preview';
                }
            };

            reader.readAsDataURL(file);
        }
    });

    // Handle form submission feedback
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bx bx-loader bx-spin mr-1.5"></i> Saving...';
            }
        });
    });

    // Additional Animations and Interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Add any additional initialization or animations here
        console.log('Dashboard initialized successfully.');
    });
</script>
