<x-app-layout>
    <div class="flex min-h-screen bg-gradient-to-br from-gray-900 via-indigo-900 to-black text-white">
        <x-admin-sidebar />

        <div class="flex-1 p-4">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">
                <h1
                    class="text-2xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-purple-500 drop-shadow-md">
                    User Management
                </h1>
                <div class="flex items-center space-x-3 md:justify-end w-full md:w-auto">
                    <div class="relative w-full md:w-auto">
                        <button
                            class="flex items-center space-x-1 px-3 py-2 bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-lg rounded-lg border border-cyan-500/30 text-sm font-medium text-cyan-200 hover:scale-105 transition-all duration-300 group"
                            id="filter-dropdown-button">
                            <i class='bx bx-filter-alt text-cyan-400 glow'></i>
                            <span>Filter</span>
                            <i class='bx bx-chevron-down text-cyan-400'></i>
                        </button>
                        <div class="hidden absolute right-0 mt-2 w-56 origin-top-right bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-lg rounded-lg border border-cyan-500/20 shadow-lg z-10"
                            id="filter-dropdown-menu">
                            <div class="py-1">
                                <a href="{{ route('admin.users', ['filter' => 'all'] + request()->except('filter', 'page')) }}"
                                    class="block px-4 py-2 text-sm {{ request('filter', 'all') === 'all' ? 'bg-cyan-500/20 text-cyan-300' : 'text-gray-300 hover:bg-cyan-500/10' }} transition-all duration-300">All
                                    Users</a>
                                <a href="{{ route('admin.users', ['filter' => 'admins'] + request()->except('filter', 'page')) }}"
                                    class="block px-4 py-2 text-sm {{ request('filter') === 'admins' ? 'bg-cyan-500/20 text-cyan-300' : 'text-gray-300 hover:bg-cyan-500/10' }} transition-all duration-300">Admins
                                    Only</a>
                                <a href="{{ route('admin.users', ['filter' => 'pending'] + request()->except('filter', 'page')) }}"
                                    class="block px-4 py-2 text-sm {{ request('filter') === 'pending' ? 'bg-cyan-500/20 text-cyan-300' : 'text-gray-300 hover:bg-cyan-500/10' }} transition-all duration-300">Pending
                                    Verification</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div id="stats-cards">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    @include('admin.partials.user_stats_cards_inner', [
                        'users' => $users,
                        'activeUsers' => $activeUsers,
                        'usersPercentageChange' => $usersPercentageChange,
                        'verifiedPercentage' => $verifiedPercentage,
                        'adminCount' => $adminCount,
                    ])
                </div>
            </div>

            <!-- User Directory -->
            <div
                class="bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-xl rounded-2xl shadow-xl border border-indigo-500/20 overflow-hidden">
                <div
                    class="px-6 py-3 border-b border-indigo-500/30 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-full bg-cyan-600/20 text-cyan-300 border border-cyan-500/50 glow">
                            <i class='bx bx-group text-xl'></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-white drop-shadow-md">User Directory</h3>
                            <p class="text-xs text-gray-300">{{ $users->count() }} users in system</p>
                        </div>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-[calc(100vh-300px)] md:max-h-[calc(100vh-250px)] lg:max-h-[calc(100vh-200px)]"
                    id="users-table-container">
                    @include('admin.partials.users_table', ['users' => $users])
                </div>
            </div>

            @if ($users->isEmpty())
                <div
                    class="bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-xl rounded-2xl shadow-xl border border-indigo-500/20 p-12 text-center max-w-2xl mx-auto mt-8">
                    <div
                        class="w-24 h-24 mx-auto bg-gradient-to-br from-cyan-500/20 to-blue-800/20 rounded-full flex items-center justify-center mb-6">
                        <i class='bx bx-group text-4xl text-cyan-400 glow'></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white drop-shadow-md mb-2">No Users Found</h3>
                    <p class="text-gray-300 mb-6">It looks like there are no users registered yet.</p>
                    <button
                        class="px-6 py-3 bg-gradient-to-r from-cyan-400 to-blue-600 text-white rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center mx-auto glow">
                        <i class='bx bx-user-plus mr-2'></i> Invite Users
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Success Notification -->
    <div id="success-notification"
        class="fixed top-4 right-4 z-50 transform translate-x-full transition-transform duration-300">
        <div
            class="bg-gradient-to-br from-emerald-500/20 to-green-800/20 backdrop-blur-lg rounded-lg shadow-lg border border-emerald-500/30 overflow-hidden w-80">
            <div class="flex items-start p-4">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-emerald-400 glow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-emerald-200" id="notification-title">Success</p>
                    <p class="mt-1 text-sm text-emerald-300" id="notification-message">User deleted successfully.</p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button onclick="hideNotification()"
                        class="bg-transparent rounded-md inline-flex text-emerald-400 hover:text-emerald-300 focus:outline-none">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="bg-emerald-400 h-1 w-full" id="notification-progress"></div>
        </div>
    </div>

    <style>
        .glow {
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.5));
        }

        .glow-sm {
            filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.3));
        }

        .backdrop-blur-lg {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .backdrop-blur-md {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        #success-notification {
            transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        #notification-progress {
            transition: width 5s linear;
        }

        .translate-x-0 {
            transform: translateX(0);
        }

        .translate-x-full {
            transform: translateX(calc(100% + 1rem));
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButton = document.getElementById('filter-dropdown-button');
            const filterMenu = document.getElementById('filter-dropdown-menu');
            if (filterButton && filterMenu) {
                filterButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    filterMenu.classList.toggle('hidden');
                });
                document.addEventListener('click', function(e) {
                    if (!filterMenu.contains(e.target) && !filterButton.contains(e.target)) {
                        filterMenu.classList.add('hidden');
                    }
                });
            }

            const container = document.getElementById('users-table-container');
            if (container) {
                let isLoading = false;
                let currentPageUrl = window.location.href;
                const loadingHTML = `
                    <div class="flex justify-center items-center h-64">
                        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-cyan-400"></div>
                    </div>
                `;

                const normalizeUrl = (url) => {
                    const urlObj = new URL(url);
                    const params = new URLSearchParams(urlObj.search);
                    const paramsArray = Array.from(params.entries()).sort();
                    const sortedParams = new URLSearchParams(paramsArray);
                    return `${urlObj.origin}${urlObj.pathname.replace(/\/+$/, '')}?${sortedParams.toString()}`;
                };

                const updateActiveFilter = (filterValue) => {
                    const filterLinks = document.querySelectorAll('#filter-dropdown-menu a');
                    filterLinks.forEach(link => {
                        const linkFilter = new URL(link.href).searchParams.get('filter') || 'all';
                        if (linkFilter === filterValue) {
                            link.classList.add('bg-cyan-500/20', 'text-cyan-300');
                            link.classList.remove('text-gray-300', 'hover:bg-cyan-500/10');
                        } else {
                            link.classList.remove('bg-cyan-500/20', 'text-cyan-300');
                            link.classList.add('text-gray-300', 'hover:bg-cyan-500/10');
                        }
                    });
                };

                const loadPage = async (url) => {
                    if (isLoading) return;
                    const normalizedUrl = normalizeUrl(url);
                    const normalizedCurrentUrl = normalizeUrl(currentPageUrl);
                    if (normalizedUrl === normalizedCurrentUrl) return;

                    isLoading = true;
                    const oldTableContent = container.innerHTML;
                    container.innerHTML = loadingHTML;

                    try {
                        const response = await fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });
                        if (!response.ok) throw new Error('Network response was not ok');
                        const data = await response.json();

                        document.querySelector('#stats-cards .grid').innerHTML = data.cards;
                        container.innerHTML = data.table;
                        currentPageUrl = url;

                        const urlObj = new URL(url);
                        const filterValue = urlObj.searchParams.get('filter') || 'all';
                        updateActiveFilter(filterValue);

                        window.history.pushState({
                            url
                        }, '', url);
                    } catch (error) {
                        console.error('Error:', error);
                        container.innerHTML = oldTableContent;
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'p-4 bg-red-500/20 text-red-300 rounded-lg mb-4';
                        errorDiv.innerHTML = `
                            <div class="flex items-center">
                                <i class='bx bx-error-circle text-xl mr-2'></i>
                                <span>Failed to load content. Please try again.</span>
                            </div>
                        `;
                        container.appendChild(errorDiv);
                    } finally {
                        isLoading = false;
                    }
                };

                document.addEventListener('click', (e) => {
                    const paginationLink = e.target.closest('a[href*="page="]');
                    if (paginationLink) {
                        e.preventDefault();
                        loadPage(paginationLink.href);
                        return;
                    }
                    const filterLink = e.target.closest('#filter-dropdown-menu a');
                    if (filterLink) {
                        e.preventDefault();
                        if (filterMenu) filterMenu.classList.add('hidden');
                        loadPage(filterLink.href);
                        return;
                    }
                });

                window.addEventListener('popstate', (e) => {
                    if (e.state?.url) loadPage(e.state.url);
                    else loadPage(window.location.href);
                });

                const urlObj = new URL(window.location.href);
                const initialFilter = urlObj.searchParams.get('filter') || 'all';
                updateActiveFilter(initialFilter);
            }

            if (!document.getElementById('spinner-animation-style')) {
                const style = document.createElement('style');
                style.id = 'spinner-animation-style';
                style.textContent = `
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                    .animate-spin { animation: spin 1s linear infinite; }
                `;
                document.head.appendChild(style);
            }
        });

        function showSuccessNotification(message = 'User deleted successfully.') {
            const notification = document.getElementById('success-notification');
            const msg = document.getElementById('notification-message');
            const progress = document.getElementById('notification-progress');
            msg.textContent = message;
            notification.classList.remove('translate-x-full');
            notification.classList.add('translate-x-0');
            progress.style.width = '100%';
            progress.style.transition = 'width 5s linear';
            setTimeout(() => hideNotification(), 5000);
            setTimeout(() => progress.style.width = '0%', 50);
        }

        function hideNotification() {
            const notification = document.getElementById('success-notification');
            notification.classList.remove('translate-x-0');
            notification.classList.add('translate-x-full');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('opacity-100');
            modal.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }

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

        document.getElementById('delete-user-form')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: new FormData(this)
                });
                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.message || 'Failed to delete user');
                }
                closeModal('delete-user-modal');
                showSuccessNotification('User deleted successfully.');
                if (typeof loadPage === 'function') {
                    const url = new URL(window.location.href);
                    url.searchParams.delete('page');
                    loadPage(url.toString());
                }
            } catch (error) {
                alert(error.message);
                closeModal('delete-user-modal');
            }
        });
    </script>
</x-app-layout>
