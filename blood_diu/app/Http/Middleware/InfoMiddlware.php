<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InfoMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($request->routeIs('information') && $user->blood_group) {
            return redirect()->route('dashboard');
        }
        if ($request->routeIs('information') && !$user->blood_group) {
            return $next($request);
        }
        if (!$user->blood_group) {
            return redirect()->route('information');
        }
        return $next($request);
    }
}
