<table class="w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                User
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Contact
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Role
            </th>
            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center">
                            @if ($user->profile_photo_path)
                                <img class="h-10 w-10 rounded-full" src="{{ asset($user->profile_photo_path) }}" alt="{{ $user->name }}">
                            @else
                                <span class="text-blue-600 font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
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
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
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
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
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
                            <span class="text-gray-400 text-sm flex items-center h-10">Current user</span>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination -->
<div class="px-4 py-[12px] border-t border-gray-200 bg-gray-50 flex items-center justify-between">
    <div class="text-sm text-gray-600">
        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
    </div>

    <div class="flex items-center space-x-1">
        {{ $users->appends(request()->query())->onEachSide(1)->links('vendor.pagination.custom') }}
    </div>
</div>
