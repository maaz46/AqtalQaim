@extends('Main.Layout.layout')

@section('MainSection')

<h1>testing {{Session::get('user_name')}}</h1>

@endsection