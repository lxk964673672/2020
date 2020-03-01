<?php

namespace App\Http\Middleware;

use Closure;

class Logins
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
        //执行动作
        $user=session('dl');
        if(!$user){
            return redirect('/dl');
        }
        return $next($request);
    }
}
