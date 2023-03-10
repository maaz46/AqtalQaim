<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoginSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->exists('user_id')) :
            if ($request->session()->get('is_admin') == "1") :
                return redirect('/Admin/Dashboard');
            elseif ($request->session()->get('is_admin') == "0") :
                return redirect('/Dashboard');
            endif;
        endif;
        return $next($request);
    }
}
