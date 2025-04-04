<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Success message -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <i class='bx bx-check text-green-600 text-xl'></i>
                    </div>
                    <h2 class="mt-3 text-lg font-medium text-gray-900">Payment Successful!</h2>
                    <p class="mt-1 text-sm text-gray-500">Order #{{ $order->id }}</p>
                </div>
            </div>

            <!-- Products rating section -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Rate your purchased products</h3>

                @foreach ($order->products as $product)
                    <div class="mb-6 p-4 border border-gray-100 rounded-lg">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset($product->image) }}" class="w-16 h-16 object-cover rounded mr-4">
                            <div>
                                <h4 class="font-medium">{{ $product->title }}</h4>
                                <p class="text-sm text-gray-500">{{ $product->pivot->quantity }} ×
                                    ${{ number_format($product->pivot->price, 2) }}</p>
                            </div>
                        </div>

                        <form action="{{ route('products.rate', $product) }}" method="POST" class="rating-form">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">

                            <div class="flex justify-center space-x-2 mb-4">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button" class="star-rating focus:outline-none"
                                        data-rating="{{ $i }}">
                                        <i class='bx bx-star text-3xl text-gray-300'></i>
                                    </button>
                                @endfor
                                <input type="hidden" name="rating" value="0">
                            </div>

                            <button type="submit"
                                class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Submit Rating
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
