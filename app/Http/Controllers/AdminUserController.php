<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:system_admin');
    }

    /**
     * Display a listing of admin users
     */
    public function index()
    {
        $users = User::whereIn('role', ['system_admin', 'office_staff', 'accountant'])
            ->orderBy('name')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new admin user
     */
    public function create()
    {
        $roles = [
            'system_admin' => 'System Administrator',
            'office_staff' => 'Office Staff',
            'accountant' => 'Accountant'
        ];

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created admin user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(['system_admin', 'office_staff', 'accountant'])],
            'password_change_required' => 'boolean'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'password_change_required' => $request->boolean('password_change_required', true),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user created successfully!');
    }

    /**
     * Display the specified admin user
     */
    public function show(User $user)
    {
        if (!in_array($user->role, ['system_admin', 'office_staff', 'accountant'])) {
            abort(404);
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified admin user
     */
    public function edit(User $user)
    {
        if (!in_array($user->role, ['system_admin', 'office_staff', 'accountant'])) {
            abort(404);
        }

        $roles = [
            'system_admin' => 'System Administrator',
            'office_staff' => 'Office Staff',
            'accountant' => 'Accountant'
        ];

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified admin user
     */
    public function update(Request $request, User $user)
    {
        if (!in_array($user->role, ['system_admin', 'office_staff', 'accountant'])) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['system_admin', 'office_staff', 'accountant'])],
            'password' => 'nullable|string|min:8|confirmed',
            'password_change_required' => 'boolean'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password_change_required' => $request->boolean('password_change_required'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user updated successfully!');
    }

    /**
     * Remove the specified admin user
     */
    public function destroy(User $user)
    {
        if (!in_array($user->role, ['system_admin', 'office_staff', 'accountant'])) {
            abort(404);
        }

        // Prevent deleting the last system admin
        if ($user->role === 'system_admin') {
            $systemAdminCount = User::where('role', 'system_admin')->count();
            if ($systemAdminCount <= 1) {
                return redirect()->back()
                    ->with('error', 'Cannot delete the last system administrator!');
            }
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user deleted successfully!');
    }

    /**
     * Reset user password
     */
    public function resetPassword(User $user)
    {
        if (!in_array($user->role, ['system_admin', 'office_staff', 'accountant'])) {
            abort(404);
        }

        $newPassword = 'password123'; // You might want to generate a random password
        $user->update([
            'password' => Hash::make($newPassword),
            'password_change_required' => true,
        ]);

        return redirect()->back()
            ->with('success', "Password reset successfully! New password: {$newPassword}");
    }

    /**
     * Toggle user status
     */
    public function toggleStatus(User $user)
    {
        if (!in_array($user->role, ['system_admin', 'office_staff', 'accountant'])) {
            abort(404);
        }

        // You might want to add an 'is_active' field to users table
        // For now, we'll just update the password_change_required field
        $user->update([
            'password_change_required' => !$user->password_change_required
        ]);

        $status = $user->password_change_required ? 'disabled' : 'enabled';
        return redirect()->back()
            ->with('success', "User {$status} successfully!");
    }
}
