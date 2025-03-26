<?php
// filepath: c:\Users\Cduken\Desktop\2nd Sem\Mini Capstone\mini capstone pure laravel\mini-capstone\app\Http\Controllers\AdminController.php
namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $search = request('search');

        // Get users with search functionality
        $users = User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Get active users statistics
        $activeUsers = $this->getActiveUsersStats();

        return view('admin.users', compact('users', 'activeUsers'));
    }

    // Helper method to get active users statistics
    protected function getActiveUsersStats()
    {
        return cache()->remember('active_users_stats', now()->addMinutes(1), function () {
            $activeToday = User::where('last_login_at', '>=', Carbon::now()->subDay())->count();
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
