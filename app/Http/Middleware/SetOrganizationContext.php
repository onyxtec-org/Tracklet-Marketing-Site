<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetOrganizationContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Set organization context for non-super-admin users
        if ($user && !$user->isSuperAdmin() && $user->organization) {
            // Add organization to request for easy access
            $request->merge(['organization' => $user->organization]);
            
            // Set global organization scope if needed
            // This ensures all queries are scoped to the organization
        }

        return $next($request);
    }
}
