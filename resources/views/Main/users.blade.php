@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black;">USER RIGHTS</h2>


<div class="about1">
			    <div class="container">
        <div class="row">
          
          <div class="col-md-12">
          	<div class="buttton">
          		<div class="btn">New</div>
          		<div class="btn">Save</div>
          		<div class="btn">Cancel</div>
          	</div>
          </div>
        </div>
      </div>
    </div>

    <div class="about1">
			    <div class="container">
        <div class="row">
          
          <div class="col-md-6">
          	<div class="form">
              <label class="weight">Name</label>
                <input type="text" name="text" ><br>

                <label class="weight">Username</label>
                <input type="text" name="text">
                
                <br>

                <label class="weight">Password</label>
                <input type="password" name="Password">
                <br>

                <label class="weight">Confirm Password</label>
                <input type="password" name="Password">
                <br>
                <label class="weight">Email</label>
                <input type="email" name="text">
                <br>
                <label class="weight">Cell</label>
                <input type="tel" name="number">
                <br>
                
          		
          	</div>
          </div>
          <div class="col-md-6">
          	<div class="buttton">
          		<div class="btn">New</div>
          		<div class="btn">Save</div>
          		<div class="btn">Cancel</div>
          	</div>
          </div>
        </div>
      </div>
    </div>



<table class="table">
    <thead class="thead-dark">
        <th>User Name</th>
        <th>Role Name</th>
        <th>Project Name</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @php
        if(count($users)>0):
        foreach($users as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->user_name}}</td>
            <td>{{$item->role_name}}</td>
            <td>{{$item->project_name}}</td>
            <td><a href="/EditUser/{{$item->user_id}}">Edit</a></td>
            <td><a href="/DeleteUser/{{$item->user_id}}">Delete</a></td>
        </tr>
        @php
        endforeach;
        endif;
        @endphp
    </tbody>
</table>
@endsection