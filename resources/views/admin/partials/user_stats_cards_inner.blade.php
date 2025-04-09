<!-- Total Users Card -->
<div
    class="relative bg-gradient-to-br from-purple-500/20 to-indigo-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-purple-500/30 p-4 transform hover:scale-105 transition-all duration-300 group">
    <div
        class="absolute inset-0 bg-gradient-to-r from-purple-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
    </div>
    <div class="relative flex items-start justify-between z-10">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <i class='bx bx-group text-xl text-purple-400 glow'></i>
                <span class="text-xs font-semibold text-purple-200 tracking-wider">TOTAL USERS</span>
            </div>
            <h3 class="text-2xl font-extrabold text-white drop-shadow-md">{{ $users->total() }}</h3>
            <div class="flex items-center mt-2 space-x-2">
                @if ($usersPercentageChange >= 0)
                    <span
                        class="bg-purple-500/20 text-purple-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                        <i class='bx bx-up-arrow-alt text-xs mr-1'></i>
                        {{ round($usersPercentageChange, 1) }}%
                    </span>
                @else
                    <span
                        class="bg-red-500/20 text-red-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                        <i class='bx bx-down-arrow-alt text-xs mr-1'></i>
                        {{ round(abs($usersPercentageChange), 1) }}%
                    </span>
                @endif
                <span class="text-[10px] text-gray-300">vs last month</span>
            </div>
        </div>
        <div class="p-2 rounded-full bg-purple-600/20 text-purple-300 border border-purple-500/50 glow">
            <i class='bx bx-group text-2xl'></i>
        </div>
    </div>
    <div class="relative h-1 mt-3 bg-purple-900/50 rounded-full overflow-hidden">
        <div class="absolute h-full bg-gradient-to-r from-purple-400 to-indigo-600 rounded-full transition-all duration-700 ease-out glow"
            style="width: {{ min($usersPercentageChange + 50, 100) }}%"></div>
    </div>
</div>

<!-- Active Today Card -->
<div
    class="relative bg-gradient-to-br from-emerald-500/20 to-green-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-emerald-500/30 p-4 transform hover:scale-105 transition-all duration-300 group">
    <div
        class="absolute inset-0 bg-gradient-to-r from-emerald-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
    </div>
    <div class="relative flex items-start justify-between z-10">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <i class='bx bx-user-check text-xl text-emerald-400 glow'></i>
                <span class="text-xs font-semibold text-emerald-200 tracking-wider">ACTIVE TODAY</span>
            </div>
            <h3 class="text-2xl font-extrabold text-white drop-shadow-md">{{ number_format($activeUsers['count']) }}
            </h3>
            <div class="flex items-center mt-2 space-x-2">
                @if ($activeUsers['trend'] === 'up')
                    <span
                        class="bg-emerald-500/20 text-emerald-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                        <i class='bx bx-up-arrow-alt text-xs mr-1'></i>
                        {{ number_format(abs($activeUsers['percentage_change']), 1) }}%
                    </span>
                @else
                    <span
                        class="bg-red-500/20 text-red-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                        <i class='bx bx-down-arrow-alt text-xs mr-1'></i>
                        {{ number_format(abs($activeUsers['percentage_change']), 1) }}%
                    </span>
                @endif
                <span class="text-[10px] text-gray-300">vs yesterday</span>
            </div>
        </div>
        <div class="p-2 rounded-full bg-emerald-600/20 text-emerald-300 border border-emerald-500/50 glow">
            <i class='bx bx-user-check text-2xl'></i>
        </div>
    </div>
    <div class="relative h-1 mt-3 bg-emerald-900/50 rounded-full overflow-hidden">
        <div class="absolute h-full bg-gradient-to-r from-emerald-400 to-green-600 rounded-full transition-all duration-700 ease-out glow"
            style="width: {{ min(abs($activeUsers['percentage_change']) + 50, 100) }}%"></div>
    </div>
</div>

<!-- Verified Users Card -->
<div
    class="relative bg-gradient-to-br from-cyan-500/20 to-blue-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-cyan-500/30 p-4 transform hover:scale-105 transition-all duration-300 group">
    <div
        class="absolute inset-0 bg-gradient-to-r from-cyan-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
    </div>
    <div class="relative flex items-start justify-between z-10">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <i class='bx bx-badge-check text-xl text-cyan-400 glow'></i>
                <span class="text-xs font-semibold text-cyan-200 tracking-wider">VERIFIED USERS</span>
            </div>
            <h3 class="text-2xl font-extrabold text-white drop-shadow-md">
                {{ $users->whereNotNull('email_verified_at')->count() }}</h3>
            <div class="flex items-center mt-2 space-x-2">
                <span
                    class="bg-cyan-500/20 text-cyan-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                    {{ number_format($verifiedPercentage, 1) }}%
                </span>
                <span class="text-[10px] text-gray-300">of total</span>
            </div>
        </div>
        <div class="p-2 rounded-full bg-cyan-600/20 text-cyan-300 border border-cyan-500/50 glow">
            <i class='bx bx-badge-check text-2xl'></i>
        </div>
    </div>
    <div class="relative h-1 mt-3 bg-cyan-900/50 rounded-full overflow-hidden">
        <div class="absolute h-full bg-gradient-to-r from-cyan-400 to-blue-600 rounded-full transition-all duration-700 ease-out glow"
            style="width: {{ $verifiedPercentage }}%"></div>
    </div>
</div>

<!-- Administrators Card -->
<div
    class="relative bg-gradient-to-br from-red-500/20 to-amber-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-red-500/30 p-4 transform hover:scale-105 transition-all duration-300 group">
    <div
        class="absolute inset-0 bg-gradient-to-r from-red-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
    </div>
    <div class="relative flex items-start justify-between z-10">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <i class='bx bx-shield-alt-2 text-xl text-red-400 glow'></i>
                <span class="text-xs font-semibold text-red-200 tracking-wider">ADMINISTRATORS</span>
            </div>
            <h3 class="text-2xl font-extrabold text-white drop-shadow-md">{{ $adminCount }}</h3>
            @if ($users->total() > 0)
                <!-- Use total() instead of count() -->
                <div class="flex items-center mt-2 space-x-2">
                    <span
                        class="bg-red-500/20 text-red-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                        {{ number_format(($adminCount / $users->total()) * 100, 1) }}%
                    </span>
                    <span class="text-[10px] text-gray-300">of total</span>
                </div>
            @endif
        </div>
        <div class="p-2 rounded-full bg-red-600/20 text-red-300 border border-red-500/50 glow">
            <i class='bx bx-shield-alt-2 text-2xl'></i>
        </div>
    </div>
    <div class="relative h-1 mt-3 bg-red-900/50 rounded-full overflow-hidden">
        <div class="absolute h-full bg-gradient-to-r from-red-400 to-amber-600 rounded-full transition-all duration-700 ease-out glow"
            style="width: {{ $users->total() > 0 ? ($adminCount / $users->total()) * 100 : 0 }}%"></div>
    </div>
</div>
