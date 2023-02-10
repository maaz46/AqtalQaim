@extends('Main.Layout.layout')

@section('MainSection')
@php
if(Session::exists('status')):
echo Session::get('status');
endif;
@endphp
<form action="/UpdateProject" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Project Name*</label>
        <input type="text" placeholder="Enter Project Name" class="type5" value="{{$result->project_name}}"
            name="project_name">
        @error('project_name')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Project Category*</label>
        <select name="project_category_id" class="type2" required>
            <option disabled selected>Select A Project Category</option>
            @php
            if(count($project_categories)>0):
            foreach($project_categories as $key=>$item):
            @endphp
            <option value="{{$item->project_category_id}}" {{$result->project_category_id==$item->project_category_id ?'selected' : ''}}>{{$item->project_category}}</option>
            @php
            endforeach;
            endif;
            @endphp
        </select>

        @error('project_category_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <input type="hidden" name="project_id" value="{{$result->project_id}}">
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>
@endsection