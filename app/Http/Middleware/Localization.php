<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
        if (request()->has('fb_lang') && (request()->fb_lang === 'ka' || request()->fb_lang === 'en')) {
            App::setLocale(request()->fb_lang);
            View::share('lang', Session::get('locale'));
        } else {
            if (Session::has('locale')) {
                App::setLocale(Session::get('locale'));
            }

            if (request()->lang == 'en') {
                app()->setLocale('en');
                session()->put('locale', 'en');
                return redirect()->back();
            }
            if (request()->lang == 'ka') {
                app()->setLocale('ka');
                session()->put('locale', 'ka');
                return redirect()->back();
            }

            View::share('lang', Session::get('locale'));
        }
        return $next($request);
    }
}
