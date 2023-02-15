@extends('Main.Layout.layout')

@section('MainSection')
<form action="/UpdateChartOfAccount" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Chart Of Account*</label>
        <input type="text" class="type5" value="{{$result->chart_of_account}}" name="chart_of_account">
        @error('chart_of_account')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>



    <div class="form-group">
        <label for="">Group Code*</label>
        <select name="group_code_id" id="group_code_id" required class="type">
            <option disabled value="">Select A Group Code</option>
            @php
            if(count($group_codes)>0):
            foreach($group_codes as $key=>$item):
            @endphp
            <option value="{{$item->group_code_id}}" {{ $result->group_code_id==$item->group_code_id ? 'selected' : ''; }}>{{$item->group_account}}</option>
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
        <label for="">Control Code*</label>
        <select name="control_code_id" id="control_code_id" required class="type">
            <option disabled selected value="">Select A Group Code First</option>
        </select>
        @error('control_code_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>


    <div class="form-group">
        <label for="">Opening Balance Debit</label>
        <input type="number" class="type5" name="opening_balance_debit" value="{{$result->opening_balance_debit}}">
        @error('opening_balance_debit')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Opening Balance Credit</label>
        <input type="number" class="type5" name="opening_balance_credit" value="{{$result->opening_balance_credit}}">
        @error('opening_balance_credit')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <input type="hidden" value="{{$result->chart_of_account_id}}" name="chart_of_account_id">
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>
@endsection

@section('IndividualScript')

<script>
    $(function () {
        var OldControlCode = '<?php echo $result->control_code_id; ?>';
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