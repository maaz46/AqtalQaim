@extends('User.Layout.layout')

@section('MainSection')
<div class="tm-main">
	<!-- Home section -->

     
		<div class="first" style="text-decoration: 2px underline #006699;"><h2 class="tm-text-primary">AQT - Al Qaim Trust Pakistan</h2></div>
    <div class="second"><h3 class="tm-text-primary" style="color:black;">Al Qaim Model School Khairpur</h3></div>
		<img src="{{asset('assets/MainAssets/img/AQT Logo.PNG')}}" class="pikss">


    <div class="cont">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
          <div class="first"><h2 class="tm-text-primary">Bill</h2></div> 
   </div>
    </div>
    </div>
</div>

<div class="aboot1">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <div class="buon">
          <button class=bet1>Search</button>
            <button class=bet1 type="submit">Prev</button>
            <button class=bet1>Next</button>
            <button class=bet1>New</button>
            <button class=bet1 type="submit">Save</button>
            <button class=bet1>Cancel</button>
            <button class=bet1>Edit</button>
            <button class=bet1 type="submit">Delete</button>
            <button class=bet1>Approved</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <div class="aboot2">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
        <div class="first"><h4 class="tm-text-primary" style="text-decoration: underline;">Party Information</h4></div> 
        <div>
          <p style="color: black; font-size: 20px;">Name:X-Mart Technology</p>
        </div>
          
        </div>
      </div>
    </div>
  </div>

  <div class="aboot3">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
        <div class="first"><h4 class="tm-text-primary" style="text-decoration: underline;">Bill Details</h4></div> 
        
          
        </div>
        <div class="aboot4">
        <div class="col-md-12" >
        <div class="form">
          <label class="weight" style="margin-right: 96px;">BLL</label>
          <input type="text" name="text" class="type7" style="margin-bottom:20px;" >
          <br>
         
          <div class="arrange1">
          <label class="weight" style="margin-right:64px;">Date</label>
          <input type="date" class="type5" style="margin-bottom:20px;"><br>
          
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>


  <table id="RoleTable" class="table table-responsive-sm">
  <thead class="thead-dark">
    <th>A/C Code</th>
    <th>A/C Descripton</th>
    <th>Narration</th>
    <th>Ref No.</th>
    <th>Ref Date</th>
    <th>Debit</th>
    <th>Credit</th>
    
  </thead>
  <tbody>
    <tr>
      <td></td>
      <td>
        <select name="A/c Description" class="sel">
          <option value="A/c Description">
          <option value="A/c Description">
        </select>
      </td>
      <td>
        <textarea id="message"></textarea>
      </td>
      <td>
      <select name="Ref No." class="sel">
          <option value="A/c Description">
          <option value="A/c Description">
        </select>
      </td>
      <td>
        <input type="date">
      </td>
      <td></td>
      <td></td>
      
    </tr>
  </tbody>

</table>


<form style="margin-top:20px;">
  <div class="col-8">
  <label class="weight">Amount in Words:</label>
  
  <input type="text"  class="bot">
  
</div>

</form>




		</div>

@endsection
@section('IndividualScript')

@endsection
