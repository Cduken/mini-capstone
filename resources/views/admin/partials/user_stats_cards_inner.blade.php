<!-- Total Users Card -->
<div
    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-purple-300 hover:transform hover:scale-105 transition duration-300">
    <div class="p-5 flex items-start justify-between">
        <div>
            <span class="text-gray-500 text-sm font-medium">Total Users</span>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $users->total() }}</h3>
            <div class="flex items-center mt-3">
                @if ($usersPercentageChange >= 0)
                    <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full flex items-center">
                        <i class='bx bx-up-arrow-alt mr-1'></i> {{ round($usersPercentageChange, 0) }}%
                    </span>
                @else
                    <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full flex items-center">
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
        <div class="h-1 bg-purple-500" style="width: {{ min($usersPercentageChange + 50, 100) }}%"></div>
    </div>
</div>

<!-- Active Today Card -->
<div
    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-green-300 hover:transform hover:scale-105 transition duration-300">
    <div class="p-5 flex items-start justify-between">
        <div>
            <span class="text-gray-500 text-sm font-medium">Active Today</span>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($activeUsers['count']) }}</h3>
            <div class="flex items-center mt-3">
                @if ($activeUsers['trend'] === 'up')
                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full flex items-center">
                        <i class='bx bx-up-arrow-alt mr-1'></i>
                        {{ number_format(abs($activeUsers['percentage_change']), 1) }}%
                    </span>
                @else
                    <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full flex items-center">
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
        <div class="h-1 bg-green-500" style="width: {{ min($activeUsers['percentage_change'] + 50, 100) }}%"></div>
    </div>
</div>

<!-- Verified Users Card -->
<div
    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-blue-300 hover:transform hover:scale-105 transition duration-300">
    <div class="p-5 flex items-start justify-between">
        <div>
            <span class="text-gray-500 text-sm font-medium">Verified Users</span>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $users->whereNotNull('email_verified_at')->count() }}
            </h3>
            <div class="flex items-center mt-3">
                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full flex items-center">
                    {{ number_format($verifiedPercentage, 1) }}%
                </span>
                <span class="text-gray-500 text-xs ml-2">of total</span>
            </div>
        </div>
        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
            <i class='bx bx-badge-check text-2xl'></i>
        </div>
    </div>
    <div class="h-1 bg-blue-200 w-full">
        <div class="h-1 bg-blue-500" style="width: {{ $verifiedPercentage }}%"></div>
    </div>
</div>

<!-- Administrators Card -->
<div
    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-red-300 hover:transform hover:scale-105 transition duration-300">
    <div class="p-5 flex items-start justify-between">
        <div>
            <span class="text-gray-500 text-sm font-medium">Administrators</span>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $adminCount }}</h3>
            @if ($users->count() > 0)
                <div class="flex items-center mt-3">
                    <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full flex items-center">
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
            style="width: {{ $users->count() > 0 ? ($adminCount / $users->count()) * 100 : 0 }}%"></div>
    </div>
</div>
