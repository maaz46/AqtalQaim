@extends('Main.Layout.layout')

@section('MainSection')

<h1>maaz did this new work {{Session::get('user_name')}}</h1>
<div class="btn">Button</div>
@endsection