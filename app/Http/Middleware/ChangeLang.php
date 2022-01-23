<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class ChangeLang
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
        /**
     * requests hasHeader is used to check the Accept-Language header from the REST API's
     */
    if ($request->hasHeader("Lang")) {
        App::setLocale($request->header("lang"));
    }
        // route lang
        App::setLocale('en');
        if(isset($request->lang)&&$request->lang=='ar')
        App::setLocale('ar');

    //     // continue request
        return $next($request);
    }
}
