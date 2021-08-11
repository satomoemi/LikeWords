<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\User;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     //
    //     $username = $request->getUser();
    //     $password = $request->getPassword();
        
    //     if ($username == User::where('name',$request->email)->first() && $password == User::where('password',$request->password)->first()) {
            
    //         return $next($request);
    //     }

    //     abort(401, "Enter email and password.", [
    //         header('WWW-Authenticate: Basic realm="Sample Private Page"'),
    //         header('Content-Type: text/plain; charset=utf-8')
    //     ]);
    // }
}
