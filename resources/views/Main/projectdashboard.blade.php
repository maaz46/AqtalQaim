@extends('Main.Layout.layout')

@section('MainSection')

<div class="tm-main">
	<!-- Home section -->


	<section id="home" class="tm-section">

		<h2 class="tm-text-primary">
			Welcome To {{$result->project_name}} Dashboard
		</h2>
		<img src="{{asset('assets/MainAssets/img/AQT Logo.PNG')}}" class="piks">
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





							@endsection

							@section('IndividualScript')

							@endsection