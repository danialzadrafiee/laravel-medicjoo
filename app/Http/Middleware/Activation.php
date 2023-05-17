<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Activation
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
        if (!Auth::check() || auth()->user()->UserAttr()->first()->active != 1) {
            return redirect()->route('sms_active');
        }

        if (!Auth::check() || auth()->user()->UserAttr()->first()->approved != 1) {
            return redirect()->route('user_not_approved');
        }

        return $next($request);
    }
}
