@extends('Main.Layout.layout')

@section('IndividualStyle')
<style>
      .page_section:not(:first-child){
            margin-top:20px;
      }
</style>
@endsection
@section('MainSection')
<h2 style="color:black;">USERS</h2>


<form action="/Users" id="userform" method="post">
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
                                    <label class="weight" for="user_type" style="margin-right:30px;">Select User Type</label>
                                    <select id="user_type" name="user_type" required class="Maintype" style="color: white;">
                                          <option value="" disabled selected>Select A User Type</option>
                                          <option value="Administrator">Administrator</option>
                                          <option value="User">User</option>
                                    </select>
                              </div>
                              <div class="form">
                                    <label class="weight" style="margin-right:84px;">Full Name</label>
                                    <input type="text" name="full_name" required class="Maintype"><br>

                                    <label class="weight" style="margin-right:82px;">Username</label>
                                    <input type="text" name="user_name" required class="Maintype">

                                    <br>

                                    <label class="weight" style="margin-right:85px;">Password</label>
                                    <input type="password" name="password" required class="Maintype">
                                    <br>

                                    <label class="weight" style="margin-right:20px;">Confirm Password</label>
                                    <input type="password" name="confirm_password" required class="Maintype">
                                    <br>
                                    <label class="weight" style="margin-right:120px;">Email</label>
                                    <input type="email" name="email" required class="Maintype">
                                    <br>
                                    <label class="weight" style="margin-right:132px;">Cell</label>
                                    <input type="tel" name="cell" class="Maintype">
                                    <br>
                                    <div class="sel">
                                          <label class="weight" for="is_block" style="margin-right:88px;">Block Y/N</label>
                                          <input type="checkbox" id="is_block" name="is_block">
                                    </div>

                                    <div class="sel">
                                          <label class="weight" for="can_change_year" style="margin-right:30px;">Can Change Year</label>
                                          <input type="checkbox" id="can_change_year" name="can_change_year">
                                    </div>

                                    
                                    
                                    <div class="AssignMoreProjectsDiv">
                                          
                                    </div>
                                    <div class="text-right">
                                          <button class="btn btn-info btn-sm" type="button" id="BtnAssignMoreProjects">Assign More Projects</button>
                                    </div>
                              </div>

                        </div>

                        <div class="col-md-6" style="padding-left: 65px; border-left:2px solid;" id="col1">
                              <div class="form-check d-none" id="pages_section">

                                    @php
                                    if(count($pages)>0):
                                    foreach($pages as $key=>$item):
                                    @endphp
                                    <input class="form-check-input CBPage" PageID="{{$item->page_id}}" type="checkbox" id="CBPage_{{$item->page_id}}" name="user_role_page_mapping[{{$key}}][page_id]" style="margin-top: 1.0rem;" value="{{$item->page_id}}">
                                    <label class="form-check-label" for="CBPage_{{$item->page_id}}" style="margin-right: 0px;">
                                          {{$item->page_name}}</label><br>
                                    <select id="SelectRole_{{$item->page_id}}" disabled placeholder="Year" name="user_role_page_mapping[{{$key}}][role_id]" class="Maintype1" style="color: white;">
                                          @foreach($roles as $key=>$roleitem)
                                          <option value="{{$roleitem->role_id}}">{{$roleitem->role_name}}</option>
                                          @endforeach
                                    </select>
                                    <br>
                                    @php
                                    endforeach;
                                    endif;
                                    @endphp





                              </div>


                        </div>
                  </div>
            </div>
      </div>
</form>

