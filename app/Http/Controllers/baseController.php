<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class baseController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Redirect based on the user type
            if ($user->user_type == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->user_type == 'vendor') {
                return redirect()->route('vendor.dashboard');
            }
        }

        // If the user is not authenticated, show the login page
        return view('login');
    }


    public function login(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt authentication
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            //first entry on log that user logged in
            $log = new Logs();
            $log->table_name = 'user';
            $log->type_name = $user->user_type . ' Login';
            $log->action_name = 'login';
            $log->item_id = 0;
            $log->uid = $user->id;
            $log->save();

            // Redirect based on user type
            if ($user->type === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('vendor.dashboard');
            }
        }

        return redirect()
            ->back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput();
    }

    public function sendPasswordResetEmail(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email|exists:users,email', // Ensure the email exists in the database
        ]);

        // Get the user by email
        $user = User::where('email', $request->email)->first();

        // Generate OTP
        $otp = rand(100000, 999999);
        $user->otp = $otp; // Set OTP in the user table
        $user->save();

        // Send the email
        try {
            Mail::send('forget_pass', ['otp' => $otp, 'data' => $user], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Password Reset Request')
                    ->from('no-reply@GSTBiller');
            });

            // Return response or redirect to the OTP page
            return view('change_password')->with('success', 'OTP sent successfully! Check your email.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send OTP. Please try again later.');
        }
    }
    public function change_password()
    {
        return view('change_password');
    }

    public function verify_change(Request $request)
    {
        // Validate input fields
        $request->validate([
            'otp' => 'required|digits:6', // OTP must be exactly 6 digits
            'password' => 'required|min:6', // Password must be at least 6 characters
            'confirm_password' => 'required|same:password', // Confirm password must match password
        ]);

        // Find user by OTP
        $user = User::where('otp', $request->otp)->first();

        if ($user) {
            // Update password and reset OTP
            $user->password = Hash::make($request->password); // Hash the new password
            $user->otp = 0; // Clear OTP after use
            $user->save();

            // Redirect to login with success message
            return redirect()->route('index')->with('success', 'Password changed successfully! You can now log in with your new password.');
        }

        // If no user found with the provided OTP
        return redirect()->route('change.pasword')->with('error', 'Invalid OTP or the OTP has expired.');
    }

    public function logout()
    {
        $user = Auth::user();

        //first entry on log that user logged in
        $log = new Logs();
        $log->table_name = 'user';
        $log->type_name = $user->user_type . ' Logout';
        $log->action_name = 'Logout';
        $log->item_id = 0;
        $log->uid = $user->id;
        $log->save();

        Auth::logout();
        return redirect()->Route('index')->with('success', 'You have been logged out!');
    }
}
