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
use App\Models\Customers;
use App\Models\Pages;
use App\Models\Rights;
use App\Models\RightsMapping;
use App\Models\UserRolePageMapping;
use App\Models\UserProjectMapping;
use Illuminate\Support\Facades\Hash;



class MainController extends Controller
{
    #region DASHBOARD
    public function Dashboard($project_id = null)
    {
        if ($project_id == null) {
            $project_categories = ProjectCategories::get();
            return view('Main.admindashboard', ['project_categories' => $project_categories]);
        } else {
            $result = Projects::where(['project_id' => $project_id])->first();
            return view('Main.projectdashboard', ['result' => $result]);
        }
    }

    #endregion


    #region GroupType
    public function GroupTypes()
    {
        $group_types = GroupTypes::get();
        return view('Main.grouptypes', ['group_types' => $group_types]);
    }


    public function AddGroupType(Request $req)
    {
        $validatedData = $req->validate([
            'group_type' => ['required'],
        ]);

        $group_types = new GroupTypes();
        $group_types->group_type = $req->group_type;
        if ($group_types->save()) :
            $req->session()->flash('status', 'Group Type Added Successfully');

        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('GroupTypes');
    }


    public function EditGroupType(Request $req)
    {
        $result = GroupTypes::where(['group_type_id' => $req->GroupTypeID])->first();
        return view('Main.edit_grouptypes', compact('result'));
    }

