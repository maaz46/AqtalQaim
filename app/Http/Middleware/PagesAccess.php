<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PagesAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $PageID)
    {
        $user_role_page_mapping_data = json_decode($request->session()->get('user_role_page_mapping_data'), true);
        foreach($user_role_page_mapping_data as $key=>$item):
            if($item['page_id']==$PageID):
                if($item['has_access']=="0"):
                    echo 'Forbidden';
                    exit;
                endif;
            endif;
        endforeach;
        // if($PageID=="3"):
        //     return Redirect('/');
        // endif;
        return $next($request);
    }
}
