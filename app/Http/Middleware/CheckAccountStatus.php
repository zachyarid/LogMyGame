<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccountStatus
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
        if (Auth::user())
        {
            switch (Auth::user()->status)
            {
                case 1:
                    break;
                default:
                    return redirect('/')->with('fail_message', 'Your account is not active in good standing.');
                    break;
            }
        }

        return $next($request);
    }
}