    public function UpdateGroupType(Request $req)
    {
        $validatedData = $req->validate([
            'group_type' => ['required'],
        ]);
        if (GroupTypes::where(['group_type_id' => $req->group_type_id])->update(['group_type' => $req->group_type])) :
            $req->session()->flash('status', 'Group Type Update Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('GroupTypes');
    }

    public function DeleteGroupType(Request $req)
    {
        if (GroupTypes::where(['group_type_id' => $req->GroupTypeID])->delete()) :
            $req->session()->flash('status', 'Group Type Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('GroupTypes');
    }
    #endregion GroupType




    #region GroupCode
    public function GroupCodes()
    {
        $group_types = GroupTypes::get();
        $group_codes = GroupCodes::join('group_types', 'group_types.group_type_id', '=', 'group_codes.group_type_id', 'left')->get(['group_types.group_type', 'group_codes.group_code_id', 'group_codes.group_account', 'group_codes.group_code']);
        return view('Main.groupcodes', ['group_types' => $group_types, 'group_codes' => $group_codes]);
    }


    public function AddGroupCode(Request $req)
    {
        $validatedData = $req->validate([
            'group_code' => ['required'],
            'group_account' => ['required'],
            'group_type_id' => ['required'],
        ], [
            'group_code.required' => 'Group Code Field Is Required',
            'group_account.required' => 'Group Account Field Is Required',
            'group_type_id.required' => 'Select A Group Type'
        ]);


        $group_codes = new GroupCodes();
        $group_codes->group_code = $req->group_code;
        $group_codes->group_account = $req->group_account;
        $group_codes->group_type_id = $req->group_type_id;
        if ($group_codes->save()) :
            $req->session()->flash('status', 'Group Code Added Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('GroupCodes');
    }


    public function EditGroupCode(Request $req)
    {
        $result = GroupCodes::join('group_types', 'group_types.group_type_id', '=', 'group_codes.group_type_id')->where(['group_codes.group_code_id' => $req->GroupCodeID])->first();

        $group_types = GroupTypes::get();
        return view('Main.edit_groupcodes', ['group_types' => $group_types, 'result' => $result]);
    }

    public function UpdateGroupCode(Request $req)
    {
        $validatedData = $req->validate([
            'group_code' => ['required'],
            'group_account' => ['required'],
            'group_type_id' => ['required'],
        ], [
            'group_code.required' => 'Group Code Field Is Required',
            'group_account.required' => 'Group Account Field Is Required',
            'group_type_id.required' => 'Select A Group Type'
        ]);

        if (GroupCodes::where(['group_code_id' => $req->group_code_id])->update(['group_code' => $req->group_code, 'group_account' => $req->group_account, 'group_type_id' => $req->group_type_id])) :
            $req->session()->flash('status', 'Group Code Update Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;
        return redirect('GroupCodes');
    }

    public function DeleteGroupCode(Request $req)
    {
        if (GroupCodes::where(['group_code_id' => $req->GroupCodeID])->delete()) :
            $req->session()->flash('status', 'Group Code Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('GroupCodes');
    }
    #endregion Group Code


    #region ControlType
    public function ControlTypes()
    {
        $control_types = ControlTypes::get();
        return view('Main.controltypes', ['control_types' => $control_types]);
    }


    public function AddControlType(Request $req)
    {
        $validatedData = $req->validate([
            'control_type' => ['required'],
        ]);

        $control_types = new ControlTypes();
        $control_types->control_type = $req->control_type;
        if ($control_types->save()) :
            $req->session()->flash('status', 'Control Type Added Successfully');

        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ControlTypes');
    }


    public function EditControlType(Request $req)
    {
        $result = ControlTypes::where(['control_type_id' => $req->ControlTypeID])->first();
        return view('Main.edit_controltypes', compact('result'));
    }

    public function UpdateControlType(Request $req)
    {
        $validatedData = $req->validate([
            'control_type' => ['required'],
        ]);
        if (ControlTypes::where(['control_type_id' => $req->control_type_id])->update(['control_type' => $req->control_type])) :
            $req->session()->flash('status', 'Control Type Update Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ControlTypes');
    }

    public function DeleteControlType(Request $req)
    {
        if (ControlTypes::where(['control_type_id' => $req->ControlTypeID])->delete()) :
            $req->session()->flash('status', 'Control Type Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ControlTypes');
    }
    #endregion ControlType




    #region Control Code
    public function ControlCodes()
    {
        // SELECT control_codes.control_code_id, control_codes.control_code, control_codes.control_description, GC.group_code_id, GC.group_code, GC.group_account, CT.control_type_id, CT.control_type, control_codes.isPnL FROM `control_codes` AS control_codes 
        //LEFT JOIN control_types AS CT ON control_codes.control_type_id = CT.control_type_id 
        //LEFT JOIN group_codes AS GC ON control_codes.group_code_id = GC.group_code_id 
        //ORDER BY control_codes.control_code ASC; 
        $control_codes = ControlCodes::join('control_types AS CT', 'control_codes.control_type_id', '=', 'CT.control_type_id', 'left')
            ->join('group_codes AS GC', 'control_codes.group_code_id', '=', 'GC.group_code_id', 'left')->orderBy('control_codes.control_code', 'ASC')->get(
                [
                    'control_codes.control_code_id',
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
        return view('Main.controlcodes', ['group_codes' => $group_codes, 'control_types' => $control_types, 'control_codes' => $control_codes]);
    }


    public function AddControlCode(Request $req)
    {
        // echo $req->isPnL=="on"?'1':'0';

        $validatedData = $req->validate([
            'control_code' => ['required'],
            'control_description' => ['required'],
            'group_code_id' => ['required'],
        ], [
            'control_code.required' => 'Control Code Field Is Required',
            'control_description.required' => 'Control Description Field Is Required',
            'group_code_id.required' => 'Select A Group Code'
        ]);

        $control_codes = new ControlCodes();
        $control_codes->control_code = $req->control_code;
        $control_codes->control_description = $req->control_description;
        $control_codes->control_type_id = $req->control_type_id;
        $control_codes->group_code_id = $req->group_code_id;
        $control_codes->isPnL = $req->isPnL == "on" ? '1' : '0';

        if ($control_codes->save()) :
            $req->session()->flash('status', 'Control Code Added Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ControlCodes');
    }


    public function EditControlCode(Request $req)
    {
        $result = ControlCodes::join('control_types AS CT', 'control_codes.control_type_id', '=', 'CT.control_type_id', 'left')->join('group_codes AS GC', 'control_codes.group_code_id', '=', 'GC.group_code_id', 'left')->where(['control_codes.control_code_id' => $req->ControlCodeID])->first();
        $group_codes = GroupCodes::get();
        $control_types = ControlTypes::get();
        return view('Main.edit_controlcodes', ['group_codes' => $group_codes, 'control_types' => $control_types, 'result' => $result]);
    }

    public function UpdateControlCode(Request $req)
    {
        $validatedData = $req->validate([
            'control_code' => ['required'],
            'control_description' => ['required'],
            'group_code_id' => ['required'],
        ], [
            'control_code.required' => 'Control Code Field Is Required',
            'control_description.required' => 'Control Description Field Is Required',
            'group_code_id.required' => 'Select A Group Code'
        ]);

        if (ControlCodes::where(['control_code_id' => $req->control_code_id])->update(['control_code' => $req->control_code, 'control_description' => $req->control_description, 'control_type_id' => $req->control_type_id, 'group_code_id' => $req->group_code_id, 'isPnL' => $req->isPnL == "on" ? "1" : "0"])) :
            $req->session()->flash('status', 'Control Code Update Successfully');
        else :
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
    public function ProjectCategories()
    {
        $project_categories = ProjectCategories::get();
        return view('Main.projectcategories', ['project_categories' => $project_categories]);
    }


    public function AddProjectCategory(Request $req)
    {
        $validatedData = $req->validate([
            'project_category' => ['required'],
        ]);

        $project_categories = new ProjectCategories();
        $project_categories->project_category = $req->project_category;
        if ($project_categories->save()) :
            $req->session()->flash('status', 'Project Category Added Successfully');

        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ProjectCategories');
    }


    public function EditProjectCategory(Request $req)
    {
        $result = ProjectCategories::where(['project_category_id' => $req->ProjectCategoryID])->first();
        return view('Main.edit_projectcategories', compact('result'));
    }

    public function UpdateProjectCategory(Request $req)
    {
        $validatedData = $req->validate([
            'project_category' => ['required'],
        ]);
        if (ProjectCategories::where(['project_category_id' => $req->project_category_id])->update(['project_category' => $req->project_category])) :
            $req->session()->flash('status', 'Project Category Update Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ProjectCategories');
    }

    public function DeleteProjectCategory(Request $req)
    {
        $projects = Projects::where(['project_category_id' => $req->ProjectCategoryID])->get();

        if (count($projects) == 0) :
            if (ProjectCategories::where(['project_category_id' => $req->ProjectCategoryID])->delete()) :
                $req->session()->flash('status', 'Project Category Deleted Successfully');
            else :
                $req->session()->flash('status', 'Some Error Occured');
            endif;

        else :
            $req->session()->flash('status', 'You cannot delete this project category. Some projects are associated with this category.');
        endif;


        return redirect('ProjectCategories');
    }
    #endregion ProjectCategory



    #region Project
    public function Projects()
    {
        $project_categories = ProjectCategories::get();
        $projects = Projects::join('project_categories', 'project_categories.project_category_id', '=', 'projects.project_category_id', 'left')->get(['project_categories.project_category', 'projects.project_id', 'projects.project_name']);
        return view('Main.projects', ['project_categories' => $project_categories, 'projects' => $projects]);
    }


    public function AddProject(Request $req)
    {
        $validatedData = $req->validate([
            'project_name' => ['required'],
            'project_category_id' => ['required'],
        ], [
            'project_name.required' => 'Project Name Field Is Required',
            'project_category_id.required' => 'Select A Project Category'
        ]);



        $projects = new Projects();
        $projects->project_name = $req->project_name;
        $projects->project_category_id = $req->project_category_id;
        if ($projects->save()) :
            $req->session()->flash('status', 'Project Added Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Projects');
    }


    public function EditProject(Request $req)
    {
        $result = Projects::join('project_categories', 'project_categories.project_category_id', '=', 'projects.project_category_id')->where(['projects.project_id' => $req->ProjectID])->first();

        $project_categories = ProjectCategories::get();
        return view('Main.edit_projects', ['project_categories' => $project_categories, 'result' => $result]);
    }

    public function UpdateProject(Request $req)
    {
        $validatedData = $req->validate([
            'project_name' => ['required'],
            'project_category_id' => ['required'],
        ], [
            'project_name.required' => 'Project Name Field Is Required',
            'project_category_id.required' => 'Select A Project Category'
        ]);

        if (Projects::where(['project_id' => $req->project_id])->update(['project_name' => $req->project_name, 'project_category_id' => $req->project_category_id])) :
            $req->session()->flash('status', 'Project Update Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;
        return redirect('Projects');
    }

    public function DeleteProject(Request $req)
    {
        if (Projects::where(['project_id' => $req->ProjectID])->delete()) :
            $req->session()->flash('status', 'Project Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Projects');
    }
    #endregion Project







    #region ROLES
    public function Roles()
    {
        $roles = Roles::join('rights_mapping AS RM', 'roles.role_id', '=', 'RM.role_id', 'left')->join('rights AS RI', 'RI.right_id', '=', 'RM.right_id', 'left')->get(['roles.role_id', 'roles.role_name', 'RI.right_id', 'RI.right_name', 'RM.has_right']);

        $rights = Rights::get();


        $mydata = array();
        foreach ($roles as $key => $item) :
            $mydata[$key]['role_id'] = $item->role_id;
            $mydata[$key]['role_name'] = $item->role_name;
            $mydata[$key]['right_id'] = $item->right_id;
            $mydata[$key]['right_name'] = $item->right_name;
            $mydata[$key]['has_right'] = $item->has_right;
        endforeach;


        $uniqueRoles = array();

        foreach ($mydata as $key => $item) :
            $dataSubjectsValue = array_column($uniqueRoles, 'role_id');
            if (!in_array($item['role_id'], $dataSubjectsValue)) :
                $datatopush['role_id'] = $item['role_id'];
                $datatopush['role_name'] = $item['role_name'];
                $datatopush['rights'] = array();
                // $datatopush['rights']['right_name'] = $item['right_name'];
                // $datatopush['rights']['has_right'] = $item['has_right'];
                array_push($uniqueRoles, $datatopush);
            endif;
        endforeach;


        foreach ($uniqueRoles as $key => $uniqueroleitem) :
            foreach ($mydata as $key2 => $roleitem) :

                if ($roleitem['role_id'] == $uniqueroleitem['role_id']) :
                    array_push($uniqueRoles[$key]['rights'], $roleitem);
                endif;
            endforeach;
        endforeach;
        // foreach ($mynewdata as $key => $item) :
        //     foreach ($mydata as $key2 => $item2) :
        //         if (($item['role_id'] == $item2['role_id']) && $item2['right_id'] != "") :
        //             array_push($mynewdata[$key]['rights'], $item2['right_id']);
        //         endif;
        //     endforeach;
        // endforeach;

        $data['roles'] = $uniqueRoles;
        $data['rights'] = Rights::get();

        return view('Main.roles', $data);
    }


    public function AddRole(Request $req)
    {
        $validatedData = $req->validate([
            'role_name' => ['required'],
        ]);

        $rights = Rights::get();

        $roles = new Roles();
        $roles->role_name = $req->role_name;


        if ($roles->save()) :
            $role_id = $roles->id;
            if (!empty($req->right_id)) :
                if (count($req->right_id) > 0) :
                    $datatoadd = array();
                    // for ($i = 0; $i < count($req->right_id); $i++) :
                    //     $datatoadd[$i]['right_id'] = $req->right_id[$i];
                    //     $datatoadd[$i]['role_id'] = $role_id;
                    // endfor;
                    foreach ($rights as $key => $item) :
                        $datatoadd[$key]['right_id'] = $item->right_id;
                        $datatoadd[$key]['role_id'] = $role_id;
                        $datatoadd[$key]['has_right'] = "0";
                        if (in_array($item->right_id, $req->right_id)) :
                            $datatoadd[$key]['has_right'] = "1";
                        endif;
                    endforeach;
                    RightsMapping::upsert($datatoadd, ['right_id', 'role_id']);
                endif;
            endif;
            $req->session()->flash('status', 'Role Added Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Roles');
    }


    public function EditRole(Request $req)
    {
        // SELECT R.role_id, R.role_name, RI.right_id, RI.right_name FROM roles AS R LEFT JOIN rights_mapping AS RM ON R.role_id = RM.role_id LEFT JOIN rights AS RI ON RI.right_id = RM.right_id; 

        $data['rightmapping'] = RightsMapping::join('rights AS RI', 'rights_mapping.right_id', '=', 'RI.right_id', 'left')->where(['rights_mapping.role_id' => $req->RoleID])->get();
        $data['result'] = Roles::where(['role_id' => $req->RoleID])->first();

        return view('Main.edit_roles', $data);
    }

    public function UpdateRole(Request $req)
    {
        // $validatedData = $req->validate([
        //     'role_name' => ['required'],
        // ]);
        $role_id = $req->role_id;
        if (Roles::where(['role_id' => $role_id])->update(['role_name' => $req->role_name])) :
            if (RightsMapping::where(['role_id' => $role_id])->update(['has_right' => "0"])) :

                if (!empty($req->right_id)) :

                    if (count($req->right_id) > 0) :
                        $datatoupdate = array();
                        foreach ($req->right_id as $key => $item) :
                            $datatoupdate[] = $item;
                        endforeach;
                        RightsMapping::whereIn("rights_mapping_id", $datatoupdate)->update(['has_right' => "1"]);
                    endif;
                endif;
                $req->session()->flash('status', 'Role Update Successfully');
            endif;
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Roles');
    }

    public function DeleteRole(Request $req)
    {
        if (Roles::where(['role_id' => $req->RoleID])->delete()) :
            $req->session()->flash('status', 'Role Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Roles');
    }
    #endregion ROLES



    #region USERS
    public function Users()
    {
        $roles = Roles::get();
        $project_categories = ProjectCategories::get();
        $projects = Projects::get();
        $pages = Pages::get();

        $users = Users::get(['users.user_id', 'users.full_name', 'users.user_name', 'users.email', 'users.cell', 'users.is_block', 'users.can_change_year']);
        // var_dump($users);
        return view('Main.users', ['users' => $users, 'roles' => $roles, 'pages' => $pages, 'project_categories' => $project_categories]);
    }


    public function AddUser(Request $req)
    {

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $validatedData = $req->validate([
            'user_name' => ['required'],
            'user_type' => ['required'],
            'password' => ['required'],
            'project_id' => ['required'],
            // 'role_id' => ['required']
        ]);
        $users = new Users();
        $users->full_name = $req->full_name;
        $users->user_name = $req->user_name;
        $users->password = Hash::make($req->password);
        $users->email = $req->email;
        $users->cell = $req->cell;
        $users->is_block = $req->is_block == "on" ? 1 : 0;
        $users->can_change_year = $req->can_change_year == "on" ? 1 : 0;
        $users->is_admin = $req->user_type == "Administrator" ? 1 : 0;


        if ($users->save()) :
            $user_id = $users->id;
            $user_project_mapping = new UserProjectMapping();
            $user_project_mapping->user_id = $user_id;
            $user_project_mapping->project_id = $req->project_id;
            $user_project_mapping->save();

            if ($req->user_type == "User") :
                $pages = Pages::get();

                $datatoadd = array();

                foreach ($pages as $key => $item) :
                    $datatoadd[$key]['page_id'] = $item->page_id;
                    $datatoadd[$key]['user_id'] = $user_id;
                    $datatoadd[$key]['has_access'] = "0";
                    $datatoadd[$key]['role_id'] = null;

                    $mykey = array_search($item->page_id, array_map(function ($v) {
                        return $v['page_id'];
                    }, $req->user_role_page_mapping));
                    if ($mykey != "") :
                        $selectedroleid = $req->user_role_page_mapping[$mykey]['role_id'];
                        $datatoadd[$key]['role_id'] = $selectedroleid;
                        $datatoadd[$key]['has_access'] = "1";
                    endif;
                endforeach;
                UserRolePageMapping::upsert($datatoadd, ['page_id', 'user_id', 'has_access', 'role_id']);
            endif;
            $req->session()->flash('status', 'User Added Successfully');

        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Users');
    }


    public function EditUser(Request $req)
    {
        $roles = Roles::get();
        $projects = Projects::get();
        $pages = Pages::get();
        $user_categories = UserCategories::get();
        $user_role_page_mapping = UserRolePageMapping::where(['user_id' => $req->UserID])->get();
        $result = Users::where(['user_id' => $req->UserID])->first();
        return view('Main.edit_users', ['result' => $result, 'roles' => $roles, 'projects' => $projects, 'pages' => $pages, 'user_categories' => $user_categories, 'user_role_page_mapping' => $user_role_page_mapping]);
    }

    public function UpdateUser(Request $req)
    {
        // $validatedData = $req->validate([
        //     'user_name' => ['required'],
        //     'project_id' => ['required'],
        //     'role_id' => ['required']
        // ]);


        $DataToUpdate = [
            'full_name' => $req->full_name,
            'user_name' => $req->user_name,
            'email' => $req->email,
            'cell' => $req->cell,
            'block_yn' => $req->block_yn,
            'can_change_year' => $req->can_change_year,
        ];
        if (Users::where(['user_id' => $req->user_id])->update($DataToUpdate)) :
            foreach ($req->user_role_page_mapping as $key => $item) :
                $user_role_page_mapping_id = $item['user_role_page_mapping_id'];
                if (array_key_exists('page_id', $item)) :
                    $MappingDataToUpdate = [
                        'role_id' => $item['role_id'],
                        'page_id' => $item['page_id'],
                        'has_access' => "1"
                    ];
                else :
                    $MappingDataToUpdate = [
                        'role_id' => null,
                        'has_access' => "0"
                    ];
                endif;

                UserRolePageMapping::where(['user_role_page_mapping_id' => $user_role_page_mapping_id])->update($MappingDataToUpdate);

            endforeach;
            $req->session()->flash('status', 'User Update Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Users');
    }

    public function DeleteUser(Request $req)
    {
        if (Users::where(['user_id' => $req->UserID])->delete()) :
            $req->session()->flash('status', 'Role Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Users');
    }
    #endregion USERS


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

    #region CHART OF ACCOUNTS
    public function ChartOfAccounts()
    {
        $group_codes = GroupCodes::get();
        $projects = Projects::get();
        $chart_of_accounts = ChartOfAccounts::join('control_codes AS CC', 'CC.control_code_id', 'chart_of_accounts.control_code_id', 'left')->join('group_codes AS GC', 'GC.group_code_id', '=', 'CC.group_code_id', 'left')->get(['chart_of_accounts.chart_of_account_id', 'GC.group_code', 'GC.group_account', 'CC.control_code', 'CC.control_description', 'chart_of_accounts.chart_of_account_code', 'chart_of_accounts.chart_of_account', 'chart_of_accounts.opening_balance_debit', 'chart_of_accounts.opening_balance_credit']);

        return view('Main.chartofaccounts', ['group_codes' => $group_codes, 'chart_of_accounts' => $chart_of_accounts, 'projects' => $projects]);
    }


    public function AddChartOfAccount(Request $req)
    {
        $validatedData = $req->validate([
            'chart_of_account_code' => ['required'],
            'chart_of_account' => ['required'],
            'group_code_id' => ['required'],
            'control_code_id' => ['required'],
        ]);

        $chart_of_accounts = new ChartOfAccounts();

        $control_code = ControlCodes::where(['control_code_id' => $req->control_code_id])->first(['control_code']);

        $chart_of_accounts->chart_of_account_code = $req->chart_of_account_code;
        $chart_of_accounts->chart_of_account = $req->chart_of_account;
        $chart_of_accounts->control_code_id = $req->control_code_id;
        $chart_of_accounts->opening_balance_debit = $req->opening_balance_debit;
        $chart_of_accounts->opening_balance_credit = $req->opening_balance_credit;

        if ($chart_of_accounts->save()) :
            $req->session()->flash('status', 'Chart Of Account Added Successfully');

        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ChartOfAccounts');
    }


    public function EditChartOfAccount(Request $req)
    {

        $group_codes = GroupCodes::get();
        $result = ChartOfAccounts::where(['chart_of_account_id' => $req->ChartOfAccountID])->join('control_codes AS CC', 'CC.control_code_id', 'chart_of_accounts.control_code_id', 'left')->join('group_codes AS GC', 'GC.group_code_id', '=', 'CC.group_code_id', 'left')->first(['chart_of_accounts.chart_of_account_id', 'GC.group_code_id', 'CC.control_code_id', 'chart_of_accounts.chart_of_account_code', 'chart_of_accounts.chart_of_account', 'chart_of_accounts.opening_balance_debit', 'chart_of_accounts.opening_balance_credit']);
        return view('Main.edit_chartofaccounts', ['group_codes' => $group_codes, 'result' => $result]);
    }


    public function UpdateChartOfAccount(Request $req)
    {
        $validatedData = $req->validate([
            'chart_of_account_code' => ['required'],
            'chart_of_account' => ['required'],
            'group_code_id' => ['required'],
            'control_code_id' => ['required'],
        ]);
        if (ChartOfAccounts::where(['chart_of_account_id' => $req->chart_of_account_id])->update(['chart_of_account_code' => $req->chart_of_account_code, 'chart_of_account' => $req->chart_of_account, 'control_code_id' => $req->control_code_id, 'opening_balance_debit' => $req->opening_balance_debit, 'opening_balance_credit' => $req->opening_balance_credit])) :
            $req->session()->flash('status', 'Chart Of Account Update Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;
        return redirect('ChartOfAccounts');
    }

    #endregion




    #region  USERS CATEGORIES
    public function UserCategories()
    {
        $user_categories = UserCategories::get();
        return view('Main.usercategories', ['user_categories' => $user_categories]);
    }


    public function AddUserCategory(Request $req)
    {
        $validatedData = $req->validate([
            'user_category_code' => ['required'],
            'user_category_name' => ['required'],
        ]);

        $user_categories = new UserCategories();
        $user_categories->user_category_code = $req->user_category_code;
        $user_categories->user_category_name = $req->user_category_name;
        $user_categories->login_date_from = $req->login_date_from;
        $user_categories->login_date_to = $req->login_date_to;
        if ($user_categories->save()) :
            $req->session()->flash('status', 'User Category Added Successfully');

        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('UserCategories');
    }


    public function EditUserCategory(Request $req)
    {
        $result = UserCategories::where(['user_category_id' => $req->UserCategoryID])->first();
        return view('Main.edit_usercategories', compact('result'));
    }

    public function UpdateUserCategory(Request $req)
    {
        $validatedData = $req->validate([
            'user_category_code' => ['required'],
            'user_category_name' => ['required'],
        ]);

        $DataToUpdate = [
            'user_category_code' => $req->user_category_code,
            'user_category_name' => $req->user_category_name,
            'login_date_from' => $req->login_date_from,
            'login_date_to' => $req->login_date_to,
        ];
        if (UserCategories::where(['user_category_id' => $req->user_category_id])->update($DataToUpdate)) :
            $req->session()->flash('status', 'User Category Update Successfully');
        else :
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
    public function Suppliers()
    {
        $chart_of_accounts = ChartOfAccounts::get();
        $suppliers = Suppliers::join('chart_of_accounts AS COA', 'COA.chart_of_account_id', '=', 'suppliers.chart_of_account_id', 'left')->get();
        return view('Main.suppliers', ['chart_of_accounts' => $chart_of_accounts, 'suppliers' => $suppliers]);
    }


    public function AddSupplier(Request $req)
    {
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
        if ($suppliers->save()) :
            $req->session()->flash('status', 'Supplier Added Successfully');

        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Suppliers');
    }


    public function EditSupplier(Request $req)
    {
        $chart_of_accounts = ChartOfAccounts::get();
        $result = Suppliers::where(['supplier_id' => $req->SupplierID])->first();
        return view('Main.edit_suppliers', ['chart_of_accounts' => $chart_of_accounts, 'result' => $result]);
    }

    public function UpdateSupplier(Request $req)
    {
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


        if (Suppliers::where(['supplier_id' => $req->supplier_id])->update($suppliers)) :
            $req->session()->flash('status', 'Supplier Update Successfully');
        else :
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
    public function Customers()
    {
        $chart_of_accounts = ChartOfAccounts::get();
        $customers = Customers::join('chart_of_accounts AS COA', 'COA.chart_of_account_id', '=', 'customers.chart_of_account_id', 'left')->get();
        return view('Main.customers', ['chart_of_accounts' => $chart_of_accounts, 'customers' => $customers]);
    }


    public function AddCustomer(Request $req)
    {
        $validatedData = $req->validate([
            'customer_code' => ['required'],
            'customer_name' => ['required'],
            'contact_no' => ['required'],
            'email_address' => ['required'],
        ]);

        $customers = new Customers();
        $customers->customer_code = $req->customer_code;
        $customers->customer_name = $req->customer_name;
        $customers->poc_name = $req->poc_name;
        $customers->address = $req->address;
        $customers->contact_no = $req->contact_no;
        $customers->email_address = $req->email_address;
        $customers->website = $req->website;
        $customers->account_code = $req->account_code;
        $customers->chart_of_account_id = $req->chart_of_account_id;
        if ($customers->save()) :
            $req->session()->flash('status', 'Customer Added Successfully');

        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Customers');
    }


    public function EditCustomer(Request $req)
    {
        $chart_of_accounts = ChartOfAccounts::get();
        $result = Customers::where(['customer_id' => $req->CustomerID])->first();
        return view('Main.edit_customers', ['chart_of_accounts' => $chart_of_accounts, 'result' => $result]);
    }

    public function UpdateCustomer(Request $req)
    {
        $validatedData = $req->validate([
            'customer_code' => ['required'],
            'customer_name' => ['required'],
            'contact_no' => ['required'],
            'email_address' => ['required'],
        ]);

        $customers = array();
        $customers['customer_code'] = $req->customer_code;
        $customers['customer_name'] = $req->customer_name;
        $customers['poc_name'] = $req->poc_name;
        $customers['address'] = $req->address;
        $customers['contact_no'] = $req->contact_no;
        $customers['email_address'] = $req->email_address;
        $customers['website'] = $req->website;
        $customers['account_code'] = $req->account_code;
        $customers['chart_of_account_id'] = $req->chart_of_account_id;


        if (Customers::where(['customer_id' => $req->customer_id])->update($customers)) :
            $req->session()->flash('status', 'Customer Update Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Customers');
    }

    function UsernameValidation(Request $req)
    {
        $userscount = Users::where(['user_name' => $req->UserName])->get()->count();
        return response()->json($userscount);
    }


    function EmailValidation(Request $req)
    {
        $userscount = Users::where(['email' => $req->Email])->get()->count();
        return response()->json($userscount);
    }

    // public function DeleteGroupType(Request $req){
    //    if(GroupTypes::where(['group_type_id'=>$req->GroupTypeID])->delete()):
    //         $req->session()->flash('status', 'Group Type Deleted Successfully');
    //    else:
    //         $req->session()->flash('status', 'Some Error Occured');
    //    endif;

    //    return redirect('GroupTypes');
    // }
    #endregion CUSTOMERS


    #region BANKPAYMENTVOUCHER

    function BankPaymentVouchers()
    {
        return view('Main.bankpaymentvouchers');
    }

    #endregion BANKPAYMENTVOUCHER


    #region CASHPAYMENTVOUCHER

    function CashPaymentVouchers()
    {
        return view('Main.cashpaymentvouchers');
    }

    #endregion CASHPAYMENTVOUCHER


    #region BANKRECEIPTVOUCHER

    function BankReceiptVouchers()
    {
        return view('Main.bankreceiptvouchers');
    }

    #endregion BANKRECEIPTVOUCHER


    #region CASHRECEIPTVOUCHER

    function CashReceiptVouchers()
    {
        return view('Main.cashreceiptvouchers');
    }

    #endregion CASHRECEIPTVOUCHER


    #region JOURNALVOUCHERS

    function JournalVouchers()
    {
        return view('Main.journalvouchers');
    }

    #endregion JOURNALVOUCHERS


    #region BILLS

    function Bills()
    {
        return view('Main.bills');
    }

    #endregion BILLS


    #region INVOICES

    function Invoices()
    {
        return view('Main.invoices');
    }

    #endregion INVOICES


}
