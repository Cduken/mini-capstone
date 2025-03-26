<x-app-layout>
    <div class="flex min-h-screen bg-gray-300">
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">User Management</h2>

                </div>


            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <i class='bx bx-group text-blue-500'></i>
                        <span class="text-sm font-medium text-gray-700">{{ $users->count() }} Users</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="text-xs text-gray-500 hover:text-gray-700 flex items-center">
                            <i class='bx bx-export mr-1'></i> Export
                        </button>
                    </div>
                </div>


                <div class="overflow-y-auto max-h-[505px]">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User</th>
                                <th
                                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email Verified</th>
                                <th
                                    class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role</th>
                                <th
                                    class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <!-- User Column -->
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                                <i class='bx bx-user text-xl text-gray-600'></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Email Column -->
                                    <td class="py-4 px-6 text-sm text-gray-900">
                                        {{ $user->email }}
                                    </td>

                                    <!-- Status Column -->
                                    <td class="py-4 px-6">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full
                                        {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                                        </span>
                                    </td>

                                    <!-- Role Column -->
                                    <td class="py-4 px-6">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full
                                        {{ $user->userType === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst($user->userType) }}
                                        </span>
                                    </td>

                                    <!-- Actions Column -->
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex justify-end space-x-2">
                                            @if (Auth::user()->userType === 'admin' && Auth::id() !== $user->id)
                                                <!-- Edit Button -->
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 transition-all duration-200 group relative"
                                                    title="Edit User">
                                                    <i class="bx bx-edit text-xl"></i>

                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-all duration-200 group relative"
                                                        title="Delete User">
                                                        <i class="bx bx-trash text-xl"></i>

                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-sm flex items-center h-10">Current
                                                    user</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of
                        {{ $users->total() }} users
                    </div>

                    <div class="flex items-center space-x-1">
                        {{ $users->appends(['search' => request('search')])->onEachSide(1)->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State (for when no users exist) -->
    @if ($users->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center max-w-2xl mx-auto mt-8">
            <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class='bx bx-group text-3xl text-gray-400'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No Users Found</h3>
            <p class="text-gray-600 mb-6">It looks like there are no users registered yet.</p>
            <button
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class='bx bx-user-plus mr-2'></i> Invite Users
            </button>
        </div>
    @endif
</x-app-layout>
