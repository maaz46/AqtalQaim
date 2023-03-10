@extends('User.Layout.layout')
@section('IndividualStyle')
<style>
.link_change_default_project{
    display:none;
}
</style>
@endsection
@section('MainSection')
<form action="/SetDefaultProject" method="post">
    @csrf
    <div class="about1">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="buttton">
                        <button class=bet type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about2">
        <div class="sel">
            <label class="weight" for="project_id" style="margin-right:30px;">Select Default Project</label>
            <select id="" name="project_id" class="Maintype" required style="color: white;">
                <option value="" disabled selected>Select A Default Project</option>
                @foreach(Session::get('assigned_projects') as $key=>$item)
                <option value="{{$item['project_id']}}">{{$item['project_name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
@endsection