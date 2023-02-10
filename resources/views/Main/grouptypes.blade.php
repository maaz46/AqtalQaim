@extends('Main.Layout.layout')

@section('MainSection')

<form action="/GroupTypes" method="POST">
    @csrf
    <div class="form-group">
        <label>Group Type</label>
        <input type="text" class="type5" placeholder="Enter Group Type" name="group_type">
        @error('group_type')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    
    <div class="form-group">
    <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>

<table class="table">
    <thead class="thead-dark">
        <th>Group Types</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @php
        if(count($group_types)>0):
        foreach($group_types as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->group_type}}</td>
            <td><a href="/EditGroupType/{{$item->group_type_id}}">Edit</a></td>
            <td><a
                    href="/DeleteGroupType/{{$item->group_type_id}}">Delete</a></td>
        </tr>
        @php
        endforeach;
        endif;
        @endphp
    </tbody>
</table>
@endsection