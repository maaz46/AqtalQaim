@extends('Main.Layout.layout')

@section('MainSection')
<form action="/Roles" method="post">
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
                        if(count($rights)>0):
                        foreach($rights as $key=>$item):
                        $checked = '';
                        foreach($rightmapping as $key2=>$item2):
                        if($item->right_id==$item2->right_id):
                        if($item2->has_right=="1"):
                        $checked = 'checked';
                        endif;
                        endif;
                        endforeach;
                        @endphp
                        <input class="form-check-input" name="right_id[]" {{$checked}} type="checkbox" value="{{$item->right_id}}" id="CBRight_{{$item->right_id}}">
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