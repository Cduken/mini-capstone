<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">User Management</h2>

                </div>

                <div class="flex items-center space-x-3">
                    <!-- Search Bar -->
                    <div class="relative w-full md:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-search text-gray-400'></i>
                        </div>
                        <input type="text" placeholder="Search users..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>

                    <!-- Add User Button -->
                    {{-- <button class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium py-2.5 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 flex items-center whitespace-nowrap">
                        <i class='bx bx-user-plus text-xl mr-2'></i> Add User
                    </button> --}}
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
                <!-- Total Users -->
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Users</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $users->total() }}</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                            <i class='bx bx-group text-2xl'></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-sm text-green-600">
                        <i class='bx bx-up-arrow-alt mr-1'></i> 12% from last month
                    </div>
                </div>

                <!-- Active Users -->
                <!-- Active Users Card -->
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Today</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">
                                {{ number_format($activeUsers['count']) }}
                            </h3>
                        </div>
                        <div class="p-3 rounded-lg bg-green-50 text-green-600">
                            <i class='bx bx-user-check text-2xl'></i>
                        </div>
                    </div>
                    <div
                        class="mt-3 flex items-center text-sm {{ $activeUsers['trend'] === 'up' ? 'text-green-600' : 'text-red-600' }}">
                        <i class='bx bx-{{ $activeUsers['trend'] === 'up' ? 'up' : 'down' }}-arrow-alt mr-1'></i>
                        {{ number_format(abs($activeUsers['percentage_change']), 1) }}% from yesterday
                    </div>
                </div>

                <!-- Verified Users -->
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Verified</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">
                                {{ $users->whereNotNull('email_verified_at')->count() }}</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                            <i class='bx bx-badge-check text-2xl'></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-sm text-gray-500">
                        {{ number_format(($users->whereNotNull('email_verified_at')->count() / $users->count()) * 100, 1) }}%
                        of total
                    </div>
                </div>

                <!-- Admin Users -->
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Administrators</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">
                                {{ $users->where('userType', 'admin')->count() }}</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-red-50 text-red-600">
                            <i class='bx bx-shield-alt-2 text-2xl'></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-sm text-gray-500">
                        {{ number_format(($users->where('userType', 'admin')->count() / $users->count()) * 100, 1) }}%
                        of total
                    </div>
                </div>
            </div>

            <!-- Users Table Container -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Table Header with Filters -->
                <div
                    class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                            <i class='bx bx-group text-xl'></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">User Directory</h3>
                            <p class="text-xs text-gray-500">{{ $users->count() }} users in system</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <!-- Filter Dropdown -->
                        <div class="relative">
                            <button
                                class="flex items-center space-x-1 px-3 py-2 border border-gray-200 rounded-lg bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <i class='bx bx-filter-alt text-gray-500'></i>
                                <span>Filter</span>
                                <i class='bx bx-chevron-down text-gray-400'></i>
                            </button>
                            <!-- Dropdown menu -->
                            <div
                                class="hidden absolute right-0 mt-2 w-56 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                                <div class="py-1">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">All Users</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Verified
                                        Only</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admins Only</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pending
                                        Verification</a>
                                </div>
                            </div>
                        </div>

                        <!-- Export Button -->
                        <button
                            class="flex items-center space-x-1 px-3 py-2 border border-gray-200 rounded-lg bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <i class='bx bx-export text-gray-500'></i>
                            <span>Export</span>
                        </button>
                    </div>
                </div>

                <!-- Responsive Table -->
                <div class="overflow-y-auto max-h-[calc(100vh-300px)]">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <!-- User Column -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center">
                                                @if ($user->profile_photo_path)
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ asset($user->profile_photo_path) }}"
                                                        alt="{{ $user->name }}">
                                                @else
                                                    <span
                                                        class="text-blue-600 font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}
                                                </div>
                                                <div class="text-xs text-gray-500">ID: {{ $user->id }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Contact Column -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->phone ?? 'No phone' }}</div>
                                    </td>

                                    <!-- Status Column -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium flex items-center
                                                  {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                <i class='bx {{ $user->email_verified_at ? 'bx-check-circle' : 'bx-time' }} mr-1'></i>
                                                {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                                            </span>
                                            @if ($user->last_login_at)
                                                <span class="ml-2 text-xs text-gray-500">
                                                    Last seen {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Role Column -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $user->userType === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst($user->userType) }}
                                        </span>
                                    </td>

                                    <!-- Actions Column -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            @if (Auth::user()->userType === 'admin' && Auth::id() !== $user->id)
                                                <!-- Edit Button -->
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 transition-colors duration-200 group relative"
                                                    title="Edit">
                                                    <i class="bx bx-edit text-lg"></i>
                                                    <span class="tooltip-text">Edit</span>
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-colors duration-200 group relative"
                                                        title="Delete">
                                                        <i class="bx bx-trash text-lg"></i>
                                                        <span class="tooltip-text">Delete</span>
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

                <!-- Pagination -->
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
            <div
                class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-50 to-indigo-50 rounded-full flex items-center justify-center mb-6">
                <i class='bx bx-group text-4xl text-blue-500'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No Users Found</h3>
            <p class="text-gray-600 mb-6">It looks like there are no users registered yet.</p>
            <button
                class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-sm hover:shadow-md transition-all flex items-center justify-center mx-auto">
                <i class='bx bx-user-plus mr-2'></i> Invite Users
            </button>
        </div>
    @endif

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
