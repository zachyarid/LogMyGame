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
        if ($this->auth->user())
        {
            switch ($this->auth->user()->status)
            {
                case 1:
                    break;
                default:
                    return redirect('/')->with('fail_message', 'Your account is not active in good standing.');
                    break;
            }
        }
        /*if ($request->user()->status != 1)
        {
            return redirect('/')->with('fail_message', 'Your account is not active in good standing.');
        }*/

        return $next($request);
    }
}
