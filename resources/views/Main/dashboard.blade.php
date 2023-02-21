@extends('Main.Layout.layout')

@section('MainSection')

<div class="tm-main">
	<!-- Home section -->


	<section id="home" class="tm-section">

		<h2 class="tm-text-primary">AQT - Al Qaim Trust Pakistan</h2>
		<img src="http://127.0.0.1:8000/assets/MainAssets/img/AQT Logo.PNG" class="piks">
		<hr class="mb-4">
		<div class="header2">

			<div class="col-12">
				<div class="row">


					<input type="search" name="search" class="ser" placeholder="Search">

					<div class="message">

						<a href="#"> <i class="fa fa-envelope me-lg-2"></i><span id="tet"
								style="margin: 10px; font-size: 20px;">Message</span></a>

						<div class="dropdown">

							<a href="#">Jhon Send A message</a><br>15 minutes ago
							<hr class="dropdown-divider">
							<a href="#">Jhon Send A message</a><br>15 minutes ago
							<hr class="dropdown-divider">
							<a href="#">Jhon Send A message</a><br>15 minutes ago
						</div>


					</div>

					<div class="message">
						<a href="#">
							<i class="fa fa-bell me-lg-2"></i><span id="tet"
								style="margin: 10px; font-size: 20px;">Notification</span></a>

						<div class="dropdown">

							<a href="#">Jhon Send A message</a><br>15 minutes ago
							<hr class="dropdown-divider">
							<a href="#">Jhon Send A message</a><br>15 minutes ago
							<hr class="dropdown-divider">
							<a href="#">Jhon Send A message</a><br>15 minutes ago
						</div>
					</div>


					<div class="message">
						<a href="#">
							<i class="fa fa-user me-lg-2"></i><span id="tet"
								style="margin: 10px; font-size: 20px;">Profile</span></a>
						<div class="dropdown">

							<a href="#">My Profile</a><br>
							<hr class="dropdown-divider">
							<a href="#">Setting</a><br>
							<hr class="dropdown-divider">
							<a href="#">LogOut</a><br>
						</div>
					</div>

				</div>
			</div>



		</div>

		<div class="about">
			<div class="container">
				<div class="row">

					<div class="col-md-12">
						<form class="form1">


							<div class="sel">

								<select id="project_category_id" name="project_id" class="type1" style="color: white;">
									<option value="" disabled selected>Select A Project Category</option>
									@if(count($project_categories)>0)
									@foreach($project_categories as $key=>$item)
									<option value="{{$item->project_category_id}}">{{$item->project_category}}
									</option>
									@endforeach
									@endif
								</select>

								<select id="project_id" class="type1"
									style="color: white;">
									<option disabled selected value="">Select A Group Code First</option>
								</select>
								<input type="submit" value="Enter" class="btn btn-success btn-sm"
									style="margin-left:20px;">


							</div>


							@endsection

							@section('IndividualScript')

							<script>
								$('#project_category_id').on('change', function () {
									var ProjectCategoryID = $(this).val();
									console.log(ProjectCategoryID);
									$('#project_id').css({ 'opacity': '0.2', 'pointer-events': 'none' });
									$.ajax({
										url: '/GetProjectsByProjectCategoryID/' + ProjectCategoryID,
										type: 'GET',
										async: false,
										success: function (e) {
											$('#project_id').empty();
											if (e.length > 0) {
												$('#project_id').append('<option disabled selected>Select A Project</option>')
												$.each(e, function (i, option) {

													$('#project_id').append('<option value="' + option.project_id + '"">'
														+ option.project_name + '</option>')
												});
											} else {
												$('#project_id').append('<option disabled selected>No Projects Were Found</option >');
											}
											$('#project_id').css({ 'opacity': '1', 'pointer-events': 'all' });
										}

									})
								});
							</script>
							@endsection