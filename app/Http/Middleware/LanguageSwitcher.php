<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;
use App;
class LanguageSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! Session::has('lang')){
            Session::put('lang',Config::get('app.locale'));
        }
        App::setLocale(session('lang'));
        return $next($request);
    }
}
