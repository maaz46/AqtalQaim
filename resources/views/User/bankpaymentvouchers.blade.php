@extends('User.Layout.layout')

@section('MainSection')
<div class="tm-main">
  <!-- Home section -->


  <div class="first" style="text-decoration: 2px underline #006699">
    <h2 class="tm-text-primary">AQT - Al Qaim Trust Pakistan</h2>
  </div>
  <div class="second">
    <h3 class="tm-text-primary" style="color:black;">{{Session::get('selected_project_name')}}</h3>
  </div>
  <img src="{{asset('assets/MainAssets/img/AQT Logo.PNG')}}" class="pikss">


  <div class="cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="first">
            <h2 class="tm-text-primary">Bank Payment Voucher</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <form action="/BankPaymentVouchers" id="FormBankPaymentVoucher" method="post">
    @csrf
    <div class="aboot1">
      <div class="container">
        <div class="row">

          <div class="col-md-12">
            <div class="buon">
              <button class="bet1 BtnSearch" type="button">Search</button>
              <button class="bet1 BtnPrev" type="button">Prev</button>
              <button class="bet1 BtnNext" type="button">Next</button>
              <button class="bet1 BtnNew" type="button">New</button>
              <button class="bet1 BtnSave" type="submit" disabled>Save</button>
              <button class="bet1 BtnCancel" type="button" disabled>Cancel</button>
              <button class="bet1 BtnEdit" type="button">Edit</button>
              <button class="bet1 BtnDelete" type="button">Delete</button>
              <button class="bet1 BtnApproved" type="button">Approved</button>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="aboot2">
      <div class="container">
        <div class="row">

          <div class="col-md-12">
            <div class="first">
              <h4 class="tm-text-primary" style="text-decoration: underline;">Party Information</h4>
            </div>
            <div class="sel">
              <label class="weight" style="margin-right:12px;">Select A Party</label>
              <select name="supplier_id" disabled required id="select_supplier_id" class="Maintype FormField" style="color: white;">
                <option value="" disabled selected>Select A Party</option>
                <option value="0">Custom Party Name</option>
                @foreach($suppliers as $key=>$item)
                <option value="{{$item->supplier_id}}" ChartOfAccountID="{{$item->chart_of_account_id}}">{{$item->supplier_name}}</option>
                @endforeach
              </select>
            </div>
            <div id="CustomPartyNameDiv"></div>


          </div>
        </div>
      </div>
    </div>

    <div class="aboot3">
      <div class="container">
        <div class="row">

          <div class="col-md-12">
            <div class="first">
              <h4 class="tm-text-primary" style="text-decoration: underline;">Payment Details</h4>
            </div>


          </div>
          <div class="aboot4">
            <div class="col-md-12">
              <div class="form">
                <label class="weight" style="margin-right: 96px;">BPV</label>
                <input type="text" disabled name="bank_payment_voucher_code" class="type7 FormField" style="margin-bottom:20px;">
                <br>
                <label class="weight" style="margin-right: 38px;">Cheque No.</label>
                <input type="text" disabled name="cheque_no" class="type7 FormField"><br>
                <div class="arrange">
                  <label class="weight" style="margin-right:64px;">Date</label>
                  <input type="date" disabled name="bank_payment_voucher_date" class="type5 FormField" style="margin-bottom:20px;"><br>
                  <label class="weight">Cheque Date</label>
                  <input type="date" disabled name="cheque_date" class="type5 FormField"><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <table id="BankVoucherTable" class="table table-responsive-sm">
      <thead class="thead-dark">
        <th>Action</th>
        <th>A/C Code</th>
        <th>A/C Descripton</th>
        <th>Narration</th>
        <th>Ref No.</th>
        <th>Ref Date</th>
        <th>D/C</th>
        <th>Amount</th>

      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="7"></th>
          <th>
            <p class="mb-0 d-flex justify-content-between align-items-center">Debit:<span id="TotalDebitAmount">0</span></p>
            <p class="mb-0 d-flex justify-content-between align-items-center">Credit:<span id="TotalCreditAmount">0</span></p>
            <p class="mb-0 d-flex justify-content-between align-items-center">Difference:<span id="TotalDifferenceAmount">0</span></p>
          </th>
        </tr>
      </tfoot>
    </table>
    <button class="btn btn-success btn-sm BtnAdd FormField" disabled type="button">Add</button>

  </form>

  <form style="margin-top:20px;">
    <div class="col-8">
      <label class="weight">Amount in Words:</label>

      <input type="text" class="bot">

    </div>

  </form>




