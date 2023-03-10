@extends('User.Layout.layout')

@section('MainSection')

<h2 style="color:black; text-transform:uppercase;">Group Codes</h2>

<form action="/UpdateGroupCode" method="POST">
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
    <input type="text" placeholder="Enter Group Code" class="type5" required value="{{ $result->group_code }}" name="group_code">
    @error('group_code')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group">
    <label>Group Account</label>
    <input type="text" placeholder="Enter Group Account" class="type5" required value="{{ $result->group_account }}" name="group_account">
    @error('group_account')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>

  <div class="form-group">
    <label for="">Group Type</label>
    <select name="group_type_id" required class="type2">
        <option value="0" disabled>Select A Group Type</option>
        @php
        if(count($group_types)>0):
        foreach($group_types as $key=>$item):
        @endphp
        <option value="{{$item->group_type_id}}" {{$result->group_type_id==$item->group_type_id ?'selected' : ''}}>{{$item->group_type}}</option>
        @php
        endforeach;
        endif;
        @endphp
    </select>
    @error('group_type_id')
    <p class="text-danger">{{$message}}</p>
    @enderror
    </div>
    <input type="hidden" value="{{$result->group_code_id}}" name="group_code_id">
</form>

@endsection
@section('IndividualScript')
@endsection