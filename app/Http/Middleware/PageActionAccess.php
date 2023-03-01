<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PageActionAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $PageID, $ActionID)
    {
        $user_role_page_mapping_data = json_decode($request->session()->get('user_role_page_mapping_data'), true);
        if ($request->session()->get('is_admin') == "0") :
            foreach ($user_role_page_mapping_data as $key => $item) :
                if ($item['page_id'] == $PageID && $item['right_id'] == $ActionID) :
                    if ($item['has_right'] == "0") :
                        echo 'Forbidden';
                        exit;
                    endif;
                endif;
            endforeach;
        endif;
        return $next($request);
    }
}
