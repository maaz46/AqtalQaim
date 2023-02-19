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
use App\Models\UserCategories;
use App\Models\ChartOfAccounts;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Hash;
use Session;



class MainController extends Controller
{
    #region DASHBOARD
    public function Dashboard(){
        return view('Main.dashboard');
    }
    #endregion


    #region GroupType
    public function GroupTypes(){
        $group_types = GroupTypes::get();
        return view('Main.grouptypes', ['group_types'=>$group_types]);
    }


    public function AddGroupType(Request $req){
        $validatedData = $req->validate([
            'group_type' => ['required'],
        ]);
       
        $group_types = new GroupTypes();
        $group_types->group_type = $req->group_type;
        if($group_types->save()):
            $req->session()->flash('status', 'Group Type Added Successfully');

        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('GroupTypes');
    }


    public function EditGroupType(Request $req){
        $result = GroupTypes::where(['group_type_id'=>$req->GroupTypeID])->first();
        return view('Main.edit_grouptypes', compact('result'));
    }

    public function UpdateGroupType(Request $req){
        $validatedData = $req->validate([
            'group_type' => ['required'],
        ]);
       if(GroupTypes::where(['group_type_id'=>$req->group_type_id])->update(['group_type'=>$req->group_type])):
            $req->session()->flash('status', 'Group Type Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('GroupTypes');
    }

    public function DeleteGroupType(Request $req){
       if(GroupTypes::where(['group_type_id'=>$req->GroupTypeID])->delete()):
            $req->session()->flash('status', 'Group Type Deleted Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('GroupTypes');
    }
    #endregion GroupType




     #region GroupCode
     public function GroupCodes(){
        $group_types = GroupTypes::get();
        $group_codes = GroupCodes::join('group_types','group_types.group_type_id','=','group_codes.group_type_id','left')->get(['group_types.group_type','group_codes.group_code_id','group_codes.group_account','group_codes.group_code']);
        return view('Main.groupcodes', ['group_types'=>$group_types,'group_codes'=>$group_codes]);
    }


    public function AddGroupCode(Request $req){
        $validatedData = $req->validate([
            'group_account' => ['required'],
            'group_type_id' => ['required'],
        ],[
            'group_account.required'=>'Group Account Field Is Required', 
        'group_type_id.required'=>'Select A Group Type'
    ]);

        
    $group_code_type_id_count = GroupCodes::where(['group_type_id'=>$req->group_type_id])->get()->count();
        $group_codes = new GroupCodes();
        $group_codes->group_code = $req->group_type_id.'-'.sprintf('%02d',$group_code_type_id_count);
        $group_codes->group_account = $req->group_account;
        $group_codes->group_type_id = $req->group_type_id;
        if($group_codes->save()):
            $req->session()->flash('status', 'Group Code Added Successfully');
        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('GroupCodes');
    }


    public function EditGroupCode(Request $req){
        $result = GroupCodes::join('group_types','group_types.group_type_id','=','group_codes.group_type_id')->where(['group_codes.group_code_id'=>$req->GroupCodeID])->first();
        
        $group_types = GroupTypes::get();
        return view('Main.edit_groupcodes', ['group_types'=>$group_types,'result'=>$result]);

    }

    public function UpdateGroupCode(Request $req){
        $validatedData = $req->validate([
            'group_account' => ['required'],
            'group_type_id' => ['required'],
        ],[
            'group_account.required'=>'Group Account Field Is Required', 
        'group_type_id.required'=>'Select A Group Type'
    ]);

       if(GroupCodes::where(['group_code_id'=>$req->group_code_id])->update(['group_account'=>$req->group_account,'group_type_id'=>$req->group_type_id])):
            $req->session()->flash('status', 'Group Code Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;
       return redirect('GroupCodes');
   
    }

    public function DeleteGroupCode(Request $req){
       if(GroupCodes::where(['group_code_id'=>$req->GroupCodeID])->delete()):
            $req->session()->flash('status', 'Group Code Deleted Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('GroupCodes');
    }
    #endregion Group Code


    #region ControlType
    public function ControlTypes(){
        $control_types = ControlTypes::get();
        return view('Main.controltypes', ['control_types'=>$control_types]);
    }


    public function AddControlType(Request $req){
        $validatedData = $req->validate([
            'control_type' => ['required'],
        ]);
       
        $control_types = new ControlTypes();
        $control_types->control_type = $req->control_type;
        if($control_types->save()):
            $req->session()->flash('status', 'Control Type Added Successfully');

        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ControlTypes');
    }


    public function EditControlType(Request $req){
        $result = ControlTypes::where(['control_type_id'=>$req->ControlTypeID])->first();
        return view('Main.edit_controltypes', compact('result'));
    }

    public function UpdateControlType(Request $req){
        $validatedData = $req->validate([
            'control_type' => ['required'],
        ]);
       if(ControlTypes::where(['control_type_id'=>$req->control_type_id])->update(['control_type'=>$req->control_type])):
            $req->session()->flash('status', 'Control Type Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('ControlTypes');
    }

    public function DeleteControlType(Request $req){
       if(ControlTypes::where(['control_type_id'=>$req->ControlTypeID])->delete()):
            $req->session()->flash('status', 'Control Type Deleted Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('ControlTypes');
    }
    #endregion ControlType




    #region Control Code
    public function ControlCodes(){
        // SELECT control_codes.control_code_id, control_codes.control_code, control_codes.control_description, GC.group_code_id, GC.group_code, GC.group_account, CT.control_type_id, CT.control_type, control_codes.isPnL FROM `control_codes` AS control_codes 
        //LEFT JOIN control_types AS CT ON control_codes.control_type_id = CT.control_type_id 
        //LEFT JOIN group_codes AS GC ON control_codes.group_code_id = GC.group_code_id 
        //ORDER BY control_codes.control_code ASC; 
        $control_codes = ControlCodes::join('control_types AS CT','control_codes.control_type_id','=','CT.control_type_id','left')
        ->join('group_codes AS GC','control_codes.group_code_id','=','GC.group_code_id','left')->orderBy('control_codes.control_code','ASC')->get(
            ['control_codes.control_code_id',
            'control_codes.control_code',
            'control_codes.control_description',
            'CT.control_type',
            'control_codes.group_code_id',
            'GC.group_code',
            'GC.group_account',
            'control_codes.isPnL'
            ]
        );
        $group_codes = GroupCodes::get();
        $control_types = ControlTypes::get();
        return view('Main.controlcodes', ['group_codes'=>$group_codes,'control_types'=>$control_types,'control_codes'=>$control_codes]);
    }


    public function AddControlCode(Request $req){
        // echo $req->isPnL=="on"?'1':'0';
        
        $validatedData = $req->validate([
            'control_description' => ['required'],
            'group_code_id' => ['required'],
        ],[
            'control_description.required'=>'Control Description Field Is Required', 
        'group_code_id.required'=>'Select A Group Code'
    ]);

    $group_code = GroupCodes::where(['group_code_id'=>$req->group_code_id])->first();
    $control_code_control_code_count = ControlCodes::where(['group_code_id'=>$req->group_code_id])->get()->count();
    $finalControlCode = $group_code->group_code.'-'.sprintf('%02d',($control_code_control_code_count+1));
    $control_codes = new ControlCodes();
        $control_codes->control_code = $finalControlCode;
        $control_codes->control_description = $req->control_description;
        $control_codes->control_type_id = $req->control_type_id;
        $control_codes->group_code_id = $req->group_code_id;
        $control_codes->isPnL = $req->isPnL=="on"?'1':'0';

            if($control_codes->save()):
            $req->session()->flash('status', 'Control Code Added Successfully');
        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ControlCodes');
    
    }


    public function EditControlCode(Request $req){
        $result = ControlCodes::join('control_types AS CT','control_codes.control_type_id','=','CT.control_type_id','left')->join('group_codes AS GC','control_codes.group_code_id','=','GC.group_code_id','left')->where(['control_codes.control_code_id'=>$req->ControlCodeID])->first();
        $group_codes = GroupCodes::get();
        $control_types = ControlTypes::get();
        return view('Main.edit_controlcodes', ['group_codes'=>$group_codes,'control_types'=>$control_types,'result'=>$result]);
    }

    public function UpdateControlCode(Request $req){
        $validatedData = $req->validate([
            'control_description' => ['required'],
            'group_code_id' => ['required'],
        ],[
            'control_description.required'=>'Control Description Field Is Required', 
        'group_code_id.required'=>'Select A Group Code'
    ]);

       if(ControlCodes::where(['control_code_id'=>$req->control_code_id])->update(['control_description'=>$req->control_description,'control_type_id'=>$req->control_type_id,'group_code_id'=>$req->group_code_id,'isPnL'=>$req->isPnL=="on"?"1":"0"])):
            $req->session()->flash('status', 'Control Code Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;
       return redirect('ControlCodes');
   
    }

    // public function DeleteGroupCode(Request $req){
    //    if(GroupCodes::where(['group_code_id'=>$req->GroupCodeID])->delete()):
    //         $req->session()->flash('status', 'Group Code Deleted Successfully');
    //    else:
    //         $req->session()->flash('status', 'Some Error Occured');
    //    endif;

    //    return redirect('GroupCodes');
    // }
    #endregion Control Code


     #region ProjectCategory
     public function ProjectCategories(){
        $project_categories = ProjectCategories::get();
        return view('Main.projectcategories', ['project_categories'=>$project_categories]);
    }


    public function AddProjectCategory(Request $req){
        $validatedData = $req->validate([
            'project_category' => ['required'],
        ]);
       
        $project_categories = new ProjectCategories();
        $project_categories->project_category = $req->project_category;
        if($project_categories->save()):
            $req->session()->flash('status', 'Project Category Added Successfully');

        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ProjectCategories');
    }


    public function EditProjectCategory(Request $req){
        $result = ProjectCategories::where(['project_category_id'=>$req->ProjectCategoryID])->first();
        return view('Main.edit_projectcategories', compact('result'));
    }

    public function UpdateProjectCategory(Request $req){
        $validatedData = $req->validate([
            'project_category' => ['required'],
        ]);
       if(ProjectCategories::where(['project_category_id'=>$req->project_category_id])->update(['project_category'=>$req->project_category])):
            $req->session()->flash('status', 'Project Category Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('ProjectCategories');
    }

    public function DeleteProjectCategory(Request $req){
        $projects = Projects::where(['project_category_id'=>$req->ProjectCategoryID])->get();
        
        if(count($projects)==0):
            if(ProjectCategories::where(['project_category_id'=>$req->ProjectCategoryID])->delete()):
                $req->session()->flash('status', 'Project Category Deleted Successfully');
           else:
                $req->session()->flash('status', 'Some Error Occured');
           endif;

        else:
            $req->session()->flash('status', 'You cannot delete this project category. Some projects are associated with this category.');
        endif;
      

       return redirect('ProjectCategories');
    }
    #endregion ProjectCategory
    
    

    #region Project
     public function Projects(){
        $project_categories = ProjectCategories::get();
        $projects = Projects::join('project_categories','project_categories.project_category_id','=','projects.project_category_id','left')->get(['project_categories.project_category','projects.project_id','projects.project_name']);
        return view('Main.projects', ['project_categories'=>$project_categories,'projects'=>$projects]);
    }


    public function AddProject(Request $req){
        $validatedData = $req->validate([
            'project_name' => ['required'],
            'project_category_id' => ['required'],
        ],[
            'project_name.required'=>'Project Name Field Is Required', 
        'project_category_id.required'=>'Select A Project Category'
    ]);

        
 
        $projects = new Projects();
        $projects->project_name = $req->project_name;
        $projects->project_category_id = $req->project_category_id;
        if($projects->save()):
            $req->session()->flash('status', 'Project Added Successfully');
        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Projects');
    }


    public function EditProject(Request $req){
        $result = Projects::join('project_categories','project_categories.project_category_id','=','projects.project_category_id')->where(['projects.project_id'=>$req->ProjectID])->first();
        
        $project_categories = ProjectCategories::get();
        return view('Main.edit_projects', ['project_categories'=>$project_categories,'result'=>$result]);

    }

    public function UpdateProject(Request $req){
        $validatedData = $req->validate([
            'project_name' => ['required'],
            'project_category_id' => ['required'],
        ],[
            'project_name.required'=>'Project Name Field Is Required', 
        'project_category_id.required'=>'Select A Project Category'
    ]);

       if(Projects::where(['project_id'=>$req->project_id])->update(['project_name'=>$req->project_name,'project_category_id'=>$req->project_category_id])):
            $req->session()->flash('status', 'Project Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;
       return redirect('Projects');
   
    }

    public function DeleteProject(Request $req){
       if(Projects::where(['project_id'=>$req->ProjectID])->delete()):
            $req->session()->flash('status', 'Project Deleted Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('Projects');
    }
    #endregion Project







    #region ROLES
    public function Roles(){
        $roles = Roles::get();
        return view('Main.roles', ['roles'=>$roles]);
    }


    public function AddRole(Request $req){
        $validatedData = $req->validate([
            'role_name' => ['required'],
        ]);
       
        $roles = new Roles();
        $roles->role_name = $req->role_name;
        if($roles->save()):
            $req->session()->flash('status', 'Role Added Successfully');

        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Roles');
    }


    public function EditRole(Request $req){
        $result = Roles::where(['role_id'=>$req->RoleID])->first();
        return view('Main.edit_roles', compact('result'));
    }

    public function UpdateRole(Request $req){
        $validatedData = $req->validate([
            'role_name' => ['required'],
        ]);
       if(Roles::where(['role_id'=>$req->role_id])->update(['role_name'=>$req->role_name])):
            $req->session()->flash('status', 'Role Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('Roles');
    }

    public function DeleteRole(Request $req){
       if(Roles::where(['role_id'=>$req->RoleID])->delete()):
            $req->session()->flash('status', 'Role Deleted Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('Roles');
    }
    #endregion ROLES



    #region USERS
    public function Users(){
        $roles = Roles::get();
        $projects = Projects::get();
        $users = Users::join('roles as R','users.role_id','=','R.role_id','left')->join('projects as P','users.project_id','=','P.project_id','left')->get(['users.user_id','users.user_name','users.role_id','users.project_id','R.role_name','P.project_name']);
        return view('Main.users', ['roles'=>$roles,'projects'=>$projects,'users'=>$users]);
    }


    public function AddUser(Request $req){
        $validatedData = $req->validate([
            'user_name' => ['required'],
            'password' => ['required'],
            'project_id' => ['required'],
            'role_id' => ['required']
        ]);

        $users = new Users();
        $users->user_name = $req->user_name;
        $users->password = Hash::make($req->password);
        $users->role_id = $req->role_id;
        $users->project_id = $req->project_id;
       
        if($users->save()):
            $req->session()->flash('status', 'User Added Successfully');

        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Users');
    }


    public function EditUser(Request $req){
        $roles = Roles::get();
        $projects = Projects::get();
        $result = Users::where(['user_id'=>$req->UserID])->first();
        return view('Main.edit_users', ['roles'=>$roles,'projects'=>$projects,'result'=>$result]);
    }

    public function UpdateUser(Request $req){
        $validatedData = $req->validate([
            'user_name' => ['required'],
            'project_id' => ['required'],
            'role_id' => ['required']
        ]);

       if(Users::where(['user_id'=>$req->user_id])->update(['user_name'=>$req->user_name,'role_id'=>$req->role_id,'project_id'=>$req->project_id])):
            $req->session()->flash('status', 'User Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('Users');
    }

    public function DeleteUser(Request $req){
       if(Users::where(['user_id'=>$req->UserID])->delete()):
            $req->session()->flash('status', 'Role Deleted Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('Users');
    }
    #endregion USERS


    #region GET CONTROL CODES

    public function GetControlCodesByGroupCodeID(Request $req){
        $result = ControlCodes::where(['group_code_id'=>$req->GroupCodeID])->get();
        return response()->json($result);
    }

    #endregion

    #region CHART OF ACCOUNTS
    public function ChartOfAccounts(){
        $group_codes = GroupCodes::get();
        $chart_of_accounts = ChartOfAccounts::join('control_codes AS CC','CC.control_code_id','chart_of_accounts.control_code_id','left')->join('group_codes AS GC','GC.group_code_id','=','CC.group_code_id','left')->get(['chart_of_accounts.chart_of_account_id','GC.group_code','GC.group_account','CC.control_code','CC.control_description','chart_of_accounts.chart_of_account_code','chart_of_accounts.chart_of_account','chart_of_accounts.opening_balance_debit','chart_of_accounts.opening_balance_credit']);

        return view('Main.chartofaccounts',['group_codes'=>$group_codes,'chart_of_accounts'=>$chart_of_accounts]);
    }


    public function AddChartOfAccount(Request $req){
        $validatedData = $req->validate([
            'chart_of_account' => ['required'],
            'group_code_id' => ['required'],
            'control_code_id' => ['required'],
        ]);

        $chart_of_accounts = new ChartOfAccounts();

        $control_code = ControlCodes::where(['control_code_id'=>$req->control_code_id])->first(['control_code']);
        

        $control_code_group_code_count = ChartOfAccounts::join('control_codes AS CC','CC.control_code_id','=','chart_of_accounts.control_code_id','left')->where(['CC.control_code'=>$control_code->control_code])->get()->count();


        $chart_of_accounts->chart_of_account_code = $control_code->control_code.'-'.sprintf('%04d',$control_code_group_code_count);
        $chart_of_accounts->chart_of_account = $req->chart_of_account;
        $chart_of_accounts->control_code_id = $req->control_code_id;
        $chart_of_accounts->opening_balance_debit = $req->opening_balance_debit;
        $chart_of_accounts->opening_balance_credit = $req->opening_balance_credit;

        if($chart_of_accounts->save()):
            $req->session()->flash('status', 'Chart Of Account Added Successfully');

        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ChartOfAccounts');
    }


    public function EditChartOfAccount(Request $req){

        $group_codes = GroupCodes::get();
        $result = ChartOfAccounts::where(['chart_of_account_id'=>$req->ChartOfAccountID])->join('control_codes AS CC','CC.control_code_id','chart_of_accounts.control_code_id','left')->join('group_codes AS GC','GC.group_code_id','=','CC.group_code_id','left')->first(['chart_of_accounts.chart_of_account_id','GC.group_code_id','CC.control_code_id','chart_of_accounts.chart_of_account','chart_of_accounts.opening_balance_debit','chart_of_accounts.opening_balance_credit']);
        return view('Main.edit_chartofaccounts',['group_codes'=>$group_codes,'result'=>$result]);
    }


    public function UpdateChartOfAccount(Request $req){
        $validatedData = $req->validate([
            'chart_of_account' => ['required'],
            'group_code_id' => ['required'],
            'control_code_id' => ['required'],
        ]);
       if(ChartOfAccounts::where(['chart_of_account_id'=>$req->chart_of_account_id])->update(['chart_of_account'=>$req->chart_of_account,'control_code_id'=>$req->control_code_id,'opening_balance_debit'=>$req->opening_balance_debit,'opening_balance_credit'=>$req->opening_balance_credit])):
            $req->session()->flash('status', 'Chart Of Account Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;
       return redirect('ChartOfAccounts');
   
    }

    #endregion




    #region  USERS CATEGORIES
    public function UserCategories(){
        $user_categories = UserCategories::get();
        return view('Main.usercategories', ['user_categories'=>$user_categories]);
    }


    public function AddUserCategory(Request $req){
        $validatedData = $req->validate([
            'user_category_code' => ['required'],
            'user_category_name' => ['required'],
        ]);
       
        $user_categories = new UserCategories();
        $user_categories->user_category_code = $req->user_category_code;
        $user_categories->user_category_name = $req->user_category_name;
        $user_categories->login_date_from = $req->login_date_from;
        $user_categories->login_date_to = $req->login_date_to;
        if($user_categories->save()):
            $req->session()->flash('status', 'User Category Added Successfully');

        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('UserCategories');
    }


    public function EditUserCategory(Request $req){
        $result = UserCategories::where(['user_category_id'=>$req->UserCategoryID])->first();
        return view('Main.edit_usercategories', compact('result'));
    }

    public function UpdateUserCategory(Request $req){
        $validatedData = $req->validate([
            'user_category_code' => ['required'],
            'user_category_name' => ['required'],
        ]);

        $DataToUpdate = [
            'user_category_code'=>$req->user_category_code,
            'user_category_name'=>$req->user_category_name,
            'login_date_from'=>$req->login_date_from,
            'login_date_to'=>$req->login_date_to,
        ];
       if(UserCategories::where(['user_category_id'=>$req->user_category_id])->update($DataToUpdate)):
            $req->session()->flash('status', 'User Category Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('UserCategories');
    }

    // public function DeleteGroupType(Request $req){
    //    if(GroupTypes::where(['group_type_id'=>$req->GroupTypeID])->delete()):
    //         $req->session()->flash('status', 'Group Type Deleted Successfully');
    //    else:
    //         $req->session()->flash('status', 'Some Error Occured');
    //    endif;

    //    return redirect('GroupTypes');
    // }
    #endregion USERS CATEGORIES


     #region  SUPPLIERS
     public function Suppliers(){
        $chart_of_accounts = ChartOfAccounts::get();
        $suppliers = Suppliers::join('chart_of_accounts AS COA','COA.chart_of_account_id','=','suppliers.chart_of_account_id','left')->get();
        return view('Main.suppliers',['chart_of_accounts'=>$chart_of_accounts,'suppliers'=>$suppliers]);
    }


    public function AddSupplier(Request $req){
        $validatedData = $req->validate([
            'supplier_code' => ['required'],
            'supplier_name' => ['required'],
            'contact_no' => ['required'],
            'email_address' => ['required'],
        ]);
       
        $suppliers = new Suppliers();
        $suppliers->supplier_code = $req->supplier_code;
        $suppliers->supplier_name = $req->supplier_name;
        $suppliers->poc_name = $req->poc_name;
        $suppliers->address = $req->address;
        $suppliers->contact_no = $req->contact_no;
        $suppliers->email_address = $req->email_address;
        $suppliers->website = $req->website;
        $suppliers->account_code = $req->account_code;
        $suppliers->chart_of_account_id = $req->chart_of_account_id;
        if($suppliers->save()):
            $req->session()->flash('status', 'Supplier Added Successfully');

        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Suppliers');
    }


    public function EditSupplier(Request $req){
        $chart_of_accounts = ChartOfAccounts::get();
        $result = Suppliers::where(['supplier_id'=>$req->SupplierID])->first();
        return view('Main.edit_suppliers', ['chart_of_accounts'=>$chart_of_accounts,'result'=>$result]);
    }

    public function UpdateSupplier(Request $req){
        $validatedData = $req->validate([
            'supplier_code' => ['required'],
            'supplier_name' => ['required'],
            'contact_no' => ['required'],
            'email_address' => ['required'],
        ]);
       
        $suppliers = array();
        $suppliers['supplier_code'] = $req->supplier_code;
        $suppliers['supplier_name'] = $req->supplier_name;
        $suppliers['poc_name'] = $req->poc_name;
        $suppliers['address'] = $req->address;
        $suppliers['contact_no'] = $req->contact_no;
        $suppliers['email_address'] = $req->email_address;
        $suppliers['website'] = $req->website;
        $suppliers['account_code'] = $req->account_code;
        $suppliers['chart_of_account_id'] = $req->chart_of_account_id;


       if(Suppliers::where(['supplier_id'=>$req->supplier_id])->update($suppliers)):
            $req->session()->flash('status', 'Supplier Update Successfully');
       else:
            $req->session()->flash('status', 'Some Error Occured');
       endif;

       return redirect('Suppliers');
    }

    // public function DeleteGroupType(Request $req){
    //    if(GroupTypes::where(['group_type_id'=>$req->GroupTypeID])->delete()):
    //         $req->session()->flash('status', 'Group Type Deleted Successfully');
    //    else:
    //         $req->session()->flash('status', 'Some Error Occured');
    //    endif;

    //    return redirect('GroupTypes');
    // }
    #endregion SUPPLIERS


     #region  CUSTOMERS
     public function Customers(){
        // $group_types = GroupTypes::get();
        return view('Main.customers');
    }


    // public function AddGroupType(Request $req){
    //     $validatedData = $req->validate([
    //         'group_type' => ['required'],
    //     ]);
       
    //     $group_types = new GroupTypes();
    //     $group_types->group_type = $req->group_type;
    //     if($group_types->save()):
    //         $req->session()->flash('status', 'Group Type Added Successfully');

    //     else:
    //         $req->session()->flash('status', 'Some Error Occured');
    //     endif;

    //     return redirect('GroupTypes');
    // }


    // public function EditGroupType(Request $req){
    //     $result = GroupTypes::where(['group_type_id'=>$req->GroupTypeID])->first();
    //     return view('Main.edit_grouptypes', compact('result'));
    // }

    // public function UpdateGroupType(Request $req){
    //     $validatedData = $req->validate([
    //         'group_type' => ['required'],
    //     ]);
    //    if(GroupTypes::where(['group_type_id'=>$req->group_type_id])->update(['group_type'=>$req->group_type])):
    //         $req->session()->flash('status', 'Group Type Update Successfully');
    //    else:
    //         $req->session()->flash('status', 'Some Error Occured');
    //    endif;

    //    return redirect('GroupTypes');
    // }

    // public function DeleteGroupType(Request $req){
    //    if(GroupTypes::where(['group_type_id'=>$req->GroupTypeID])->delete()):
    //         $req->session()->flash('status', 'Group Type Deleted Successfully');
    //    else:
    //         $req->session()->flash('status', 'Some Error Occured');
    //    endif;

    //    return redirect('GroupTypes');
    // }
    #endregion CUSTOMERS


}
