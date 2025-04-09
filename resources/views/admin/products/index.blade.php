<x-app-layout>
    <div class="flex min-h-screen bg-gradient-to-br from-gray-900 via-indigo-900 to-black text-white">
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-4">
            <!-- Header with Add Product Button -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                <h2
                    class="text-2xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-purple-500 drop-shadow-md">
                    Product Management
                </h2>
                <button onclick="openModal('add-product-modal')"
                    class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium py-2 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center w-full md:w-auto glow">
                    <i class='bx bx-plus-circle text-xl mr-2'></i>
                    Add New Product
                </button>
            </div>

            @if ($products->isEmpty())
                <!-- Empty State -->
                <div
                    class="bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-xl rounded-2xl shadow-xl border border-indigo-500/20 p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div
                            class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-50/20 to-indigo-50/20 rounded-full flex items-center justify-center mb-6 glow">
                            <i class='bx bx-package text-4xl text-blue-400'></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white drop-shadow-md">No Products Found</h3>
                        <p class="text-gray-300 mt-2">Get started by adding your first product to inventory</p>
                    </div>
                </div>
            @else
                <div
                    class="bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-xl rounded-2xl shadow-xl border border-indigo-500/20 overflow-hidden">
                    <!-- Table Header with Search -->
                    <div
                        class="px-4 py-2 border-b border-indigo-500/30 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-gray-900/30">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-600/20 rounded-lg text-blue-400 glow">
                                <i class='bx bx-package text-xl'></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-white drop-shadow-md">Product Inventory</h3>
                                <p class="text-xs text-gray-300">{{ $products->count() }} products in stock</p>
                            </div>
                        </div>
                        <!-- Search Form -->
                        <form method="GET" action="{{ route('admin.products.index') }}"
                            class="relative w-full md:w-64">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-search text-gray-400'></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="block w-full pl-10 pr-3 py-2 border border-indigo-500/30 rounded-lg bg-gray-800/50 shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400 glow-sm"
                                placeholder="Search products...">
                            @if (request('search'))
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <a href="{{ route('admin.products.index') }}"
                                        class="text-gray-400 hover:text-gray-200">
                                        <i class='bx bx-x'></i>
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>

                    <div class="overflow-y-auto max-h-[500px]">
                        <table class="w-full divide-y divide-indigo-500/20">
                            <thead class="bg-gray-900/30">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Product
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-indigo-500/20">
                                @foreach ($products as $product)
                                    <tr class="hover:bg-indigo-900/20 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden bg-gray-800/50 border border-indigo-500/30 glow-sm">
                                                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}"
                                                        class="h-full w-full object-cover">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-medium text-white drop-shadow-md">
                                                        {{ $product->title }}</div>
                                                    <div class="text-xs text-gray-300">SKU: {{ $product->id ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 bg-blue-600/20 text-blue-300 rounded-full text-xs font-medium glow-sm">
                                                <i class='bx bx-category mr-1'></i> {{ $product->category }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                            ${{ number_format($product->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium flex items-center w-fit
                                                {{ $product->inStock ? 'bg-green-600/20 text-green-300' : 'bg-red-600/20 text-red-300' }} glow-sm">
                                                <i
                                                    class='bx {{ $product->inStock ? 'bx-check-circle' : 'bx-x-circle' }} mr-1'></i>
                                                {{ $product->inStock ? 'In Stock' : 'Out of Stock' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <!-- Edit Button -->
                                                <button onclick="openEditModal({{ $product->id }})"
                                                    class="p-2 rounded-lg bg-blue-600/20 hover:bg-blue-600/40 text-blue-300 transition-colors duration-200 group relative glow-sm"
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
                                                        class="p-2 rounded-lg bg-red-600/20 hover:bg-red-600/40 text-red-300 transition-colors duration-200 group relative glow-sm"
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

                    <div
                        class="px-4 py-2 border-t border-indigo-500/30 bg-gray-900/30 flex items-center justify-between">
                        <div class="text-sm text-gray-300">
                            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of
                            {{ $products->total() }} results
                        </div>
                        <div class="flex items-center space-x-1 ajax-pagination">
                            {{ $products->appends(['search' => request('search')])->onEachSide(1)->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Product Modal (Redesigned) -->
    <div id="add-product-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-70 backdrop-blur-xl hidden transition-opacity duration-300">
        <div class="bg-gray-800 rounded-2xl shadow-xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0 glow"
            id="add-product-modal-content">
            <!-- Modal Header -->
            <div
                class="bg-gradient-to-r from-blue-600 to-indigo-700 px-5 py-4 flex items-center justify-between rounded-t-2xl">
                <div class="flex items-center space-x-3">
                    <i class='bx bx-package text-white text-2xl'></i>
                    <h3 class="text-xl font-bold text-white tracking-tight">Add New Product</h3>
                </div>
                <button onclick="closeModal('add-product-modal')"
                    class="text-white hover:text-gray-300 transition-colors duration-200">
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
                            <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                                Product Name
                            </label>
                            <div class="relative">
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="w-full pl-10 pr-3 py-2 text-sm bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-gray-400"
                                    placeholder="Enter product name">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-rename text-gray-400 text-sm'></i>
                                </div>
                            </div>
                            @error('title')
                                <p class="mt-1 text-xs text-red-500 flex items-center">
                                    <i class='bx bx-error-circle mr-1 text-xs'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-300 mb-2">
                                Category
                            </label>
                            <div class="relative">
                                <select name="category" id="category"
                                    class="w-full pl-10 pr-8 py-2 text-sm bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none">
                                    <option value="" class="bg-gray-800">Select a category</option>
                                    <option value="Phone" {{ old('category') == 'Phone' ? 'selected' : '' }}
                                        class="bg-gray-800">Phone</option>
                                    <option value="Tablet" {{ old('category') == 'Tablet' ? 'selected' : '' }}
                                        class="bg-gray-800">Tablet</option>
                                    <option value="Laptop" {{ old('category') == 'Laptop' ? 'selected' : '' }}
                                        class="bg-gray-800">Laptop</option>
                                    <option value="Watch" {{ old('category') == 'Watch' ? 'selected' : '' }}
                                        class="bg-gray-800">Watch</option>
                                    <option value="Accessories"
                                        {{ old('category') == 'Accessories' ? 'selected' : '' }} class="bg-gray-800">
                                        Accessories</option>
                                    <option value="Airpods" {{ old('category') == 'Airpods' ? 'selected' : '' }}
                                        class="bg-gray-800">Airpods</option>
                                    <option value="Desktop" {{ old('category') == 'Desktop' ? 'selected' : '' }}
                                        class="bg-gray-800">Desktop</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-category text-gray-400 text-sm'></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class='bx bx-chevron-down text-gray-400 text-sm'></i>
                                </div>
                            </div>
                            @error('category')
                                <p class="mt-1 text-xs text-red-500 flex items-center">
                                    <i class='bx bx-error-circle mr-1 text-xs'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-300 mb-2">
                                Price
                            </label>
                            <div class="relative">
                                <input type="text" name="price" id="price" value="{{ old('price') }}"
                                    class="w-full pl-10 pr-3 py-2 text-sm bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-gray-400"
                                    placeholder="0.00">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-dollar text-gray-400 text-sm'></i>
                                </div>
                            </div>
                            @error('price')
                                <p class="mt-1 text-xs text-red-500 flex items-center">
                                    <i class='bx bx-error-circle mr-1 text-xs'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-300 mb-2">
                                Product Image
                            </label>
                            <div class="flex items-center space-x-3">
                                <div id="image-preview-container"
                                    class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden border border-gray-600 hidden">
                                    <img id="image-preview" src="" alt="Preview"
                                        class="h-full w-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div
                                        class="flex justify-center px-4 pt-3 pb-3 border-2 border-gray-600 border-dashed rounded-lg bg-gray-700">
                                        <div class="space-y-1 text-center">
                                            <div class="flex text-xs text-gray-400 justify-center">
                                                <label for="image" id="image-upload-label"
                                                    class="relative cursor-pointer rounded-md font-medium text-blue-400 hover:text-blue-300 transition-colors">
                                                    <span id="image-upload-text">Upload a file</span>
                                                    <input id="image" name="image" type="file"
                                                        class="sr-only" accept="image/*">
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-xs text-red-500 flex items-center">
                                    <i class='bx bx-error-circle mr-1 text-xs'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Stock Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">
                                Stock Status
                            </label>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-400">Out of Stock</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="inStock" value="1" class="sr-only peer"
                                        {{ old('inStock') == '1' ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-600 rounded-full peer peer-checked:bg-green-500 transition-colors duration-300">
                                    </div>
                                    <div
                                        class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300 peer-checked:translate-x-5">
                                    </div>
                                </label>
                                <span class="text-sm text-gray-400">In Stock</span>
                            </div>
                            @error('inStock')
                                <p class="mt-1 text-xs text-red-500 flex items-center">
                                    <i class='bx bx-error-circle mr-1 text-xs'></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal('add-product-modal')"
                            class="px-4 py-2 bg-gray-600 text-white text-sm rounded-lg hover:bg-gray-700 transition-colors duration-200 flex items-center">
                            <i class='bx bx-x mr-1'></i> Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 flex items-center glow">
                            <i class='bx bx-plus mr-1'></i> Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal (Redesigned with Fix) -->
    <div id="edit-product-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-70 backdrop-blur-xl hidden transition-opacity duration-300">
        <div class="bg-gray-800 rounded-2xl shadow-xl w-full max-w-md transform transition-all duration-300 glow"
            id="edit-product-modal-content">
            <div
                class="bg-gradient-to-r from-blue-600 to-indigo-700 px-5 py-4 flex items-center justify-between rounded-t-2xl">
                <div class="flex items-center space-x-3">
                    <i class='bx bx-edit text-white text-2xl'></i>
                    <h3 class="text-xl font-bold text-white tracking-tight">Edit Product</h3>
                </div>
                <button onclick="closeModal('edit-product-modal')"
                    class="text-white hover:text-gray-300 transition-colors duration-200">
                    <i class='bx bx-x text-2xl'></i>
                </button>
            </div>
            <div class="p-6">
                <form id="edit-product-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-5">
                        <div>
                            <label for="edit-title" class="block text-sm font-medium text-gray-300 mb-2">
                                Product Name
                            </label>
                            <div class="relative">
                                <input type="text" name="title" id="edit-title"
                                    class="w-full pl-10 pr-3 py-2 text-sm bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-gray-400"
                                    placeholder="Enter product name">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-rename text-gray-400 text-sm'></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="edit-category" class="block text-sm font-medium text-gray-300 mb-2">
                                Category
                            </label>
                            <div class="relative">
                                <select name="category" id="edit-category"
                                    class="w-full pl-10 pr-8 py-2 text-sm bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none">
                                    <option value="" class="bg-gray-800">Select a category</option>
                                    <option value="Phone" class="bg-gray-800">Phone</option>
                                    <option value="Tablet" class="bg-gray-800">Tablet</option>
                                    <option value="Laptop" class="bg-gray-800">Laptop</option>
                                    <option value="Watch" class="bg-gray-800">Watch</option>
                                    <option value="Airpods" class="bg-gray-800">Airpods</option>
                                    <option value="Desktop" class="bg-gray-800">Desktop</option>
                                    <option value="Camera" class="bg-gray-800">Camera</option>
                                    <option value="Accessories" class="bg-gray-800">Accessories</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-category text-gray-400 text-sm'></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class='bx bx-chevron-down text-gray-400 text-sm'></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="edit-price" class="block text-sm font-medium text-gray-300 mb-2">
                                Price
                            </label>
                            <div class="relative">
                                <input type="text" name="price" id="edit-price"
                                    class="w-full pl-10 pr-3 py-2 text-sm bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-gray-400"
                                    placeholder="0.00">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class='bx bx-dollar text-gray-400 text-sm'></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="edit-image" class="block text-sm font-medium text-gray-300 mb-2">
                                Product Image
                            </label>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden border border-gray-600">
                                    <img id="edit-current-image" src="" alt="Current product image"
                                        class="h-full w-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div
                                        class="flex justify-center px-4 pt-3 pb-3 border-2 border-gray-600 border-dashed rounded-lg bg-gray-700">
                                        <div class="space-y-1 text-center">
                                            <div class="flex text-xs text-gray-400 justify-center">
                                                <label for="edit-image"
                                                    class="relative cursor-pointer rounded-md font-medium text-blue-400 hover:text-blue-300 transition-colors">
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
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">
                                Stock Status
                            </label>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-400">Out of Stock</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="edit-inStock" class="sr-only peer">
                                    <input type="hidden" name="inStock" id="edit-inStock-hidden" value="0">
                                    <div
                                        class="w-11 h-6 bg-gray-600 rounded-full peer peer-checked:bg-green-500 transition-colors duration-300">
                                    </div>
                                    <div
                                        class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300 peer-checked:translate-x-5">
                                    </div>
                                </label>
                                <span class="text-sm text-gray-400">In Stock</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal('edit-product-modal')"
                            class="px-4 py-2 bg-gray-600 text-white text-sm rounded-lg hover:bg-gray-700 transition-colors duration-200 flex items-center">
                            <i class='bx bx-x mr-1'></i> Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 flex items-center glow">
                            <i class='bx bx-save mr-1'></i> Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal (Unchanged, but styled to match) -->
    <div id="delete-product-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-70 backdrop-blur-xl hidden transition-opacity duration-300">
        <div class="bg-gray-800 rounded-2xl shadow-xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0 glow"
            id="delete-product-modal-content">
            <div
                class="bg-gradient-to-r from-red-600 to-red-700 px-5 py-4 flex items-center justify-between rounded-t-2xl">
                <div class="flex items-center space-x-3">
                    <i class='bx bx-trash text-white text-2xl'></i>
                    <h3 class="text-xl font-bold text-white tracking-tight">Delete Product</h3>
                </div>
                <button onclick="closeModal('delete-product-modal')"
                    class="text-white hover:text-gray-300 transition-colors duration-200">
                    <i class='bx bx-x text-2xl'></i>
                </button>
            </div>
            <div class="p-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 h-16 w-16 rounded-lg overflow-hidden border border-gray-600">
                        <img id="delete-product-image" src="" alt="Product image"
                            class="h-full w-full object-cover">
                    </div>
                    <div>
                        <p class="text-gray-300 mb-1">
                            <span id="delete-product-title" class="font-medium text-white block"></span>
                            <span id="delete-product-category" class="text-xs text-gray-500"></span>
                        </p>
                        <p class="text-sm text-gray-400 mt-2">This action cannot be undone. Are you sure you want to
                            delete this product?</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('delete-product-modal')"
                        class="px-4 py-2 bg-gray-600 text-white text-sm rounded-lg hover:bg-gray-700 transition-colors duration-200 flex items-center">
                        <i class='bx bx-x mr-1'></i> Cancel
                    </button>
                    <button type="button" id="delete-product-confirm"
                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 flex items-center glow">
                        <i class='bx bx-trash mr-1'></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global functions for notifications
        function showProductNotification(message = 'Product added successfully') {
            const notification = document.getElementById('product-added-notification');
            const progressBar = document.getElementById('product-notification-progress');
            const messageElement = notification.querySelector('p'); // The main message element
            const subMessageElement = notification.querySelector('.text-green-700 span'); // The sub-message element

            if (notification && progressBar && messageElement && subMessageElement) {
                // Set the custom message
                messageElement.textContent = message;
                subMessageElement.textContent = message === 'Product added successfully'
                    ? 'Your product has been added to inventory'
                    : 'Your product has been updated in inventory';

                notification.classList.remove('hidden', 'notification-slide-out');
                notification.classList.add('notification-slide-in');
                progressBar.style.width = '0%';
                progressBar.style.transition = 'width 3s linear';
                setTimeout(() => progressBar.style.width = '100%', 50);
                setTimeout(() => closeProductNotification(), 3000);
            }
        }

        function closeProductNotification() {
            const notification = document.getElementById('product-added-notification');
            if (notification) {
                notification.classList.remove('notification-slide-in');
                notification.classList.add('notification-slide-out');
                setTimeout(() => {
                    notification.classList.add('hidden');
                    const bgRed = notification.querySelector('.bg-red-600');
                    const borderRed = notification.querySelector('.border-red-300');
                    const textRed = notification.querySelector('.text-red-700');
                    const progressRed = notification.querySelector('.bg-red-500');
                    const message = notification.querySelector('p');

                    if (bgRed) {
                        bgRed.classList.remove('bg-red-600');
                        bgRed.classList.add('bg-green-600');
                    }
                    if (borderRed) {
                        borderRed.classList.remove('border-red-300');
                        borderRed.classList.add('border-green-300');
                    }
                    if (textRed) {
                        textRed.classList.remove('text-red-700');
                        textRed.classList.add('text-green-700');
                    }
                    if (progressRed) {
                        progressRed.classList.remove('bg-red-500');
                        progressRed.classList.add('bg-green-500');
                    }
                    // No need to reset the message here since it’s set dynamically
                }, 500);
            }
        }

        // Image upload preview for Add Product modal
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const previewContainer = document.getElementById('image-preview-container');
            const imagePreview = document.getElementById('image-preview');

            if (imageInput && previewContainer && imagePreview) {
                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            previewContainer.classList.remove('hidden');
                            imagePreview.src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewContainer.classList.add('hidden');
                        imagePreview.src = '';
                    }
                });

                // Reset the preview when the modal is closed
                document.getElementById('add-product-modal').addEventListener('transitionend', function(e) {
                    if (e.propertyName === 'opacity' && this.classList.contains('hidden')) {
                        previewContainer.classList.add('hidden');
                        imagePreview.src = '';
                        imageInput.value = ''; // Clear the file input
                    }
                });
            }

            // Ensure inStock value is updated when the toggle changes
            const editInStockCheckbox = document.getElementById('edit-inStock');
            const editInStockHidden = document.getElementById('edit-inStock-hidden');
            if (editInStockCheckbox && editInStockHidden) {
                editInStockCheckbox.addEventListener('change', function() {
                    editInStockHidden.value = this.checked ? '1' : '0';
                });
            }
        });

        // Modal open/close functions
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            const content = document.getElementById(`${modalId}-content`);
            if (modal && content) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    content.classList.remove('scale-95');
                    content.classList.remove('opacity-0');
                }, 20);
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const content = document.getElementById(`${modalId}-content`);
            if (modal && content) {
                modal.classList.add('opacity-0');
                content.classList.add('scale-95');
                content.classList.add('opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
                document.body.style.overflow = 'auto';
            }
        }

        // Open Edit Product modal
        function openEditModal(productId) {
            fetch(`/admin/products/${productId}/json`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('edit-title').value = data.title;
                    document.getElementById('edit-category').value = data.category;
                    document.getElementById('edit-price').value = data.price;
                    const inStockCheckbox = document.getElementById('edit-inStock');
                    const inStockHidden = document.getElementById('edit-inStock-hidden');
                    inStockCheckbox.checked = data.inStock === 1 || data.inStock === true;
                    inStockHidden.value = inStockCheckbox.checked ? '1' : '0';
                    document.getElementById('edit-current-image').src = data.image;
                    document.getElementById('edit-product-form').action = `/admin/products/${productId}/update`;
                    openModal('edit-product-modal');
                })
                .catch(error => {
                    console.error('Error fetching product data:', error);
                    alert('Failed to load product data');
                });
        }

        // Open Delete Product modal
        function openDeleteModal(productId) {
            fetch(`/admin/products/${productId}/json`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('delete-product-title').textContent = data.title;
                    document.getElementById('delete-product-category').textContent = data.category;
                    document.getElementById('delete-product-image').src = data.image;
                    const deleteBtn = document.getElementById('delete-product-confirm');
                    deleteBtn.onclick = function() {
                        document.getElementById(`delete-form-${productId}`).submit();
                    };
                    openModal('delete-product-modal');
                })
                .catch(error => {
                    console.error('Error fetching product data:', error);
                    alert('Failed to load product data');
                });
        }

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('bg-black')) {
                const openModals = document.querySelectorAll('.bg-black:not(.hidden)');
                openModals.forEach(modal => closeModal(modal.id));
            }
        });

        // Debounce function for search
        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        // Search input handler
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('keyup', debounce(function(e) {
                if (e.target.value.length > 2 || e.target.value.length === 0) e.target.form.submit();
            }, 500));
        }

        // Image upload preview for Edit Product modal
        document.addEventListener('DOMContentLoaded', function() {
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

            // Add form submission handler for Edit Product form
            document.getElementById('edit-product-form')?.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = e.target;
                const formData = new FormData(form);
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bx bx-loader bx-spin mr-1.5"></i> Updating...';
                }
                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        }
                    })
                    .then(response => {
                        if (response.redirected) {
                            showProductNotification('Product updated successfully');
                            setTimeout(() => window.location.href = response.url, 3000);
                            return;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data && data.success) {
                            showProductNotification('Product updated successfully');
                            closeModal('edit-product-modal');
                            setTimeout(() => window.location.reload(), 3000);
                        } else if (data && data.errors) {
                            Object.entries(data.errors).forEach(([field, messages]) => {
                                const input = form.querySelector(`[name="${field}"]`);
                                if (input) {
                                    const errorDiv = document.createElement('div');
                                    errorDiv.className = 'error-message text-xs text-red-500 mt-1 flex items-center';
                                    errorDiv.innerHTML = `<i class='bx bx-error-circle mr-1 text-xs'></i> ${messages.join('<br>')}`;
                                    const parent = input.closest('div');
                                    if (parent) {
                                        const existingError = parent.querySelector('.error-message');
                                        if (existingError) existingError.remove();
                                        parent.appendChild(errorDiv);
                                    }
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        const notification = document.getElementById('product-added-notification');
                        if (notification) {
                            const bgGreen = notification.querySelector('.bg-green-600');
                            const borderGreen = notification.querySelector('.border-green-300');
                            const textGreen = notification.querySelector('.text-green-700');
                            const progressGreen = notification.querySelector('.bg-green-500');
                            const message = notification.querySelector('p');

                            if (bgGreen) {
                                bgGreen.classList.remove('bg-green-600');
                                bgGreen.classList.add('bg-red-600');
                            }
                            if (borderGreen) {
                                borderGreen.classList.remove('border-green-300');
                                borderGreen.classList.add('border-red-300');
                            }
                            if (textGreen) {
                                textGreen.classList.remove('text-green-700');
                                textGreen.classList.add('text-red-700');
                            }
                            if (progressGreen) {
                                progressGreen.classList.remove('bg-green-500');
                                progressGreen.classList.add('bg-red-500');
                            }
                            if (message) {
                                message.textContent = 'Error updating product';
                            }
                            showProductNotification('Error updating product');
                        }
                        setTimeout(() => window.location.reload(), 3000);
                    })
                    .finally(() => {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = '<i class="bx bx-save mr-1"></i> Update Product';
                        }
                    });
            });
        });

        // Pagination and history management
        document.addEventListener('DOMContentLoaded', function() {
            window.history.replaceState({
                path: window.location.href,
                pageTitle: document.title,
                tableContent: document.querySelector('.bg-white.rounded-2xl .overflow-y-auto')?.innerHTML || '',
                paginationContent: document.querySelector('.ajax-pagination')?.innerHTML || ''
            }, '', window.location.href);

            document.addEventListener('click', function(e) {
                const paginationLink = e.target.closest('.pagination-link');
                if (paginationLink) {
                    e.preventDefault();
                    const url = paginationLink.getAttribute('href');
                    loadPaginatedData(url);
                }
            });

            function loadPaginatedData(url) {
                const tableContainer = document.querySelector('.overflow-y-auto');
                const paginationContainer = document.querySelector('.ajax-pagination');
                const originalState = {
                    tableContent: tableContainer.innerHTML,
                    paginationContent: paginationContainer?.innerHTML || ''
                };

                const loadingSpinner = createLoadingSpinner();
                tableContainer.innerHTML = '';
                tableContainer.appendChild(loadingSpinner);

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.text();
                    })
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newTable = doc.querySelector('.overflow-y-auto');
                        if (newTable) tableContainer.innerHTML = newTable.innerHTML;
                        const newPagination = doc.querySelector('.ajax-pagination');
                        if (newPagination && paginationContainer) paginationContainer.innerHTML = newPagination.innerHTML;
                        window.history.pushState({
                            path: url,
                            tableContent: tableContainer.innerHTML,
                            paginationContent: paginationContainer?.innerHTML || ''
                        }, '', url);
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    })
                    .catch(error => {
                        console.error('Error loading paginated data:', error);
                        tableContainer.innerHTML = originalState.tableContent;
                        if (paginationContainer && originalState.paginationContent) paginationContainer.innerHTML = originalState.paginationContent;
                        const errorMessage = document.createElement('div');
                        errorMessage.className = 'p-4 bg-red-50 text-red-600 rounded-lg mb-4';
                        errorMessage.innerHTML = `
                            <div class="flex items-center">
                                <i class='bx bx-error-circle text-xl mr-2'></i>
                                <span>Failed to load content. Please try again.</span>
                            </div>
                        `;
                        tableContainer.prepend(errorMessage);
                        setTimeout(() => errorMessage.remove(), 5000);
                    });
            }

            window.addEventListener('popstate', function(event) {
                if (event.state) {
                    const tableContainer = document.querySelector('.overflow-y-auto');
                    const paginationContainer = document.querySelector('.ajax-pagination');
                    if (event.state.tableContent && tableContainer) tableContainer.innerHTML = event.state.tableContent;
                    if (event.state.paginationContent && paginationContainer) paginationContainer.innerHTML = event.state.paginationContent;
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            });

            function createLoadingSpinner() {
                const container = document.createElement('div');
                container.className = 'flex justify-center items-center h-64';
                const spinner = document.createElement('div');
                spinner.className = 'animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500';
                container.appendChild(spinner);
                return container;
            }

            // Add Product form submission handler
            document.getElementById('add-product-form')?.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = e.target;
                const formData = new FormData(form);
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bx bx-loader bx-spin mr-1.5"></i> Adding...';
                }
                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        }
                    })
                    .then(response => {
                        if (response.redirected) {
                            showProductNotification('Product added successfully');
                            setTimeout(() => window.location.href = response.url, 3000);
                            return;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data && data.success) {
                            showProductNotification('Product added successfully');
                            closeModal('add-product-modal');
                            form.reset();
                            const previewContainer = document.getElementById('image-preview-container');
                            if (previewContainer) previewContainer.classList.add('hidden');
                            setTimeout(() => window.location.reload(), 3000);
                        } else if (data && data.errors) {
                            Object.entries(data.errors).forEach(([field, messages]) => {
                                const input = form.querySelector(`[name="${field}"]`);
                                if (input) {
                                    const errorDiv = document.createElement('div');
                                    errorDiv.className = 'error-message text-xs text-red-500 mt-1 flex items-center';
                                    errorDiv.innerHTML = `<i class='bx bx-error-circle mr-1 text-xs'></i> ${messages.join('<br>')}`;
                                    const parent = input.closest('div');
                                    if (parent) {
                                        const existingError = parent.querySelector('.error-message');
                                        if (existingError) existingError.remove();
                                        parent.appendChild(errorDiv);
                                    }
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        const notification = document.getElementById('product-added-notification');
                        if (notification) {
                            const bgGreen = notification.querySelector('.bg-green-600');
                            const borderGreen = notification.querySelector('.border-green-300');
                            const textGreen = notification.querySelector('.text-green-700');
                            const progressGreen = notification.querySelector('.bg-green-500');
                            const message = notification.querySelector('p');

                            if (bgGreen) {
                                bgGreen.classList.remove('bg-green-600');
                                bgGreen.classList.add('bg-red-600');
                            }
                            if (borderGreen) {
                                borderGreen.classList.remove('border-green-300');
                                borderGreen.classList.add('border-red-300');
                            }
                            if (textGreen) {
                                textGreen.classList.remove('text-green-700');
                                textGreen.classList.add('text-red-700');
                            }
                            if (progressGreen) {
                                progressGreen.classList.remove('bg-green-500');
                                progressGreen.classList.add('bg-red-500');
                            }
                            if (message) {
                                message.textContent = 'Error adding product';
                            }
                            showProductNotification('Error adding product');
                        }
                        setTimeout(() => window.location.reload(), 3000);
                    })
                    .finally(() => {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = '<i class="bx bx-plus mr-1"></i> Add Product';
                        }
                    });
            });

            // Add pagination spinner styles
            if (!document.getElementById('pagination-spinner-style')) {
                const style = document.createElement('style');
                style.id = 'pagination-spinner-style';
                style.textContent = `
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                    .animate-spin {
                        animation: spin 1s linear infinite;
                    }
                `;
                document.head.appendChild(style);
            }
        });
    </script>
    <style>
        /* Styles matching Dashboard */
        .glow {
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.5));
        }

        .glow-sm {
            filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.3));
        }

        .backdrop-blur-xl {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .tooltip-text {
            visibility: hidden;
            width: 60px;
            background-color: rgba(0, 0, 0, 0.8);
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

        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        #product-added-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            width: 320px;
            transform: translateX(120%);
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .notification-slide-in {
            transform: translateX(0);
        }

        .notification-slide-out {
            transform: translateX(120%);
        }

        #product-notification-progress {
            transition: width 3s linear !important;
        }
    </style>

    <!-- Product Added Success Notification -->
    <div id="product-added-notification"
        class="hidden fixed top-4 right-4 z-[9999] w-80 transition-all duration-500 ease-[cubic-bezier(0.68,-0.55,0.265,1.55)] translate-x-[120%]">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden border border-green-300">
            <div class="p-4 flex items-center bg-green-600">
                <div class="flex-shrink-0 p-2 bg-white/10 rounded-full">
                    <i class='bx bx-check-circle text-xl text-white'></i>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm text-white/90 mt-1">Product added successfully</p>
                </div>
                <button onclick="closeProductNotification()"
                    class="ml-4 text-white hover:text-white/80 transition-colors">
                    <i class='bx bx-x text-xl'></i>
                </button>
            </div>
            <div class="p-4 bg-white">
                <div class="flex items-center text-green-700">
                    <i class='bx bx-package text-xl mr-2'></i>
                    <span class="text-sm font-medium">Your product has been added to inventory</span>
                </div>
            </div>
            <div class="h-1.5 bg-gray-100 w-full">
                <div id="product-notification-progress"
                    class="h-full bg-green-500 transition-all duration-3000 ease-linear">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
