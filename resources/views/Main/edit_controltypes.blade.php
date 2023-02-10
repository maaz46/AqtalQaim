@extends('Main.Layout.layout')

@section('MainSection')
@php
if(Session::exists('status')):
echo Session::get('status');
endif;
@endphp
<form action="/UpdateControlType" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Control Type</label>
    <input type="text" class="type5" value="{{$result->control_type}}" placeholder="Enter Control Type" name="control_type">
    @error('control_type')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <input type="hidden" value="{{$result->control_type_id}}" required name="control_type_id">
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>
@endsection