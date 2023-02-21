<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UserRolePageMapping;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login(){
        return view('Auth.login');
    }

    public function SelectProject(){
        return view('Auth/selectproject');
    }

    public function LoginPost(Request $req){
        $result = Users::where([
            'user_name'=>$req->user_name,
        ])->first();
        if(!empty($result)):
            if (Hash::check($req->password, $result->password)) :
                // $user_role_page_mapping_data = UserRolePageMapping::where(['user_id'=>$result->user_id])->get();


                $user_role_page_mapping_data = UserRolePageMapping::join('rights_mapping AS RM','RM.role_id','=','user_role_page_mapping.role_id','left')->join('rights AS R','RM.right_id','=','R.right_id','left')
                ->join('pages AS P','user_role_page_mapping.page_id','=','P.page_id','left')
                ->where(['user_role_page_mapping.user_id'=>$result->user_id])->get(['P.page_id','R.right_name','R.right_id','RM.has_right','user_role_page_mapping.has_access']);
                $req->session()->put('user_id',$result->user_id);
                $req->session()->put('user_name',$result->user_name);
                $req->session()->put('user_role_page_mapping_data',json_encode($user_role_page_mapping_data));
                // echo $result->user_id;
                return redirect('/Dashboard');
            endif;
        endif;
        $req->session()->flash('incorrectlogin', 'Incorrect Username Or Password');
        return redirect('/');
    }
}
