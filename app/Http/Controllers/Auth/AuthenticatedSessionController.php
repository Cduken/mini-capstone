<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Update last login timestamp
        $user = $request->user();
        $user->last_login_at = Carbon::now();
        $user->save();

        if ($user->userType === 'admin') {
            // Validate admin code
            if (!$request->has('admin_code') || $request->admin_code !== config('auth.admin_code')) {
                Auth::logout();
                return back()->withErrors([
                    'admin_code' => 'Invalid admin code.',
                ])->withInput($request->except('password', 'admin_code'));
            }
            return redirect('admin/dashboard');
        }

        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Check if an email belongs to an admin user.
     */
    public function checkAdminEmail(Request $request)
    {
        try {
            $email = $request->input('email');
            $user = \App\Models\User::where('email', $email)->first();
            
            return response()->json([
                'isAdmin' => $user && $user->userType === 'admin'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while checking admin status'
            ], 500);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
