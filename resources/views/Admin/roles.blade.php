@extends('Admin.Layout.layout')

@section('MainSection')


<h2 style="color:black;">USER RIGHTS ROLES</h2>

<form action="/Admin/Roles" method="post">
  @csrf
  <div class="abot1">
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

  <div class="abot2">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <div class="txt">
            <input type="text" class="form-control" name="role_name" placeholder="Enter Role Name">
          </div>
          <div class="form-check">

            @php
            if(count($rights)>0):
            foreach($rights as $key=>$item):
            @endphp
            <input class="form-check-input" name="right_id[]" type="checkbox" value="{{$item->right_id}}" id="CBRight_{{$item->right_id}}">
            <label class="form-check-label" for="CBRight_{{$item->right_id}}">
              {{$item->right_name}}
            </label>
            @php
            endforeach;
            endif;
            @endphp


          </div>

        </div>
      </div>
    </div>
</form>



<table id="RoleTable" class="table table-responsive-sm">
  <thead class="thead-dark">
    <th>User Role ID</th>
    <th>User Roles</th>
    @php
    if(count($rights)>0):
    foreach($rights as $key=>$item):
    @endphp
    <th>{{$item->right_name}}</th>
    @php
    endforeach;
    endif;
    @endphp
    <th></th>
    <th></th>
  </thead>
  <tbody>
    @php
    if(count($roles)>0):
    foreach($roles as $key=>$item):
    @endphp
    <tr>
      <td>{{$item["role_id"]}}</td>
      <td>{{$item['role_name']}}</td>
      @foreach($rights as $key2=>$item2)
      <td>
        @php
        $icontoshow = '';

        foreach($item['rights'] as $key3=>$item3):

        if($item3['right_id']==$item2['right_id']):

        if($item3['has_right']=="1"):
        @endphp
        <i class="fas fa-check text-success"></i>
        @php
          
        else:
        @endphp

        <i class="fas fa-times text-danger"></i>
        @php
        endif;

        endif;

        endforeach
        @endphp

      </td>
      @endforeach
      <td style="text-align:center;"><a href="/Admin/EditRole/{{$item['role_id']}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
      <td style="text-align:center;"><a href="/Admin/DeleteRole/{{$item['role_id']}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
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
@endsection