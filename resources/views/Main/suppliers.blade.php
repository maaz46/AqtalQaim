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
            <input type="text" name="supplier_code" class="Maintypee">
            @error('supplier_code')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <br>

            <label class="weight" style="margin-right:42px;">Supplier Name</label>
            <input type="text" name="supplier_name" class="Maintype">
            @error('supplier_name')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <br>

            <label class="weight" style="margin-right:78px;">Poc Name</label>
            <input type="text" name="poc_name" class="Maintype">

            <br>

            <label class="weight" style="margin-right:90px;">Address</label>
            <input type="text" name="address" class="Maintype">

            <br>

            <label class="weight" style="margin-right:68px;">Contact No</label>
            <input type="tel" name="contact_no" class="Maintype">
            @error('contact_no')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <br>

            <label class="weight" style="margin-right:42px;">Email Address</label>
            <input type="email" name="email_address" class="Maintype">
            @error('email_address')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <br>

            <label class="weight" style="margin-right:90px;">Website</label>
            <input type="text" name="website" class="Maintype">

            <br>




          </div>

        </div>

        <div class="col-md-6" style="padding-left: 20px;" id="col1">
          <div class="form-check">

            <label class="weight" style="margin-right:35px;">Account Code</label>
            <input type="text" name="account_code" class="Maintype">

            <br>

            <div class="sel">
              <label class="weight" style="margin-right:12px;">Chart Of Account</label>

              <select id="Project Category" name="chart_of_account_id" class="Maintype" style="color: white;">
                @php
                if(count($chart_of_accounts)>0):
                @endphp
                <option disabled selected>Select A Chart Of Account</option>
                @php
                foreach($chart_of_accounts as $key=>$item):
                @endphp
                <option value="{{$item->chart_of_account_id}}">{{$item->chart_of_account}}</option>
                @php
                endforeach;

                else:
                @endphp
                <option value="">No Chart Of Account Found</option>
                @php
                endif;
                @endphp
              </select>
            </div>

            <br>



          </div>


        </div>
      </div>
    </div>
  </div>
</form>

<table id="RoleTable" class="table">
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
    @php
        if(count($suppliers)>0):
        foreach($suppliers as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->supplier_code}}</td>
            <td>{{$item->supplier_name}}</td>
            <td>{{$item->poc_name}}</td>
            <td>{{$item->address}}</td>
            <td>{{$item->contact_no}}</td>
            <td>{{$item->email_address}}</td>
            <td>{{$item->website}}</td>
            <td>{{$item->account_code}}</td>
            <td>{{$item->chart_of_account}}</td>
            <td style="text-align:center;"><a href="/EditSupplier/{{$item->supplier_id}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
            <td style="text-align:center;"><a href="/EditSupplier/{{$item->supplier_id}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
        </tr>
        @php
        endforeach;
        endif;
        @endphp
  </tbody>
</table>


@endsection
@section('IndividualScript')
<script>
  $('#RoleTable').DataTable();
</script>
@endsection