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
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div
                            class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center">
                            @if ($user->profile_photo_path)
                                <img class="h-10 w-10 rounded-full" src="{{ asset($user->profile_photo_path) }}"
                                    alt="{{ $user->name }}">
                            @else
                                <span
                                    class="text-blue-600 font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $user->id }}</div>
                        </div>
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                    <div class="text-xs text-gray-500">{{ $user->phone ?? 'No phone' }}</div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <span
                            class="px-2.5 py-0.5 rounded-full text-xs font-medium flex items-center
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

                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2.5 py-0.5 rounded-full text-xs font-medium
                          {{ $user->userType === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ ucfirst($user->userType) }}
                    </span>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-2">
                        @if (Auth::user()->userType === 'admin' && Auth::id() !== $user->id)
                            <button type="button"
                                class="delete-user-button p-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-colors duration-200 group relative"
                                title="Delete" data-user-id="{{ $user->id }}"
                                data-user-name="{{ $user->name }}">
                                <i class="bx bx-trash text-lg"></i>
                                <span class="tooltip-text">Delete</span>
                            </button>
                        @else
                            <span class="text-gray-400 text-sm flex items-center h-10">Current user</span>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div id="delete-user-modal"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md transform transition-all duration-300 scale-95">
        <div class="border-b border-gray-200 px-5 py-4 flex items-center justify-between bg-red-600 rounded-t-xl">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                    <i class='bx bx-trash text-white text-lg'></i>
                </div>
                <h3 class="text-lg font-semibold text-white">Confirm Deletion</h3>
            </div>
            <button onclick="closeModal('delete-user-modal')"
                class="p-1 rounded-full hover:bg-white/10 transition-colors text-white hover:text-gray-200">
                <i class='bx bx-x text-xl'></i>
            </button>
        </div>

        <div class="p-5">
            <div class="flex items-start mb-4">
                <div class="flex-shrink-0 pt-0.5">
                    <i class='bx bx-error-circle text-3xl text-red-500'></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900" id="modal-title">Delete User</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Are you sure you want to delete this user? This action cannot
                            be undone.</p>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('delete-user-modal')"
                    class="px-4 py-2.5 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors flex items-center">
                    <i class='bx bx-x mr-1.5'></i> Cancel
                </button>
                <form id="delete-user-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2.5 text-sm bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-md flex items-center">
                        <i class='bx bx-trash mr-1.5'></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="px-4 py-[12px] border-t border-gray-200 bg-gray-50 flex items-center justify-between">
    <div class="text-sm text-gray-600">
        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
    </div>

    <div class="flex items-center space-x-1">
        {{ $users->appends(request()->query())->onEachSide(1)->links('vendor.pagination.custom') }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Delete user with modal confirmation
        document.addEventListener('click', function(e) {
            const deleteButton = e.target.closest('.delete-user-button');
            if (deleteButton) {
                e.preventDefault();
                const userId = deleteButton.getAttribute('data-user-id');
                const userName = deleteButton.getAttribute('data-user-name');

                // Update modal content
                document.getElementById('modal-title').textContent = `Delete ${userName}`;

                // Set form action
                document.getElementById('delete-user-form').action = `/admin/users/${userId}`;

                // Show modal with animation
                const modal = document.getElementById('delete-user-modal');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.add('opacity-100');
                    modal.querySelector('.transform').classList.remove('scale-95');
                }, 10);
                document.body.style.overflow = 'hidden';
            }
        });
    });

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('opacity-100');
        modal.querySelector('.transform').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 200);
    }
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
</style>
