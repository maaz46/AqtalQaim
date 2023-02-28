@extends('Main.Layout.layout')

@section('MainSection')
<div class="tm-main">
	<!-- Home section -->

     
		<div class="first"><h2 class="tm-text-primary">AQT - Al Qaim Trust Pakistan</h2></div>
    <div class="second"><h3 class="tm-text-primary" style="color:black; font">Al Qaim Model School Khairpur</h3></div>
		<img src="http://127.0.0.1:8000/assets/MainAssets/img/AQT Logo.PNG" class="piks">


    <div class="cont">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
          <div class="first"><h2 class="tm-text-primary">Bank Payment Voucher</h2></div> 
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

  <div class="aboot2">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
        <div class="first"><h4 class="tm-text-primary" style="text-decoration: underline;">Payment Details</h4></div> 
        
          
        </div>
        <div class="col-md-6">
        <form>
          <label>BPV</label>
          <
        </form>
        </div>
      </div>
    </div>
  </div>


		</div>



@endsection
@section('IndividualScript')
<script>
  $('#RoleTable').DataTable();
</script>
@endsection
