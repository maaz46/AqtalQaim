@extends('Admin.Layout.layout')

@section('MainSection')
<form action="/Admin/UpdateRole" method="post">
    @csrf
    <div class="abot1">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="buttton">
                        <button class=bet>New</button>
                        <button class=bet type="submit">Save</button>
                        <button class=bet>Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="abot2">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="txt">
                        <input type="text" class="form-control" value="{{$result->role_name}}" name="role_name" placeholder="Enter Role Name">
                    </div>
                    <div class="form-check">

                        @php
                        if(count($rightmapping)>0):
                        foreach($rightmapping as $key=>$item):
                        @endphp
                        <input class="form-check-input" name="right_id[]" {{$item->has_right=="1" ? "checked":""}} type="checkbox" value="{{$item->rights_mapping_id}}" id="CBRight_{{$item->right_id}}">
                        <label class="form-check-label" for="CBRight_{{$item->right_id}}">
                            {{$item->right_name}}
                        </label>
                        @php
                        endforeach;
                        endif;
                        @endphp

                    </div>
                    <input type="hidden" value="{{$result->role_id}}" name="role_id">

                </div>
            </div>
        </div>
</form>
@endsection