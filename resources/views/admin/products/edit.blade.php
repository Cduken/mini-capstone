<x-app-layout>
    <div class="py-12 flex justify-center">
        <div class="w-full max-w-4xl bg-white shadow-md rounded-lg p-8">
            <div class="flex justify-between items-center border-b pb-4">
                <h1 class="text-2xl font-semibold text-gray-800">Edit Product</h1>
                <a href="{{ route('admin.products.index') }}"
                    class="px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600">
                    Back
                </a>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                class="mt-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="title" id="title" value="{{ $product->title }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <input type="text" name="category" id="category" value="{{ $product->category }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" id="price" value="{{ $product->price }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label for="inStock" class="block text-sm font-medium text-gray-700">In Stock</label>
                    <select name="inStock" id="inStock"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
                        <option value="1" {{ $product->inStock ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ !$product->inStock ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                    @if ($product->image)
                        <div class="mb-4">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}"
                                class="w-32 h-32 object-cover rounded-md">
                        </div>
                    @endif
                    <input type="file" name="image" id="image"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
