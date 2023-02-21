@extends('Main.Layout.layout')

@section('MainSection')
<form action="/ChartOfAccounts" method="POST">
    @csrf
    <div class="form-group">
        <label for="" style="margin-right:38px">Chart Of Account*</label>
        <input type="text" class="type5" value="{{old('chart_of_account')}}" name="chart_of_account">
        @error('chart_of_account')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>



    <div class="form-group">
        <label for="" style="margin-right:50px">Group Code*</label>
        <select name="group_code_id" id="group_code_id" required class="type2">
            <option disabled value="">Select A Group Code</option>
            @php
            if(count($group_codes)>0):
            foreach($group_codes as $key=>$item):
            @endphp
            <option value="{{$item->group_code_id}}" {{ old('group_code_id')==$item->group_code_id ? 'selected' : ''; }}>{{$item->group_account}}</option>
            @php
            endforeach;
            endif;
            @endphp
        </select>
        @error('group_code_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>


    <div class="form-group ControlCodeFormGroup">
        <label for="" style="margin-right:42px">Control Code*</label>
        <select name="control_code_id" id="control_code_id" required class="type2">
            <option disabled selected value="">Select A Group Code First</option>
        </select>
        @error('control_code_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>


    <div class="form-group">
        <label for="">Opening Balance Debit</label>
        <input type="number" class="type5" name="opening_balance_debit" value="{{old('opening_balance_debit')}}">
        @error('opening_balance_debit')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Opening Balance Credit</label>
        <input type="number" class="type5" name="opening_balance_credit" value="{{old('opening_balance_credit')}}">
        @error('opening_balance_credit')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>


    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>


<table  id="RoleTable" class="table table-responsive-sm">
    <thead class="thead-dark">
        <th>Group Code</th>
        <th>Group Accounts</th>
        <th>Control Code</th>
        <th>Control Description</th>
        <th>Account Codes</th>
        <th>Chart Of Accounts</th>
        <th>Opening Balance Debit</th>
        <th>Opening Balance Credit</th>
        <th class="size"></th>
        <th class="size"></th>
    </thead>
    <tbody>
        @php
        if(count($chart_of_accounts)>0):
        foreach($chart_of_accounts as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->group_code}}</td>
            <td>{{$item->group_account}}</td>
            <td>{{$item->control_code}}</td>
            <td>{{$item->control_description}}</td>
            <td>{{$item->chart_of_account_code}}</td>
            <td>{{$item->chart_of_account}}</td>
            <td>{{$item->opening_balance_debit}}</td>
            <td>{{$item->opening_balance_credit}}</td>
            <td style="text-align:center;"><a href="/EditChartOfAccount/{{$item->chart_of_account_id}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
            <td style="text-align:center;"><a href="/DeleteChartOfAccount/{{$item->chart_of_account_id}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
        </tr>
        @php
        endforeach;
        endif;
        @endphp
    </tbody>
</table>


@endsection


@section('IndividualScript')
<script>
  $('#RoleTable').DataTable();
</script>
<script>
    $(function () {
        var OldControlCode = '<?php echo old('control_code_id'); ?>';
        $('#group_code_id').on('change', function () {
            $('.ControlCodeFormGroup').css({ 'opacity': '0.5', 'pointer-events': 'none' });
            var GroupCodeID = $(this).val();
            $.ajax({
                url: '/GetControlCodesByGroupCodeID/' + GroupCodeID,
                type: 'GET',
                async:false,
                success: function (e) {
                    $('#control_code_id').empty();
                    if (e.length > 0) {
                        $('#control_code_id').append('<option disabled selected>Select A Control Code</option>')
                        $.each(e, function (i, option) {
                            var selected = '';
                            if(OldControlCode==option.control_code_id){
                                selected = 'selected';
                            }

                            $('#control_code_id').append('<option value="' + option.control_code_id + '" '+selected+'>' + option.control_description + '</option>')
                        });
                    } else {
                        $('#control_code_id').append('<option disabled selected>No Control Codes For This Group Code</option>')
                    }
                    $('.ControlCodeFormGroup').css({ 'opacity': '1', 'pointer-events': 'all' });
                }

            })
        });

        $('#group_code_id').val($('#group_code_id').val()).trigger('change');

    });
</script>

@endsection