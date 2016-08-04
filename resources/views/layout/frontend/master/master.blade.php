<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_WEB_ADMIN_NAME', 'Asia Box Office') }} - @yield('title')</title>

          <!-- Bootstrap -->
        {!! Html::style('assets/frontend/css/bootstrap.min.css') !!}
        {!! Html::style('assets/frontend/font-awesome-4.6.3/css/font-awesome.css') !!}
        {!! Html::style('assets/frontend/css/style.css') !!}

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,800,700,900' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favico.ico') }}">
        {!! Html::script('assets/frontend/js/modernizr.js') !!}
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <header>
        <div id="top-header">
            <div class="container">
                <div class="pull-left left-header">
                    <nav class="main-menu" role="navigation">
                        <ul class="nav-menu">
                            <li class="nav-item">
                                <a href="#"><img src="{{ asset('assets/frontend/images/logo.png') }}" class="logo"></a>
                            </li>
                            <li class="nav-item">
                                <div class="cd-dropdown-wrapper">
                                    <a class="cd-dropdown-trigger" href="#0"><img src="{{ asset('assets/frontend/images/singapore-flag.png') }}"> Singapore</a>
                                    <nav class="cd-dropdown">
                                        <h2>Title</h2>
                                        <a href="#0" class="cd-close">Close</a>
                                        <ul class="cd-dropdown-content">
                                            <li class="has-childern">
                                                <a href="#">Select Country / Language</a>
                                            </li>
                                            <li class="has-childern">
                                                <div class="countryList">
                                                    <ul>
                                                        <li>
                                                            <a href="#">
                                                                <img src="{{ asset('assets/frontend/images/asia.png') }}"><br>
                                                                <span>Asia</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <img src="{{ asset('assets/frontend/images/singaporebig-flag.png') }}"><br>
                                                                <span>Singapore</span>
                                                            </a>
                                                            <ul>
                                                                <li><a href="#"></a>English</li>
                                                                <li><a href="#"></a>简体中文</li>
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <img src="{{ asset('assets/frontend/images/malaysiabig-flag.png') }}"><br>
                                                                <span>Malaysia</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <img src="{{ asset('assets/frontend/images/indonesiabig-flag.png') }}"><br>
                                                                <span>Indonesia</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul> <!-- .cd-dropdown-content -->
                                    </nav> <!-- .cd-dropdown -->
                                </div> <!-- .cd-dropdown-wrapper -->
                            </li>
                            <li class="nav-item">
                                <div class="nav-search">
                                    <form>
                                        <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <input type="text" class="form-control input-search" placeholder="Search in Singapore...">
                                    </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL::route('discover')}}" class="hover-li">Discover</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL::route('promotion')}}" class="hover-li">Promotions</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="hover-li">Support</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="pull-right right-header login-register">
                    <a href="https://asiaboxoffice.nliven.co/account/login" target="_blank">Login</a>
                    <span> / </span>
                    <a href="https://asiaboxoffice.nliven.co/account/register" target="_blank">Register</a>      
                </div>
            </div>
        </div>
      </header>

      <!-- Start Main Content -->
        @yield('content')
      <!-- End Main Content -->

    <footer>
        <div id="footer1">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 centeredCap">
                        <div class="footIcon">
                            <img src="{{ asset('assets/frontend/images/ico-support.png') }}">
                        </div>
                        <div class="linkFoot">
                            <a href="#">Support ></a>
                        </div>
                        <div class="capFoot">
                            <p>Need help with anything?</p>
                        </div>
                    </div>
                    <div class="col-md-3 centeredCap">
                        <div class="footIcon">
                            <img src="{{ asset('assets/frontend/images/ico-regis.png') }}">
                        </div>
                        <div class="linkFoot">
                            <a href="#">Register ></a>
                        </div>
                        <div class="capFoot">
                            <p>Buy tickets from us and more.</p>
                        </div>
                    </div>
                    <div class="col-md-3 centeredCap">
                        <div class="footIcon">
                            <img src="{{ asset('assets/frontend/images/ico-subscribe.png') }}">
                        </div>
                        <div class="linkFoot">
                            <a href="#">Subscribe to Us ></a>
                        </div>
                        <div class="capFoot">
                            <p>Get events updates and tips.</p>
                        </div>
                    </div>
                    <div class="col-md-3 centeredCap">
                        <div class="footIcon">
                            <img src="{{ asset('assets/frontend/images/ico-company.png') }}">
                        </div>
                        <div class="linkFoot">
                            <a href="#">Our Company ></a>
                        </div>
                        <div class="capFoot">
                            <p>About us, jobs and partnerships.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer2">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 information-box">
                        <div class="information-title">
                            Events
                        </div>
                        <ul class="list-unstyled">
                            <li><a href="{{URL::route('home')}}">Home</a></li>
                            <li><a href="#">Search For</a></li>
                            <li><a href="{{URL::route('event')}}">Events</a></li>
                            <li><a href="{{URL::route('discover')}}">Discover Events</a></li>
                            <li><a href="{{URL::route('promotion')}}">Promotions</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 information-box">
                        <div class="information-title">
                            Support
                        </div>
                        <ul class="list-unstyled">
                            <li><a href="#">Ways To Buy Tickets</a></li>
                            <li><a href="#">Frequently Asked Questions</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Terms And Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 information-box">
                        <div class="information-title">
                            My Account
                        </div>
                        <ul class="list-unstyled login-register">
                            <li>
                                <a href="https://asiaboxoffice.nliven.co/account/login" target="_blank">Login</a>
                                <span> / </span>
                                <a href="https://asiaboxoffice.nliven.co/account/register" target="_blank">Register</a>
                            </li>
                            <li><a href="#">Subscribe Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 information-box">
                        <div class="information-title">
                            Our Company
                        </div>
                        <ul class="list-unstyled">
                            <li><a href="#"> About Asia Box Office</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="information-title">
                            Follow Us On Facebook
                        </div>
                        <div class="facebookLike">
                            <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=124&layout=button_count&action=like&size=small&show_faces=true&share=true&height=46&appId=336369053042" width="124" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                        </div>
                        <div class="information-title">
                            Download Our Mobile App
                        </div>
                        <div class="mobileApp">
                            <a href="#"><img src="{{ asset('assets/frontend/images/appstore.png') }}"></a>
                            <a href="#"><img src="{{ asset('assets/frontend/images/playstore.png') }}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer3">
            <div class="container">
                <div class="row footer-bottom">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <img src="{{ asset('assets/frontend/images/logo.png') }}">
                        </div>
                        <div class="col-md-10">
                            <p>Asia Box Office is the largest ticketing service and solution provider in Singapore. It sells tickets to events ranging from pop concerts, musicals, theatre, family entertainment to sports. Asia Box Office's Authorised Agents are now conveniently located in Singapore, Malaysia, Indonesia, India, Taiwan and Vietnam.<br>
                            <br>
    Copyright 2016. © Asia Box Office Pte Ltd. All rights reserved. All trademarks, pictures and brands are the property of their respective owners. Use of this Web site constitutes acceptance of the Asia Box Office’s Conditions of Access and Privacy Policy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
   </body>
    {!! Html::script('assets/frontend/js/jquery-2.1.1.js') !!}
    {!! Html::script('assets/frontend/js/jquery.menu-aim.js') !!}
    {!! Html::script('assets/frontend/js/main.js') !!}
    {!! Html::script('assets/frontend/js/bootstrap.min.js') !!}
</html>
