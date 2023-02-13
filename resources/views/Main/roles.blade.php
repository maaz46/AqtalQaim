@extends('Main.Layout.layout')

@section('MainSection')


<h2 style="color:black;">USER RIGHTS ROLES</h2>


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
    
    <div class="about2">
			    <div class="container">
        <div class="row">
          
          <div class="col-md-12">
            <div class="txt">Rights for the Role</div>
          	<div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                  New
                                   </label>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                   Edit
                                   </label>                       
           <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                   Delete
                                   </label> 
             <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                   Print
                                   </label>
             
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                   Approved
                                   </label> 
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                  Un-Approved
                                   </label>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                   Void
                                   </label>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                   Un-Void
                                   </label>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                  Lock
                                   </label>
                                   
          </div>
         
          </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <div class="form-check">
            
         <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                  Un-Lock
                                   </label>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                  Checked
                                   </label>
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                 Un-Checked
                                   </label>
        </div>
        </div>
      </div>
    </div>

   

<table class="table">
    <thead class="thead-dark">
        <th>User Roles</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Print</th>
        <th>Approve</th>
        <th>Un-Approve</th>
        <th>Void</th>
        <th>Un-void</th>
        <th>Lock</th>
        <th>Un-Lock</th>
        <th>Checked</th>
        <th>Un-Checked</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @php
        if(count($roles)>0):
        foreach($roles as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->role_name}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><a href="/EditRole/{{$item->role_id}}">Edit</a></td>
            <td><a href="/DeleteRole/{{$item->role_id}}">Delete</a></td>
        </tr>
        @php
        endforeach;
        endif;
        @endphp
    </tbody>
</table>

@endsection