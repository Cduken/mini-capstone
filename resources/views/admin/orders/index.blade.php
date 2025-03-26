<!-- filepath: resources/views/admin/orders/index.blade.php -->
<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-2xl font-semibold mb-6">Orders</h1>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Name</th>
                            <th class="py-2 px-4 border-b">Email</th>
                            <th class="py-2 px-4 border-b">Order Items</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $order->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $order->email }}</td>
                                <td class="py-2 px-4 border-b">
                                    <ul>
                                        @foreach ($order->items as $item)
                                            <li>{{ $item['product']['title'] }} ({{ $item['quantity'] }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
