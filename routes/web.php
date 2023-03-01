<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckSession;
use App\Http\Middleware\CheckLoginSession;

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

Route::middleware([CheckLoginSession::class])->group(function () {
    Route::get('/', [AuthController::class, 'Login']);
});
Route::post('/', [AuthController::class, 'LoginPost']);


Route::middleware([CheckSession::class])->group(function () {


    Route::get('/Dashboard', [MainController::class, 'Dashboard'])->middleware('PagesAccess:1');
    Route::get('/Dashboard/{ProjectID}', [MainController::class, 'Dashboard'])->middleware('PagesAccess:1');

    Route::get('/SelectProject', [AuthController::class, 'SelectProject']);

    #region INITIAL SETUP
    Route::middleware('PagesAccess:3')->group(function () {
        #region GROUP TYPES
        Route::get('/GroupTypes', [MainController::class, 'GroupTypes']);
        Route::post('/GroupTypes', [MainController::class, 'AddGroupType']);
        Route::get('/EditGroupType/{GroupTypeID}', [MainController::class, 'EditGroupType'])->middleware('PageActionAccess:3,1');
        Route::post('/UpdateGroupType', [MainController::class, 'UpdateGroupType'])->middleware('PageActionAccess:3,1');
        Route::get('/DeleteGroupType/{GroupTypeID}', [MainController::class, 'DeleteGroupType'])->middleware('PageActionAccess:3,2');

        #endregion GROUP TYPES


        #region GROUP CODES
        Route::get('/GroupCodes', [MainController::class, 'GroupCodes']);
        Route::post('/GroupCodes', [MainController::class, 'AddGroupCode']);
        Route::get('/EditGroupCode/{GroupCodeID}', [MainController::class, 'EditGroupCode'])->middleware('PageActionAccess:3,1');
        Route::post('/UpdateGroupCode', [MainController::class, 'UpdateGroupCode'])->middleware('PageActionAccess:3,1');
        Route::get('/DeleteGroupCode/{GroupCodeID}', [MainController::class, 'DeleteGroupCode'])->middleware('PageActionAccess:3,2');
        #endregion GROUP CODES


        #region CONTROL TYPES
        Route::get('/ControlTypes', [MainController::class, 'ControlTypes']);
        Route::post('/ControlTypes', [MainController::class, 'AddControlType']);
        Route::get('/EditControlType/{ControlTypeID}', [MainController::class, 'EditControlType'])->middleware('PageActionAccess:3,1');
        Route::post('/UpdateControlType', [MainController::class, 'UpdateControlType'])->middleware('PageActionAccess:3,1');
        Route::get('/DeleteControlType/{ControlTypeID}', [MainController::class, 'DeleteControlType'])->middleware('PageActionAccess:3,2');
        #endregion CONTROL TYPES


        #region CONTROL CODES
        Route::get('/ControlCodes', [MainController::class, 'ControlCodes']);
        Route::post('/ControlCodes', [MainController::class, 'AddControlCode']);
        Route::get('/EditControlCode/{ControlCodeID}', [MainController::class, 'EditControlCode'])->middleware('PageActionAccess:3,1');
        Route::post('/UpdateControlCode', [MainController::class, 'UpdateControlCode'])->middleware('PageActionAccess:3,1');
        Route::get('/DeleteControlCode/{ControlCodeID}', [MainController::class, 'DeleteControlCode'])->middleware('PageActionAccess:3,2');
        #endregion CONTROL CODES



        #region CHART OF ACCOUNTS
        Route::get('/ChartOfAccounts', [MainController::class, 'ChartOfAccounts']);
        Route::post('/ChartOfAccounts', [MainController::class, 'AddChartOfAccount']);
        Route::get('/EditChartOfAccount/{ChartOfAccountID}', [MainController::class, 'EditChartOfAccount'])->middleware('PageActionAccess:3,1');
        Route::post('/UpdateChartOfAccount', [MainController::class, 'UpdateChartOfAccount'])->middleware('PageActionAccess:3,1');
        Route::get('/DeleteChartOfAccount/{ChartOfAccountID}', [MainController::class, 'DeleteChartOfAccount'])->middleware('PageActionAccess:3,2');
        #endregion CONTROL CODES


        #region PROJECT CATEGORIES
        Route::get('/ProjectCategories', [MainController::class, 'ProjectCategories']);
        Route::post('/ProjectCategories', [MainController::class, 'AddProjectCategory']);
        Route::get('/EditProjectCategory/{ProjectCategoryID}', [MainController::class, 'EditProjectCategory'])->middleware('PageActionAccess:3,1');
        Route::post('/UpdateProjectCategory', [MainController::class, 'UpdateProjectCategory'])->middleware('PageActionAccess:3,1');
        Route::get('/DeleteProjectCategory/{ProjectCategoryID}', [MainController::class, 'DeleteProjectCategory'])->middleware('PageActionAccess:3,2');
        #endregion PROJECT TYPES



        #region PROJECTS
        Route::get('/Projects', [MainController::class, 'Projects']);
        Route::post('/Projects', [MainController::class, 'AddProject']);
        Route::get('/EditProject/{ProjectID}', [MainController::class, 'EditProject'])->middleware('PageActionAccess:3,1');
        Route::post('/UpdateProject', [MainController::class, 'UpdateProject'])->middleware('PageActionAccess:3,1');
        Route::get('/DeleteProject/{ProjectID}', [MainController::class, 'DeleteProject'])->middleware('PageActionAccess:3,2');
        #endregion PROJECTS

    });

    #endregion INITIAL SETUP


    #region MANAGEMENT

    Route::middleware('PagesAccess:6')->group(function () {


        #region ROLES
        Route::get('/Roles', [MainController::class, 'Roles']);
        Route::post('/Roles', [MainController::class, 'AddRole']);
        Route::get('/EditRole/{RoleID}', [MainController::class, 'EditRole'])->middleware('PageActionAccess:6,1');
        Route::post('/UpdateRole', [MainController::class, 'UpdateRole'])->middleware('PageActionAccess:6,1');
        Route::get('/DeleteRole/{RoleID}', [MainController::class, 'DeleteRole'])->middleware('PageActionAccess:6,2');
        #endregion ROLES


        #region USERS
        Route::get('/Users', [MainController::class, 'Users']);
        Route::post('/Users', [MainController::class, 'AddUser']);
        Route::get('/EditUser/{UserID}', [MainController::class, 'EditUser'])->middleware('PageActionAccess:6,1');
        Route::post('/UpdateUser', [MainController::class, 'UpdateUser'])->middleware('PageActionAccess:6,1');
        Route::get('/DeleteUser/{UserID}', [MainController::class, 'DeleteUser'])->middleware('PageActionAccess:6,2');
        #endregion USERS

        #region USERS CATEGORIES
        Route::get('/UserCategories', [MainController::class, 'UserCategories']);
        Route::post('/UserCategories', [MainController::class, 'AddUserCategory']);
        Route::get('/EditUserCategory/{UserCategoryID}', [MainController::class, 'EditUserCategory'])->middleware('PageActionAccess:6,1');
        Route::post('/UpdateUserCategory', [MainController::class, 'UpdateUserCategory'])->middleware('PageActionAccess:6,1');
        Route::get('/DeleteUserCategory/{UserCategoryID}', [MainController::class, 'DeleteUserCategory'])->middleware('PageActionAccess:6,2');
        #endregion USERS CATEGORIES

        #region SUPPLIERS
        Route::get('/Suppliers', [MainController::class, 'Suppliers']);
        Route::post('/Suppliers', [MainController::class, 'AddSupplier']);
        Route::get('/EditSupplier/{SupplierID}', [MainController::class, 'EditSupplier'])->middleware('PageActionAccess:6,1');
        Route::post('/UpdateSupplier', [MainController::class, 'UpdateSupplier'])->middleware('PageActionAccess:6,1');
        Route::get('/DeleteSupplier/{SupplierID}', [MainController::class, 'DeleteSupplier'])->middleware('PageActionAccess:6,2');
        #endregion SUPPLIERS


        #region CUSTOMERS
        Route::get('/Customers', [MainController::class, 'Customers']);
        Route::post('/Customers', [MainController::class, 'AddCustomer']);
        Route::get('/EditCustomer/{CustomerID}', [MainController::class, 'EditCustomer'])->middleware('PageActionAccess:6,1');
        Route::post('/UpdateCustomer', [MainController::class, 'UpdateCustomer'])->middleware('PageActionAccess:6,1');
        Route::get('/DeleteCustomer/{CustomerID}', [MainController::class, 'DeleteCustomer'])->middleware('PageActionAccess:6,2');
        #endregion CUSTOMERS



       

    });




    #endregion MANAGEMENT


    #region FINANCE
    
    Route::middleware('PagesAccess:4')->group(function () {

        #region BANKVOUCHERS
        Route::get('/BankVouchers', [MainController::class, 'BankVouchers']);
        Route::post('/BankVouchers', [MainController::class, 'AddBankVoucher']);
        Route::get('/EditBankVoucher/{BankVoucherID}', [MainController::class, 'EditBankVoucher'])->middleware('PageActionAccess:4,1');
        Route::post('/UpdateBankVoucher', [MainController::class, 'UpdateBankVoucher'])->middleware('PageActionAccess:4,1');
        Route::get('/DeleteBankVoucher/{BankVoucherID}', [MainController::class, 'DeleteBankVoucher'])->middleware('PageActionAccess:4,2');
        #endregion BANKVOUCHERS


        #region CASHPAYMENTVOUCHERS
        Route::get('/CashPaymentVouchers', [MainController::class, 'CashPaymentVouchers']);
        Route::post('/CashPaymentVouchers', [MainController::class, 'AddCashPaymentVoucher']);
        Route::get('/EditCashPaymentVoucher/{CashPaymentVoucherID}', [MainController::class, 'EditCashPaymentVoucher'])->middleware('PageActionAccess:4,1');
        Route::post('/UpdateCashPaymentVoucher', [MainController::class, 'UpdateCashPaymentVoucher'])->middleware('PageActionAccess:4,1');
        Route::get('/DeleteCashPaymentVoucher/{CashPaymentVoucherID}', [MainController::class, 'DeleteBankVoucher'])->middleware('PageActionAccess:4,2');
        #endregion CASHPAYMENTVOUCHERS



        #region BANKRECEIPTVOUCHERS
        Route::get('/BankReceiptVouchers', [MainController::class, 'BankReceiptVouchers']);
        Route::post('/BankReceiptVouchers', [MainController::class, 'AddBankReceiptVoucher']);
        Route::get('/EditBankReceiptVoucher/{BankReceiptVoucherID}', [MainController::class, 'EditBankReceiptVoucher'])->middleware('PageActionAccess:4,1');
        Route::post('/UpdateBankReceiptVoucher', [MainController::class, 'UpdateEditBankReceiptVoucher'])->middleware('PageActionAccess:4,1');
        Route::get('/DeleteBankReceiptVoucher/{BankReceiptVoucherID}', [MainController::class, 'DeleteBankReceiptVoucher'])->middleware('PageActionAccess:4,2');
        #endregion BANKRECEIPTVOUCHERS


         #region CASHRECEIPTVOUCHERS
         Route::get('/CashReceiptVouchers', [MainController::class, 'CashReceiptVouchers']);
         Route::post('/CashReceiptVouchers', [MainController::class, 'AddCashReceiptVoucher']);
         Route::get('/EditCashReceiptVoucher/{CashReceiptVoucherID}', [MainController::class, 'EditCashReceiptVoucher'])->middleware('PageActionAccess:4,1');
         Route::post('/UpdateCashReceiptVoucher', [MainController::class, 'UpdateEditCashReceiptVoucher'])->middleware('PageActionAccess:4,1');
         Route::get('/DeleteCashReceiptVoucher/{CashReceiptVoucherID}', [MainController::class, 'DeleteCashReceiptVoucher'])->middleware('PageActionAccess:4,2');
         #endregion CASHRECEIPTVOUCHERS

           });
       
    #endregion FINANCE

    #region AJAX

    Route::get('/GetControlCodesByGroupCodeID/{GroupCodeID}', [MainController::class, 'GetControlCodesByGroupCodeID']);
    Route::get('/GetProjectsByProjectCategoryID/{ProjectCategoryID}', [MainController::class, 'GetProjectsByProjectCategoryID']);
    Route::post('/UsernameValidation', [MainController::class, 'UsernameValidation']);
    Route::post('/EmailValidation', [MainController::class, 'EmailValidation']);

    #endregion AJAX


    Route::get('/Logout', function () {
        Session::forget(['user_id', 'user_name']);
        return redirect('/');
    });
});
