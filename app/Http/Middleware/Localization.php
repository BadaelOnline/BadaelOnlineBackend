<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //    Check header request
        if (Session::has('locale')) {
        // set laravel localization
            $locale = Session::get('locale',Config::get('app.locale'));
        } else{
            $locale = 'en';
            // App::setLocale(session()->get('locale'));
        }
        App::setLocale($locale);
        /**
     * requests hasHeader is used to check the Accept-Language header from the REST API's
     */
    if ($request->hasHeader("Lang")) {
        /**
         * If Accept-Language header found then set it to the default locale
         */
        App::setLocale($request->header("lang"));
    }
        // route lang
        App::setLocale('en');
        if(isset($request->lang)&&$request->lang=='ar')
        App::setLocale('ar');

        // continue request
        return $next($request);
    }
}
