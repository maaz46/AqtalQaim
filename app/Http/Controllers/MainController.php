<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupTypes;
use App\Models\GroupCodes;
use App\Models\ControlTypes;
use App\Models\ControlCodes;
use App\Models\ProjectCategories;
use App\Models\Projects;
use App\Models\Roles;
use App\Models\Users;
use App\Models\ChartOfAccounts;
use App\Models\Suppliers;
use App\Models\Customers;
use App\Models\Pages;
use App\Models\Rights;
use App\Models\RightsMapping;
use App\Models\UserRolePageMapping;
use App\Models\UserProjectMapping;
use App\Models\ChartOfAccountsProjectMapping;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class MainController extends Controller
{
    



   

   


    






    
    #region GET CONTROL CODES

    public function GetControlCodesByGroupCodeID(Request $req)
    {
        $result = ControlCodes::where(['group_code_id' => $req->GroupCodeID])->get();
        return response()->json($result);
    }

    #endregion

    #region GET PROJECTS BY PROJECT CATEGORY ID

    public function GetProjectsByProjectCategoryID(Request $req)
    {
        $result = Projects::where(['project_category_id' => $req->ProjectCategoryID])->get();
        return response()->json($result);
    }

    #endregion GET PROJECTS BY PROJECT CATEGORY ID


    function PrintR($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit;
    }
}
