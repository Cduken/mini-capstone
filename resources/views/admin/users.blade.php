<x-app-layout>
    <div class="flex flex-col md:flex-row min-h-screen bg-gray-50">
        <x-admin-sidebar />

        <div class="flex-1 p-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">User Management</h2>
                </div>

                <div class="flex items-center space-x-3 md:justify-end w-full md:w-auto">
                    <div class="relative w-full md:w-auto">
                        <button
                            class="flex items-center space-x-1 px-3 py-2 border border-gray-200 rounded-lg bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 w-full md:w-auto"
                            id="filter-dropdown-button">
                            <i class='bx bx-filter-alt text-gray-500'></i>
                            <span>Filter</span>
                            <i class='bx bx-chevron-down text-gray-400'></i>
                        </button>
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
                </div>
                <div class="overflow-y-auto max-h-[calc(100vh-300px)] md:max-h-[calc(100vh-250px)] lg:max-h-[calc(100vh-200px)]"
                    id="users-table-container">
                    @include('admin.partials.users_table', ['users' => $users])
                </div>
            </div>

            @if ($users->isEmpty())
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center max-w-2xl mx-auto mt-8">
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
        </div>
    </div>

    <!-- Success Notification -->
    <div id="success-notification"
        class="fixed top-4 right-4 z-50 transform translate-x-full transition-transform duration-300">
        <div class="bg-green-50 border border-green-200 rounded-lg shadow-lg overflow-hidden w-80">
            <div class="flex items-start p-4">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-green-800" id="notification-title">Success</p>
                    <p class="mt-1 text-sm text-green-600" id="notification-message">User deleted successfully.</p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button onclick="hideNotification()"
                        class="bg-white rounded-md inline-flex text-green-400 hover:text-green-500 focus:outline-none">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="bg-green-400 h-1 w-full" id="notification-progress"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle filter dropdown
            const filterButton = document.getElementById('filter-dropdown-button');
            const filterMenu = document.getElementById('filter-dropdown-menu');

            if (filterButton && filterMenu) {
                filterButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    filterMenu.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!filterMenu.contains(e.target) && !filterButton.contains(e.target)) {
                        filterMenu.classList.add('hidden');
                    }
                });
            }

            // AJAX Pagination and Filter with smooth loading
            const container = document.getElementById('users-table-container');
            if (container) {
                let isLoading = false;
                let currentPageUrl = window.location.href;

                // New loading spinner design (matches products table)
                const loadingHTML = `
                    <div class="flex justify-center items-center h-64">
                        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
                    </div>
                `;

                const normalizeUrl = (url) => {
                    // Remove trailing slashes and sort query parameters for consistent comparison
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
                            link.classList.add('bg-blue-50', 'text-blue-600');
                            link.classList.remove('text-gray-700', 'hover:bg-gray-100');
                        } else {
                            link.classList.remove('bg-blue-50', 'text-blue-600');
                            link.classList.add('text-gray-700', 'hover:bg-gray-100');
                        }
                    });
                };

                const loadPage = async (url) => {
                    if (isLoading) return;

                    const normalizedUrl = normalizeUrl(url);
                    const normalizedCurrentUrl = normalizeUrl(currentPageUrl);

                    if (normalizedUrl === normalizedCurrentUrl) return;

                    isLoading = true;

                    // Show loading indicator only on the table, not cards
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

                        // Update the cards and table
                        document.querySelector('#stats-cards .grid').innerHTML = data.cards;
                        container.innerHTML = data.table;

                        currentPageUrl = url;

                        // Update the active filter state
                        const urlObj = new URL(url);
                        const filterValue = urlObj.searchParams.get('filter') || 'all';
                        updateActiveFilter(filterValue);

                        window.history.pushState({
                            url
                        }, '', url);
                    } catch (error) {
                        console.error('Error:', error);
                        container.innerHTML = oldTableContent;

                        // Show error message (matches products table style)
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'p-4 bg-red-50 text-red-600 rounded-lg mb-4';
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

                // Improved event delegation for all navigation links
                document.addEventListener('click', (e) => {
                    // Handle pagination links (both numbers and arrows)
                    const paginationLink = e.target.closest('a[href*="page="]');
                    if (paginationLink) {
                        e.preventDefault();
                        loadPage(paginationLink.href);
                        return;
                    }

                    // Handle filter links
                    const filterLink = e.target.closest('#filter-dropdown-menu a');
                    if (filterLink) {
                        e.preventDefault();
                        if (filterMenu) filterMenu.classList.add('hidden'); // Close dropdown
                        loadPage(filterLink.href);
                        return;
                    }
                });

                window.addEventListener('popstate', (e) => {
                    if (e.state?.url) {
                        loadPage(e.state.url);
                    } else {
                        loadPage(window.location.href);
                    }
                });

                // Initialize active filter state
                const urlObj = new URL(window.location.href);
                const initialFilter = urlObj.searchParams.get('filter') || 'all';
                updateActiveFilter(initialFilter);
            }

            // Add spinner animation CSS if not already present
            if (!document.getElementById('spinner-animation-style')) {
                const style = document.createElement('style');
                style.id = 'spinner-animation-style';
                style.textContent = `
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                    .animate-spin {
                        animation: spin 1s linear infinite;
                    }
                `;
                document.head.appendChild(style);
            }
        });

        // Show success notification
        function showSuccessNotification(message = 'User deleted successfully.') {
            const notification = document.getElementById('success-notification');
            const title = document.getElementById('notification-title');
            const msg = document.getElementById('notification-message');
            const progress = document.getElementById('notification-progress');

            // Set message
            msg.textContent = message;

            // Reset animation
            notification.classList.remove('translate-x-full');
            notification.classList.add('translate-x-0');

            // Reset progress bar
            progress.style.width = '100%';
            progress.style.transition = 'width 5s linear';

            // Auto-hide after 5 seconds
            setTimeout(() => {
                hideNotification();
            }, 5000);

            // Start progress bar animation
            setTimeout(() => {
                progress.style.width = '0%';
            }, 50);
        }

        // Hide notification
        function hideNotification() {
            const notification = document.getElementById('success-notification');
            notification.classList.remove('translate-x-0');
            notification.classList.add('translate-x-full');
        }

        // Close modal function
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('opacity-100');
            modal.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }

        // Delete user form handler
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

        // Add delete form submission handler
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

                // Close delete modal
                closeModal('delete-user-modal');

                // Show success notification
                showSuccessNotification('User deleted successfully.');

                // Update the table via AJAX instead of refreshing
                if (typeof loadPage === 'function') {
                    // Create a new URL without the page parameter to go back to first page
                    const url = new URL(window.location.href);
                    url.searchParams.delete('page');
                    loadPage(url.toString());
                }

            } catch (error) {
                alert(error.message);
                closeModal('delete-user-modal');
            }
        });

        // Modify the loadPage function to handle the notification
        const loadPage = async (url) => {
            if (isLoading) return;

            const normalizedUrl = normalizeUrl(url);
            const normalizedCurrentUrl = normalizeUrl(currentPageUrl);

            if (normalizedUrl === normalizedCurrentUrl) return;

            isLoading = true;

            // Show loading indicator only on the table, not cards
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

                // Update the cards and table
                document.querySelector('#stats-cards .grid').innerHTML = data.cards;
                container.innerHTML = data.table;

                currentPageUrl = url;

                // Update the active filter state
                const urlObj = new URL(url);
                const filterValue = urlObj.searchParams.get('filter') || 'all';
                updateActiveFilter(filterValue);

                window.history.pushState({
                    url
                }, '', url);
            } catch (error) {
                console.error('Error:', error);
                container.innerHTML = oldTableContent;

                // Show error message (matches products table style)
                const errorDiv = document.createElement('div');
                errorDiv.className = 'p-4 bg-red-50 text-red-600 rounded-lg mb-4';
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

        /* Notification animations */
        #success-notification {
            transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        #notification-progress {
            transition: width 5s linear;
        }

        /* Slide in from right */
        .translate-x-0 {
            transform: translateX(0);
        }

        /* Slide out to right */
        .translate-x-full {
            transform: translateX(calc(100% + 1rem));
        }
    </style>
</x-app-layout>
