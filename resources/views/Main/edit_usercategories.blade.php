@extends('Main.Layout.layout')

@section('MainSection')
<form action="/UpdateUserCategory" method="post">
    @csrf
    <div class="about1">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="buttton">
                        <button class=bet>New</button>
                        <button type="submit" class=bet>Save</button>
                        <button class=bet>Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="abott2">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="weight" style="margin-right:px;">Category Code</label>
                        <input type="text" name="user_category_code" value="{{$result->user_category_code}}" name="text"
                            class="type2">
                        @error('user_category_code')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="weight" style="margin-right:18px;">Category Name</label>
                        <input type="text" name="user_category_name" value="{{$result->user_category_name}}" name="text"
                            class="type5">
                        @error('user_category_name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="weight" style="margin-right:8px;">Login Date From</label>
                        <input type="Date" name="login_date_from" value="{{$result->login_date_from}}" class="type6">

                        <br>
                    </div>

                    <div class="form-group">
                        <label class="weight" style="margin-right:30px;">Login Date To</label>
                        <input type="Date" name="login_date_to" value="{{$result->login_date_to}}" class="type6">
                    </div>

                    <input type="hidden" value="{{$result->user_category_id}}" required name="user_category_id">


                </div>
            </div>
        </div>
    </div>
</form>
@endsection