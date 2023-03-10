@extends('Admin.Layout.layout')

@section('MainSection')

<h2 style="color:black; text-transform:uppercase;">Project </h2>

<form action="/Admin/Projects" method="POST">
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
        <label for="" style="margin-right:45px">Project Name*</label>
        <input type="text" placeholder="Enter Project Name" class="type5" value="{{ old('project_name') }}"
            name="project_name">
        @error('project_name')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Project Category*</label>
        <select name="project_category_id" class="type2" required>
            <option disabled selected>Select A Project Category</option>
            @php
            if(count($project_categories)>0):
            foreach($project_categories as $key=>$item):
            @endphp
            <option value="{{$item->project_category_id}}">{{$item->project_category}}</option>
            @php
            endforeach;
            endif;
            @endphp
        </select>

        @error('project_category_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>

<table id="RoleTable" class="table table-responsive-sm">
    <thead class="thead-dark">
        <th>Project Name</th>
        <th>Project Category</th>
        <th class="size"></th>
        <th class="size"></th>
    </thead>
    <tbody>
        @php
        if(count($projects)>0):
        foreach($projects as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->project_name}}</td>
            <td>{{$item->project_category}}</td>
            <td style="text-align:center;"><a href="/Admin/EditProject/{{$item->project_id}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
            <td style="text-align:center;"><a href="/Admin/DeleteProject/{{$item->project_id}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
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