<div class="table-responsive mt-3">
<table id="RoleTable" class="table">
      <thead class="thead-dark">
            <th>Name</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Cell</th>
            <th>Block Y/N</th>
            <th>Can Change Year</th>
            <th class="size"></th>
            <th class="size"></th>
      </thead>
      <tbody>
            @if(!empty($users))

            @if(count($users)>0)
            @foreach($users as $key=>$item)
            <tr>
                  <td>{{$item->full_name}}</td>
                  <td>{{$item->user_name}}</td>
                  <td>{{$item->email}}</td>
                  <td>{{$item->cell}}</td>
                  <td>{{$item->is_block == "1" ? "Yes" : "No"}}</td>
                  <td>{{$item->can_change_year}}</td>
                  <td style="text-align:center;"><a href="/EditUser/{{$item['user_id']}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
                  <td style="text-align:center;"><a href="/DeleteUser/{{$item['user_id']}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
            </tr>
            @endforeach
            @endif

            @endif
      </tbody>
</table>
</div>

@endsection
@section('IndividualScript')
<script>
      $(function() {
            AssignProjects();
            $('#RoleTable').DataTable();

            $('#BtnAssignMoreProjects').on('click', function(){
                  AssignProjects();
            });;

            $('#user_type').on('change', function() {
                  if ($(this).val() == "Administrator") {
                        $('#pages_section').addClass('d-none');
                  }
                  if ($(this).val() == "User") {
                        $('#pages_section').removeClass('d-none');
                  }
            });

            $('#user_type').val('').trigger('change');
      })

      // $('#project_category_id, #project_id').val('').prop('selected', true);
      // $(document.body).on('change','#project_category_id', function() {
      //       var ProjectCategoryID = $(this).val();
      //       $('#project_id').css({
      //             'opacity': '0.2',
      //             'pointer-events': 'none'
      //       });
      //       $.ajax({
      //             url: '/GetProjectsByProjectCategoryID/' + ProjectCategoryID,
      //             type: 'GET',
      //             async: false,
      //             success: function(e) {
      //                   $('#project_id').empty();
      //                   if (e.length > 0) {
      //                         $('#project_id').append('<option disabled selected>Select A Project</option>')
      //                         $.each(e, function(i, option) {

      //                               $('#project_id').append('<option value="' + option.project_id + '"">' +
      //                                     option.project_name + '</option>')
      //                         });
      //                   } else {
      //                         $('#project_id').append('<option disabled selected>No Projects Were Found</option >');
      //                   }
      //                   $('#project_id').css({
      //                         'opacity': '1',
      //                         'pointer-events': 'all'
      //                   });
      //             }

      //       })
      // });

      $('#userform').on('submit', function(e) {
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

      $('.CBPage').on('change', function() {
            var PageID = $(this).attr('PageID');

            if ($(this).is(':checked')) {
                  $('#SelectRole_' + PageID).prop('disabled', false);
            } else {
                  $('#SelectRole_' + PageID).prop('disabled', true);
            }
      });

      function AssignProjects(){
            $('.AssignMoreProjectsDiv').append('<div class="ProjectSection page_section"><div class="sel">'
            +'<label class="weight" for="project_category_id" style="margin-right:30px;">Project Category</label>'
            +'<select id="" name="project_category_id[]" class="Maintype project_category_id" style="color: white;">'
            +'<option value="" disabled selected>Select A Project Category</option>'
            +'@if(count($project_categories)>0)'
            +'@foreach($project_categories as $key=>$item)'
            +'<option value="{{$item->project_category_id}}">{{$item->project_category}}</option>'
            +'@endforeach @endif '
            +'</select>'
            +'</div>'
            
            +'<div class="sel">'
            +'<label class="weight" for="project_category_id" style="margin-right:30px;">Assign A Project</label>'
            +'<select name="project_id[]" class="Maintype project_id" style="color: white;">'
            +'<option disabled selected value="">Select A Project Category First</option>'
            +'</select>'
            +'</div></div>');
      }

      $(document.body).on('change','.project_category_id',function(){
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

                                    $(ProjectIDSelect).append('<option value="' + option.project_id + '"">' +
                                          option.project_name + '</option>')
                              });
                        } else {
                              $(ProjectIDSelect).append('<option disabled selected>No Projects Were Found</option >');
                        }
                        $(ProjectIDSelect).css({
                              'opacity': '1',
                              'pointer-events': 'all'
                        });
                  }

            })
      });
</script>
@endsection