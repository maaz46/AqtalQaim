<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DefaultProject
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
        if($request->session()->get('is_admin')=="0"):
            if($request->session()->get('selected_project_id')=="" && $request->session()->get('select_project_name')==""):
                
                return redirect('SetDefaultProject');
            endif;
        endif;
        return $next($request);
    }
}
