<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $local = $request->header('X-localization');
        app()->setLocale('ar');
        if (!in_array($local, ['en', 'ar', 'zh'])) {
            app()->setLocale('ar');
        } else {
            app()->setLocale($local);
        }
        return $next($request);
    }
}
