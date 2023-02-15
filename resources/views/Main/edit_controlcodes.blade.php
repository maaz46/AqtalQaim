@extends('Main.Layout.layout')

@section('MainSection')

<form action="/UpdateControlCode" method="POST">
    @csrf

    <div class="form-group">
        <label for="">Control Description*</label>
        <input type="text" class="type5" placeholder="Enter Control Description" value="{{ $result->control_description }}" name="control_description">
        @error('control_description')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Control Type</label>
        <select name="control_type_id" required class="type7">
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
        <label for="">Group Code*</label>
    <select name="group_code_id" required class="type7">
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

    @error('group_code_id')
    <p class="text-danger">{{$message}}</p>
    @enderror

    <div class="form-group">
        <input type="checkbox" id="isPnL" name="isPnL" class="mr-2"{{$result->isPnL=="1" ? 'checked' : ''}}><label for="isPnL">P&L</label>
    </div>
    
    <input type="hidden" name="control_code_id" value="{{$result->control_code_id}}">
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>
@endsection