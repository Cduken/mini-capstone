<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-50 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Confirmation Header -->
            <div class="bg-gradient-to-r from-green-400 to-green-600 p-6 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-white shadow-lg">
                    <i class='bx bx-check text-green-500 text-4xl'></i>
                </div>
                <h1 class="mt-4 text-2xl font-bold text-white">Order Confirmed!</h1>
                <p class="mt-2 text-green-100">Your payment was successful</p>
            </div>

            <!-- Order Details -->
            <div class="px-6 py-8">
                <div class="flex justify-center mb-6">
                    <div class="animate-bounce">
                        <i class='bx bxs-package text-blue-500 text-5xl'></i>
                    </div>
                </div>

                <div class="text-center">
                    <h2 class="text-xl font-semibold text-gray-800">Thank you for your order!</h2>
                    <p class="mt-2 text-gray-600">We've received your order #{{ $order->id }} and it's being
                        processed.</p>

                    <div class="mt-6 bg-blue-50 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700">Estimated delivery</span>
                            <span class="font-medium">{{ now()->addDays(5)->format('l, F jS') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <!-- Order Summary -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-4">ORDER SUMMARY</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium">${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax</span>
                            <span class="font-medium">${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between pt-4 border-t border-gray-200 font-bold text-lg">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 grid grid-cols-1 gap-4">
                    <a href="{{ route('home') }}"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center font-medium">
                        <i class='bx bx-home mr-2'></i> Back to Home
                    </a>
                    <a href="#"
                        class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center font-medium">
                        <i class='bx bxs-file-pdf mr-2'></i> Download Receipt
                    </a>
                </div>

                <!-- Help Section -->
                <div class="mt-8 text-center text-sm text-gray-500">
                    <p>Need help? <a href="#" class="text-blue-600 hover:text-blue-800">Contact our support</a>
                    </p>
                    <p class="mt-1">We'll send a confirmation email shortly</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
