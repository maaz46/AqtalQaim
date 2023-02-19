@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black;">SUPPLIERS</h2>

<form action="/UpdateSupplier" method="post">
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
            <input type="text" name="supplier_code" value="{{$result->supplier_code}}" class="Maintypee">
            @error('supplier_code')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <br>

            <label class="weight" style="margin-right:42px;">Supplier Name</label>
            <input type="text" name="supplier_name" value="{{$result->supplier_name}}" class="Maintype">
            @error('supplier_name')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <br>

            <label class="weight" style="margin-right:78px;">Poc Name</label>
            <input type="text" name="poc_name" value="{{$result->poc_name}}" class="Maintype">

            <br>

            <label class="weight" style="margin-right:90px;">Address</label>
            <input type="text" name="address" value="{{$result->address}}" class="Maintype">

            <br>

            <label class="weight" style="margin-right:68px;">Contact No</label>
            <input type="tel" name="contact_no" value="{{$result->contact_no}}" class="Maintype">
            @error('contact_no')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <br>

            <label class="weight" style="margin-right:42px;">Email Address</label>
            <input type="email" name="email_address" value="{{$result->email_address}}" class="Maintype">
            @error('email_address')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <br>

            <label class="weight" style="margin-right:90px;">Website</label>
            <input type="text" name="website" value="{{$result->website}}" class="Maintype">

            <br>




          </div>

        </div>

        <div class="col-md-6" style="padding-left: 20px;" id="col1">
          <div class="form-check">

            <label class="weight" style="margin-right:35px;">Account Code</label>
            <input type="text" name="account_code" value="{{$result->account_code}}" class="Maintype">

            <br>

            <div class="sel">
              <label class="weight" style="margin-right:88px;">Chart Of Account</label>

              <select id="Project Category" name="chart_of_account_id" class="Maintype" style="color: white;">
                @php
                if(count($chart_of_accounts)>0):
                @endphp
                <option value="" disabled>Select A Chart Of Account</option>
                @php
                foreach($chart_of_accounts as $key=>$item):
                @endphp
                <option value="{{$item->chart_of_account_id}}" {{$result->chart_of_account_id==$item->chart_of_account_id ?'selected' : ''}}>{{$item->chart_of_account}}</option>
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
    <input type="hidden" name="supplier_id" value="{{$result->supplier_id}}">

            <br>



          </div>


        </div>
      </div>
    </div>
  </div>
</form>


@endsection