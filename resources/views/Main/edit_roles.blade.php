@extends('Main.Layout.layout')

@section('MainSection')
@php
if(Session::exists('status')):
echo Session::get('status');
endif;
@endphp
<form action="/UpdateRole" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Role Name*</label>
        <input type="text" placeholder="Enter Role" class="type5" value="{{$result->role_name}}" name="role_name">
        @error('role_name')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <input type="hidden" value="{{$result->role_id}}" required name="role_id">
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>
@endsection