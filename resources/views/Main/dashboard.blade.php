@extends('Main.Layout.layout')

@section('MainSection')

<h1>hello {{Session::get('user_name')}}</h1>

@endsection