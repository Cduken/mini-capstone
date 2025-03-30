<x-app-layout>


    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-4">
            <!-- Header with Add Product Button -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-[26px] gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Product Management</h2>

                </div>

                <button onclick="openModal('add-product-modal')"
                    class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium py-2 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center w-full md:w-auto">
                    <i class='bx bx-plus-circle text-xl mr-2'></i>
                    Add New Product
                </button>
            </div>

            @if ($products->isEmpty())
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div
                            class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-50 to-indigo-50 rounded-full flex items-center justify-center mb-6">
                            <i class='bx bx-package text-4xl text-blue-500'></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">No Products Found</h3>
                        <p class="text-gray-600 mb-6">Get started by adding your first product to inventory</p>
                        <button onclick="openModal('add-product-modal')"
                            class="bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium py-2 px-6 rounded-lg shadow-sm hover:shadow-md transition-all">
                            <i class='bx bx-plus mr-2'></i> Add Product
                        </button>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Table Header with Search -->
                    <div
                        class="px-4 py-2 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                                <i class='bx bx-package text-xl'></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800">Product Inventory</h3>
                                <p class="text-xs text-gray-500">{{ $products->count() }} products in stock</p>
                            </div>
                        </div>
                        <!-- Search Form -->
                        <form method="GET" action="{{ route('admin.products.index') }}"
                            class="relative w-full md:w-64">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-search text-gray-400'></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Search products...">
                            @if (request('search'))
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <a href="{{ route('admin.products.index') }}"
                                        class="text-gray-400 hover:text-gray-600">
                                        <i class='bx bx-x'></i>
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>


                    <div class="overflow-y-auto max-h-[500px]">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    {{-- <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        #</th> --}}
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($products as $product)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $loop->iteration }}</td> --}}
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}"
                                                        class="h-full w-full object-cover">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-medium text-gray-900">{{ $product->title }}</div>
                                                    <div class="text-sm text-gray-500">SKU: {{ $product->id ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 bg-blue-50 text-blue-800 rounded-full text-xs font-medium">
                                                <i class='bx bx-category mr-1'></i> {{ $product->category }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            ${{ number_format($product->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium flex items-center w-fit
                                                {{ $product->inStock ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                <i
                                                    class='bx {{ $product->inStock ? 'bx-check-circle' : 'bx-x-circle' }} mr-1'></i>
                                                {{ $product->inStock ? 'In Stock' : 'Out of Stock' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <!-- Edit Button -->
                                                <button onclick="openEditModal({{ $product->id }})"
                                                    class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 transition-colors duration-200 group relative"
                                                    title="Edit">
                                                    <i class="bx bx-edit text-lg"></i>
                                                    <span class="tooltip-text">Edit</span>
                                                </button>

                                                <!-- Delete Button -->
                                                <form id="delete-form-{{ $product->id }}"
                                                    action="{{ route('admin.products.destroy', $product->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        onclick="openDeleteModal({{ $product->id }})"
                                                        class="p-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-colors duration-200 group relative"
                                                        title="Delete">
                                                        <i class="bx bx-trash text-lg"></i>
                                                        <span class="tooltip-text">Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>




                    <div class="px-4 py-2 border-t border-gray-200 bg-gray-50 flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of
                            {{ $products->total() }} results
                        </div>

                        <div class="flex items-center space-x-1">
                            {{ $products->appends(['search' => request('search')])->onEachSide(1)->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Product Modal -->
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
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data"
                    id="add-product-form">
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
                                    <option value="Accessories"
                                        {{ old('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                                    <option value="Airpods" {{ old('category') == 'Airpods' ? 'selected' : '' }}>
                                        Airpods</option>
                                    <option value="Desktop" {{ old('category') == 'Desktop' ? 'selected' : '' }}>
                                        Desktop</option>
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
                            <div class="flex items-center gap-4">
                                <!-- Image Preview Container (initially hidden) -->
                                <div id="image-preview-container"
                                    class="hidden flex-shrink-0 h-48 w-48 rounded-lg overflow-hidden border border-gray-200 bg-gray-100">
                                    <img id="image-preview" src="" alt="Preview"
                                        class="h-full w-full object-cover">
                                </div>

                                <!-- Upload Box -->
                                <div class="flex-1">
                                    <div
                                        class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl">
                                        <div class="space-y-1 text-center">
                                            <div class="flex text-sm text-gray-600 justify-center">
                                                <label for="image" id="image-upload-label"
                                                    class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                                    <span id="image-upload-text">Upload a file</span>
                                                    <input id="image" name="image" type="file"
                                                        class="sr-only" accept="image/*">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                        </div>
                                    </div>
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

    <!-- Edit Product Modal -->
    <div id="edit-product-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md transform transition-all duration-300"
            id="edit-product-modal-content">
            <!-- Modal Header (compact like add modal) -->
            <div
                class="border-b border-gray-200 px-5 py-3 flex items-center justify-between bg-gradient-to-r from-blue-500 to-blue-600 rounded-t-xl">
                <div class="flex items-center space-x-2">
                    <div class="p-1.5 bg-white bg-opacity-20 rounded-lg">
                        <i class='bx bx-edit text-white text-lg'></i>
                    </div>
                    <h3 class="text-lg font-bold text-white">Edit Product</h3>
                </div>
                <button onclick="closeModal('edit-product-modal')"
                    class="text-white hover:text-gray-200 transition-colors">
                    <i class='bx bx-x text-xl'></i>
                </button>
            </div>

            <!-- Modal Body (compact like add modal) -->
            <div class="p-4">
                <form id="edit-product-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <!-- Product Name -->
                        <div>
                            <label for="edit-title"
                                class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class='bx bx-rename mr-2 text-blue-500 text-sm'></i> Product Name
                            </label>
                            <div class="relative">
                                <input type="text" name="title" id="edit-title"
                                    class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    placeholder="Enter product name">
                                <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                                    <i class='bx bx-text text-gray-400 text-sm'></i>
                                </div>
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="edit-category"
                                class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class='bx bx-category mr-2 text-blue-500 text-sm'></i> Category
                            </label>
                            <div class="relative">
                                <select name="category" id="edit-category"
                                    class="w-full pl-8 pr-8 py-2 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                    <option value="">Select a category</option>
                                    <option value="Phone">Phone</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Laptop">Laptop</option>
                                    <option value="Watch">Watch</option>
                                    <option value="Airpods">Airpods</option>
                                    <option value="Desktop">Desktop</option>
                                    <option value="Camera">Camera</option>
                                    <option value="Accessories">Accessories</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                                    <i class='bx bx-category text-gray-400 text-sm'></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none">
                                    <i class='bx bx-chevron-down text-gray-400 text-sm'></i>
                                </div>
                            </div>
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="edit-price"
                                class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class='bx bx-dollar mr-2 text-blue-500 text-sm'></i> Price
                            </label>
                            <div class="relative">
                                <input type="text" name="price" id="edit-price"
                                    class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0.00">
                                <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">$</span>
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload (compact version) -->
                        <div>
                            <label for="edit-image"
                                class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class='bx bx-image mr-2 text-blue-500 text-sm'></i> Product Image
                            </label>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden border border-gray-200">
                                    <img id="edit-current-image" src="" alt="Current product image"
                                        class="h-full w-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div
                                        class="flex justify-center px-4 pt-3 pb-3 border-2 border-gray-300 border-dashed rounded-lg">
                                        <div class="space-y-1 text-center">
                                            <div class="flex text-xs text-gray-600 justify-center">
                                                <label for="edit-image"
                                                    class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500">
                                                    <span>Change image</span>
                                                    <input id="edit-image" name="image" type="file"
                                                        class="sr-only" accept="image/*">
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Stock Status (compact version) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class='bx bx-check-shield mr-2 text-blue-500 text-sm'></i> Stock Status
                            </label>
                            <div class="grid grid-cols-2 gap-2">
                                <label
                                    class="flex items-center space-x-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 border-gray-300"
                                    id="edit-inStock-true">
                                    <input type="radio" name="inStock" value="1"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <span class="block text-xs font-medium text-gray-700">In Stock</span>
                                    </div>
                                    <i class='bx bx-check-circle text-lg ml-auto text-green-500'></i>
                                </label>
                                <label
                                    class="flex items-center space-x-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 border-gray-300"
                                    id="edit-inStock-false">
                                    <input type="radio" name="inStock" value="0"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <span class="block text-xs font-medium text-gray-700">Out of Stock</span>
                                    </div>
                                    <i class='bx bx-x-circle text-lg ml-auto text-red-500'></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer (compact like add modal) -->
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" onclick="closeModal('edit-product-modal')"
                            class="px-4 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors flex items-center">
                            <i class='bx bx-x mr-1'></i> Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-colors shadow-sm flex items-center">
                            <i class='bx bx-save mr-1'></i> Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-product-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 hidden transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0"
            id="delete-product-modal-content">
            <!-- Modal Header -->
            <div class="border-b border-gray-200 px-5 py-3 flex items-center justify-between rounded-t-xl bg-red-50">
                <div class="flex items-center space-x-2">
                    <div class="p-1.5 bg-red-100 rounded-lg">
                        <i class='bx bx-trash text-red-600 text-lg'></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Delete Product</h3>
                </div>
                <button onclick="closeModal('delete-product-modal')"
                    class="text-gray-500 hover:text-gray-700 transition-colors">
                    <i class='bx bx-x text-xl'></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="text-center">
                    <p class="text-gray-600 mb-4">
                        <span id="delete-product-title" class="font-medium text-gray-900"></span>
                    </p>
                    <p class="text-sm text-gray-500">This action cannot be undone. Are you sure you want to delete this
                        product?</p>
                </div>

                <!-- Modal Footer -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('delete-product-modal')"
                        class="px-4 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors flex items-center">
                        <i class='bx bx-x mr-1'></i> Cancel
                    </button>
                    <button type="button" id="delete-product-confirm"
                        class="px-4 py-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors flex items-center">
                        <i class='bx bx-trash mr-1'></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const previewContainer = document.getElementById('image-preview-container');
            const imagePreview = document.getElementById('image-preview');

            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        previewContainer.classList.remove('hidden');
                        imagePreview.src = event.target.result;
                    }

                    reader.readAsDataURL(file);
                } else {
                    previewContainer.classList.add('hidden');
                    imagePreview.src = '';
                }
            });
        });

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

        function openEditModal(productId) {
            fetch(`/admin/products/${productId}/json`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-title').value = data.title;
                    document.getElementById('edit-category').value = data.category;
                    document.getElementById('edit-price').value = data.price;

                    // Set stock status
                    if (data.inStock) {
                        document.querySelector('#edit-inStock-true input').checked = true;
                        document.querySelector('#edit-inStock-true').classList.add('border-blue-500', 'bg-blue-50');
                    } else {
                        document.querySelector('#edit-inStock-false input').checked = true;
                        document.querySelector('#edit-inStock-false').classList.add('border-blue-500', 'bg-blue-50');
                    }

                    // Set current image - make sure this uses the full URL if needed
                    const imageUrl = data.image.startsWith('http') ? data.image : `/${data.image}`;
                    document.getElementById('edit-current-image').src = imageUrl;

                    // Update form action
                    document.getElementById('edit-product-form').action = `/admin/products/${productId}/update`;

                    openModal('edit-product-modal');
                })
                .catch(error => {
                    console.error('Error fetching product data:', error);
                    alert('Failed to load product data');
                });
        }

        function openDeleteModal(productId) {
            fetch(`/admin/products/${productId}/json`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('delete-product-title').textContent = data.title;
                    document.getElementById('delete-product-confirm').addEventListener('click', function() {
                        document.getElementById(`delete-form-${productId}`).submit();
                    });
                    openModal('delete-product-modal');
                })
                .catch(error => {
                    console.error('Error fetching product data:', error);
                });
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

        // Debounce function to prevent too many requests
        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        // Apply debouncing to search
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('keyup', debounce(function(e) {
                if (e.target.value.length > 2 || e.target.value.length === 0) {
                    e.target.form.submit();
                }
            }, 500));
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Handle image preview for add modal
            const addImageInput = document.getElementById('image');
            if (addImageInput) {
                addImageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            // Create a preview container if it doesn't exist
                            let previewContainer = document.querySelector(
                                '#add-product-modal .image-preview');
                            if (!previewContainer) {
                                previewContainer = document.createElement('div');
                                previewContainer.className =
                                    'image-preview flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden border border-gray-200 ml-3';
                                const uploadContainer = document.querySelector(
                                    '#add-product-modal .border-dashed');
                                uploadContainer.parentNode.insertBefore(previewContainer,
                                    uploadContainer);
                            }
                            previewContainer.innerHTML =
                                `<img src="${event.target.result}" class="h-full w-full object-cover">`;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Handle image preview for edit modal
            const editImageInput = document.getElementById('edit-image');
            if (editImageInput) {
                editImageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            document.getElementById('edit-current-image').src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>

    <style>
        .tooltip-text {
            visibility: hidden;
            width: 60px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -30px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 12px;
        }

        .group:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Custom scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>
</x-app-layout>
