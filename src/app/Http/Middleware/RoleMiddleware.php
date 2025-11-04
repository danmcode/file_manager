<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $hasAccess = match ($role) {
            'Administrador' => $user->isAdmin(),
            'Usuario' => $user->isUser(),
            default => false,
        };

        if (!$hasAccess) {
            return $this->denyAccess();
        }

        return $next($request);
    }

    private function denyAccess()
    {
        return redirect()
            ->route('dashboard')
            ->with('error', 'No tienes permisos para acceder');
    }
}