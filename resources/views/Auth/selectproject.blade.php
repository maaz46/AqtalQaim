@extends('Auth.Layout.layout')
@section('IndividualStyle')
<link rel="stylesheet" href="{{asset('assets/AuthAssets/css/selectproject.css')}}">
@endsection
@section('MainSection')
<form class="form1">
    <div class="sel">

        <select id="Project Category" placeholder="Project Category" class="type1" style="color: white;">
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

        </select><br><br>
    </div>
    <div>

        <select id="Project Category2" placeholder="Project Category" class="type2" style="color: white;">
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


        </select><br><br>
    </div>
    <input type="submit" name="login" value="Enter Project" class="type3">
    <p class="text1">Copyright 2023 © Qaabil Software Company</p>
</form>
@endsection