@extends('Main.Layout.layout')

@section('MainSection')
@php
if(Session::exists('status')):
echo Session::get('status');
endif;
@endphp
<form action="/UpdateGroupType" method="POST">
    @csrf

    <div class="form-group">
        <label>Group Type</label>
        <input type="text" class="type5" placeholder="Enter Group Type" value="{{$result->group_type}}" name="group_type">
        @error('group_type')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <input type="hidden" value="{{$result->group_type_id}}" required name="group_type_id">
    <div class="form-group">
    <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>
@endsection
@section('IndividualScript')
<script>
  $('#RoleTable').DataTable();
</script>
@endsection