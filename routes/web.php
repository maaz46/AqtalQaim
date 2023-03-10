<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckSession;
use App\Http\Middleware\CheckLoginSession;
use App\Http\Middleware\DefaultProject;
use App\Http\Middleware\CheckIfAdmin;
use Illuminate\Support\Facades\Session;

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

    //region For Admin Only
    Route::middleware(['CheckIfAdmin:1'])->group(function () {
        Route::get('/Admin/Dashboard', [AdminController::class, 'Dashboard']);

        #region GROUP TYPES
        Route::get('/Admin/GroupTypes', [AdminController::class, 'GroupTypes']);
        Route::post('/Admin/GroupTypes', [AdminController::class, 'AddGroupType']);
        Route::get('/Admin/EditGroupType/{GroupTypeID}', [AdminController::class, 'EditGroupType']);
        Route::post('/Admin/UpdateGroupType', [AdminController::class, 'UpdateGroupType']);
        Route::get('/Admin/DeleteGroupType/{GroupTypeID}', [AdminController::class, 'DeleteGroupType']);

        #endregion GROUP TYPES


        #region CONTROL TYPES
        Route::get('/Admin/ControlTypes', [AdminController::class, 'ControlTypes']);
        Route::post('/Admin/ControlTypes', [AdminController::class, 'AddControlType']);
        Route::get('/Admin/EditControlType/{ControlTypeID}', [AdminController::class, 'EditControlType']);
        Route::post('/Admin/UpdateControlType', [AdminController::class, 'UpdateControlType']);
        Route::get('/Admin/DeleteControlType/{ControlTypeID}', [AdminController::class, 'DeleteControlType']);
        #endregion CONTROL TYPES


        #region ROLES
        Route::get('/Admin/Roles', [AdminController::class, 'Roles']);
        Route::post('/Admin/Roles', [AdminController::class, 'AddRole']);
        Route::get('/Admin/EditRole/{RoleID}', [AdminController::class, 'EditRole']);
        Route::post('/Admin/UpdateRole', [AdminController::class, 'UpdateRole']);
        Route::get('/Admin/DeleteRole/{RoleID}', [AdminController::class, 'DeleteRole']);
        #endregion ROLES


        #region USERS
        Route::get('/Admin/Users', [AdminController::class, 'Users']);
        Route::post('/Admin/Users', [AdminController::class, 'AddUser']);
        Route::get('/Admin/EditUser/{UserID}', [AdminController::class, 'EditUser']);
        Route::post('/Admin/UpdateUser', [AdminController::class, 'UpdateUser']);
        Route::post('/Admin/UpdatePassword', [AdminController::class, 'UpdatePassword']);
        Route::get('/Admin/DeleteUser/{UserID}', [AdminController::class, 'DeleteUser']);
        #endregion USERS

        #region PROJECT CATEGORIES
        Route::get('/Admin/ProjectCategories', [AdminController::class, 'ProjectCategories']);
        Route::post('/Admin/ProjectCategories', [AdminController::class, 'AddProjectCategory']);
        Route::get('/Admin/EditProjectCategory/{ProjectCategoryID}', [AdminController::class, 'EditProjectCategory']);
        Route::post('/Admin/UpdateProjectCategory', [AdminController::class, 'UpdateProjectCategory']);
        Route::get('/Admin/DeleteProjectCategory/{ProjectCategoryID}', [AdminController::class, 'DeleteProjectCategory']);
        #endregion PROJECT TYPES



        #region PROJECTS
        Route::get('/Admin/Projects', [AdminController::class, 'Projects']);
        Route::post('/Admin/Projects', [AdminController::class, 'AddProject']);
        Route::get('/Admin/EditProject/{ProjectID}', [AdminController::class, 'EditProject']);
        Route::post('/Admin/UpdateProject', [AdminController::class, 'UpdateProject']);
        Route::get('/Admin/DeleteProject/{ProjectID}', [AdminController::class, 'DeleteProject']);
        #endregion PROJECTS


    });
    //endregion For Admin Only


    //region For User Only
    Route::middleware(['CheckIfAdmin:0'])->group(function () {
        Route::get('/SetDefaultProject', [UserController::class, 'SetDefaultProject']);
        Route::post('/SetDefaultProject', [UserController::class, 'UpdateDefaultProject']);
        Route::middleware([DefaultProject::class])->group(function () {
            Route::get('/Dashboard', [UserController::class, 'Dashboard']);

            // Route::get('/Dashboard/{ProjectID}', [UserController::class, 'Dashboard'])->middleware('PagesAccess:1');


            #region INITIAL SETUP
            Route::middleware('PagesAccess:3')->group(function () {


                #region GROUP CODES
                Route::get('/GroupCodes', [UserController::class, 'GroupCodes']);
                Route::post('/GroupCodes', [UserController::class, 'AddGroupCode']);
                Route::get('/EditGroupCode/{GroupCodeID}', [UserController::class, 'EditGroupCode'])->middleware('PageActionAccess:3,1');
                Route::post('/UpdateGroupCode', [UserController::class, 'UpdateGroupCode'])->middleware('PageActionAccess:3,1');
                Route::get('/DeleteGroupCode/{GroupCodeID}', [UserController::class, 'DeleteGroupCode'])->middleware('PageActionAccess:3,2');
                #endregion GROUP CODES




                #region CONTROL CODES
                Route::get('/ControlCodes', [UserController::class, 'ControlCodes']);
                Route::post('/ControlCodes', [UserController::class, 'AddControlCode']);
                Route::get('/EditControlCode/{ControlCodeID}', [UserController::class, 'EditControlCode'])->middleware('PageActionAccess:3,1');
                Route::post('/UpdateControlCode', [UserController::class, 'UpdateControlCode'])->middleware('PageActionAccess:3,1');
                Route::get('/DeleteControlCode/{ControlCodeID}', [UserController::class, 'DeleteControlCode'])->middleware('PageActionAccess:3,2');
                #endregion CONTROL CODES



                #region CHART OF ACCOUNTS
                Route::get('/ChartOfAccounts', [UserController::class, 'ChartOfAccounts']);
                Route::post('/ChartOfAccounts', [UserController::class, 'AddChartOfAccount']);
                Route::get('/EditChartOfAccount/{ChartOfAccountID}', [UserController::class, 'EditChartOfAccount'])->middleware('PageActionAccess:3,1');
                Route::post('/UpdateChartOfAccount', [UserController::class, 'UpdateChartOfAccount'])->middleware('PageActionAccess:3,1');
                Route::get('/DeleteChartOfAccount/{ChartOfAccountID}', [UserController::class, 'DeleteChartOfAccount'])->middleware('PageActionAccess:3,2');
                #endregion CONTROL CODES



            });

            #endregion INITIAL SETUP


            #region MANAGEMENT

            Route::middleware('PagesAccess:6')->group(function () {



                #region SUPPLIERS
                Route::get('/Suppliers', [UserController::class, 'Suppliers']);
                Route::post('/Suppliers', [UserController::class, 'AddSupplier']);
                Route::get('/EditSupplier/{SupplierID}', [UserController::class, 'EditSupplier'])->middleware('PageActionAccess:6,1');
                Route::post('/UpdateSupplier', [UserController::class, 'UpdateSupplier'])->middleware('PageActionAccess:6,1');
                Route::get('/DeleteSupplier/{SupplierID}', [UserController::class, 'DeleteSupplier'])->middleware('PageActionAccess:6,2');
                #endregion SUPPLIERS


                #region CUSTOMERS
                Route::get('/Customers', [UserController::class, 'Customers']);
                Route::post('/Customers', [UserController::class, 'AddCustomer']);
                Route::get('/EditCustomer/{CustomerID}', [UserController::class, 'EditCustomer'])->middleware('PageActionAccess:6,1');
                Route::post('/UpdateCustomer', [UserController::class, 'UpdateCustomer'])->middleware('PageActionAccess:6,1');
                Route::get('/DeleteCustomer/{CustomerID}', [UserController::class, 'DeleteCustomer'])->middleware('PageActionAccess:6,2');
                #endregion CUSTOMERS





            });




            #endregion MANAGEMENT


            #region FINANCE

            Route::middleware('PagesAccess:4')->group(function () {

                #region BANKPAYMENTVOUCHERS
                Route::get('/BankPaymentVouchers', [UserController::class, 'BankPaymentVouchers']);
                Route::post('/BankPaymentVouchers', [UserController::class, 'AddBankPaymentVoucher']);
                Route::get('/EditBankPaymentVoucher/{BankPaymentVoucherID}', [UserController::class, 'EditBankPaymentVoucher'])->middleware('PageActionAccess:4,1');
                Route::post('/UpdateBankPaymentVoucher', [UserController::class, 'UpdateBankPaymentVoucher'])->middleware('PageActionAccess:4,1');
                Route::get('/DeleteBankPaymentVoucher/{BankPaymentVoucherID}', [UserController::class, 'DeleteBankPaymentVoucher'])->middleware('PageActionAccess:4,2');
                #endregion BANKPAYMENTVOUCHERS


                #region CASHPAYMENTVOUCHERS
                Route::get('/CashPaymentVouchers', [UserController::class, 'CashPaymentVouchers']);
                Route::post('/CashPaymentVouchers', [UserController::class, 'AddCashPaymentVoucher']);
                Route::get('/EditCashPaymentVoucher/{CashPaymentVoucherID}', [UserController::class, 'EditCashPaymentVoucher'])->middleware('PageActionAccess:4,1');
                Route::post('/UpdateCashPaymentVoucher', [UserController::class, 'UpdateCashPaymentVoucher'])->middleware('PageActionAccess:4,1');
                Route::get('/DeleteCashPaymentVoucher/{CashPaymentVoucherID}', [UserController::class, 'DeleteBankVoucher'])->middleware('PageActionAccess:4,2');
                #endregion CASHPAYMENTVOUCHERS



                #region BANKRECEIPTVOUCHERS
                Route::get('/BankReceiptVouchers', [UserController::class, 'BankReceiptVouchers']);
                Route::post('/BankReceiptVouchers', [UserController::class, 'AddBankReceiptVoucher']);
                Route::get('/EditBankReceiptVoucher/{BankReceiptVoucherID}', [UserController::class, 'EditBankReceiptVoucher'])->middleware('PageActionAccess:4,1');
                Route::post('/UpdateBankReceiptVoucher', [UserController::class, 'UpdateBankReceiptVoucher'])->middleware('PageActionAccess:4,1');
                Route::get('/DeleteBankReceiptVoucher/{BankReceiptVoucherID}', [UserController::class, 'DeleteBankReceiptVoucher'])->middleware('PageActionAccess:4,2');
                #endregion BANKRECEIPTVOUCHERS


                #region CASHRECEIPTVOUCHERS
                Route::get('/CashReceiptVouchers', [UserController::class, 'CashReceiptVouchers']);
                Route::post('/CashReceiptVouchers', [UserController::class, 'AddCashReceiptVoucher']);
                Route::get('/EditCashReceiptVoucher/{CashReceiptVoucherID}', [UserController::class, 'EditCashReceiptVoucher'])->middleware('PageActionAccess:4,1');
                Route::post('/UpdateCashReceiptVoucher', [UserController::class, 'UpdateCashReceiptVoucher'])->middleware('PageActionAccess:4,1');
                Route::get('/DeleteCashReceiptVoucher/{CashReceiptVoucherID}', [UserController::class, 'DeleteCashReceiptVoucher'])->middleware('PageActionAccess:4,2');
                #endregion CASHRECEIPTVOUCHERS


                #region JOURNALVOUCHERS
                Route::get('/JournalVouchers', [UserController::class, 'JournalVouchers']);
                Route::post('/JournalVouchers', [UserController::class, 'AddJournalVoucher']);
                Route::get('/EditJournalVoucher/{JournalVoucherID}', [UserController::class, 'EditJournalVoucher'])->middleware('PageActionAccess:4,1');
                Route::post('/UpdateJournalVoucher', [UserController::class, 'UpdateJournalVoucher'])->middleware('PageActionAccess:4,1');
                Route::get('/DeleteJournalVoucher/{JournalVoucherID}', [UserController::class, 'DeleteJournalVoucher'])->middleware('PageActionAccess:4,2');
                #endregion JOURNALVOUCHERS


                #region BILLS
                Route::get('/Bills', [UserController::class, 'Bills']);
                Route::post('/Bills', [UserController::class, 'AddBill']);
                Route::get('/EditBill/{BillID}', [UserController::class, 'EditBill'])->middleware('PageActionAccess:4,1');
                Route::post('/UpdateBill', [UserController::class, 'UpdateBill'])->middleware('PageActionAccess:4,1');
                Route::get('/DeleteBill/{BillID}', [UserController::class, 'DeleteBill'])->middleware('PageActionAccess:4,2');
                #endregion BILLS


                #region INVOICES
                Route::get('/Invoices', [UserController::class, 'Invoices']);
                Route::post('/Invoices', [UserController::class, 'AddInvoice']);
                Route::get('/EditInvoice/{InvoiceID}', [UserController::class, 'EditInvoice'])->middleware('PageActionAccess:4,1');
                Route::post('/UpdateInvoice', [UserController::class, 'UpdateInvoice'])->middleware('PageActionAccess:4,1');
                Route::get('/DeleteInvoice/{InvoiceID}', [UserController::class, 'DeleteInvoice'])->middleware('PageActionAccess:4,2');
                #endregion INVOICES



            });


            #endregion FINANCE






        });
    });
    //endregion For User Only

    #region AJAX
    Route::get('/GetControlCodesByGroupCodeID/{GroupCodeID}', [MainController::class, 'GetControlCodesByGroupCodeID']);
    Route::get('/GetProjectsByProjectCategoryID/{ProjectCategoryID}', [MainController::class, 'GetProjectsByProjectCategoryID']);
    Route::post('/UsernameValidation', [MainController::class, 'UsernameValidation']);
    Route::post('/EmailValidation', [MainController::class, 'EmailValidation']);
    #endregion AJAX

    Route::get('/Logout', function () {
        Session::forget(['user_id', 'user_name', 'is_admin', 'selected_project_id', 'selected_project_name', 'assigned_projects', 'user_role_page_mapping_data']);
        return redirect('/');
    });
});
