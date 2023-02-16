@extends('Main.Layout.layout')

@section('MainSection')
<form action="/GroupCodes" method="POST">
    @csrf
    <div class="form-group">
    <label>Group Account</label>
    <input type="text" placeholder="Enter Group Account" class="type5" value="{{ old('group_account') }}" name="group_account">
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
    <div class="form-group">
    <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>

<table class="table">
    <thead class="thead-dark">
        <th>Group Code</th>
        <th>Group Account</th>
        <th>Group Type</th>
        <th></th>
        <th></th>
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