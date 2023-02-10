@extends('Main.Layout.layout')

@section('MainSection')

<form action="/Roles" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Role Name*</label>
        <input type="text" placeholder="Enter Role" class="type5" name="role_name">
        @error('role_name')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>

<table class="table">
    <thead class="thead-dark">
        <th>Roles</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @php
        if(count($roles)>0):
        foreach($roles as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->role_name}}</td>
            <td><a href="/EditRole/{{$item->role_id}}">Edit</a></td>
            <td><a href="/DeleteRole/{{$item->role_id}}">Delete</a></td>
        </tr>
        @php
        endforeach;
        endif;
        @endphp
    </tbody>
</table>
@endsection