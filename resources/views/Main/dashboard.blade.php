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

                                    <a href="#"> <i class="fa fa-envelope me-lg-2" ></i><span id="tet"style="margin: 10px; font-size: 20px;">Message</span></a>

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
                                <i class="fa fa-bell me-lg-2" ></i><span id="tet" style="margin: 10px; font-size: 20px;">Notification</span></a>

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
                                    <i class="fa fa-user me-lg-2" ></i><span id="tet" style="margin: 10px; font-size: 20px;">Profile</span></a>
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

            
				<select id="Project Category" placeholder="Project Category" class="type1" style="color: white;" >
					<option value="Project Category">Project Category</option>
					<option value="Learning Academies
					">Learning Academies
				</option>
					<option value="Medical Centers
					">Medical Centers
				</option>
					<option value="Masjid o Imambargahs
					">Masjid o Imambargahs
				</option>
					<option value="Ration and Rozgar Programs
					">Ration and Rozgar Programs
				</option>
				<option value="Rescue & Relief
				">Rescue & Relief
			</option>

				</select>
				
                
						<select id="Project Category2" placeholder="Project Category" class="type1" style="color: white;" >
					<option value="Project Name & Branch">Project Name & Branch
					<option value="Al Qaim Model School Khairpur
					">Al Qaim Model School Khairpur
				</option>
					<option value="Shaikh Mufeed Library Khairpur
					">Shaikh Mufeed Library Khairpur
				</option>
					<option value="Al Qaim Quran Academy DG Khan 
					">Al Qaim Quran Academy DG Khan
				</option>
					<option value="Al Qaim Model School Uch Shareef
					">Al Qaim Model School Uch Shareef
				</option>
				<option value="Al Qaim Quran Academy Karachi (New Rizvia)
					">Al Qaim Quran Academy Karachi (New Rizvia)
				</option>
				<option value="International Journal Of Theology and Social Sciences Karachi
					">International Journal Of Theology and Social Sciences Karachi
				</option>
				<option value="Al Qaim School and College Tando Allah Yar
					">Al Qaim School and College Tando Allah Yar
				</option>
				<option value="Al Qaim Model School Nawabshah
					">Al Qaim Model School Nawabshah
				</option>
				<option value="Al Qaim Model School Faisalabad
					">Al Qaim Model School Faisalabad
				</option>
				<option value="Al Qaim Medical Center Karachi (Abbas Town)
					">Al Qaim Medical Center Karachi (Abbas Town)
				</option>
				<option value="Al Qaim Medical Center Karachi (New Karachi)
					">Al Qaim Medical Center Karachi (New Karachi)
				</option>
				<option value="Al Qaim Medical Center Hyderabad
					">Al Qaim Medical Center Hyderabad
				</option>
				<option value="Al Qaim Ambulance Service Dadu
					">Al Qaim Ambulance Service Dadu
				</option>
				<option value="Al Qaim Medical Center Lahore
					">Al Qaim Medical Center Lahore
				</option>
				<option value="Fatima Zehra Medical Center Khoshab
					">Fatima Zehra Medical Center Khoshab
				</option>
				<option value="Imam Zain-ul-Abideen Hospital Layya (Chunni)
					">Imam Zain-ul-Abideen Hospital Layya (Chunni)
				</option>
				<option value="Al Qaim Medical Center Uch Shareef
					">Al Qaim Medical Center Uch Shareef
				</option>
				<option value="Mehfil e Mustafa Medical Center Karachi (Agra Taj)
					">Mehfil e Mustafa Medical Center Karachi (Agra Taj)
				</option>
				<option value="Al Qaim Medical Center Nawabshah
					">Al Qaim Medical Center Nawabshah
				</option>
				<option value="Hazrat Muhammad Mustafa (saww) Medical Center Layya
					">Hazrat Muhammad Mustafa (saww) Medical Center Layya
				</option>
				<option value="Tameer Masjid & Imam Bargah Project Karachi
					">Tameer Masjid & Imam Bargah Project Karachi
				</option>
				<option value="Masjid o Imambargah Hassan o Hussain Karachi (Tahirabad)
					">Masjid o Imambargah Hassan o Hussain Karachi (Tahirabad)
				</option>
				<option value="Masjid e Sahla Nawabshah (Qazi Ahmed)
					">Masjid e Sahla Nawabshah (Qazi Ahmed)
				</option>
				<option value="Masjid and Medical Center Larkana
					">Masjid and Medical Center Larkana
				</option>
				<option value="Al Qaim Rescue and Relief Karachi
					">Al Qaim Rescue and Relief Karachi
				</option>
				<option value="Al Qaim Rozgar Scheme Karachi
					">Al Qaim Rozgar Scheme Karachi
				</option>
				<option value="Ramazan Ration Program Karachi
					">Ramazan Ration Program Karachi
				</option>


				</select>
                <input type="submit" value="Enter" class="btn btn-success btn-sm" style="margin-left:20px;">

            
            </div>
					

@endsection