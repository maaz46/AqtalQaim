@extends('Admin.Layout.layout')

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

<h2 style="color:black;">Edit User</h2>


<form action="/Admin/UpdateUser" id="userform" method="post">
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

    <div class="about2">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <div class="sel">
                        <label class="weight" for="user_type" style="margin-right:30px;">Select User
                            Type</label>
                        <select id="user_type" name="user_type" required class="Maintype" style="color: white;">
                            <option value="" disabled>Select A User Type</option>
                            <option value="Administrator" {{ $result->is_admin =="1" ? "selected" : "" }}>Administrator</option>
                            <option value="User" {{ $result->is_admin =="0" ? "selected" : "" }}>User</option>
                        </select>
                    </div>
                    <div class="form">
                        <label class="weight" style="margin-right:84px;">Full Name</label>
                        <input type="text" name="full_name" value="{{$result->full_name}}" required class="Maintype"><br>

                        <label class="weight" style="margin-right:82px;">Username</label>
                        <input type="text" name="user_name" value="{{$result->user_name}}" required class="Maintype">

                        <br>

                        <label class="weight" style="margin-right:85px;">Password</label>
                        <button class="btn btn-info btn-sm mb-3" data-toggle="modal" data-target="#ChangePasswordModal" type="button">Change Password</button>
                        <br>

                        <label class="weight" style="margin-right:120px;">Email</label>
                        <input type="email" name="email" value="{{$result->email}}" required class="Maintype">
                        <br>
                        <label class="weight" style="margin-right:132px;">Cell</label>
                        <input type="tel" name="cell" value="{{$result->cell}}" class="Maintype">
                        <br>
                        <div class="sel">
                            <label class="weight" for="is_block" style="margin-right:88px;">Block
                                Y/N</label>
                            <input type="checkbox" id="is_block" {{$result->is_block=="1" ? "checked" : ""}} name="is_block">
                        </div>

                        <div class="sel">
                            <label class="weight" for="can_change_year" style="margin-right:30px;">Can
                                Change Year</label>
                            <input type="checkbox" id="can_change_year" {{$result->can_change_year=="1" ? "checked" : ""}} name="can_change_year">
                        </div>


                        <div id="ProjectsDiv" class="projects_div d-none">
                            <div class="AssignMoreProjectsDiv">
                                @foreach($user_project_mapping as $user_project_mapping_item)
                                <div class="ProjectSection page_section">
                                    <div>
                                        <div class="sel">
                                            <label class="weight" for="project_category_id" style="margin-right:30px;">Project Category</label>
                                            <select id="" name="project_category_id[]" AssignedProjectID="{{$user_project_mapping_item['project_id']}}" class="Maintype project_category_id" style="color: white;">
                                                <option value="" disabled selected>Select A Project Category</option>
                                                @if(count($project_categories)>0)
                                                @foreach($project_categories as $key=>$item)
                                                <option value="{{$item->project_category_id}}" {{ $item->project_category_id==$user_project_mapping_item['project_category_id'] ? 'selected' : '' }}>{{$item->project_category}}</option>
                                                @endforeach @endif
                                            </select>
                                        </div>


                                        <div class="sel">
                                            <label class="weight" for="project_category_id" style="margin-right:30px;">Assign A Project</label>
                                            <select name="project_id[]" required class="Maintype project_id" style="color: white;">
                                                <option disabled selected value="">Select A Project Category First</option>
                                            </select>
                                        </div>
                                    </div><i class="fas fa-trash bg-danger text-white p-2 rounded BtnProjectRemove btn_project_remove"></i>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-right">
                                <button class="btn btn-info btn-sm" type="button" id="BtnAssignMoreProjects">Assign More Projects</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6" style="padding-left: 65px; border-left:2px solid;" id="col1">
                    <div id="pages_section" class="form-check {{ $result->is_admin=='1' ? 'd-none' : '' }}">

                        @php
                        if(count($pages)>0):
                        $user_role_page_mapping_id_hidden = "";
                        foreach($pages as $key=>$item):

                        $role_id = "";
                        $checked = "";
                        $user_role_page_mapping_id = "";

                        foreach($user_role_page_mapping as $key2=>$item2):

                        if($item->page_id == $item2->page_id):

                        if($item2->has_access=="1"):
                        $checked = 'checked';
                        $role_id = $item2->role_id;
                        endif;

                        $user_role_page_mapping_id = $item2->user_role_page_mapping_id;
                        endif;

                        endforeach;
                        @endphp



                        <input type="hidden" name="user_role_page_mapping[{{$key}}][user_role_page_mapping_id]" value="{{ $user_role_page_mapping_id }}">

                        <input class="form-check-input CBPage" PageID="{{$item->page_id}}" type="checkbox" id="CBPage_{{$item->page_id}}" name="user_role_page_mapping[{{$key}}][page_id]" {{$checked}} style="margin-top: 1.0rem;" value="{{$item->page_id}}">

                        <label class="form-check-label" for="CBPage_{{$item->page_id}}" style="margin-right: 0px;">
                            {{$item->page_name}}</label><br>
                        <select id="SelectRole_{{$item->page_id}}" disabled placeholder="Year" name="user_role_page_mapping[{{$key}}][role_id]" class="Maintype1" style="color: white;">
                            @foreach($roles as $key=>$roleitem)
                            <option value="{{$roleitem->role_id}}" {{$roleitem->role_id == $role_id ? 'selected' : ''}}>{{$roleitem->role_name}}</option>
                            @endforeach
                        </select>


                        <br>
                        @php
                        endforeach;
                        endif;
                        @endphp




                        <input type="hidden" value="{{$result->user_id}}" name="user_id">
                    </div>


                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="ChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ChangePasswordForm" action="/Admin/UpdatePassword" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" required name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                <input type="hidden" value="{{$result->user_id}}" name="user_id">
            </form>
        </div>
    </div>
