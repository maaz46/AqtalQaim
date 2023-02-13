<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckSession;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'Login']);
Route::post('/', [AuthController::class, 'LoginPost']);

Route::middleware([CheckSession::class])->group(function(){


Route::get('/Dashboard',[MainController::class, 'Dashboard']);

Route::get('/SelectProject', [AuthController::class, 'SelectProject']);

#region GROUP TYPES
Route::get('/GroupTypes', [MainController::class, 'GroupTypes']);
Route::post('/GroupTypes', [MainController::class, 'AddGroupType']);
Route::get('/EditGroupType/{GroupTypeID}', [MainController::class, 'EditGroupType']);
Route::post('/UpdateGroupType', [MainController::class, 'UpdateGroupType']);
Route::get('/DeleteGroupType/{GroupTypeID}', [MainController::class, 'DeleteGroupType']);
#endregion GROUP TYPES


#region GROUP CODES
Route::get('/GroupCodes', [MainController::class, 'GroupCodes']);
Route::post('/GroupCodes', [MainController::class, 'AddGroupCode']);
Route::get('/EditGroupCode/{GroupCodeID}', [MainController::class, 'EditGroupCode']);
Route::post('/UpdateGroupCode', [MainController::class, 'UpdateGroupCode']);
Route::get('/DeleteGroupCode/{GroupCodeID}', [MainController::class, 'DeleteGroupCode']);
#endregion GROUP CODES


#region CONTROL TYPES
Route::get('/ControlTypes', [MainController::class, 'ControlTypes']);
Route::post('/ControlTypes', [MainController::class, 'AddControlType']);
Route::get('/EditControlType/{ControlTypeID}', [MainController::class, 'EditControlType']);
Route::post('/UpdateControlType', [MainController::class, 'UpdateControlType']);
Route::get('/DeleteControlType/{ControlTypeID}', [MainController::class, 'DeleteControlType']);
#endregion CONTROL TYPES


#region CONTROL CODES
Route::get('/ControlCodes', [MainController::class, 'ControlCodes']);
Route::post('/ControlCodes', [MainController::class, 'AddControlCode']);
Route::get('/EditControlCode/{ControlCodeID}', [MainController::class, 'EditControlCode']);
Route::post('/UpdateControlCode', [MainController::class, 'UpdateControlCode']);
Route::get('/DeleteControlCode/{ControlCodeID}', [MainController::class, 'DeleteControlCode']);
#endregion CONTROL CODES

Route::get('/GetControlCodesByGroupCodeID/{GroupCodeID}',[MainController::class, 'GetControlCodesByGroupCodeID']);


#region CHART OF ACCOUNTS
Route::get('/ChartOfAccounts', [MainController::class, 'ChartOfAccounts']);
Route::post('/ChartOfAccounts', [MainController::class, 'AddChartOfAccount']);
Route::get('/EditChartOfAccount/{ChartOfAccountID}', [MainController::class, 'EditChartOfAccount']);
Route::post('/UpdateChartOfAccount', [MainController::class, 'UpdateChartOfAccount']);
Route::get('/DeleteChartOfAccount/{ChartOfAccountID}', [MainController::class, 'DeleteChartOfAccount']);
#endregion CONTROL CODES


#region PROJECT CATEGORIES
Route::get('/ProjectCategories', [MainController::class, 'ProjectCategories']);
Route::post('/ProjectCategories', [MainController::class, 'AddProjectCategory']);
Route::get('/EditProjectCategory/{ProjectCategoryID}', [MainController::class, 'EditProjectCategory']);
Route::post('/UpdateProjectCategory', [MainController::class, 'UpdateProjectCategory']);
Route::get('/DeleteProjectCategory/{ProjectCategoryID}', [MainController::class, 'DeleteProjectCategory']);
#endregion PROJECT TYPES



#region PROJECTS
Route::get('/Projects', [MainController::class, 'Projects']);
Route::post('/Projects', [MainController::class, 'AddProject']);
Route::get('/EditProject/{ProjectID}', [MainController::class, 'EditProject']);
Route::post('/UpdateProject', [MainController::class, 'UpdateProject']);
Route::get('/DeleteProject/{ProjectID}', [MainController::class, 'DeleteProject']);
#endregion PROJECTS

#region ROLES
Route::get('/Roles', [MainController::class, 'Roles']);
Route::post('/Roles', [MainController::class, 'AddRole']);
Route::get('/EditRole/{RoleID}', [MainController::class, 'EditRole']);
Route::post('/UpdateRole', [MainController::class, 'UpdateRole']);
Route::get('/DeleteRole/{RoleID}', [MainController::class, 'DeleteRole']);
#endregion ROLES


#region USERS
Route::get('/Users', [MainController::class, 'Users']);
Route::post('/Users', [MainController::class, 'AddUser']);
Route::get('/EditUser/{UserID}', [MainController::class, 'EditUser']);
Route::post('/UpdateUser', [MainController::class, 'UpdateUser']);
Route::get('/DeleteUser/{UserID}', [MainController::class, 'DeleteUser']);
#endregion USERS


Route::get('/Logout',function(){
    Session::forget(['user_id','user_name']);
    return redirect('/');
});

});