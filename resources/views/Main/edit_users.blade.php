@extends('Main.Layout.layout')

@section('MainSection')
<form action="/UpdateUser" method="POST">
    @csrf
    <div class="form-group">
        <label for="">User Name*</label>
        <input type="text" placeholder="Enter User Name" class="type5" value="{{ $result->user_name }}"
            name="user_name">
        @error('user_name')
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
            <option value="{{$item->role_id}}" {{$result->role_id == $item->role_id ? 'selected' :
                ''}}>{{$item->role_name}}
            </option>
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
            <option value="{{$item->project_id}}" {{$result->project_id == $item->project_id ? 'selected' :
                ''}}>{{$item->project_name}}</option>
            @php
            endforeach;
            endif;
            @endphp
        </select>

        @error('project_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <input type="hidden" name="user_id" value="{{$result->user_id}}">
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>
@endsection