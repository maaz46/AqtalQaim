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

class AdminController extends Controller
{

    public function Dashboard(Request $req, $project_id = null)
    {
        if ($req->session()->get('is_admin') == "1") :
            if ($project_id == null) {
                $project_categories = ProjectCategories::get();
                return view('Admin.admindashboard', ['project_categories' => $project_categories]);
            } else {
                $result = Projects::where(['project_id' => $project_id])->first();
                return view('Admin.projectdashboard', ['result' => $result]);
            }

        elseif ($req->session()->get('is_admin') == "0") :
            if ($req->session()->get('selected_project_id') == "" && $req->session()->get('selected_project_name') == "") :
                return view('Admin.userselectdefaultproject');
            else :
                return view('Admin.userdefaultdashboard');
            endif;
        endif;
    }

    #region GroupType
    public function GroupTypes()
    {
        $group_types = GroupTypes::get();
        return view('Admin.grouptypes', ['group_types' => $group_types]);
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

        return redirect('Admin/GroupTypes');
    }


    public function EditGroupType(Request $req)
    {
        $result = GroupTypes::where(['group_type_id' => $req->GroupTypeID])->first();
        return view('Admin.edit_grouptypes', compact('result'));
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

        return redirect('Admin/GroupTypes');
    }

    public function DeleteGroupType(Request $req)
    {
        if (GroupTypes::where(['group_type_id' => $req->GroupTypeID])->delete()) :
            $req->session()->flash('status', 'Group Type Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Admin/GroupTypes');
    }
    #endregion GroupType


    #region ControlType
    public function ControlTypes()
    {
        $control_types = ControlTypes::get();
        return view('Admin.controltypes', ['control_types' => $control_types]);
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

        return redirect('Admin/ControlTypes');
    }


    public function EditControlType(Request $req)
    {
        $result = ControlTypes::where(['control_type_id' => $req->ControlTypeID])->first();
        return view('Admin.edit_controltypes', compact('result'));
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

        return redirect('Admin/ControlTypes');
    }

    public function DeleteControlType(Request $req)
    {
        if (ControlTypes::where(['control_type_id' => $req->ControlTypeID])->delete()) :
            $req->session()->flash('status', 'Control Type Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Admin/ControlTypes');
    }
    #endregion ControlType

     #region ProjectCategory
     public function ProjectCategories()
     {
         $project_categories = ProjectCategories::get();
         return view('Admin.projectcategories', ['project_categories' => $project_categories]);
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
 
         return redirect('Admin/ProjectCategories');
     }
 
 
     public function EditProjectCategory(Request $req)
     {
         $result = ProjectCategories::where(['project_category_id' => $req->ProjectCategoryID])->first();
         return view('Admin.edit_projectcategories', compact('result'));
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
 
         return redirect('Admin/ProjectCategories');
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
 
 
         return redirect('Admin/ProjectCategories');
     }
     #endregion ProjectCategory

     
     #region Project
    public function Projects()
    {
        $project_categories = ProjectCategories::get();
        $projects = Projects::join('project_categories', 'project_categories.project_category_id', '=', 'projects.project_category_id', 'left')->get(['project_categories.project_category', 'projects.project_id', 'projects.project_name']);
        return view('Admin.projects', ['project_categories' => $project_categories, 'projects' => $projects]);
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

        return redirect('Admin/Projects');
    }


    public function EditProject(Request $req)
    {
        $result = Projects::join('project_categories', 'project_categories.project_category_id', '=', 'projects.project_category_id')->where(['projects.project_id' => $req->ProjectID])->first();

        $project_categories = ProjectCategories::get();
        return view('Admin.edit_projects', ['project_categories' => $project_categories, 'result' => $result]);
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
        return redirect('Admin/Projects');
    }

    public function DeleteProject(Request $req)
    {
        if (Projects::where(['project_id' => $req->ProjectID])->delete()) :
            $req->session()->flash('status', 'Project Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Admin/Projects');
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

        return view('Admin.roles', $data);
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

        return redirect('Admin/Roles');
    }


    public function EditRole(Request $req)
    {
        // SELECT R.role_id, R.role_name, RI.right_id, RI.right_name FROM roles AS R LEFT JOIN rights_mapping AS RM ON R.role_id = RM.role_id LEFT JOIN rights AS RI ON RI.right_id = RM.right_id; 

        $data['rightmapping'] = RightsMapping::join('rights AS RI', 'rights_mapping.right_id', '=', 'RI.right_id', 'left')->where(['rights_mapping.role_id' => $req->RoleID])->get();
        $data['result'] = Roles::where(['role_id' => $req->RoleID])->first();

        return view('Admin.edit_roles', $data);
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

        return redirect('Admin/Roles');
    }

    public function DeleteRole(Request $req)
    {
        if (Roles::where(['role_id' => $req->RoleID])->delete()) :
            $req->session()->flash('status', 'Role Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Admin/Roles');
    }
    #endregion ROLES



    #region USERS
    public function Users()
    {
        $roles = Roles::get();
        $project_categories = ProjectCategories::get();
        $pages = Pages::get();

        $users = Users::selectRaw('users.user_id, users.full_name, users.user_name, users.email, users.cell, users.is_block, users.can_change_year, GROUP_CONCAT(P.project_name SEPARATOR \' | \') AS projects')
            ->join('user_project_mapping AS UPM', 'UPM.user_id', '=', 'users.user_id', 'left')
            ->join('projects AS P', 'P.project_id', '=', 'UPM.project_id', 'left')
            ->groupBy('users.user_id')
            ->get();


        return view('Admin.users', ['users' => $users, 'roles' => $roles, 'pages' => $pages, 'project_categories' => $project_categories]);
    }


