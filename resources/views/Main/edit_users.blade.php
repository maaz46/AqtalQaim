@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black;">USER RIGHTS</h2>


<form action="/UpdateUser" id="userform" method="post">
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
                    <div class="form">
                        <label class="weight" style="margin-right:84px;">Full Name</label>
                        <input type="text" name="full_name" value="{{$result->full_name}}" required class="Maintype"><br>

                        <label class="weight" style="margin-right:82px;">Username</label>
                        <input type="text" name="user_name" value="{{$result->user_name}}" required class="Maintype">

                        <label class="weight" style="margin-right:120px;">Email</label>
                        <input type="email" name="email" value="{{$result->email}}" required class="Maintype">
                        <br>
                        <label class="weight" style="margin-right:132px;">Cell</label>
                        <input type="tel" name="cell" value="{{$result->cell}}" class="Maintype">
                        <br>
                        <div class="sel">
                            <label class="weight" style="margin-right:88px;">Block Y/N</label>
                            <select id="Project Category" placeholder="Project Category" name="block_yn" class="Maintype" style="color: white;">
                                <option value="">Year</option>
                                <option value="2000">2000</option>
                                <option value="2000">2001</option>
                                <option value="2000">2002</option>
                                <option value="2000">2003</option>
                                <option value="2000">2004</option>
                                <option value="2000">2005</option>
                                <option value="2000">2006</option>
                                <option value="2000">2007</option>
                                <option value="2000">2008</option>
                                <option value="2000">2009</option>
                                <option value="2000">2010</option>
                                <option value="2000">2011</option>
                                <option value="2000">2012</option>
                                <option value="2000">2013</option>
                                <option value="2000">2014</option>
                                <option value="2000">2015</option>
                                <option value="2000">2016</option>
                                <option value="2000">2017</option>
                                <option value="2000">2018</option>
                                <option value="2000">2019</option>
                                <option value="2000">2020</option>
                                <option value="2000">2021</option>
                                <option value="2000">2022</option>
                                <option value="2000">2023</option>


                            </select>
                        </div>

                        <div class="sel">
                            <label class="weight" style="margin-right:30px;">Can Change Year</label>
                            <select id="Year" placeholder="Year" class="Maintype" name="can_change_year" style="color: white;">
                                <option value="">Year</option>
                                <option value="2000">2000</option>
                                <option value="2000">2001</option>
                                <option value="2000">2002</option>
                                <option value="2000">2003</option>
                                <option value="2000">2004</option>
                                <option value="2000">2005</option>
                                <option value="2000">2006</option>
                                <option value="2000">2007</option>
                                <option value="2000">2008</option>
                                <option value="2000">2009</option>
                                <option value="2000">2010</option>
                                <option value="2000">2011</option>
                                <option value="2000">2012</option>
                                <option value="2000">2013</option>
                                <option value="2000">2014</option>
                                <option value="2000">2015</option>
                                <option value="2000">2016</option>
                                <option value="2000">2017</option>
                                <option value="2000">2018</option>
                                <option value="2000">2019</option>
                                <option value="2000">2020</option>
                                <option value="2000">2021</option>
                                <option value="2000">2022</option>
                                <option value="2023">2023</option>


                            </select>
                        </div>

                        <div class="sel">
                            <label class="weight" style="margin-right:30px;">Assign To Project</label>
                            <select id="project_id" name="project_id" class="Maintype" style="color: white;">
                                @if(count($projects)>0)
                                @foreach($projects as $key=>$item)
                                <option value="{{$item->project_id}}" {{ $item->project_id == $result->project_id ? 'selected' : '' }}>{{$item->project_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>


                        <div class="sel">
                            <label class="weight" style="margin-right:54px;">User Category</label>
                            <select id="user_category_id" class="Maintype" name="user_category_id" style="color: white;">
                                @if(count($user_categories)>0)
                                @foreach($user_categories as $key=>$item)
                                <option value="{{$item->user_category_id}}" {{ $item->user_category_id == $result->user_category_id ? 'selected' : '' }}>
                                    {{$item->user_category_name}}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>


                    </div>

                </div>

                <div class="col-md-6" style="padding-left: 65px; border-left:2px solid;" id="col1">
                    <div class="form-check">

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

@endsection
@section('IndividualScript')
<script>
    $(function() {
        CheckboxRoleToggle();
    });

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





    // $('input[name="user_name"]').on('keyup', function(){
    //       var UserName = $(this).val();
    //       var obj = new Object();
    //       obj.UserName = UserName;
    //       obj._token = "{{csrf_token()}}";
    //       $.ajax({
    //             url:'/UsernameValidation',
    //             method:'POST',
    //             data:obj,
    //             success:function(e){
    //                   console.log(e);
    //             }
    //       });
    // });

    // $('input[name="email"]').on('keyup', function(){
    //       var Email = $(this).val();
    //       var obj = new Object();
    //       obj.Email = Email;
    //       obj._token = "{{csrf_token()}}";
    //       $.ajax({
    //             url:'/EmailValidation',
    //             method:'POST',
    //             data:obj,
    //             success:function(e){
    //                   console.log(e);
    //             }
    //       });
    // });
</script>
@endsection