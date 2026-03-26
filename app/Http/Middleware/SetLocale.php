<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supported = ['es', 'en', 'pt'];
        $routeLang = $request->route('lang');
        $requested = $request->query('lang');

        if (is_string($routeLang) && in_array($routeLang, $supported, true)) {
            $request->session()->put('lang', $routeLang);
            app()->setLocale($routeLang);
            return $next($request);
        }

        if (is_string($requested) && in_array($requested, $supported, true)) {
            $request->session()->put('lang', $requested);
        }

        $locale = $request->session()->get('lang', config('app.locale'));

        if (in_array($locale, $supported, true)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
