@extends('Main.Layout.layout')

@section('MainSection')

<form action="/ControlTypes" method="POST">
    @csrf
    <div class="form-group">
        <h2>Control Types</h2>
        <label for="">Control Type</label>
    <input type="text" class="type5" placeholder="Enter Control Type" name="control_type">
    @error('control_type')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>

<table class="table">
    <thead class="thead-dark">
        <th>Control Types</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @php
        if(count($control_types)>0):
        foreach($control_types as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->control_type}}</td>
            <td><a href="/EditControlType/{{$item->control_type_id}}">Edit</a></td>
            <td><a
                    href="/DeleteControlType/{{$item->control_type_id}}">Delete</a></td>
        </tr>
        @php
        endforeach;
        endif;
        @endphp
    </tbody>
</table>
@endsection