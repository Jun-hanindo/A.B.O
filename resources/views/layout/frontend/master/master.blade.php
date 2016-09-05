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
        {!! Html::style('assets/frontend/css/custom.css') !!}
        {!! Html::style('assets/frontend/css/color.css') !!}

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
        <div class="page-wrapper">
          <header>
            <div id="top-header">
                <div class="container">
                    <div class="pull-left left-header">
                        <nav class="main-menu" role="navigation">
                            <ul class="nav-menu">
                                <li class="nav-item">
                                    <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/logo.png') }}" class="logo"></a>
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
                                                            <li class="lang-box">
                                                                <a href="#" class="no-arrow">
                                                                    <img src="{{ asset('assets/frontend/images/asia.png') }}"><br>
                                                                    <span>Asia</span>
                                                                </a>
                                                                
                                                            </li>
                                                            <li class="lang-box">
                                                                <a href="#" class="lang-link">
                                                                    <img src="{{ asset('assets/frontend/images/singaporebig-flag.png') }}"><br>
                                                                    <span>Singapore</span>
                                                                </a>
                                                                <ul>
                                                                    <li><a href="#"></a>English</li>
                                                                    <li><a href="#"></a>简体中文</li>
                                                                </ul>
                                                            </li>
                                                            <li class="lang-box">
                                                                <a href="#" class="lang-link">
                                                                    <img src="{{ asset('assets/frontend/images/malaysiabig-flag.png') }}"><br>
                                                                    <span>Malaysia</span>
                                                                </a>
                                                                <ul>
                                                                    <li><a href="#"></a>English</li>
                                                                    <li><a href="#"></a>简体中文</li>
                                                                </ul>
                                                            </li>
                                                            <li class="lang-box">
                                                                <a href="#" class="lang-link">
                                                                    <img src="{{ asset('assets/frontend/images/indonesiabig-flag.png') }}"><br>
                                                                    <span>Indonesia</span>
                                                                </a>
                                                                <ul>
                                                                    <li><a href="#"></a>English</li>
                                                                    <li><a href="#"></a>简体中文</li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul> <!-- .cd-dropdown-content -->
                                        </nav> <!-- .cd-dropdown -->
                                    </div> <!-- .cd-dropdown-wrapper -->
                                </li>
                                <li class="nav-item nav-third">
                                    <div class="nav-search">
                                        <form action="{{route('event-search-get')}}" method="get">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                                <input type="text" name="q" value="{{@$q}}" class="form-control input-search" placeholder="Search...">
                                                <input type="hidden" id="sort-text" name="sort" value="date">
                                            </div>
    
                                            <ul class="notification-drawer" data-type="inbox" id="ul-search" style="display:none">
                                                <span class="append-search"></span>
                                            </ul>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item list-menu">
                                    <a href="{{ URL::route('discover')}}" class="hover-li">Discover</a>
                                </li>
                                <li class="nav-item list-menu">
                                    <a href="{{ URL::route('promotion')}}" class="hover-li">Promotions</a>
                                </li>
                                <li class="nav-item list-menu">
                                    <a href="#" class="hover-li">Support</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="pull-right right-header">
                        <ul>
                            <li><a href="https://asiaboxoffice.nliven.co/account/login">Login</a></li>
                            <li>/</li>
                            <li><a href="https://asiaboxoffice.nliven.co/account/register">Register</a></li>
                        </ul>
                    </div> 
                </div>
            </div>
            <div id="mobile-header">
                <div class="mobile-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="mobile-search">
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="mobile-logo">
                                    <img src="{{ asset('assets/frontend/images/logo.png') }}">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="mobile-menu">
                                    <div class="mobile-collapse-top">
                                        <div class="mobile-collapse-header-top">
                                            <i class="fa fa-align-justify"></i>
                                        </div>
                                        <ul class="list-unstyled mobile-collapse-body-top">
                                            <li class="collapse-child clearfix">
                                                <a href="#" class="mobile-flag">
                                                    <img src="{{ asset('assets/frontend/images/mobile-singapore.png') }}">
                                                    Singapore
                                                </a>
                                                <ul class="list-unstyled mobile-flag-collapse">
                                                    <li class="li-flag">
                                                        <a href="#" class="no-arrow">
                                                            <img src="{{ asset('assets/frontend/images/mobile-asia-expand.png') }}">
                                                            Asia
                                                        </a>
                                                    </li>
                                                    <li class="li-flag">
                                                        <a href="#" class="flag-expand">
                                                            <img src="{{ asset('assets/frontend/images/mobile-singapore-expand.png') }}">
                                                            Singapore
                                                        </a>
                                                        <ul class="list-unstyled collapse-flag">
                                                            <li><a href="#">English</a></li>
                                                            <li><a href="#">简体中文</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="li-flag">
                                                        <a href="#" class="flag-expand">
                                                            <img src="{{ asset('assets/frontend/images/mobile-malay-expand.png') }}">
                                                            Malaysia
                                                        </a>
                                                        <ul class="list-unstyled collapse-flag">
                                                            <li><a href="#">English</a></li>
                                                            <li><a href="#">简体中文</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="li-flag">
                                                        <a href="#" class="flag-expand">
                                                            <img src="{{ asset('assets/frontend/images/mobile-indo-expand.png') }}">
                                                            Indonesia
                                                        </a>
                                                        <ul class="list-unstyled collapse-flag">
                                                            <li><a href="#">English</a></li>
                                                            <li><a href="#">简体中文</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ URL::route('discover')}}">Discover</a></li>
                                            <li><a href="{{ URL::route('promotion')}}">Promotions</a></li>
                                            <li><a href="#">Support</a></li>
                                            <li><a href="https://asiaboxoffice.nliven.co/account/login">Login</a> / <a href="https://asiaboxoffice.nliven.co/account/register"> Register</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- <div class="mobile-search-show">
                    <input type="text" name="" placeholder="search...">
                </div> -->
            </div>
          </header>
          

      <!-- Start Main Content -->
        @yield('content')
      <!-- End Main Content -->

    <footer>
        @if(Request::is('/'))
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
                                <a href="https://asiaboxoffice.nliven.co/account/register">Register ></a>
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
                                <a href="{{URL::route('our-company')}}">Our Company ></a>
                            </div>
                            <div class="capFoot">
                                <p>About us, jobs and partnerships.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div id="footer2">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="information-box mobile-collapse">
                            <div class="information-title mobile-collapse-header">
                                Events
                            </div>
                            <ul class="list-unstyled mobile-collapse-body">
                                <li><a href="{{URL::route('home')}}">Home</a></li>
                                <li><a href="{{URL::route('search-result')}}">Search For Events</a></li>
                                <li><a href="{{URL::route('discover')}}">Discover Events</a></li>
                                <li><a href="{{URL::route('promotion')}}">Promotions</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="information-box mobile-collapse">
                            <div class="information-title mobile-collapse-header">
                                Support
                            </div>
                            <ul class="list-unstyled mobile-collapse-body">
                                <li><a href="{{URL::route('support-way-to-buy-tickets')}}">Ways To Buy Tickets</a></li>
                                <li><a href="{{URL::route('support-faq')}}">Frequently Asked Questions</a></li>
                                <li><a href="{{URL::route('contact-us')}}">Contact Us</a></li>
                                <li><a href="#">Terms And Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="information-box mobile-collapse">
                            <div class="information-title mobile-collapse-header">
                                My Account
                            </div>
                            <ul class="list-unstyled mobile-collapse-body">
                                <li><a href="https://asiaboxoffice.nliven.co/account/login">Login / Register</a></li>
                                <li><a href="#">Subscribe Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="information-box mobile-collapse">
                            <div class="information-title mobile-collapse-header">
                                Our Company
                            </div>
                            <ul class="list-unstyled mobile-collapse-body">
                                <li><a href="{{URL::route('our-company')}}"> About Asia Box Office</a></li>
                                <li><a href="{{URL::route('careers')}}">Careers</a></li>
                                <li><a href="{{URL::route('contact-us')}}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="information-title mobile-collapse-header">
                            Follow Us On Facebook
                        </div>
                        <div class="facebookLike">
                            {!! isset($setting['facebook']) ? $setting['facebook'] : '' !!}
                        </div>
                        <div class="information-title mobile-collapse-header">
                            Download Our Mobile App
                        </div>
                        <div class="mobileApp">
                            <a href="{{ isset($setting['apple_store']) ? $setting['apple_store'] : '#' }}"><img src="{{ asset('assets/frontend/images/appstore.png') }}"></a>
                            <a href="{{ isset($setting['google_play']) ? $setting['google_play'] : '#' }}"><img src="{{ asset('assets/frontend/images/playstore.png') }}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer3">
            <div class="container">
                <div class="row footer-bottom">
                    <div class="col-md-12">
                        <div class="col-md-2 logo-footer">
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
      </div>
   </body>
    {!! Html::script('assets/frontend/js/jquery-2.1.1.js') !!}
    {!! Html::script('assets/frontend/js/jquery.menu-aim.js') !!}
    {!! Html::script('assets/frontend/js/main.js') !!}
    {!! Html::script('assets/frontend/js/bootstrap.min.js') !!}
    {!! Html::script('assets/frontend/js/custom.js') !!}
    
    @yield('script')

    <script type="text/javascript">

    var base_url = {!! json_encode(url('/')) !!};

   $(document).ready(function(){
    $('.mobile-collapse-header').click(function() {
     
          $(this).next('ul').slideToggle();
          $(this).next('.facebookLike').slideToggle();
          $(this).next('.mobileApp').slideToggle();
          return false;
      });
        $(window).resize(toggleFooter);
        toggleFooter();
         })

        toggleFooter = function (){
          var current_width = $(window).width();
        if (current_width < 960) {
              toggleFooter();
        }else{
           
        $('.mobile-collapse-header').next('ul').slideDown();
        $('.mobile-collapse-header').next('.facebookLike').slideDown();
        $('.mobile-collapse-header').next('.mobileApp').slideDown();
        }


        }


        $('.mobile-collapse-header-top').click(function(){
        $('.mobile-collapse-body-top').slideToggle();
        })

        $('.mobile-flag').click(function(){
          $(this).toggleClass('shown');
        $('.mobile-flag-collapse').slideToggle();
        })

        $('.lang-box').click(function(){
          $('.lang-box ul').slideUp();
          $(this).find('.lang-link').removeClass('shown')
          if ($(this).find('ul').is(':visible')){
            $('.lang-box ul').slideUp();
            $(this).find('.lang-link').removeClass('shown')
          }else{
            $(this).find('ul').slideDown();
            $('.lang-link').removeClass('shown')
            $(this).find('.lang-link').addClass('shown')
          }
          
        })

        $('.cd-dropdown-trigger').click(function(){
          if ($(this).is(':not(.dropdown-is-active)')){
            $('.lang-box ul').hide();
            $('.lang-link').removeClass('shown')
          }
        })


         $('.li-flag').click(function(){
          $('.li-flag ul').slideUp();
          $(this).find('.flag-expand').removeClass('shown')
          if ($(this).find('ul').is(':visible')){
            $('.li-flag ul').slideUp();
           $(this).find('.flag-expand').removeClass('shown')
          }else{
            $(this).find('ul').slideDown();
            $('.flag-expand').removeClass('shown')
            $(this).find('.flag-expand').addClass('shown')
          }
          
        })

         $('.mobile-flag').click(function(){
          if ($(this).is(':not(.shown)')){
             $('.li-flag ul').hide();
            $('.flag-expand').removeClass('shown')
          }
        })

   </script>
</html>
