<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        // Bannissement
        if ($user && $user->banned_at) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('error', 'Compte banni');
        }

        // 1 seule coloc active
        if ($user && $user->activeColocation() && !in_array($role, ['admin'])) {
            return redirect('/colocations')->with('error', 'Une seule colocation active');
        }

        return $next($request);
    }
}
