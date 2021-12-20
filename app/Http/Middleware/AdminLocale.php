<?php

namespace App\Http\Middleware;

use App\Constants\AppConstants;
use Closure;
use Illuminate\Http\Request;

class AdminLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale(AppConstants::ADMIN_DEFAULT_LANGUAGE);
        return $next($request);
    }
}