</div>

@endsection
@section('IndividualScript')
<script>
    $(function() {
        CheckboxRoleToggle();
        if ($('.ProjectSection').length == 0) {
            AssignProjects();
        }
        $('#BtnAssignMoreProjects').on('click', function() {
            AssignProjects();
        });
        $('#user_type').on('change', function() {
            if ($(this).val() == "Administrator") {
                $('#pages_section, #ProjectsDiv').addClass('d-none');
            }
            if ($(this).val() == "User") {
                $('#pages_section, #ProjectsDiv').removeClass('d-none');
            }
        });
        $('#user_type').trigger('change');

        $(document.body).on('click', '.BtnProjectRemove', function() {
            $(this).closest('.ProjectSection').remove();
        })
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
            '</div></div><i class="fas fa-trash bg-danger text-white p-2 rounded BtnProjectRemove btn_project_remove"></i></div>');
    }

    function CheckboxRoleToggle() {
        $('.CBPage').each(function() {
            var PageID = $(this).attr('PageID');
            if ($(this).is(':checked')) {
                $('#SelectRole_' + PageID).prop('disabled', false);
            } else {
                $('#SelectRole_' + PageID).prop('disabled', true);
            }
        });
    }

    $('.CBPage').on('change', function() {
        var PageID = $(this).attr('PageID');

        if ($(this).is(':checked')) {
            $('#SelectRole_' + PageID).prop('disabled', false);
        } else {
            $('#SelectRole_' + PageID).prop('disabled', true);
        }
    });
    $('#RoleTable').DataTable();

    $('#ChangePasswordForm').on('submit', function(e) {
        var GoodToGo = true;
        var password = $('input[name="password"]').val();
        var confirmpassword = $('input[name="confirm_password"]').val();
        if (password != confirmpassword) {
            GoodToGo = false;
            alert('Password doesnt match');
        }

        if (GoodToGo == false) {
            e.preventDefault();
        }
    });

    $(document.body).on('change', '.project_category_id', function() {
        var AssignedProjectID = $(this).attr('AssignedProjectID');
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
            success: function(e) {
                $(ProjectIDSelect).empty();
                if (e.length > 0) {
                    $(ProjectIDSelect).append('<option disabled selected>Select A Project</option>')
                    $.each(e, function(i, option) {
                        var Selected = "";
                        if (AssignedProjectID) {
                            if (AssignedProjectID == option.project_id) {
                                Selected = "selected";
                            }
                        }
                        $(ProjectIDSelect).append('<option value="' + option.project_id + '" ' + Selected + '>' + option.project_name + '</option>')
                    });
                } else {
                    $(ProjectIDSelect).append('<option disabled selected>No Projects Were Found</option >');
                }
                $(ProjectIDSelect).css({
                    'opacity': '1',
                    'pointer-events': 'all'
                });
            }

        });
    });
    $('.project_category_id').trigger('change');
</script>
@endsection