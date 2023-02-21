@extends('Main.Layout.layout')

@section('MainSection')

<form action="/ProjectCategories" method="POST">
    @csrf
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
            <td style="text-align:center;"><a href="/EditProjectCategory/{{$item->project_category_id}}"><i class="far fa-edit" style="font-size:24px;"></i></a></td>
            <td style="text-align:center;"><a
                    href="/DeleteProjectCategory/{{$item->project_category_id}}"><i class="fas fa-trash-alt" style="font-size:24px;"></i></a></td>
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