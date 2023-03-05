<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserProjectMapping;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UserRolePageMapping;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login()
    {
        return view('Auth.login');
    }

    public function SelectProject()
    {
        return view('Auth/selectproject');
    }

    public function LoginPost(Request $req)
    {
        $result = Users::where([
            'users.user_name' => $req->user_name,
        ])->first();

        if (!empty($result)) :
            if (Hash::check($req->password, $result->password)) :
                // $user_role_page_mapping_data = UserRolePageMapping::where(['user_id'=>$result->user_id])->get();
                // echo '<pre>';
                // print_r(json_decode(json_encode($result),true));
                // echo '</pre>';
                $user_project_mapping = array();
                $selected_project_id = "";
                $selected_project_name = "";
                if ($result->is_admin == "0") :
                    $user_project_mapping = UserProjectMapping::where(['user_project_mapping.user_id' => $result->user_id])->join('projects AS P', 'P.project_id', '=', 'user_project_mapping.project_id', 'left')->get(['P.project_id','P.project_name']);
                    if($user_project_mapping->count()=="1"):
                        $selected_project_id = $user_project_mapping[0]["project_id"];
                        $selected_project_name = $user_project_mapping[0]["project_name"];
                    endif;
                endif;

                $user_role_page_mapping_data = UserRolePageMapping::join('rights_mapping AS RM', 'RM.role_id', '=', 'user_role_page_mapping.role_id', 'left')
                    ->join('rights AS R', 'RM.right_id', '=', 'R.right_id', 'left')
                    ->join('pages AS P', 'user_role_page_mapping.page_id', '=', 'P.page_id', 'left')
                    ->where(['user_role_page_mapping.user_id' => $result->user_id])->get(['P.page_id', 'R.right_name', 'R.right_id', 'RM.has_right', 'user_role_page_mapping.has_access']);

                $sessiondata = array(
                    'user_id' => $result->user_id,
                    'user_name' => $result->user_name,
                    'is_admin' => $result->is_admin,
                    'selected_project_id'=>$selected_project_id,
                    "selected_project_name"=>$selected_project_name,
                    'assigned_projects'=>json_decode(json_encode($user_project_mapping),true),
                    'user_role_page_mapping_data' => json_encode($user_role_page_mapping_data)
                );

                $req->session()->put($sessiondata);
                return redirect('/Dashboard');
            endif;
        endif;
        $req->session()->flash('incorrectlogin', 'Incorrect Username Or Password');
        return redirect('/');
    }
}
