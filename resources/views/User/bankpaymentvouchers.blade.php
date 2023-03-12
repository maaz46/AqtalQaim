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
  <form action="/BankPaymentVouchers" method="post">
    @csrf
    <div class="aboot1">
      <div class="container">
        <div class="row">

          <div class="col-md-12">
            <div class="buon">
              <button class=bet1 type="button">Search</button>
              <button class=bet1 type="button">Prev</button>
              <button class=bet1 type="button">Next</button>
              <button class=bet1 type="button">New</button>
              <button class=bet1 type="submit">Save</button>
              <button class=bet1 type="button">Cancel</button>
              <button class=bet1 type="button">Edit</button>
              <button class=bet1 type="button">Delete</button>
              <button class=bet1 type="button">Approved</button>
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
              <select name="supplier_id" required id="select_supplier_id" class="Maintype" style="color: white;">
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
                <input type="text" name="bank_payment_voucher_code" class="type7" style="margin-bottom:20px;">
                <br>
                <label class="weight" style="margin-right: 38px;">Cheque No.</label>
                <input type="text" name="cheque_no" class="type7"><br>
                <div class="arrange">
                  <label class="weight" style="margin-right:64px;">Date</label>
                  <input type="date" name="bank_payment_voucher_date" class="type5" style="margin-bottom:20px;"><br>
                  <label class="weight">Cheque Date</label>
                  <input type="date" name="cheque_date" class="type5"><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <table id="BankVoucherTable" class="table table-responsive-sm">
      <thead class="thead-dark">
        <th>A/C Code</th>
        <th>A/C Descripton</th>
        <th>Narration</th>
        <th>Ref No.</th>
        <th>Ref Date</th>
        <th>D/C</th>

      </thead>
      <tbody>
      </tbody>
    </table>
    <button class="btn btn-success btn-sm BtnAddMore" type="button">Add More</button>

  </form>

  <form style="margin-top:20px;">
    <div class="col-8">
      <label class="weight">Amount in Words:</label>

      <input type="text" class="bot">

    </div>

  </form>




</div>



@endsection
@section('IndividualScript')
<script>
  $(function() {
    BankVoucherTableStructure();
    $('#select_supplier_id').val('').trigger('change');
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
      $(this).closest('td').find('.COAInfoDiv').html('<p class="mb-0"><small>Control Code: '+ControlCode+'</small></p>'
      +'<p class="mb-0"><small>Group Code: '+GroupCode+'</small></p>');
    });

    $('.BtnAddMore').on('click', function() {
      BankVoucherTableStructure();
    });

  });

  function BankVoucherTableStructure() {
    $('#BankVoucherTable tbody').append('<tr class=TRMain>' +
      '<td class="TDAccountCode"></td>' +
      '<td>' +
      '<select class=sel name=chart_of_account_id[]>' +
      '<option value=""disabled selected>Select Chart Of Account</option>' +
      '@foreach($chart_of_accounts as $key=>$item)' +
      '<option value="{{$item->chart_of_account_id}}" ControlCode="{{$item->control_code}}" GroupCode="{{$item->group_code}}" chartofaccountcode="{{$item->chart_of_account_code}}">{{$item->chart_of_account}}</option>@endforeach' +
      '</select>' +
      '<div class="COAInfoDiv"></div>'+
      '</td>' +
      '<td>' +
      '<textarea name="narration[]"></textarea>' +
      '</td>' +
      '<td>' +
      '<input name="ref_no[]">' +
      '</td>' +
      '<td><input name="ref_date[]" type=date></td>' +
      '<td>' +
      '<select name="DC[]" class="sel">' +
      '<option value="D">D</option>' +
      '<option value="C">C</option>' +
      '</select>' +
      '</td>' +
      '</tr>');
  }
</script>
@endsection