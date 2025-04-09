<table class="w-full divide-y divide-indigo-500/30">
    <thead class="bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-lg">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-cyan-200 uppercase tracking-wider">
                User</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-cyan-200 uppercase tracking-wider">
                Contact</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-cyan-200 uppercase tracking-wider">
                Status</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-cyan-200 uppercase tracking-wider">
                Role</th>
            <th scope="col"
                class="px-6 py-3 text-right text-xs font-semibold text-cyan-200 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-indigo-500/20">
        @foreach ($users as $user)
            <tr class="hover:bg-indigo-900/20 transition-all duration-300">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div
                            class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-cyan-500/20 to-blue-800/20 flex items-center justify-center border border-cyan-500/30 glow">
                            @if ($user->avatar && file_exists(public_path('images/' . $user->avatar)))
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="{{ asset('images/' . $user->avatar) }}" alt="{{ $user->name }}">
                            @elseif ($user->profile_photo_path)
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="{{ asset($user->profile_photo_path) }}" alt="{{ $user->name }}">
                            @else
                                <span
                                    class="text-cyan-400 font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-white drop-shadow-md">{{ $user->name }}</div>
                            <div class="text-xs text-gray-300">ID: {{ $user->id }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white drop-shadow-md">{{ $user->email }}</div>
                    <div class="text-xs text-gray-300">{{ $user->phone ?? 'No phone' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <span
                            class="px-2.5 py-0.5 rounded-full text-xs font-medium flex items-center {{ $user->email_verified_at ? 'bg-emerald-500/20 text-emerald-300' : 'bg-yellow-500/20 text-yellow-300' }} glow-sm">
                            <i class='bx {{ $user->email_verified_at ? 'bx-check-circle' : 'bx-time' }} mr-1'></i>
                            {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                        </span>
                        @if ($user->last_login_at)
                            <span
                                class="ml-2 text-xs text-gray-300">{{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}</span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->userType === 'admin' ? 'bg-purple-500/20 text-purple-300' : 'bg-cyan-500/20 text-cyan-300' }} glow-sm">
                        {{ ucfirst($user->userType) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-2">
                        @if (Auth::user()->userType === 'admin' && Auth::id() !== $user->id)
                            <button type="button"
                                class="delete-user-button p-2 rounded-lg bg-red-500/20 hover:bg-red-500/30 text-red-300 transition-all duration-200 group relative glow"
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
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
    <div
        class="bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-xl rounded-2xl shadow-xl border border-indigo-500/20 w-full max-w-md transform transition-all duration-300 scale-95">
        <div
            class="border-b border-indigo-500/30 px-5 py-4 flex items-center justify-between bg-gradient-to-r from-red-600 to-red-700 rounded-t-2xl">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                    <i class='bx bx-trash text-white text-lg glow'></i>
                </div>
                <h3 class="text-lg font-semibold text-white drop-shadow-md">Confirm Deletion</h3>
            </div>
            <button onclick="closeModal('delete-user-modal')"
                class="p-1 rounded-full hover:bg-white/10 transition-colors text-white hover:text-gray-200">
                <i class='bx bx-x text-xl glow'></i>
            </button>
        </div>
        <div class="p-5">
            <div class="flex items-start mb-4">
                <div class="flex-shrink-0 pt-0.5">
                    <i class='bx bx-error-circle text-3xl text-red-400 glow'></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-white drop-shadow-md" id="modal-title">Delete User</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-300">Are you sure you want to delete this user? This action cannot
                            be undone.</p>
                    </div>
                </div>
            </div>
            <div class="mt-5 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('delete-user-modal')"
                    class="px-4 py-2.5 text-sm bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-lg rounded-lg border border-cyan-500/30 text-cyan-200 hover:scale-105 transition-all duration-300 flex items-center glow">
                    <i class='bx bx-x mr-1.5'></i> Cancel
                </button>
                <form id="delete-user-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2.5 text-sm bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-md flex items-center glow">
                        <i class='bx bx-trash mr-1.5'></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div
    class="px-4 py-2 border-t border-indigo-500/30 bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-lg flex items-center justify-between">
    <div class="text-sm text-gray-300">
        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
    </div>
    <div class="flex items-center space-x-1">
        {{ $users->appends(request()->query())->onEachSide(1)->links('vendor.pagination.custom') }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            const deleteButton = e.target.closest('.delete-user-button');
            if (deleteButton) {
                e.preventDefault();
                const userId = deleteButton.getAttribute('data-user-id');
                const userName = deleteButton.getAttribute('data-user-name');
                document.getElementById('modal-title').textContent = `Delete ${userName}`;
                document.getElementById('delete-user-form').action = `/admin/users/${userId}`;
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
</style>
