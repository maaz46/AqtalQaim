@extends('Admin.Layout.layout')

@section('MainSection')

<h2 style="color:black; text-transform:uppercase;">Project Categories</h2>

<form action="/Admin/ProjectCategories" method="POST">
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
        <label for="">Project Category Name*</label>
        <input type="text" placeholder="Enter Project Category" class="type5" name="project_category">
        @error('project_category')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group">
        <input type="submit" value="Save" class="btn btn-success btn-sm">
    </div>
</form>

<table id="RoleTable" class="table table-responsive-sm">
    <thead class="thead-dark">
        <th>Project Categories</th>
        <th class="size"></th>
        <th class="size"></th>
    </thead>
    <tbody>
        @php
        if(count($project_categories)>0):
        foreach($project_categories as $key=>$item):
        @endphp
        <tr>
            <td>{{$item->project_category}}</td>
            <td style="text-align:center;"><a href="/Admin/EditProjectCategory/{{$item->project_category_id}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
            <td style="text-align:center;"><a
                    href="/Admin/DeleteProjectCategory/{{$item->project_category_id}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
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