</div>

<div class="modal fade" id="RemoveRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center">Are you sure you want to remove this row?</p>
        <div class="text-center">
          <button class="btn btn-success btn-sm rounded-0 BtnConfirmRemoveRow">Yes</button>
          <button class="btn btn-danger btn-sm rounded-0" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@section('IndividualScript')
<script>
  $(function() {
    ResetFields();
    // BankVoucherTableStructure();
    $('#select_supplier_id').on('change', function() {
      $('#CustomPartyNameDiv').empty();
      var SupplierID = $(this).val();
      if (SupplierID != "0") {
        var ChartOfAccountID = $('#select_supplier_id option:selected').attr('ChartOfAccountID');
        $('select[name="chart_of_account_id[]"]').val(ChartOfAccountID).trigger('change');
      } else {
        $('#CustomPartyNameDiv').html('<label class="weight" style="margin-right: 96px;">Enter Party Name</label><input type="text" name="party_name" class="type7" required style="margin-bottom:20px;">');
      }
    });

    $(document.body).on('change', 'select[name="chart_of_account_id[]"]', function() {
      $(this).closest('tr').find('.TDAccountCode').empty();
      var ChartOfAccountID = $(this).val();
      var ChartOfAccountCode = $(this).find('option:selected').attr('ChartOfAccountCode');
      var ControlCode = $(this).find('option:selected').attr('ControlCode');
      var GroupCode = $(this).find('option:selected').attr('GroupCode');
      $(this).closest('tr').find('.TDAccountCode').text(ChartOfAccountCode);
      $(this).closest('td').find('.COAInfoDiv').html('<p class="mb-0"><small>Control Code: ' + ControlCode + '</small></p>' +
        '<p class="mb-0"><small>Group Code: ' + GroupCode + '</small></p>');
    });

    $('.BtnAdd').on('click', function() {
      BankVoucherTableStructure();
    });

    $('.BtnNew').on('click', function() {
      ResetFields();
      $('.FormField').prop('disabled', false);
      $('.BtnSearch, .BtnPrev, .BtnNext, .BtnNew, .BtnEdit, .BtnDelete, .BtnApproved').prop('disabled', true);
      $('.BtnSave, .BtnCancel').prop('disabled', false);
    });


    $('.BtnCancel').on('click', function() {
      // ResetFields();
      $('.FormField').prop('disabled', true);
      $('.BtnSearch, .BtnPrev, .BtnNext, .BtnNew, .BtnEdit, .BtnDelete, .BtnApproved').prop('disabled', false);
      $('.BtnSave, .BtnCancel').prop('disabled', true);
    });
    $('.BtnCancel').click();

    $('.BtnEdit').on('click', function() {
      // ResetFields();
      $('.FormField').prop('disabled', false);
      $('.BtnSearch, .BtnPrev, .BtnNext, .BtnNew, .BtnEdit, .BtnDelete, .BtnApproved').prop('disabled', true);
      $('.BtnCancel').prop('disabled', false);
    });

    $(document.body).on('keyup', 'input[name="amount[]"]', function() {
      Calculation();
    });

    $(document.body).on('change', 'select[name="DC[]"]', function() {
      Calculation();
    });

    $(document.body).on('click', '.BtnRemoveRow', function() {
      $('#RemoveRowModal').attr('TRIndexToRemove', $(this).closest('tr').index());
      $('#RemoveRowModal').modal('show');
    });

    $('.BtnConfirmRemoveRow').on('click', function() {
      var TRIndexToRemove = $('#RemoveRowModal').attr('TRIndexToRemove');
      $('.TRMain').eq(TRIndexToRemove).remove();
      Calculation();
      if ($('.TRMain').length == 0) {
        $('#BankVoucherTable tbody').html('<tr class="TRNoData"><td colspan="8" class="text-center">No data available in table</td></tr>');

      }
      $('#RemoveRowModal').modal('hide');
    });

    $('#FormBankPaymentVoucher').on('submit', function(e) {
      var isGoodToGo = true;
      if (Calculation() === false) {
        isGoodToGo = false;
        alert('Voucher Not Balanced');
      }
      var isAllChartOfAccountSelected = true;
      if ($('.TRMain').length > 0) {

        $('select[name="chart_of_account_id[]"]').each(function() {
          if ($(this).val() == null) {
            isAllChartOfAccountSelected = false;
          }
        });
        if (isAllChartOfAccountSelected === false) {
          isGoodToGo = false;
          alert('No Empty Chart Of Account Allowed');
        }
      } else {
        isGoodToGo = false;
        alert('No Empty Chart Of Account Allowed');
      }
      if (isGoodToGo === false) {
        e.preventDefault();
      }

    });

  });

  function Calculation() {
    var TotalDebitAmount = 0;
    var TotalCreditAmount = 0;
    var TotalDifferenceAmount = 0;

    $('select[name="DC[]"]').each(function() {
      console.log($(this).val());
      var DC = $(this).val();
      var Amount = $(this).closest('tr').find('input[name="amount[]"]').val();
      if (DC == "D") {
        TotalDebitAmount += parseFloat(Amount);
      }
      if (DC == "C") {
        TotalCreditAmount += parseFloat(Amount);
      }
    });

    TotalDifferenceAmount = TotalDebitAmount - TotalCreditAmount;
    $('#TotalDebitAmount').text(TotalDebitAmount);
    $('#TotalCreditAmount').text(TotalCreditAmount);
    $('#TotalDifferenceAmount').text(TotalDifferenceAmount);

    var isGoodToGo = false;
    if (parseFloat(TotalCreditAmount) > 0 || parseFloat(TotalCreditAmount) > 0) {
      if (parseFloat(TotalDifferenceAmount) == 0) {
        isGoodToGo = true;
      }
    }
    return isGoodToGo;
  }

  function BankVoucherTableStructure() {
    $('.TRNoData').remove();
    $('#BankVoucherTable tbody').append('<tr class="TRMain">' +
      '<td class="TDAction"><div class="text-center"><a href="javascript:void(0)" class="BtnRemoveRow"><i class="fas fa-trash"></i></a></div></td>' +
      '<td class="TDAccountCode"></td>' +
      '<td>' +
      '<select class="sel FormField" name="chart_of_account_id[]">' +
      '<option value=""disabled selected>Select Chart Of Account</option>' +
      '@foreach($chart_of_accounts as $key=>$item)' +
      '<option value="{{$item->chart_of_account_id}}" ControlCode="{{$item->control_code}}" GroupCode="{{$item->group_code}}" chartofaccountcode="{{$item->chart_of_account_code}}">{{$item->chart_of_account}}</option>@endforeach' +
      '</select>' +
      '<div class="COAInfoDiv"></div>' +
      '</td>' +
      '<td>' +
      '<textarea class="FormField" name="narration[]"></textarea>' +
      '</td>' +
      '<td>' +
      '<input class="FormField" name="ref_no[]">' +
      '</td>' +
      '<td><input class="FormField" name="ref_date[]" type=date></td>' +
      '<td>' +
      '<select name="DC[]" class="sel FormField">' +
      '<option value="D">D</option>' +
      '<option value="C">C</option>' +
      '</select>' +
      '</td>' +
      '<td><input class="FormField" name="amount[]" value="0" type="number"></td>' +
      '</tr>');
  }

  function ResetFields() {
    $('#BankVoucherTable tbody').html('<tr class="TRNoData"><td colspan="8" class="text-center">No data available in table</td></tr>');
    $('select[name="supplier_id"]').val('').trigger('change');
    $('input[name="bank_payment_voucher_code"]').val('');
    $('input[name="bank_payment_voucher_date"]').val('');
    $('input[name="cheque_no"]').val('');
    $('input[name="cheque_date"]').val('');
    Calculation();
  }
</script>
@endsection