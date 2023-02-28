@extends('Main.Layout.layout')

@section('MainSection')



<table id="RoleTable" class="table table-responsive-sm">
    <thead class="thead-dark">
        <th>Group Types</th>
        <th class="size"></th>
        <th class="size"></th>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection
@section('IndividualScript')
<script>
  $('#RoleTable').DataTable();
</script>
@endsection
