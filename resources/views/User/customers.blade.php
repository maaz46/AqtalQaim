@extends('User.Layout.layout')

@section('MainSection')

<h2 style="color:black;">CUSTOMER</h2>

<form action="/Customers" method="post">
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
            <label class="weight" style="margin-right:36px;">Customer Code</label>
            <input type="text" name="customer_code" class="Maintypee">
            @error('customer_code')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <br>

            <label class="weight" style="margin-right:32px;">Customer Name</label>
            <input type="text" name="customer_name" class="Maintype">
            @error('customer_name')
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

<table id="RoleTable" class="table table-responsive-sm">
  <thead class="thead-dark">
    <th>Customer Code</th>
    <th>Customer Name</th>
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
        if(count($customers)>0):
        foreach($customers as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->customer_code}}</td>
            <td>{{$item->customer_name}}</td>
            <td>{{$item->poc_name}}</td>
            <td>{{$item->address}}</td>
            <td>{{$item->contact_no}}</td>
            <td>{{$item->email_address}}</td>
            <td>{{$item->website}}</td>
            <td>{{$item->account_code}}</td>
            <td>{{$item->chart_of_account}}</td>
            <td style="text-align:center;"><a href="/EditCustomer/{{$item->customer_id}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
            <td style="text-align:center;"><a href="/EditCustomer/{{$item->customer_id}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
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