@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black;">USER CATEGORY</h2>


<div class="about1">
			    <div class="container">
        <div class="row">
          
          <div class="col-md-12">
          <div class="buttton">
          		<button class=bet>New</button>
          		<button class=bet>Save</button>
          		<button class=bet>Cancel</button>
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
                <input type="Date" name="Date" class="type6">
                
                <br></div>

                <div class="form-group">
                <label class="weight"  style="margin-right:30px;">Login Date To</label>
                <input type="Date" name="Date" class="type6">
                
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
        <th class="size"></th>
        <th class="size"></th>
    </thead>
    <tbody>
        <tr>
        <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align:center;">
            <i class="far fa-edit" style="font-size:24px;"></i>
            </td>
            <td style="text-align:center;">
            <i class="fas fa-trash-alt" style="font-size:24px;"></i>
        </td>
        </tr>
</tbody>
</table>


@endsection