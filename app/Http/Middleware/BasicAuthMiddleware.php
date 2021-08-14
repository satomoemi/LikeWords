<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\User;
use Auth;

class BasicAuthMiddleware
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
        
        switch (true) {
        case !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']):
            case $_SERVER['PHP_AUTH_USER'] !== User::where('email',$request->email)->get():
            case $_SERVER['PHP_AUTH_PW']   !== User::where('password',$request->password)->get():
                header('WWW-Authenticate: Basic realm="Enter username and password."');
                header('Content-Type: text/plain; charset=utf-8');
                die('このページを見るにはログインが必要です');
        }

        header('Content-Type: text/html; charset=utf-8');

        return $next($request);
    }
}
