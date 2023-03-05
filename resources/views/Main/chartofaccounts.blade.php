@extends('Main.Layout.layout')
@section('IndividualStyle')
<style>
    .page_section:not(:first-child) {
        margin-top: 20px;
    }

    .btn_project_remove {
        cursor: pointer;
    }

    .page_section:first-child .btn_project_remove {
        display: none;
    }

    .page_section {
        display: flex;
        align-items: center;
    }
</style>
@endsection
@section('MainSection')

<h2 style="color:black; text-transform:uppercase;">Chart Of Accounts</h2>

<form action="/ChartOfAccounts" method="POST">
    @csrf
    <div class="about1">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="buttton">
                        <button class=bet>New</button>
                        <button class=bet type="submit">Save</button>
                        <button class=bet>Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="" style="margin-right:20px">Chart Of Account Code*</label>
        <input type="text" class="type5" value="{{old('chart_of_account_code')}}" name="chart_of_account_code">
        @error('chart_of_account_code')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="" style="margin-right:62px">Chart Of Account*</label>
        <input type="text" class="type5" value="{{old('chart_of_account')}}" name="chart_of_account">
        @error('chart_of_account')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>



    <div class="form-group">
        <label for="" style="margin-right:76px">Group Code*</label>
        <select name="group_code_id" id="group_code_id" required class="type2">
            <option disabled value="">Select A Group Code</option>
            @php
            if(count($group_codes)>0):
            foreach($group_codes as $key=>$item):
            @endphp
            <option value="{{$item->group_code_id}}" {{ old('group_code_id')==$item->group_code_id ? 'selected' : '';
                }}>{{$item->group_account}}</option>
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
        <label for="" style="margin-right:70px">Control Code*</label>
        <select name="control_code_id" id="control_code_id" required class="type2">
            <option disabled selected value="">Select A Group Code First</option>
        </select>
        @error('control_code_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div id="ProjectsDiv" class="projects_div">

    </div>
</form>


<table id="RoleTable" class="table table-responsive-sm">
    <thead class="thead-dark">
        <th>Group Code</th>
        <th>Group Accounts</th>
        <th>Control Code</th>
        <th>Control Description</th>
        <th>Account Codes</th>
        <th>Chart Of Accounts</th>
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
            <td style="text-align:center;"><a href="/EditChartOfAccount/{{$item->chart_of_account_id}}"><i
                        class="far fa-edit" style="font-size:24px;"></i></a></td>
            <td style="text-align:center;"><a href="/DeleteChartOfAccount/{{$item->chart_of_account_id}}"><i
                        class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
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
            $('.ControlCodeFormGroup').css({
                'opacity': '0.5',
                'pointer-events': 'none'
            });
            var GroupCodeID = $(this).val();
            $.ajax({
                url: '/GetControlCodesByGroupCodeID/' + GroupCodeID,
                type: 'GET',
                async: false,
                success: function (e) {
                    $('#control_code_id').empty();
                    if (e.length > 0) {
                        $('#control_code_id').append('<option disabled selected>Select A Control Code</option>')
                        $.each(e, function (i, option) {
                            var selected = '';
                            if (OldControlCode == option.control_code_id) {
                                selected = 'selected';
                            }

                            $('#control_code_id').append('<option value="' + option.control_code_id + '" ' + selected + '>' + option.control_description + '</option>')
                        });
                    } else {
                        $('#control_code_id').append('<option disabled selected>No Control Codes For This Group Code</option>')
                    }
                    $('.ControlCodeFormGroup').css({
                        'opacity': '1',
                        'pointer-events': 'all'
                    });
                }

            })
        });

        $('#group_code_id').val($('#group_code_id').val()).trigger('change');
        $('#ProjectsDiv').html('<div class="AssignMoreProjectsDiv"> </div><div class="text-right"> <button class="btn btn-info btn-sm" type="button" id="BtnAssignMoreProjects">Assign More Projects</button> </div>');

        $(document.body).on('change', '.project_category_id', function () {
            var ProjectSection = $(this).attr('ProjectSection');
            var ProjectIDSelect = $(this).closest('.ProjectSection').find('.project_id');

            var ProjectCategoryID = $(this).val();
            $(ProjectIDSelect).css({
                'opacity': '0.2',
                'pointer-events': 'none'
            });
            $.ajax({
                url: '/GetProjectsByProjectCategoryID/' + ProjectCategoryID,
                type: 'GET',
                async: false,
                success: function (e) {
                    $(ProjectIDSelect).empty();
                    if (e.length > 0) {
                        $(ProjectIDSelect).append('<option value="" disabled selected>Select A Project</option>')
                        $.each(e, function (i, option) {

                            $(ProjectIDSelect).append('<option value="' + option.project_id + '">' + option.project_name + '</option>')
                        });
                    } else {
                        $(ProjectIDSelect).append('<option value="" disabled selected>No Projects Were Found</option >');
                    }
                    $(ProjectIDSelect).css({
                        'opacity': '1',
                        'pointer-events': 'all'
                    });
                }

            });
        });

        $(document.body).on('click', '.BtnProjectRemove', function () {
            $(this).closest('.ProjectSection').remove();
        });

        $(document.body).on('click', '#BtnAssignMoreProjects', function () {
            AssignProjects();
        });

        AssignProjects();

    });

    function AssignProjects() {
        $('.AssignMoreProjectsDiv').append('<div class="ProjectSection page_section"><div><div class="sel">' +
            '<label class="weight" for="project_category_id" style="margin-right:30px;">Project Category</label>' +
            '<select id="" name="project_category_id[]" class="Maintype project_category_id" style="color: white;">' +
            '<option value="" disabled selected>Select A Project Category</option>' +
            '@if(count($project_categories)>0)' +
            '@foreach($project_categories as $key=>$item)' +
            '<option value="{{$item->project_category_id}}">{{$item->project_category}}</option>' +
            '@endforeach @endif ' +
            '</select>' +
            '</div>'

            +
            '<div class="sel">' +
            '<label class="weight" for="project_category_id" style="margin-right:30px;">Assign A Project</label>' +
            '<select name="project_id[]" required class="Maintype project_id" style="color: white;">' +
            '<option disabled selected value="">Select A Project Category First</option>' +
            '</select>' +
            '</div>'

            +
            '<div class="form-group">' +
            '<label for="" style="margin-right:20px">Opening Balance Debit</label> <input type="number" class="type5" name="opening_balance_debit[]">' +
            '</div>'

            +
            '<div class="form-group">' +
            '<label for="" style="margin-right:20px">Opening Balance Credit</label> <input type="number" class="type5" name="opening_balance_credit[]">' +
            '</div>'

            +
            '</div><i class="fas fa-trash bg-danger text-white p-2 rounded BtnProjectRemove btn_project_remove"></i></div>');
    }
</script>

@endsection