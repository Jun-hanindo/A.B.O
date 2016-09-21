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
        {!! Html::style('assets/frontend/css/responsive.css') !!}

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
                                {{--<li class="nav-item">
                                    <div class="cd-dropdown-wrapper">
                                        <a class="cd-dropdown-trigger" href="#0"><img src="{{ asset('assets/frontend/images/singapore-flag.png') }}"> Singapore</a>
                                        <nav class="cd-dropdown">
                                            <h2>Title</h2>
                                            <a href="#0" class="cd-close">Close</a>
                                            <ul class="cd-dropdown-content">
                                                <li class="has-childern">
                                                    <a href="#">{{ trans('general.select_country_language') }}</a>
                                                </li>
                                                <li class="has-childern">
                                                    <div class="countryList">
                                                        <ul>
                                                            <li class="lang-box">
                                                                <a href="#" class="no-arrow language" data-lang="">
                                                                    <img src="{{ asset('assets/frontend/images/asia.png') }}"><br>
                                                                    <span>Asia</span>
                                                                </a>
                                                                
                                                            </li>
                                                            <li class="lang-box">
                                                                <a href="#" class="lang-link language" data-lang="en">
                                                                    <img src="{{ asset('assets/frontend/images/singaporebig-flag.png') }}"><br>
                                                                    <span>Singapore</span>
                                                                </a>
                                                                <ul>
                                                                    <li><a href="#"></a>English</li>
                                                                    <li><a href="#"></a>简体中文</li>
                                                                </ul>
                                                            </li>
                                                            <li class="lang-box">
                                                                <a href="#" class="lang-link language" data-lang="ms">
                                                                    <img src="{{ asset('assets/frontend/images/malaysiabig-flag.png') }}"><br>
                                                                    <span>Malaysia</span>
                                                                </a>
                                                                <ul>
                                                                    <li><a href="#"></a>English</li>
                                                                    <li><a href="#"></a>简体中文</li>
                                                                </ul>
                                                            </li>
                                                            <li class="lang-box">
                                                                <a href="#" class="lang-link language" data-lang="id">
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
                                </li> --}}
                                {{-- <li class="nav-item nav-third">
                                    <div class="nav-search">
                                        <form action="{{route('event-search-get')}}" method="get">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="addon-search">
                                                    <i class="fa fa-search icon-search-header"></i>
                                                </span>
                                                <input type="text" name="q" value="{{@$q}}" class="form-control input-search" placeholder="{{ trans('general.search') }}...">
                                                <input type="hidden" id="sort-text" name="sort" value="date">
                                            </div>
    
                                            <ul class="notification-drawer" data-type="inbox" id="ul-search" style="display:none">
                                                <span class="append-search"></span>
                                            </ul>
                                        </form>
                                    </div>
                                </li> --}}
                                {{-- <li class="nav-item list-menu">
                                    <a href="{{ URL::route('discover')}}">{{ trans('general.discover') }}</a>
                                </li>
                                <li class="nav-item list-menu">
                                    <a href="{{ URL::route('promotion')}}">{{ trans('general.promotions') }}</a>
                                </li> --}}
                                <li class="nav-item list-menu">
                                    <a href="#">{{ trans('general.support') }}</a>
                                </li>
                                <li class="nav-item list-menu">
                                    <a href="#">{{ trans('general.subscribe_us') }}</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    {{-- <div class="pull-right right-header">
                        <ul>
                            <li><a href="https://asiaboxoffice.nliven.co/account/login">{{ trans('general.login') }}</a></li>
                            <li>/</li>
                            <li><a href="https://asiaboxoffice.nliven.co/account/register">{{ trans('general.register') }}</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
            <div id="mobile-header">
                <div class="mobile-header">
                    <div class="container">
                        <div class="mobile-header-show">
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
                                                <i class="fa fa-bars"></i>
                                            </div>
                                            <ul class="list-unstyled mobile-collapse-body-top">
                                                {{-- <li class="collapse-child clearfix">
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
                                                                <i class="fa fa-angle-down"></i>
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
                                                                <i class="fa fa-angle-down"></i>
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
                                                                <i class="fa fa-angle-down"></i>
                                                            </a>
                                                            <ul class="list-unstyled collapse-flag">
                                                                <li><a href="#">English</a></li>
                                                                <li><a href="#">简体中文</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{ URL::route('discover')}}">{{ trans('general.discover') }}</a></li>
                                                <li><a href="{{ URL::route('promotion')}}">{{ trans('general.prmotions') }}</a></li> --}}
                                                <li><a href="#">{{ trans('general.support') }}</a></li>
                                                <li><a href="#">{{ trans('general.subscribe_us') }}</a></li>
                                                {{-- <li><a href="https://asiaboxoffice.nliven.co/account/login" class="login-mobile">{{ trans('general.login') }}</a> / <a href="https://asiaboxoffice.nliven.co/account/register" class="register-mobile"> {{ trans('general.register') }}</a></li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        {{-- <div class="mobile-search-show">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <div class="back-menu-search">
                                            <a href="#"></a>
                                        </div>
                                    </div>
                                    <div class="col-xs-11">
                                        <div class="nav-mobile">
                                            <div class="nav-search">
                                                <form action="{{route('event-search-get')}}" method="get">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="addon-search">
                                                            <i class="fa fa-search icon-search-header"></i>
                                                        </span>
                                                        <input type="text" name="q" value="{{@$q}}" class="form-control input-search" placeholder="{{ trans('general.search') }}..." id="#input-search">
                                                        <input type="hidden" id="sort-text" name="sort" value="date">
                                                    </div>
            
                                                    <ul class="notification-drawer" data-type="inbox" id="ul-search" style="display:none">
                                                        <span class="append-search"></span>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
            {{-- <div id="footer1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 centeredCap">
                            <div class="footIcon">
                                <div class="icon">
                                  <div class="iconself-logo-support"></div>
                                </div>
                            </div>
                            <div class="linkFoot">
                                <a href="#" class="font-light">{{ trans('general.support') }}</a>
                            </div>
                            <div class="capFoot">
                                <p>{{ trans('general.need_help_with_anything') }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 centeredCap">
                            <div class="footIcon">
                                <div class="icon">
                                  <div class="iconself-logo-user"></div>
                                </div>
                            </div>
                            <div class="linkFoot">
                                <a href="https://asiaboxoffice.nliven.co/account/register" class="font-light">{{ trans('general.register') }}</a>
                            </div>
                            <div class="capFoot">
                                <p>{{ trans('general.buy_tickets_from_us_and_more') }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 centeredCap">
                            <div class="footIcon">
                                <div class="icon">
                                  <div class="iconself-logo-mail"></div>
                                </div>
                            </div>
                            <div class="linkFoot">
                                <a href="#" class="font-light">{{ trans('general.subscribe_to_us') }}</a>
                            </div>
                            <div class="capFoot">
                                <p>{{ trans('general.get_events_updates_and_tips') }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 centeredCap">
                            <div class="footIcon">
                                <div class="icon">
                                  <div class="iconself-logo-footer"></div>
                                </div>
                            </div>
                            <div class="linkFoot">
                                <a href="{{URL::route('our-company')}}" class="font-light">{{ trans('general.our_company') }}</a>
                            </div>
                            <div class="capFoot">
                                <p>{{ trans('general.about_us_jobs_and_partnerships') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        @endif
        {{-- <div id="footer2">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="information-box mobile-collapse">
                            <div class="information-title mobile-collapse-header">
                                {{ trans('general.events') }}
                            </div>
                            <ul class="list-unstyled mobile-collapse-body">
                                <li><a href="{{URL::route('home')}}">{{ trans('general.home') }}</a></li>
                                <li><a href="{{URL::route('event-search-get', 'q=all&sort=date')}}">{{ trans('general.search_for_events') }}</a></li>
                                <li><a href="{{URL::route('discover')}}">{{ trans('general.discover_events') }}</a></li>
                                <li><a href="{{URL::route('promotion')}}">{{ trans('general.promotions') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="information-box mobile-collapse">
                            <div class="information-title mobile-collapse-header">
                                {{ trans('general.support') }}
                            </div>
                            <ul class="list-unstyled mobile-collapse-body">
                                <li><a href="{{URL::route('support-way-to-buy-tickets')}}">{{ trans('general.ways_to_buy_tickets') }}</a></li>
                                <li><a href="{{URL::route('support-faq')}}">{{ trans('general.frequently_asked_questions') }}</a></li>
                                <li><a href="{{URL::route('contact-us')}}">{{ trans('general.contact_us') }}</a></li>
                                <li><a href="#">{{ trans('general.terms_and_conditions') }}</a></li>
                                <li><a href="#">{{ trans('general.privacy_policy') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="information-box mobile-collapse">
                            <div class="information-title mobile-collapse-header">
                                {{ trans('general.my_account') }}
                            </div>
                            <ul class="list-unstyled mobile-collapse-body">
                                <li><a href="https://asiaboxoffice.nliven.co/account/login">{{ trans('general.login') }} / {{ trans('general.register') }}</a></li>
                                <li><a href="#">{{ trans('general.subscribe_us') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="information-box mobile-collapse">
                            <div class="information-title mobile-collapse-header">
                                {{ trans('general.our_company') }}
                            </div>
                            <ul class="list-unstyled mobile-collapse-body">
                                <li><a href="{{URL::route('our-company')}}">{{ trans('general.about_asia_box_office') }}</a></li>
                                <li><a href="{{URL::route('careers')}}">{{ trans('general.careers') }}</a></li>
                                <li><a href="{{URL::route('contact-us')}}">{{ trans('general.contact_us') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    @if(isset($setting['facebook']) && !empty($setting['facebook']))
                        <div class="col-md-2">
                            <div class="information-box mobile-collapse">
                              <div class="information-title mobile-collapse-header">
                                {{ trans('general.follow_us_on_facebook') }}
                              </div>
                              <div class="facebookLike">
                                  {!! $setting['facebook'] !!}
                              </div>
                            </div>
                        </div>
                    @endif
                    @if((isset($setting['apple_store']) && !empty($setting['apple_store'])) || (isset($setting['google_play']) && !empty($setting['google_play'])))
                    <div class="col-md-2">
                        <div class="information-box box-last mobile-collapse">
                            <div class="information-title mobile-collapse-header">
                                {{ trans('general.download_our_mobile_app') }}
                            </div>
                            <div class="mobileApp">
                                @if(isset($setting['apple_store']) && !empty($setting['apple_store']))
                                    <a href="{{ $setting['apple_store'] }}"><img src="{{ asset('assets/frontend/images/appstore.png') }}"></a>
                                @endif
                                @if(isset($setting['google_play']) && !empty($setting['google_play']))
                                    <a href="{{ $setting['google_play'] }}"><img src="{{ asset('assets/frontend/images/playstore.png') }}"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div> --}}
        <div id="footer3">
            <div class="container">
                <div class="row footer-bottom">
                    <div class="col-md-12 foot-bottom">
                        <div class="col-md-2 logo-footer">
                            <img src="{{ asset('assets/frontend/images/footer-logo.svg') }}">
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
    {!! Html::script('assets/frontend/js/smoothscroll.js') !!}
    {!! Html::script('assets/plugins/HoldOn/HoldOn.min.js') !!}
    {!! Html::script('assets/frontend/js/abo.js') !!}
    
    @yield('script')

    <script type="text/javascript">

    var base_url = {!! json_encode(url('/')) !!};

   </script>
</html>
