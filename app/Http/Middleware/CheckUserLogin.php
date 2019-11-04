<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserLogin
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
        if (Auth::user() == null) {
            return $next($request);
        } else {
            if (Auth::user()->email_verified_at == null) {
                return $next($request);
            } else {
                return redirect()->route('home.member.index');
            }
        }
    }
}
