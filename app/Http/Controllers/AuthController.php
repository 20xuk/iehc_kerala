<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $user = Auth::user();
            $request->session()->regenerate();
            
            // Check if password change is required
            if ($user->needsPasswordChange()) {
                return redirect()->route('password.change');
            }
            
            // Automatically redirect based on user's role
            return $this->redirectBasedOnUserRole($user);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    private function redirectBasedOnUserRole($user)
    {
        if ($user->isSystemAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isOfficeStaff()) {
            return redirect()->route('staff.dashboard');
        } elseif ($user->isAccountant()) {
            return redirect()->route('accountant.dashboard');
        } elseif ($user->isSecretary()) {
            return redirect()->route('secretary.dashboard');
        } elseif ($user->isDonor()) {
            return redirect()->route('donor.dashboard');
        } else {
            // Default fallback
            return redirect()->route('dashboard');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:donor,secretary,admin',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    public function showPasswordChange()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        // Update password and mark as changed
        $user->update([
            'password' => Hash::make($request->password),
            'password_change_required' => false,
        ]);

        return redirect()->route('password.change.success');
    }

    public function passwordChangeSuccess()
    {
        $user = Auth::user();
        return $this->redirectBasedOnUserRole($user);
    }
}
