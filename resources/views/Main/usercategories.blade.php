@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black;">USER CATEGORY</h2>


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
        
    <div class="abott2">
			    <div class="container">
        <div class="row">
          
          <div class="col-md-12" style="">
          	<div class="form-group">
              <label class="weight" style="margin-right:px;">Category Code</label>
                <input type="text" name="text" class="type2"><br>
            </div>

            <div class="form-group">
                <label class="weight"  style="margin-right:18px;">Category Name</label>
                <input type="text" name="text" class="type5">
                
                <br></div>

                <div class="form-group">
                <label class="weight"  style="margin-right:8px;">Login Date From</label>
                <input type="Date" name="Date" class="type5">
                
                <br></div>

                <div class="form-group">
                <label class="weight"  style="margin-right:30px;">Login Date To</label>
                <input type="Date" name="Date" class="type5">
                
                <br></div>

 </div>
 </div>
</div>
</div>

<table class="table">
    <thead class="thead-dark">
        <th>Category Code</th>
        <th>Category Name</th>
        <th>Login Date From</th>
        <th>Login Date To</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        <tr>
        <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
</tbody>
</table>


@endsection