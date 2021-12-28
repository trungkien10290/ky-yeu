<?php

namespace App\Http\Middleware;

use App\Constants\AppConstants;
use Closure;
use Illuminate\Http\Request;

class Locale
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
        $lang_code = $request->segment(1);
//        if (!empty($lang_code) && in_array($lang_code, AppConstants::PUBLIC_LANGUAGES)) {
//            $request->route()->forgetParameter('lang');
//            url()->defaults(array('lang' => $lang_code));
//            app()->setLocale($lang_code);
//        } else {
//            return redirect(url(AppConstants::PUBLIC_DEFAULT_LANGUAGE));
//        }

        app()->setLocale(AppConstants::PUBLIC_DEFAULT_LANGUAGE);

        return $next($request);
    }
}
