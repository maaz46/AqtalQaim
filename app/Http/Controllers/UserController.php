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

class UserController extends Controller
{
    #region DASHBOARD
    public function Dashboard(Request $req)
    {
        if ($req->session()->get('selected_project_id') == "" && $req->session()->get('selected_project_name') == "") :
            return view('User.userselectdefaultproject');
        else :
            return view('User.userdefaultdashboard');
        endif;
    }

    public function SetDefaultProject()
    {
        return view('User.userselectdefaultproject');
    }

    public function UpdateDefaultProject(Request $req)
    {
        foreach ($req->session()->get('assigned_projects') as $key => $item) :
            if ($item['project_id'] == $req->project_id) :
                $req->session()->put([
                    'selected_project_id' => $req->project_id,
                    'selected_project_name' => $item['project_name']
                ]);

            endif;
        endforeach;
        return redirect('Dashboard');
    }
    #endregion

    #region GroupCode
    public function GroupCodes()
    {
        $SelectedProjectID = Session::get('selected_project_id');
        $group_types = GroupTypes::get();
        $group_codes = GroupCodes::join('group_types', 'group_types.group_type_id', '=', 'group_codes.group_type_id', 'left')->where(['project_id' => $SelectedProjectID])->get(['group_types.group_type', 'group_codes.group_code_id', 'group_codes.group_account', 'group_codes.group_code']);
        return view('User.groupcodes', ['group_types' => $group_types, 'group_codes' => $group_codes]);
    }


    public function AddGroupCode(Request $req)
    {
        $SelectedProjectID = Session::get('selected_project_id');
        $validatedData = $req->validate([
            'group_code' => ['required'],
            'group_account' => ['required'],
            'group_type_id' => ['required'],
        ], [
            'group_code.required' => 'Group Code Field Is Required',
            'group_account.required' => 'Group Account Field Is Required',
            'group_type_id.required' => 'Select A Group Type'
        ]);

        $set_count = GroupCodes::where(['group_code' => $req->group_code, 'group_account' => $req->group_account, 'group_type_id' => $req->group_type_id, 'project_id' => $SelectedProjectID])->get()->count();

        if ($set_count == "0") :
            $group_codes = new GroupCodes();
            $group_codes->group_code = $req->group_code;
            $group_codes->group_account = $req->group_account;
            $group_codes->group_type_id = $req->group_type_id;
            $group_codes->project_id = $SelectedProjectID;
            if ($group_codes->save()) :
                $req->session()->flash('status', 'Group Code Added Successfully');
            else :
                $req->session()->flash('status', 'Some Error Occured');
            endif;

        else :
            $req->session()->flash('status', 'Group Code Not Added | Same Set Already Exists');
        endif;

        return redirect('GroupCodes');
    }


