<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Be Qaabil Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&display=swap" rel="stylesheet">
    <!-- https://fonts.google.com/specimen/Kumbh+Sans -->
    <link rel="stylesheet" href="{{asset('assets/MainAssets/fontawesome/css/all.min.css')}}">
    <!-- https://fontawesome.com/-->
    <link rel="stylesheet" href="{{asset('assets/MainAssets/css/magnific-popup.css')}}">
    <!-- https://dimsemenov.com/plugins/magnific-popup/ -->
    <link rel="stylesheet" href="{{asset('assets/MainAssets/css/bootstrap.min.css')}}">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="{{asset('assets/MainAssets/slick/slick.min.css')}}">
    <!-- https://kenwheeler.github.io/slick/ -->
    <link rel="stylesheet" href="{{asset('assets/MainAssets/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/MainAssets/css/templatemo-upright.css')}}">
    <link rel="stylesheet" href="{{asset('assets/MainAssets/css/projectform.css')}}">
    @yield('IndividualStyle')



</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Leftside bar -->
            <div id="tm-sidebar" class="tm-sidebar">
                <nav class="tm-nav">
                    <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <div class="tm-brand-box">
                            <img src="{{asset('assets/MainAssets/img/Qaabil logo.jpg')}}" width="130px" height="70px">

                        </div>
                        <ul id="tm-main-nav">
                            <li class="nav-item">
                                <a href="/Dashboard" class="nav-link current">
                                    <div class="triangle-right"></div>
                                    <img src="{{asset('assets/MainAssets/img/icon_7-removebg-preview.png')}}"
                                        width="35px" style="margin-right: 12px;">
                                    <span style="font-size: 20px;font-family: monospace; font-weight: bolder;">DASHBOARD</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link current">
                                    <div class="triangle-right"></div>
                                    <img src="{{asset('assets/MainAssets/img/resume.png')}}" width="30px"
                                        style="margin-right: 12px;">
                                    <span style="font-size: 20px;font-family: monospace; font-weight: bolder;">MY PROFILE</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="#" class="nav-link current">
                                    <div class="triangle-right"></div>

                                    <img src="{{asset('assets/MainAssets/img/browser.png')}}" width="30px"
                                        style="margin-right: 12px;">
                                    <span style="font-size: 20px;font-family: monospace; font-weight: bolder;">INITIAL SETUP<i class="fas fa-angle-right icon"></i></span>

                                </a>
                                <div class="item">
                                    <ul>
                                        <li><a href="/GroupTypes">Group Types</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a href="/GroupCodes">Group Codes</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a href="/ControlTypes">Control Types</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a href="/ControlCodes">Control Codes</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a href="/ChartOfAccounts">Chart Of Accounts</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a href="/ProjectCategories">Project Categories</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a href="/Projects">Projects</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link current">
                                    <div class="triangle-right"></div>
                                    <img src="{{asset('assets/MainAssets/img/business-and-finance.png')}}" width="30px"
                                        style="margin-right: 12px;">
                                    <span style="font-size: 20px;font-family: monospace; font-weight: bolder;">FINANCE<i class="fas fa-angle-right icon"></i></span>


                                </a>
                                <div class="item">
                                    <ul>
                                        <li>Bank Payment Voucher</li>
                                        <hr class="dropdown-divider">
                                        <li>Bank Receipt Voucher</li>
                                        <hr class="dropdown-divider">
                                        <li>Cash Payment Voucher</li>
                                        <hr class="dropdown-divider">
                                        <li>Cash Receipt Voucher</li>
                                        <hr class="dropdown-divider">
                                        <li>Journal Voucher</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link current">
                                    <div class="triangle-right"></div>

                                    <img src="{{asset('assets/MainAssets/img/management.png')}}" width="30px"
                                        style="margin-right: 12px;">
                                    <span style="font-size: 20px;font-family: monospace; font-weight: bolder;">MANAGEMENT<i class="fas fa-angle-right icon"></i></span>

                                </a>
                                <div class="item">
                                    <ul>
                                        <li><a href="/Roles">Roles</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a href="/UserCategories">User Categories</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a href="/Users">Users</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a href="/Suppliers">Suppliers</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a href="/Customers">Customers</a></li>
                                    </ul>
                                </div>
                            </li>


                            <li class="nav-item">
                                <a href="/Logout" class="nav-link current">
                                    <div class="triangle-right"></div>
                                    <img src="{{asset('assets/MainAssets/img/resume.png')}}" width="30px"
                                        style="margin-right: 12px;">
                                    <span style="font-size: 20px;font-family: monospace; font-weight: bolder;">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <footer class="mb-3 tm-mt-100" style="color: black;">
                        Design: Qaabil Software Company
                    </footer>
                </nav>
            </div>

            <div class="tm-main">
                <!-- Home section -->
                <div class="tm-section-wrap mt-5">
                    @php
                    if(Session::exists('status')):
                    @endphp
                    <div class="alert alert-primary" role="alert">
                        {{Session::get('status')}}
                    </div>
                    @php
                    endif;
                    @endphp
                    @yield('MainSection')
                </div>


                <!-- Home section 
                        <div class="row">

                            <div class="col-lg-6 tm-col-home mb-4">
                                <div class="tm-text-container">
                                    <div class="tm-icon-container mb-5 mr-0 ml-auto">
                                        <i class="fas fa-satellite-dish fa-4x tm-text-primary"></i>
                                    </div>                                
                                    <p>
                                        Leftmost column is placed for logo and main menu.
                                        After that is an image column. Right side column 
                                        is a 100% full-width content.
                                    </p>
                                    <p>
                                        Right side can put many contents and it will
                                        scroll up / down. Left side is fixed. Parallax
                                        Image changes for different pages.
                                    </p>
                                </div>                                
                            </div>
                            <div class="col-lg-6 tm-col-home mb-4">
                                <div class="tm-text-container">
                                    <div class="tm-icon-container mb-5 mr-0 ml-auto">
                                        <i class="fas fa-broadcast-tower fa-4x tm-text-primary"></i>
                                    </div>                                 
                                    <p>
                                        Quisque tincidunt, sem rutrum euismod ornare, tortor arcu tempus 
                                        lorem, accumsan suscipit mauris lorem at lorem. Praesent feugiat 
                                        mi at tortor tincidunt, ac consequat ante cursus.
                                    </p>
                                    <div class="text-right">
                                        <a href="#gallery" class="btn btn-primary tm-btn-next">Next Page</a>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <hr class="tm-hr-short mb-5">
                        <div class="row tm-row-home">                            
                            <div class="tm-col-home tm-col-home-l">
                                <div class="media mb-4">
                                    <i class="fas fa-scroll fa-4x tm-post-icon tm-text-primary"></i>
                                    <div class="media-body">
                                        <a href="#" class="d-block mb-2 tm-text-primary tm-post-link">24 September 2020</a>  
                                        <p>
                                            Upright is free responsive HTML CSS template by <a href="https://templatemo.com/page/1" target="_parent" rel="sponsored">TemplateMo</a>. 
                                            You can feel free to adapt and apply this layout for your 
                                        commercial or non-commercial websites. </p>
                                    </div>                                    
                                </div>
                                <div class="media mb-4">
                                    <i class="fas fa-cloud-sun fa-4x tm-post-icon tm-text-primary"></i>
                                    <div class="media-body">
                                        <a href="#" class="d-block mb-2 tm-text-primary tm-post-link">22 September 2020</a>  
                                        <p>
                                            You are not allowed to re-distribute this template as a ZIP file 
                                            on any template collection website for the template download purpose. 
                                            Please contact us for more information.
                                        </p>
                                    </div>                                    
                                </div>
                                <div class="media mb-4">
                                    <i class="fas fa-dove fa-4x tm-post-icon tm-text-primary"></i>
                                    <div class="media-body">
                                        <a href="#" class="d-block mb-2 tm-text-primary tm-post-link">16 September 2020</a>  
                                        <p>
                                            You may want to support us by making   <a href="https://paypal.me/templatemo" target="_parent" rel="sponsored">a small donation via PayPal</a>. That will be helpful. We hope you like this Upright Template for your work.
                                        </p>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="tm-col-home mr-0 ml-auto">
                                <div class="tm-img-home-container"></div>                                
                            </div>
                        </div>
                    </section>
                </div>-->





                <!-- Copyright -->
                <div class="tm-section-wrap tm-copyright row">
                    <div class="col-12">
                        <div class="text-right">
                            Copyright 2023 © Qaabil Software Company
                        </div>
                    </div>
                </div>
            </div> <!-- .tm-main -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <script src="{{asset('assets/MainAssets/js/jquery-3.4.1.min.js')}}"></script> <!-- https://jquery.com/ -->
    <script src="{{asset('assets/MainAssets/js/jquery.singlePageNav.min.js')}}"></script>
    <!-- https://github.com/ChrisWojcik/single-page-nav -->
    <script src="{{asset('assets/MainAssets/js/parallax/parallax.min.js')}}"></script>
    <!-- https://pixelcog.github.io/parallax.js/ -->
    <script src="{{asset('assets/MainAssets/js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- https://imagesloaded.desandro.com/ -->
    <script src="{{asset('assets/MainAssets/js/isotope.pkgd.min.js')}}"></script> <!-- https://isotope.metafizzy.co/ -->
    <script src="{{asset('assets/MainAssets/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- https://dimsemenov.com/plugins/magnific-popup/ -->
    <script src="{{asset('assets/MainAssets/slick/slick.min.js')}}"></script>
    <!-- https://kenwheeler.github.io/slick/ -->
    <!-- <script src="{{asset('assets/MainAssets/js/templatemo-script.js')}}"></script> -->
    @yield('IndividualScript')
    <script type="text/javascript">
        $(document).ready(function(){

            $('.nav-link').click(function(){
              $(this).next('.item').slideToggle();
              $(this).find('.icon').toggleClass('rotate');

                });
        
        });
    </script>
</body>

</html>