<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-4">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">User Management</h2>

                </div>

                <div class="flex items-center space-x-3">
                    <!-- Search Bar -->
                    {{-- <div class="relative w-full md:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-search text-gray-400'></i>
                        </div>
                        <input type="text" placeholder="Search users..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div> --}}

                    <!-- Add User Button -->
                    {{-- <button class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium py-2.5 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 flex items-center whitespace-nowrap">
                        <i class='bx bx-user-plus text-xl mr-2'></i> Add User
                    </button> --}}
                </div>
            </div>

            <!-- Stats Cards -->
            <!-- Stats Cards - Updated to Match Dashboard Style -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-[9px]">
                <!-- Total Users Card -->
                <div
                    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-purple-300 hover:transform hover:scale-105 transition duration-300">
                    <div class="p-5 flex items-start justify-between">
                        <div>
                            <span class="text-gray-500 text-sm font-medium">Total Users</span>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $users->total() }}</h3>
                            <div class="flex items-center mt-3">
                                @if ($usersPercentageChange >= 0)
                                    <span
                                        class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <i class='bx bx-up-arrow-alt mr-1'></i> {{ round($usersPercentageChange, 0) }}%
                                    </span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <i class='bx bx-down-arrow-alt mr-1'></i>
                                        {{ round(abs($usersPercentageChange), 0) }}%
                                    </span>
                                @endif
                                <span class="text-gray-500 text-xs ml-2">vs last month</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                            <i class='bx bx-group text-2xl'></i>
                        </div>
                    </div>
                    <div class="h-1 bg-purple-200 w-full">
                        <div class="h-1 bg-purple-500" style="width: {{ min($usersPercentageChange + 50, 100) }}%">
                        </div>
                    </div>
                </div>

                <!-- Active Users Card -->
                <div
                    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-green-300 hover:transform hover:scale-105 transition duration-300">
                    <div class="p-5 flex items-start justify-between">
                        <div>
                            <span class="text-gray-500 text-sm font-medium">Active Today</span>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($activeUsers['count']) }}
                            </h3>
                            <div class="flex items-center mt-3">
                                @if ($activeUsers['trend'] === 'up')
                                    <span
                                        class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <i class='bx bx-up-arrow-alt mr-1'></i>
                                        {{ number_format(abs($activeUsers['percentage_change']), 1) }}%
                                    </span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <i class='bx bx-down-arrow-alt mr-1'></i>
                                        {{ number_format(abs($activeUsers['percentage_change']), 1) }}%
                                    </span>
                                @endif
                                <span class="text-gray-500 text-xs ml-2">vs yesterday</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-green-50 text-green-600">
                            <i class='bx bx-user-check text-2xl'></i>
                        </div>
                    </div>
                    <div class="h-1 bg-green-200 w-full">
                        <div class="h-1 bg-green-500"
                            style="width: {{ min($activeUsers['percentage_change'] + 50, 100) }}%"></div>
                    </div>
                </div>

                <!-- Verified Users Card -->
                <div
                    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-blue-300 hover:transform hover:scale-105 transition duration-300">
                    <div class="p-5 flex items-start justify-between">
                        <div>
                            <span class="text-gray-500 text-sm font-medium">Verified Users</span>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">
                                {{ $users->whereNotNull('email_verified_at')->count() }}</h3>
                            <div class="flex items-center mt-3">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full flex items-center">
                                    {{ number_format(($users->whereNotNull('email_verified_at')->count() / $users->count()) * 100, 1) }}%
                                </span>
                                <span class="text-gray-500 text-xs ml-2">of total</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                            <i class='bx bx-badge-check text-2xl'></i>
                        </div>
                    </div>
                    <div class="h-1 bg-blue-200 w-full">
                        <div class="h-1 bg-blue-500"
                            style="width: {{ ($users->whereNotNull('email_verified_at')->count() / $users->count()) * 100 }}%">
                        </div>
                    </div>
                </div>

                <!-- Admin Users Card -->
                <div
                    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-red-300 hover:transform hover:scale-105 transition duration-300">
                    <div class="p-5 flex items-start justify-between">
                        <div>
                            <span class="text-gray-500 text-sm font-medium">Administrators</span>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">
                                @php
                                    $adminCount = $users->where('userType', 'admin')->count();
                                    echo $adminCount >= 0 ? $adminCount : '0';
                                @endphp
                            </h3>
                            @if ($users->count() > 0)
                                <div class="flex items-center mt-3">
                                    <span
                                        class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        {{ number_format(($adminCount / $users->count()) * 100, 1) }}%
                                    </span>
                                    <span class="text-gray-500 text-xs ml-2">of total</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-3 rounded-lg bg-red-50 text-red-600">
                            <i class='bx bx-shield-alt-2 text-2xl'></i>
                        </div>
                    </div>
                    <div class="h-1 bg-red-200 w-full">
                        <div class="h-1 bg-red-500"
                            style="width: {{ $users->count() > 0 ? ($adminCount / $users->count()) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                <div
                    class="px-4 py-[14px] border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-gray-50">
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

                        <div class="relative">
                            <button
                                class="flex items-center space-x-1 px-3 py-2 border border-gray-200 rounded-lg bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                                id="filter-dropdown-button">
                                <i class='bx bx-filter-alt text-gray-500'></i>
                                <span>Filter</span>
                                <i class='bx bx-chevron-down text-gray-400'></i>
                            </button>
                            <!-- Dropdown menu -->
                            <div class="hidden absolute right-0 mt-2 w-56 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10"
                                id="filter-dropdown-menu">
                                <div class="py-1">
                                    <a href="{{ route('admin.users', ['filter' => 'all'] + request()->except('filter', 'page')) }}"
                                        class="block px-4 py-2 text-sm {{ request('filter', 'all') === 'all' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">All
                                        Users</a>

                                    <a href="{{ route('admin.users', ['filter' => 'admins'] + request()->except('filter', 'page')) }}"
                                        class="block px-4 py-2 text-sm {{ request('filter') === 'admins' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">Admins
                                        Only</a>
                                    <a href="{{ route('admin.users', ['filter' => 'pending'] + request()->except('filter', 'page')) }}"
                                        class="block px-4 py-2 text-sm {{ request('filter') === 'pending' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">Pending
                                        Verification</a>
                                </div>
                            </div>
                        </div>
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
                                            <span
                                                class="px-2.5 py-0.5 rounded-full text-xs font-medium flex items-center
                                                  {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                <i
                                                    class='bx {{ $user->email_verified_at ? 'bx-check-circle' : 'bx-time' }} mr-1'></i>
                                                {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                                            </span>
                                            @if ($user->last_login_at)
                                                <span class="ml-2 text-xs text-gray-500">
                                                    Last seen
                                                    {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}
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


                <div class="px-4 py-[12px] border-t border-gray-200 bg-gray-50 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of
                        {{ $users->total() }} users
                    </div>

                    <div class="flex items-center space-x-1">
                        {{ $users->appends(request()->query())->onEachSide(1)->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


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

    <script>
        // Toggle filter dropdown
        document.getElementById('filter-dropdown-button').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('filter-dropdown-menu').classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('filter-dropdown-menu');
            const button = document.getElementById('filter-dropdown-button');

            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.add('hidden');
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
