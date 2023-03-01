@extends('Main.Layout.layout')

@section('MainSection')

<div class="tm-main">
	<!-- Home section -->


	<section id="home" class="tm-section">

		@php
		if(Session::get('is_admin')=="0"):
		if(Session::exists('assigned_project_name')):
		@endphp
		<h2 class="tm-text-primary">
			{{Session::get('assigned_project_name')}}
		</h2>
		@php
		endif;

		else:
		@endphp
		<h2 class="tm-text-primary">
			Admin Panel
		</h2>
		@php
		endif;
		@endphp
		<img src="{{asset('assets/MainAssets/img/AQT Logo.PNG')}}" class="piks">
		<hr class="mb-4">
		<div class="header2">

			<div class="col-12">
				<div class="row">


					<input type="search" name="search" class="ser" placeholder="Search">

					<div class="message">

						<a href="#"> <i class="fa fa-envelope me-lg-2"></i><span id="tet" style="margin: 10px; font-size: 20px;">Message</span></a>

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
							<i class="fa fa-bell me-lg-2"></i><span id="tet" style="margin: 10px; font-size: 20px;">Notification</span></a>

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
							<i class="fa fa-user me-lg-2"></i><span id="tet" style="margin: 10px; font-size: 20px;">Profile</span></a>
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
		@if(Session::get('is_admin')=="1")
		<div class="about">
			<div class="container">
				<div class="row">

					<div class="col-md-12">


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

							<select id="project_id" class="type1" style="color: white;">
								<option disabled selected value="">Select A Project Category First</option>
							</select>
							<button value="Enter" class="btn btn-success btn-sm BtnEnterDashboard" style="margin-left:20px;">Enter</button>


						</div>
					</div>
				</div>
			</div>
		</div>
		@endif

		@endsection

		@section('IndividualScript')

		<script>
			$('#project_category_id, #project_id').val('').prop('selected', true);
			$('#project_category_id').on('change', function() {
				var ProjectCategoryID = $(this).val();
				$('#project_id').css({
					'opacity': '0.2',
					'pointer-events': 'none'
				});
				$.ajax({
					url: '/GetProjectsByProjectCategoryID/' + ProjectCategoryID,
					type: 'GET',
					async: false,
					success: function(e) {
						$('#project_id').empty();
						if (e.length > 0) {
							$('#project_id').append('<option disabled selected>Select A Project</option>')
							$.each(e, function(i, option) {

								$('#project_id').append('<option value="' + option.project_id + '"">' +
									option.project_name + '</option>')
							});
						} else {
							$('#project_id').append('<option disabled selected>No Projects Were Found</option >');
						}
						$('#project_id').css({
							'opacity': '1',
							'pointer-events': 'all'
						});
					}

				})
			});

			$(function() {
				$('.BtnEnterDashboard').on('click', function() {
					var ProjectID = $('#project_id').val();
					if (ProjectID > "0") {
						location.href = "/Dashboard/" + ProjectID;
					} else {
						alert('Select A Project First');
					}
				});
			});
		</script>
		@endsection