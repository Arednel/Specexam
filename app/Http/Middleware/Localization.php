<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
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
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else if (Cookie::get('locale')) {
            Session::put('locale', Cookie::get('locale'));
            App::setLocale(Cookie::get('locale'));
        } else {
            //Check preffered language, set in user browser
            switch ($request->server('HTTP_ACCEPT_LANGUAGE')) {
                    //ru is Russian language according to ISO 639-1 codes
                case 'ru':
                    $locale = 'ru';
                    break;
                    //kk is Kazakh language according to ISO 639-1 codes
                case 'kk':
                    $locale = 'kk';
                    break;
                case 'en':
                    $locale = 'en';
                    break;
                default:
                    $locale = 'ru';
                    break;
            }

            App::setLocale($locale);
            Session::put('locale', $locale);
            Cookie::queue(Cookie::forever('locale', $locale));
        }

        return $next($request);
    }
}