    public function AddUser(Request $req)
    {
        $DataToValidate = [
            'user_name' => ['required'],
            'user_type' => ['required'],
            'password' => ['required'],
            'email' => ['required'],
        ];
        $validatedData = $req->validate($DataToValidate);

        if ($req->user_type == "User") :
            if (array_key_exists('project_id', $_POST)) :
                if (count($req->project_id) == "0") :
                    $req->session()->flash('status', 'Project is required in order to create a User');
                    return redirect('Admin/Users');
                endif;

            else :
                $req->session()->flash('status', 'Project is required in order to create a User');
                return redirect('Admin/Users');
            endif;
        endif;

        $validatingUserCount = Users::where(['user_name' => $req->user_name, 'email' => $req->email])->get()->count();
        if ($validatingUserCount == "0") :

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


                    if (count($req->project_id) > 0) :

                        $projectstoadd = array();
                        foreach ($req->project_id as $key => $item) :
                            $projectstoadd[$key]['user_id'] = $user_id;
                            $projectstoadd[$key]['project_id'] = $item;
                        endforeach;
                        UserProjectMapping::upsert($projectstoadd, ['user_id', 'project_id']);
                    endif;
                endif;
                $req->session()->flash('status', 'User Added Successfully');

            else :
                $req->session()->flash('status', 'Some Error Occured');
            endif;

        else :
            $req->session()->flash('status', 'Username Or Email already exists');
        endif;

        return redirect('Admin/Users');
    }


    public function EditUser(Request $req)
    {
        $roles = Roles::get();
        $project_categories = ProjectCategories::get();
        $pages = Pages::get();
        $user_role_page_mapping = UserRolePageMapping::where(['user_id' => $req->UserID])->get();

        $result = Users::where(['user_id' => $req->UserID])->first();
        $user_project_mapping = array();

        if ($result->is_admin == "0") :
            $user_project_mapping = UserProjectMapping::join('projects AS P', 'P.project_id', '=', 'user_project_mapping.project_id', 'left')
                ->join('project_categories AS PC', 'PC.project_category_id', '=', 'P.project_category_id')
                ->where(['user_project_mapping.user_id' => $req->UserID])->get();
        endif;
        return view('Admin.edit_users', ['result' => $result, 'roles' => $roles, 'pages' => $pages, 'project_categories' => $project_categories, 'user_role_page_mapping' => $user_role_page_mapping, 'user_project_mapping' => $user_project_mapping]);
    }



    public function UpdateUser(Request $req)
    {

        $DataToValidate = [
            'user_name' => ['required'],
            'user_type' => ['required'],
            'email' => ['required'],
        ];
        $validatedData = $req->validate($DataToValidate);

        if ($req->user_type == "User") :
            if (array_key_exists('project_id', $_POST)) :
                if (count($req->project_id) == "0") :
                    $req->session()->flash('status', 'Project is required in order to update a User');
                    return redirect('Admin/EditUser/' . $req->user_id);
                endif;

            else :
                $req->session()->flash('status', 'Project is required in order to update a User');
                return redirect('Admin/EditUser/' . $req->user_id);
            endif;
        endif;

        $validatingUserCount = Users::where(['user_name' => $req->user_name, 'email' => $req->email])->whereNotIn('user_id', [$req->user_id])->get()->count();

        if ($validatingUserCount == "0") :

            $DataToUpdate = [
                'full_name' => $req->full_name,
                'user_name' => $req->user_name,
                'email' => $req->email,
                'cell' => $req->cell,
                'is_block' => $req->is_block == "on" ? 1 : 0,
                'can_change_year' => $req->can_change_year == "on" ? 1 : 0,
                'is_admin' => $req->user_type == "Administrator" ? 1 : 0
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

                if ($req->user_type == "Administrator") :
                    UserProjectMapping::where(['user_id' => $req->user_id])->delete();

                elseif ($req->user_type == "User") :
                    UserProjectMapping::where(['user_id' => $req->user_id])->whereNotIn('project_id', $req->project_id)->delete();

                    if (count($req->project_id) > 0) :
                        $projectstoadd = array();
                        foreach ($req->project_id as $key => $item) :
                            $projectstoadd[$key]['user_id'] = $req->user_id;
                            $projectstoadd[$key]['project_id'] = $item;
                            $user_project_count = UserProjectMapping::where(['user_id' => $req->user_id, 'project_id' => $item])->get()->count();
                            if ($user_project_count == "0") :
                                $user_project_mapping = new UserProjectMapping();
                                $user_project_mapping->user_id = $req->user_id;
                                $user_project_mapping->project_id = $item;
                                $user_project_mapping->save();
                            endif;
                        endforeach;
                    endif;
                endif;
                $req->session()->flash('status', 'User Update Successfully');
            else :
                $req->session()->flash('status', 'Some Error Occured');
            endif;
        else :
            $req->session()->flash('status', 'Username Or Email already exists');
            return redirect('Admin/EditUser/' . $req->user_id);
        endif;


        return redirect('Admin/Users');
    }

    public function UpdatePassword(Request $req){
        echo Hash::make($req->password);
        $DataToUpdate = ['password'=>Hash::make($req->password)];
        if(Users::where(['user_id' => $req->user_id])->update($DataToUpdate)):
            $req->session()->flash('status', 'Password Changed Successfully');
        else:
            $req->session()->flash('status', 'Some Error Occured');
        endif;
        return redirect('Admin/EditUser/'.$req->user_id);
    }

    public function DeleteUser(Request $req)
    {
        if (Users::where(['user_id' => $req->UserID])->delete()) :
            $req->session()->flash('status', 'User Deleted Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('Admin/Users');
    }
    #endregion USERS



    function PrintR($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit;
    }
}