    public function EditGroupCode(Request $req)
    {
        $SelectedProjectID = Session::get('selected_project_id');
        $result = GroupCodes::join('group_types', 'group_types.group_type_id', '=', 'group_codes.group_type_id')->where(['group_codes.group_code_id' => $req->GroupCodeID, 'group_codes.project_id' => $SelectedProjectID]);
        if ($result->count() > 0) :
            $result = $result->first();
            $group_types = GroupTypes::get();
            return view('User.edit_groupcodes', ['group_types' => $group_types, 'result' => $result]);

        else :
            return redirect('GroupCodes');
        endif;
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


    #region Control Code
    public function ControlCodes()
    {
        $SelectedProjectID = Session::get('selected_project_id');
        // SELECT control_codes.control_code_id, control_codes.control_code, control_codes.control_description, GC.group_code_id, GC.group_code, GC.group_account, CT.control_type_id, CT.control_type, control_codes.isPnL FROM `control_codes` AS control_codes 
        //LEFT JOIN control_types AS CT ON control_codes.control_type_id = CT.control_type_id 
        //LEFT JOIN group_codes AS GC ON control_codes.group_code_id = GC.group_code_id 
        //ORDER BY control_codes.control_code ASC; 
        $control_codes = ControlCodes::join('control_types AS CT', 'control_codes.control_type_id', '=', 'CT.control_type_id', 'left')
            ->join('group_codes AS GC', 'control_codes.group_code_id', '=', 'GC.group_code_id', 'left')->orderBy('control_codes.control_code', 'ASC')->where(['GC.project_id' => $SelectedProjectID])->get(
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
        $group_codes = GroupCodes::where(['project_id' => $SelectedProjectID])->get();
        $control_types = ControlTypes::get();
        return view('User.controlcodes', ['group_codes' => $group_codes, 'control_types' => $control_types, 'control_codes' => $control_codes]);
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

        $set_count = ControlCodes::where(['control_code' => $req->control_code, 'control_type_id' => $req->control_type_id, 'group_code_id' => $req->group_code_id])->get()->count();
        if ($set_count == "0") :

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

        else :
            $req->session()->flash('status', 'Control Code Not Added | Same Set Already Exists');
        endif;

        return redirect('ControlCodes');
    }


    public function EditControlCode(Request $req)
    {
        $SelectedProjectID = Session::get('selected_project_id');
        $result = ControlCodes::join('control_types AS CT', 'control_codes.control_type_id', '=', 'CT.control_type_id', 'left')->join('group_codes AS GC', 'control_codes.group_code_id', '=', 'GC.group_code_id', 'left')->where(['control_codes.control_code_id' => $req->ControlCodeID, 'GC.project_id' => $SelectedProjectID]);
        if ($result->count() > 0) :
            $result = $result->first();
            $group_codes = GroupCodes::where(['project_id' => $SelectedProjectID])->get();
            $control_types = ControlTypes::get();
            return view('User.edit_controlcodes', ['group_codes' => $group_codes, 'control_types' => $control_types, 'result' => $result]);

        else :
            return redirect('/ControlCodes');
        endif;
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


    #region CHART OF ACCOUNTS
    public function ChartOfAccounts()
    {
        $SelectedProjectID = Session::get('selected_project_id');
        $group_codes = GroupCodes::where(['project_id' => $SelectedProjectID])->get();
        $project_categories = ProjectCategories::get();
        $chart_of_accounts = ChartOfAccounts::join('control_codes AS CC', 'CC.control_code_id', 'chart_of_accounts.control_code_id', 'left')
            ->join('chart_of_accounts_project_mapping AS COAPM', 'COAPM.chart_of_account_id', '=', 'chart_of_accounts.chart_of_account_id', 'left')
            ->join('group_codes AS GC', 'GC.group_code_id', '=', 'CC.group_code_id', 'left')
            ->where(['GC.project_id' => $SelectedProjectID])->get(['chart_of_accounts.chart_of_account_id', 'GC.group_code', 'GC.group_account', 'CC.control_code', 'CC.control_description', 'chart_of_accounts.chart_of_account_code', 'chart_of_accounts.chart_of_account', 'COAPM.opening_balance_debit', 'COAPM.opening_balance_credit']);

        return view('User.chartofaccounts', ['group_codes' => $group_codes, 'chart_of_accounts' => $chart_of_accounts, 'project_categories' => $project_categories]);
    }


    public function AddChartOfAccount(Request $req)
    {
        $SelectedProjectID = Session::get('selected_project_id');
        $validatedData = $req->validate([
            'chart_of_account_code' => ['required'],
            'chart_of_account' => ['required'],
            'group_code_id' => ['required'],
            'control_code_id' => ['required'],
        ]);

        $chart_of_accounts = new ChartOfAccounts();
        $chart_of_accounts->chart_of_account_code = $req->chart_of_account_code;
        $chart_of_accounts->chart_of_account = $req->chart_of_account;
        $chart_of_accounts->control_code_id = $req->control_code_id;

        if ($chart_of_accounts->save()) :
            $chart_of_account_id = $chart_of_accounts->id;
            $projectstoadd['chart_of_account_id'] = $chart_of_account_id;
            $projectstoadd['project_id'] = $SelectedProjectID;
            $projectstoadd['opening_balance_debit'] = $req->opening_balance_debit;
            $projectstoadd['opening_balance_credit'] = $req->opening_balance_credit;
            ChartOfAccountsProjectMapping::upsert($projectstoadd, ['chart_of_account_id', 'project_id', 'opening_balance_debit', 'opening_balance_credit']);
            $req->session()->flash('status', 'Chart Of Account Added Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;

        return redirect('ChartOfAccounts');
    }


    public function EditChartOfAccount(Request $req)
    {

        $SelectedProjectID = Session::get('selected_project_id');
        $result = ChartOfAccounts::where(['chart_of_accounts.chart_of_account_id' => $req->ChartOfAccountID])
            ->join('control_codes AS CC', 'CC.control_code_id', 'chart_of_accounts.control_code_id', 'left')
            ->join('chart_of_accounts_project_mapping AS COAPM', 'COAPM.chart_of_account_id', '=', 'chart_of_accounts.chart_of_account_id', 'left')
            ->join('group_codes AS GC', 'GC.group_code_id', '=', 'CC.group_code_id', 'left');

        if ($result->count() > 0) :
            $group_codes = GroupCodes::where(['project_id' => $SelectedProjectID])->get();
            $result = $result->first(['chart_of_accounts.chart_of_account_id', 'GC.group_code_id', 'CC.control_code_id', 'chart_of_accounts.chart_of_account_code', 'chart_of_accounts.chart_of_account', 'COAPM.opening_balance_debit', 'COAPM.opening_balance_credit']);
            return view('User.edit_chartofaccounts', ['group_codes' => $group_codes, 'result' => $result]);

        else :
            return redirect('ChartOfAccounts');
        endif;
    }


    public function UpdateChartOfAccount(Request $req)
    {
        $validatedData = $req->validate([
            'chart_of_account_code' => ['required'],
            'chart_of_account' => ['required'],
            'group_code_id' => ['required'],
            'control_code_id' => ['required'],
        ]);
        if (ChartOfAccounts::where(['chart_of_account_id' => $req->chart_of_account_id])->update(['chart_of_account_code' => $req->chart_of_account_code, 'chart_of_account' => $req->chart_of_account, 'control_code_id' => $req->control_code_id])) :
            ChartOfAccountsProjectMapping::where(['chart_of_account_id' => $req->chart_of_account_id])->update(['opening_balance_debit' => $req->opening_balance_debit, 'opening_balance_credit' => $req->opening_balance_credit]);
            $req->session()->flash('status', 'Chart Of Account Update Successfully');
        else :
            $req->session()->flash('status', 'Some Error Occured');
        endif;
        return redirect('ChartOfAccounts');
    }

    #endregion


    #region  SUPPLIERS
    public function Suppliers()
    {
        $chart_of_accounts = ChartOfAccounts::get();
        $suppliers = Suppliers::join('chart_of_accounts AS COA', 'COA.chart_of_account_id', '=', 'suppliers.chart_of_account_id', 'left')->get();
        return view('User.suppliers', ['chart_of_accounts' => $chart_of_accounts, 'suppliers' => $suppliers]);
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
        return view('User.edit_suppliers', ['chart_of_accounts' => $chart_of_accounts, 'result' => $result]);
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
        return view('User.customers', ['chart_of_accounts' => $chart_of_accounts, 'customers' => $customers]);
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
        return view('User.edit_customers', ['chart_of_accounts' => $chart_of_accounts, 'result' => $result]);
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
        return view('User.bankpaymentvouchers');
    }

    #endregion BANKPAYMENTVOUCHER


    #region CASHPAYMENTVOUCHER

    function CashPaymentVouchers()
    {
        return view('User.cashpaymentvouchers');
    }

    #endregion CASHPAYMENTVOUCHER


    #region BANKRECEIPTVOUCHER

    function BankReceiptVouchers()
    {
        return view('User.bankreceiptvouchers');
    }

    #endregion BANKRECEIPTVOUCHER


    #region CASHRECEIPTVOUCHER

    function CashReceiptVouchers()
    {
        return view('User.cashreceiptvouchers');
    }

    #endregion CASHRECEIPTVOUCHER


    #region JOURNALVOUCHERS

    function JournalVouchers()
    {
        return view('User.journalvouchers');
    }

    #endregion JOURNALVOUCHERS


    #region BILLS

    function Bills()
    {
        return view('User.bills');
    }

    #endregion BILLS


    #region INVOICES

    function Invoices()
    {
        return view('User.invoices');
    }

    #endregion INVOICES


    function PrintR($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit;
    }
}
