@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black; text-transform:uppercase;">Group types</h2>

<form action="/GroupTypes" method="POST">
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
        <label>Group Type</label>
        <input type="text" class="type5" placeholder="Enter Group Type" name="group_type">
        @error('group_type')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    
    <div class="form-group">
    <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>

<table id="RoleTable" class="table table-responsive-sm">
    <thead class="thead-dark">
        <th>Group Types</th>
        <th class="size"></th>
        <th class="size"></th>
    </thead>
    <tbody>
        @php
        if(count($group_types)>0):
        foreach($group_types as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->group_type}}</td>
            <td style="text-align:center;"><a href="/EditGroupType/{{$item->group_type_id}}" class="PageIDAction_3_1"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
            <td style="text-align:center;"><a
                    href="/DeleteGroupType/{{$item->group_type_id}}" class="PageIDAction_3_2"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
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
