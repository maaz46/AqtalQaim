@extends('Main.Layout.layout')

@section('MainSection')
<form action="/Users" method="POST">
    @csrf
    <div class="form-group">
        <label for="">User Name*</label>
        <input type="text" placeholder="Enter User Name" class="type5" value="{{ old('user_name') }}" name="user_name">
        @error('user_name')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Password*</label>
        <input type="password" placeholder="Enter Password" class="type5" value="{{ old('password') }}" name="password">
        @error('password')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Role*</label>
        <select name="role_id" required class="type2">
            <option disabled selected>Select A Role</option>
            @php
            if(count($roles)>0):
            foreach($roles as $key=>$item):
            @endphp
            <option value="{{$item->role_id}}">{{$item->role_name}}</option>
            @php
            endforeach;
            endif;
            @endphp
        </select>
        @error('role_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>




    <div class="form-group">
        <label for="">Assign A Project*</label>
        <select name="project_id" required class="type2">
            <option disabled selected>Select A Project</option>
            @php
            if(count($projects)>0):
            foreach($projects as $key=>$item):
            @endphp
            <option value="{{$item->project_id}}">{{$item->project_name}}</option>
            @php
            endforeach;
            endif;
            @endphp
        </select>

        @error('project_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>

<table class="table">
    <thead class="thead-dark">
        <th>User Name</th>
        <th>Role Name</th>
        <th>Project Name</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @php
        if(count($users)>0):
        foreach($users as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->user_name}}</td>
            <td>{{$item->role_name}}</td>
            <td>{{$item->project_name}}</td>
            <td><a href="/EditUser/{{$item->user_id}}">Edit</a></td>
            <td><a href="/DeleteUser/{{$item->user_id}}">Delete</a></td>
        </tr>
        @php
        endforeach;
        endif;
        @endphp
    </tbody>
</table>
@endsection