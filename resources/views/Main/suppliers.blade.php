@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black;">SUPPLIERS</h2>

<form action="/Suppliers" method="post">
  @csrf
  <div class="about1">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <div class="buttton">
            <button class=bet>New</button>
            <button class=bet type="submit">Save</button>
            <button class=bet>Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div> 

  <div class="about2">
    <div class="container">
      <div class="row">

        <div class="col-md-6">
          <div class="form">
            <label class="weight" style="margin-right:45px;">Supplier Code</label>
            <input type="text" name="text" class="Maintypee"><br>

            <label class="weight" style="margin-right:42px;">Supplier Name</label>
            <input type="text" name="text" class="Maintype">

            <br>

            <label class="weight" style="margin-right:78px;">Poc Name</label>
            <input type="text" name="text" class="Maintype">

            <br>

            <label class="weight" style="margin-right:90px;">Address</label>
            <input type="text" name="text" class="Maintype">

            <br>

            <label class="weight" style="margin-right:68px;">Contact No</label>
            <input type="tel" name="number" class="Maintype">

            <br>

            <label class="weight" style="margin-right:42px;">Email Address</label>
            <input type="email" name="text" class="Maintype">

            <br>

            <label class="weight" style="margin-right:90px;">Website</label>
            <input type="url" name="text" class="Maintype">

            <br>




          </div>

        </div>

        <div class="col-md-6" style="padding-left: 20px;" id="col1">
          <div class="form-check">

            <label class="weight" style="margin-right:35px;">Account Code</label>
            <input type="url" name="text" class="Maintype">

            <br>

            <label class="weight" style="margin-right:15px;">Chart of Account</label>
            <input type="url" name="text" class="Maintype">

            <br>



          </div>


        </div>
      </div>
    </div>
  </div>
</form>

<table class="table">
  <thead class="thead-dark">
    <th>Supplier Code</th>
    <th>Supplier Name</th>
    <th>Poc Name</th>
    <th>Address</th>
    <th>Contact No</th>
    <th>Email Address</th>
    <th>Website</th>
    <th>Account Code</th>
    <th>Chart of Account</th>
    <th class="size"></th>
    <th class="size"></th>
  </thead>
  <tbody>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
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