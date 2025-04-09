<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter ?? 'all';

        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        switch ($filter) {
            case 'verified':
                $query->whereNotNull('email_verified_at');
                break;
            case 'admins':
                $query->where('userType', 'admin');
                break;
            case 'pending':
                $query->whereNull('email_verified_at');
                break;
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(4);

        // Calculate statistics
        $stats = $this->calculateStatistics($users);

        if ($request->ajax()) {
            return response()->json([
                'cards' => view('admin.partials.user_stats_cards_inner', array_merge(
                    ['users' => $users],
                    $stats
                ))->render(),
                'table' => view('admin.partials.users_table', ['users' => $users])->render()
            ]);
        }

        return view('admin.users', array_merge(
            ['users' => $users, 'filter' => $filter],
            $stats
        ));
    }

    protected function calculateStatistics($users)
    {
        $currentMonthUsers = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $lastMonthUsers = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $usersPercentageChange = 0;
        if ($lastMonthUsers > 0) {
            $usersPercentageChange = (($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100;
        } elseif ($currentMonthUsers > 0 && $lastMonthUsers === 0) {
            $usersPercentageChange = 100; // 100% increase if there were no users last month
        }

        $verifiedPercentage = $users->total() > 0
            ? ($users->whereNotNull('email_verified_at')->count() / $users->total()) * 100
            : 0;

        $adminCount = User::where('userType', 'admin')->count(); // Use full User query, not paginated

        return [
            'activeUsers' => $this->getActiveUsersStats(),
            'usersPercentageChange' => $usersPercentageChange,
            'verifiedPercentage' => $verifiedPercentage,
            'adminCount' => $adminCount
        ];
    }

    protected function getActiveUsersStats()
    {
        return cache()->remember('active_users_stats', now()->addMinutes(1), function () {
            $activeToday = User::where('last_login_at', '>=', Carbon::today())->count();
            $activeYesterday = User::where('last_login_at', '>=', Carbon::yesterday())
                ->where('last_login_at', '<', Carbon::today())
                ->count();

            $percentageChange = 0;
            if ($activeYesterday > 0) {
                $percentageChange = (($activeToday - $activeYesterday) / $activeYesterday) * 100;
            } elseif ($activeToday > 0 && $activeYesterday === 0) {
                $percentageChange = 100; // 100% increase if no active users yesterday
            } elseif ($activeToday === 0 && $activeYesterday > 0) {
                $percentageChange = -100; // 100% decrease if no active users today
            }

            return [
                'count' => $activeToday,
                'percentage_change' => $percentageChange,
                'trend' => $percentageChange >= 0 ? 'up' : 'down'
            ];
        });
    }

    public function edit(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'userType' => 'required|string|in:user,admin',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
}
