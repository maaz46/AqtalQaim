@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black;">USER CATEGORY</h2>


<form action="/UserCategories" method="post">
  @csrf
  <div class="about1">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <div class="buttton">
            <button class=bet>New</button>
            <button type="submit" class=bet>Save</button>
            <button class=bet>Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="abott2">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label class="weight" style="margin-right:px;">Category Code</label>
            <input type="text" name="user_category_code" value="{{old('user_category_code')}}" name="text"
              class="type2">
            @error('user_category_code')
            <p class="text-danger">{{$message}}</p>
            @enderror
          </div>

          <div class="form-group">
            <label class="weight" style="margin-right:18px;">Category Name</label>
            <input type="text" name="user_category_name" value="{{old('user_category_name')}}" name="text"
              class="type5">
            @error('user_category_name')
            <p class="text-danger">{{$message}}</p>
            @enderror
          </div>

          <div class="form-group">
            <label class="weight" style="margin-right:8px;">Login Date From</label>
            <input type="Date" name="login_date_from" value="{{old('login_date_from')}}" class="type6">

            <br>
          </div>

          <div class="form-group">
            <label class="weight" style="margin-right:30px;">Login Date To</label>
            <input type="Date" name="login_date_to" value="{{old('login_date_to')}}" class="type6">
          </div>

        </div>
      </div>
    </div>
  </div>
</form>

<table id="RoleTable" class="table">
  <thead class="thead-dark">
    <th>Category Code</th>
    <th>Category Name</th>
    <th>Login Date From</th>
    <th>Login Date To</th>
    <th class="size"></th>
    <th class="size"></th>
  </thead>
  <tbody>
    @php
    if(count($user_categories)>0):
    foreach($user_categories as $key=>$item):
    @endphp
    <tr>
      <td>{{$item->user_category_code}}</td>
      <td>{{$item->user_category_name}}</td>
      <td>{{$item->login_date_from}}</td>
      <td>{{$item->login_date_to}}</td>
      <td style="text-align:center;"><a href="/EditUserCategory/{{$item->user_category_id}}"><i class="far fa-edit"
            style="font-size:24px;"></i></a></td>
      <td style="text-align:center;"><a href="/DeleteUserCategory/{{$item->user_category_id}}"><i
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
@endsection