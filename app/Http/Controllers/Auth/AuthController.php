<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
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
                $req->session()->put('user_id',$result->user_id);
                $req->session()->put('user_name',$result->user_name);
                return redirect('/Dashboard');
            endif;
        endif;
        $req->session()->flash('incorrectlogin', 'Incorrect Username Or Password');
        return redirect('/');
    }
}
