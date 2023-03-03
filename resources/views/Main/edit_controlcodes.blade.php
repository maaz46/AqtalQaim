@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black; text-transform:uppercase;">Control Codes</h2>
<form action="/UpdateControlCode" method="POST">
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
    <input type="text" class="type5" placeholder="Enter Control Code" value="{{ $result->control_code }}" name="control_code">
    @error('control_code')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group">
    <label for="">Control Description*</label>
    <input type="text" class="type5" placeholder="Enter Control Description" value="{{ $result->control_description }}" name="control_description">
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
      <option value="{{$item->control_type_id}}" {{$result->control_type_id==$item->control_type_id ?'selected' : ''}}>{{$item->control_type}}</option>
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
      <option value="{{$item->group_code_id}}" {{$result->group_code_id==$item->group_code_id ?'selected' : ''}}>{{$item->group_account}}</option>
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
    <input type="checkbox" id="isPnL" name="isPnL" class="mr-2" {{$result->isPnL=="1" ? 'checked' : ''}}><label for="isPnL">P&L</label>
  </div>
  <input type="hidden" name="control_code_id" value="{{$result->control_code_id}}">
</form>

@endsection
@section('IndividualScript')
@endsection