@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black; text-transform:uppercase;">Control Codes</h2>
<form action="/ControlCodes" method="POST">
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
    <label for="">Control Code*</label>
    <input type="text" class="type5" placeholder="Enter Control Code" value="{{ old('control_code') }}" name="control_code">
    @error('control_code')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group">
    <label for="">Control Description*</label>
    <input type="text" class="type5" placeholder="Enter Control Description" value="{{ old('control_description') }}" name="control_description">
    @error('control_description')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>

  <div class="form-group">
    <label for="" style="margin-right:28px">Control Type</label>
    <select name="control_type_id" required class="type2">
      <option disabled selected>Select A Control Type</option>
      @php
      if(count($control_types)>0):
      foreach($control_types as $key=>$item):
      @endphp
      <option value="{{$item->control_type_id}}">{{$item->control_type}}</option>
      @php
      endforeach;
      endif;
      @endphp
    </select>

    @error('control_type_id')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>

  <div class="form-group">
    <label for="" style="margin-right:28px">Group Code*</label>
    <select name="group_code_id" required class="type2">
      <option disabled selected>Select A Group Code</option>
      @php
      if(count($group_codes)>0):
      foreach($group_codes as $key=>$item):
      @endphp
      <option value="{{$item->group_code_id}}">{{$item->group_account}}</option>
      @php
      endforeach;
      endif;
      @endphp
    </select>
    @error('group_code_id')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>

  <div class="form-group">
    <input type="checkbox" id="isPnL" name="isPnL" class="mr-2"><label for="isPnL">P&L</label>
  </div>

</form>

<table id="RoleTable" class="table table-responsive-sm">
  <thead class="thead-dark">
    <th>Control Code</th>
    <th>Control Description</th>
    <th>Group Code</th>
    <th>Group Account</th>
    <th>Control Type</th>
    <th>P&L</th>
    <th class="size"></th>
    <th class="size"></th>
  </thead>
  <tbody>
    @php
    if(count($control_codes)>0):
    foreach($control_codes as $key=>$item):
    @endphp
    <tr>
      <td>{{$item->control_code}}</td>
      <td>{{$item->control_description}}</td>
      <td>{{$item->group_code}}</td>
      <td>{{$item->group_account}}</td>
      <td>{{$item->control_type}}</td>
      <td>{{$item->isPnL=="1" ? 'P&L' : ''}}</td>
      <td style="text-align:center;"><a href="/EditControlCode/{{$item->control_code_id}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
      <td style="text-align:center;"><a href="/DeleteGroupCode/{{$item->control_code_id}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
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