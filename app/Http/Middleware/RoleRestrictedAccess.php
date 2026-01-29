<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRestrictedAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role_id == 2) {
            $allowedRoutes = [
                'home',
                'shop',
                'product.detail',
                'cart',
                'checkout',
                'checkout.success',
                'checkout.cancel',
                'dashboard',
                'my-orders',
                'my-orders.show',
                'logout',
                'profile.show',
                'user-profile-information.update',
                'current-user-photo.destroy',
                'other-browser-sessions.destroy',
            ];

            $currentRoute = $request->route()->getName();

            $isAllowed = in_array($currentRoute, $allowedRoutes);

            if (!$isAllowed) {
                // Wildcard checks
                if ($currentRoute && (
                    str_starts_with($currentRoute, 'livewire.') ||
                    str_starts_with($currentRoute, 'sanctum.') ||
                    str_starts_with($currentRoute, 'password.') ||
                    str_starts_with($currentRoute, 'two-factor.') ||
                    str_starts_with($currentRoute, 'storage.') ||
                    str_starts_with($currentRoute, 'ignition.')
                )) {
                    $isAllowed = true;
                }
            }

            if (!$isAllowed) {
                abort(403, 'Unauthorized access.');
            }
        }

        return $next($request);
    }
}
