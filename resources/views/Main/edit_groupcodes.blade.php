@extends('Main.Layout.layout')

@section('MainSection')
<form action="/UpdateGroupCode" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Group Account</label>
        <input type="text" placeholder="Enter Group Account" class="type5" value="{{$result->group_account}}" name="group_account">
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
    <input type="hidden" name="group_code_id" value="{{$result->group_code_id}}">
    <input type="submit" value="Submit">
</form>
@endsection