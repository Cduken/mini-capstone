<?php
// filepath: c:\Users\Cduken\Desktop\2nd Sem\Mini Capstone\mini capstone pure laravel\mini-capstone\app\Http\Controllers\AdminController.php
namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // app/Http/Controllers/AdminController.php

    public function index()
    {
        $search = request('search');
        $filter = request('filter', 'all');

        $query = User::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
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
        $activeUsers = $this->getActiveUsersStats();

        // Add these calculations for the users percentage change
        $currentMonthUsers = User::whereMonth('created_at', now())->count();
        $lastMonthUsers = User::whereMonth('created_at', now()->subMonth())->count();

        $usersPercentageChange = 0;
        if ($lastMonthUsers > 0) {
            $usersPercentageChange = (($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100;
        } elseif ($currentMonthUsers > 0) {
            $usersPercentageChange = 100;
        }

        $verifiedPercentage = $users->total() > 0
            ? ($users->whereNotNull('email_verified_at')->count() / $users->total()) * 100
            : 0;

        return view('admin.users', compact(
            'users',
            'activeUsers',
            'filter',
            'usersPercentageChange' // Add this to the compact function
        ));
    }

    protected function getActiveUsersStats()
    {
        return cache()->remember('active_users_stats', now()->addMinutes(1), function () {
            $activeToday = User::where('last_login_at', '>=', Carbon::now()->subDay(1))->count();
            $activeYesterday = User::whereBetween('last_login_at', [
                Carbon::now()->subDays(2),
                Carbon::now()->subDay()
            ])->count();

            $percentageChange = 0;
            if ($activeYesterday > 0) {
                $percentageChange = (($activeToday - $activeYesterday) / $activeYesterday) * 100;
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
