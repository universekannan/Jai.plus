<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class PasswordController extends Controller
{
    public function showForgotForm() {
        return view('auth.passwords.email');
    }

    public function sendResetLink(Request $request) {

        $user = User::where('user_name', $request->user_name)
                    ->where('email', $request->email)
                    ->first();

        if (!$user) {
            return back()->withErrors(['error' => 'Invalid username or email']);
        }

        // Create reset link with username
        $link = route('password.change', ['username' => $user->user_name]);

        // Send email
        Mail::raw("Click here to reset your password: $link", function($message) use ($user) {
            $message->to($user->email)
                    ->subject('Password Reset Link');
        });

        return back()->with('success', 'Reset link sent to your email.');
    }

    public function showChangeForm($username) {
        return view('auth.passwords.change', compact('username'));
    }

    public function updatePassword(Request $request, $username) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('username', $username)->firstOrFail();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password updated successfully');
    }
}

?>