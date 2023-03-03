@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black; text-transform:uppercase;">Group Codes</h2>

<form action="/GroupCodes" method="POST">
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
    <label>Group Code</label>
    <input type="text" placeholder="Enter Group Code" class="type5" required value="{{ old('group_code') }}" name="group_code">
    @error('group_code')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group">
    <label>Group Account</label>
    <input type="text" placeholder="Enter Group Account" class="type5" required value="{{ old('group_account') }}" name="group_account">
    @error('group_account')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>

  <div class="form-group">

    <label for="">Group Type</label>
    <select name="group_type_id" required class="type2">
      <option disabled selected>Select A Group Type</option>
      @php
      if(count($group_types)>0):
      foreach($group_types as $key=>$item):
      @endphp
      <option value="{{$item->group_type_id}}">{{$item->group_type}}</option>
      @php
      endforeach;
      endif;
      @endphp
    </select>

    @error('group_type_id')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
</form>

<table id="RoleTable" class="table table-responsive-sm">
  <thead class="thead-dark">
    <th>Group Code</th>
    <th>Group Account</th>
    <th>Group Type</th>
    <th class="size"></th>
    <th class="size"></th>
  </thead>
  <tbody>
    @php
    if(count($group_codes)>0):
    foreach($group_codes as $key=>$item):
    @endphp
    <tr>
      <td>{{$item->group_code}}</td>
      <td>{{$item->group_account}}</td>
      <td>{{$item->group_type}}</td>
      <td style="text-align:center;"><a href="/EditGroupCode/{{$item->group_code_id}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
      <td style="text-align:center;"><a href="/DeleteGroupCode/{{$item->group_code_id}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
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