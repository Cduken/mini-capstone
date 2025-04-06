<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && file_exists(public_path('images/' . $user->avatar))) {
                unlink(public_path('images/' . $user->avatar));
            }

            // Store new avatar
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images'), $filename);
            $data['avatar'] = $filename;
        }

        // Handle password change if current password is provided
        if (!empty($data['current_password'])) {
            if (!Hash::check($data['current_password'], $user->password)) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['current_password' => ['The provided password does not match your current password.']]
                    ], 422);
                }
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }

            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }
        }

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar ? asset('images/' . $user->avatar) : asset('images/default-avatar.png')
                ]
            ]);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->avatar && file_exists(public_path('images/' . $user->avatar))) {
            unlink(public_path('images/' . $user->avatar));
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect' => url('/')
            ]);
        }

        return Redirect::to('/');
    }
}
