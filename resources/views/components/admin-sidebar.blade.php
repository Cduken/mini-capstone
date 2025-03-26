<div x-data="{ open: true, activeGroup: null }" class="flex">
    <!-- Sidebar Overlay (for mobile) -->
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-20 lg:hidden"
        x-transition></div>

    <!-- Add Product Modal (same as your main page) -->
    <div id="add-product-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 hidden transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg transform transition-all duration-300 scale-95 opacity-0"
            id="add-product-modal-content">
            <!-- Modal Header -->
            <div
                class="border-b border-gray-200 px-6 py-4 flex items-center justify-between bg-gradient-to-r from-blue-500 to-blue-600 rounded-t-2xl">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white bg-opacity-20 rounded-lg">
                        <i class='bx bx-package text-white text-xl'></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">Add New Product</h3>
                </div>
                <button onclick="closeModal('add-product-modal')"
                    class="text-white hover:text-gray-200 transition-colors">
                    <i class='bx bx-x text-2xl'></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-5">
                        <!-- Product Name -->
                        <div>
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class='bx bx-rename mr-2 text-blue-500'></i> Product Name
                            </label>
                            <div class="relative">
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    placeholder="Enter product name">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-text text-gray-400'></i>
                                </div>
                            </div>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class='bx bx-error-circle mr-1'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class='bx bx-category mr-2 text-blue-500'></i> Category
                            </label>
                            <div class="relative">
                                <select name="category" id="category"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                    <option value="">Select a category</option>
                                    <option value="Phone" {{ old('category') == 'Phone' ? 'selected' : '' }}>Phone
                                    </option>
                                    <option value="Tablet" {{ old('category') == 'Tablet' ? 'selected' : '' }}>Tablet
                                    </option>
                                    <option value="Laptop" {{ old('category') == 'Laptop' ? 'selected' : '' }}>Laptop
                                    </option>
                                    <option value="Watch" {{ old('category') == 'Watch' ? 'selected' : '' }}>Watch
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-category text-gray-400'></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class='bx bx-chevron-down text-gray-400'></i>
                                </div>
                            </div>
                            @error('category')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class='bx bx-error-circle mr-1'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class='bx bx-dollar mr-2 text-blue-500'></i> Price
                            </label>
                            <div class="relative">
                                <input type="text" name="price" id="price" value="{{ old('price') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0.00">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">$</span>
                                </div>
                            </div>
                            @error('price')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class='bx bx-error-circle mr-1'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label for="image"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class='bx bx-image mr-2 text-blue-500'></i> Product Image
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl">
                                <div class="space-y-1 text-center">
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="image"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Upload a file</span>
                                            <input id="image" name="image" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class='bx bx-error-circle mr-1'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Stock Status -->
                        <div>
                            <label for="inStock"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class='bx bx-check-shield mr-2 text-blue-500'></i> Stock Status
                            </label>
                            <div class="grid grid-cols-2 gap-4">
                                <label
                                    class="flex items-center space-x-3 p-4 border rounded-xl cursor-pointer hover:bg-gray-50
                                    {{ old('inStock') == '1' ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }}">
                                    <input type="radio" name="inStock" value="1"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500"
                                        {{ old('inStock') == '1' ? 'checked' : '' }}>
                                    <div>
                                        <span class="block text-sm font-medium text-gray-700">In Stock</span>
                                        <span class="block text-xs text-gray-500">Available for purchase</span>
                                    </div>
                                    <i class='bx bx-check-circle text-xl ml-auto text-green-500'></i>
                                </label>
                                <label
                                    class="flex items-center space-x-3 p-4 border rounded-xl cursor-pointer hover:bg-gray-50
                                    {{ old('inStock') == '0' ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }}">
                                    <input type="radio" name="inStock" value="0"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500"
                                        {{ old('inStock') == '0' ? 'checked' : '' }}>
                                    <div>
                                        <span class="block text-sm font-medium text-gray-700">Out of Stock</span>
                                        <span class="block text-xs text-gray-500">Not available</span>
                                    </div>
                                    <i class='bx bx-x-circle text-xl ml-auto text-red-500'></i>
                                </label>
                            </div>
                            @error('inStock')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class='bx bx-error-circle mr-1'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal('add-product-modal')"
                            class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors flex items-center">
                            <i class='bx bx-x mr-2'></i> Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-colors shadow-sm flex items-center">
                            <i class='bx bx-save mr-2'></i> Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed lg:relative z-30 w-72 min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 text-white p-4 space-y-6 shadow-2xl flex flex-col transition-all duration-300 border-r border-gray-700/50"
        :class="{ '-translate-x-full lg:translate-x-0': !open }">

        <!-- Sidebar Header -->
        <div class="flex items-center justify-between pb-4">
            <div class="flex items-center space-x-3">
                <div class="p-2 rounded-lg bg-gradient-to-tr from-blue-500 to-indigo-600 shadow-lg">
                    <i class='bx bxs-dashboard text-xl text-white'></i>
                </div>
                <h3
                    class="text-xl font-bold bg-gradient-to-r from-blue-300 to-indigo-200 bg-clip-text text-transparent">
                    Admin Console</h3>
            </div>
            <button @click="open = false" class="lg:hidden p-1 rounded-full hover:bg-gray-700/50 transition-colors">
                <i class='bx bx-x text-2xl text-gray-300'></i>
            </button>
        </div>

        <!-- Sidebar Menu -->
        <nav class="flex-1 overflow-y-auto custom-scrollbar">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center p-3 rounded-xl hover:bg-gray-700/30 transition-all group {{ request()->routeIs('home') ? 'bg-gray-700/40 text-blue-300 border-l-4 border-blue-400' : '' }}">
                        <div
                            class="p-2 mr-3 rounded-lg group-hover:bg-blue-500/10 transition-colors {{ request()->routeIs('home') ? 'bg-blue-500/20' : 'bg-gray-700/50' }}">
                            <i class='bx bxs-home text-lg'></i>
                        </div>
                        <span class="font-medium">Home</span>
                        <div
                            class="ml-auto w-2 h-2 rounded-full bg-blue-400 animate-pulse {{ request()->routeIs('home') ? '' : 'opacity-0' }}">
                        </div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-3 rounded-xl hover:bg-gray-700/30 transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700/40 text-blue-300 border-l-4 border-blue-400' : '' }}">
                        <div
                            class="p-2 mr-3 rounded-lg group-hover:bg-blue-500/10 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500/20' : 'bg-gray-700/50' }}">
                            <i class='bx bxs-dashboard text-lg'></i>
                        </div>
                        <span class="font-medium">Dashboard</span>
                        <span
                            class="ml-auto px-2 py-1 text-xs rounded-full bg-blue-500/30 text-blue-300 animate-pulse">New</span>
                    </a>
                </li>

                <!-- Collapsible Group -->
                <li x-data="{ expanded: {{ request()->routeIs('admin.products.*') ? 'true' : 'false' }} }">
                    <button @click="expanded = !expanded; activeGroup = activeGroup === 'products' ? null : 'products'"
                        class="w-full flex items-center p-3 rounded-xl hover:bg-gray-700/30 transition-all">
                        <div class="p-2 mr-3 rounded-lg bg-gray-700/50 group-hover:bg-blue-500/10">
                            <i class='bx bx-package text-lg'></i>
                        </div>
                        <span class="font-medium text-left">Products</span>
                        <i class='bx bx-chevron-down ml-auto transform transition-transform duration-200'
                            :class="{ 'rotate-180': expanded }"></i>
                    </button>

                    <ul x-show="expanded" x-collapse class="ml-4 pl-5 border-l border-gray-700/30 space-y-1 mt-1">
                        <li>
                            <a href="{{ route('admin.products.index') }}"
                                class="flex items-center p-2 rounded-lg hover:bg-gray-700/20 transition-all text-sm {{ request()->routeIs('admin.products.index') ? 'text-blue-300' : '' }}">
                                <i class='bx bx-list-ul mr-2 text-sm'></i>
                                <span>All Products</span>
                            </a>
                        </li>
                        <li>
                            <button onclick="openModal('add-product-modal')"
                                class="w-full flex items-center p-2 rounded-lg hover:bg-gray-700/20 transition-all text-sm">
                                <i class='bx bx-plus-circle mr-2 text-sm'></i>
                                <span>Add New</span>
                            </button>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.users') }}"
                        class="flex items-center p-3 rounded-xl hover:bg-gray-700/30 transition-all group {{ request()->routeIs('admin.users') ? 'bg-gray-700/40 text-blue-300 border-l-4 border-blue-400' : '' }}">
                        <div
                            class="p-2 mr-3 rounded-lg group-hover:bg-blue-500/10 transition-colors {{ request()->routeIs('admin.users') ? 'bg-blue-500/20' : 'bg-gray-700/50' }}">
                            <i class='bx bx-user text-lg'></i>
                        </div>
                        <span class="font-medium">User Management</span>
                        <div
                            class="ml-auto w-2 h-2 rounded-full bg-green-400 animate-pulse {{ request()->routeIs('admin.users') ? '' : 'opacity-0' }}">
                        </div>
                    </a>
                </li>
{{--
                <li>
                    <a href="#"
                        class="flex items-center p-3 rounded-xl hover:bg-gray-700/30 transition-all group">
                        <div class="p-2 mr-3 rounded-lg group-hover:bg-blue-500/10 transition-colors bg-gray-700/50">
                            <i class='bx bx-bar-chart-alt-2 text-lg'></i>
                        </div>
                        <span class="font-medium">Analytics</span>
                    </a>
                </li> --}}
            </ul>
        </nav>

        <!-- Sidebar Footer -->
        <div class="pt-4 mt-auto">
            <div class="p-3 bg-gray-800/50 rounded-xl border border-gray-700/30 backdrop-blur-sm">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1e40af&color=fff"
                            alt="Admin" class="w-10 h-10 rounded-full border-2 border-blue-500/50">
                        <div
                            class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-green-500 border-2 border-gray-800">
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="p-2 rounded-lg hover:bg-gray-700/50 transition-colors text-gray-300 hover:text-white"
                            title="Logout">
                            <i class='bx bx-log-out text-xl'></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Button (for mobile) -->
    <button @click="open = !open"
        class="fixed bottom-6 left-6 z-20 p-3 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-full shadow-lg hover:shadow-xl transition-all lg:hidden"
        x-transition>
        <i class='bx bx-menu text-xl text-white' x-show="!open"></i>
        <i class='bx bx-x text-xl text-white' x-show="open"></i>
    </button>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.2);
    }
</style>

<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(`${modalId}-content`);

        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-95');
            content.classList.remove('opacity-0');
        }, 20);

        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(`${modalId}-content`);

        modal.classList.add('opacity-0');
        content.classList.add('scale-95');
        content.classList.add('opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);

        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('bg-black')) {
            const openModals = document.querySelectorAll('.bg-black:not(.hidden)');
            openModals.forEach(modal => {
                closeModal(modal.id);
            });
        }
    });
</script>
