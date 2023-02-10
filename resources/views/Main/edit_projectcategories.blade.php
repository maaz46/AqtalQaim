@extends('Main.Layout.layout')

@section('MainSection')

<form action="/UpdateProjectCategory" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Project Category Name*</label>
        <input type="text" placeholder="Enter Project Category" class="type5" value="{{$result->project_category}}" name="project_category">
        @error('project_category')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <input type="hidden" value="{{$result->project_category_id}}" required name="project_category_id">
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
    
</form>
@endsection