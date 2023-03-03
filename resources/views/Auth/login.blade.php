@extends('Auth.Layout.layout')
@section('IndividualStyle')
<link rel="stylesheet" href="{{asset('assets/AuthAssets/css/login.css')}}">
@endsection
@section('MainSection')
@php
if(Session::exists('user_id')):
echo Session::get('user_name');
endif;
@endphp
<form class="form1" method="POST" action="/">
  @csrf
  <div>
      <img src="{{asset('assets/AuthAssets/images/user.png')}}" width="20px">
      <input type="text" name="user_name" placeholder="User Name" class="type1"
          style="color: white;"><br><br>
  </div>
  <div>
      <img src="{{asset('assets/AuthAssets/images/lock.png')}}" width="20px">
      <input type="password" name="password" class="type2" placeholder="Password"
          style="color: white;"><br><br>
  </div>
  <input type="submit" name="login" value="login" class="type3">
   @php
                    if(Session::exists('incorrectlogin')):
                    @endphp
                    <p class="text-danger text-center mt-2 me-3">{{Session::get('incorrectlogin')}}</p>
                      
                    
                    @php
                    endif;
                    @endphp
  <p class="text1">Copyright 2023 © Qaabil Solutions</p>
</form>
@endsection