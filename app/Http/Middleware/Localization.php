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
        $local = $request->session()->get('local');
        $local = $local ?? 'en';
        App::setLocale($local);





        // if (session()->has('locale')) {
        //     // set laravel localization
        //         App::setLocale(session()->get('locale'));
            // }
        // dd(App::getLocale('locale'));
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
