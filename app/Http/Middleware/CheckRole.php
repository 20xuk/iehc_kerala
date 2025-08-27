<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Check if user has any of the required roles
        foreach ($roles as $role) {
            if ($this->userHasRole($user, $role)) {
                return $next($request);
            }
        }

        // User doesn't have required role
        abort(403, 'Unauthorized access. You do not have permission to view this page.');
    }

    private function userHasRole($user, $role): bool
    {
        return match($role) {
            'donor' => $user->isDonor(),
            'secretary' => $user->isSecretary(),
            'admin' => $user->isAdmin(),
            'system_admin' => $user->isSystemAdmin(),
            'office_staff' => $user->isOfficeStaff(),
            'accountant' => $user->isAccountant(),
            default => false
        };
    }
}
