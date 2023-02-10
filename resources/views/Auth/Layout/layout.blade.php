<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('IndividualStyle')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/AuthAssets/css/bootstrap.css')}}">
    <title>Be Qaabil Accounting Software</title>
</head>

<body>

    <div class="header_section">
        <div class="container-fluid">
            {{-- {{asset('assets/AuthAssets/css/style.css')}} --}}

            <div class="logo"><img src="{{asset('assets/AuthAssets/images/Qaabil logo.jpg')}}" width="80px"
                    height="45px"></div>
        </div>
    </div>




    <div class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="image_2"><img class="div1" src="{{asset('assets/AuthAssets/images/AQT Logo.png')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    
                    @yield('MainSection')

                </div>

            </div>
        </div>

    </div>
</body>

</html>