@extends('Admin.Layout.layout')

@section('MainSection')

<h2 style="color:black; text-transform:uppercase;">Control Types</h2>

<form action="/Admin/ControlTypes" method="POST">
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

    <div class="form-group">
        
        <label for="">Control Type</label>
    <input type="text" class="type5" placeholder="Enter Control Type" name="control_type">
    @error('control_type')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>

<table id="RoleTable" class="table table-responsive-sm">
    <thead class="thead-dark">
        <th>Control Types</th>
        <th class="size"></th>
        <th class="size"></th>
    </thead>
    <tbody>
        @php
        if(count($control_types)>0):
        foreach($control_types as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->control_type}}</td>
            <td style="text-align:center;"><a href="/EditControlType/{{$item->control_type_id}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
            <td style="text-align:center;"><a
                    href="/DeleteControlType/{{$item->control_type_id}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
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