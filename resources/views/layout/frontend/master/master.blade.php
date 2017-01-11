<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title>@yield('title'){{ env('APP_WEB_ADMIN_NAME', 'AsiaBoxOffice') }}</title>
        <meta name="description" content="@yield('description_meta')">
        <meta name="keywords" content="@yield('keywords_meta')">
        <meta property="og:image" content="@yield('og_image')" />
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:description" content="&nbsp;" />
        <!-- Purpleclick head -->
        {!! (isset($setting['purpleclick_head'])) ? $setting['purpleclick_head'] : '' !!}
        <!-- End Purpleclick head -->

          <!-- Bootstrap -->
        {!! Html::style('assets/frontend/css/bootstrap.min.css') !!}
        {!! Html::style('assets/frontend/font-awesome-4.6.3/css/font-awesome.css') !!}
        {!! Html::style('assets/frontend/css/style.css') !!}
        {!! Html::style('assets/frontend/css/custom.css') !!}
        {!! Html::style('assets/frontend/css/color.css') !!}
        {!! Html::style('assets/frontend/css/responsive.css') !!}
        {!! Html::style('assets/plugins/HoldOn/HoldOn.min.css') !!}
        {!! Html::style('assets/frontend/css/square/square.css') !!}

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,800,700,900' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favico.ico') }}">
        {!! Html::script('assets/frontend/js/modernizr.js') !!}
        <!-- Google Analytics Production -->
        {!! (isset($setting['google_analytics'])) ? $setting['google_analytics'] : '' !!}
        <!-- End Google Analytics Production -->
    </head>
    <body>
        <!-- Purpleclick body -->
        {!! (isset($setting['purpleclick_body'])) ? $setting['purpleclick_body'] : '' !!}
        <!-- End Purpleclick body -->
        <!-- Google Analytics Tracking Code -->
        @yield('ga_tracking_code')
        <!-- End Google Analytics Tracking Code -->
        <!-- Facebook Pixel Tracking Code -->
        @yield('fp_tracking_code')
        <!-- End Facebook Pixel Tracking Code -->
        @if(!Request::is('subscribe'))
            <div class="page-wrapper">
                <header>
                    <div id="top-header">
                        <div class="container">
                            <div class="pull-left left-header">
                                <nav class="main-menu" role="navigation">
                                    <ul class="nav-menu">
                                        <li class="nav-item">
                                            @if(isset($setting['header_logo']))
                                                <a href="{{URL::route('home')}}"><img src="{{ file_url('settings/'.$setting['header_logo'], env('FILESYSTEM_DEFAULT')) }}" class="logo"></a>
                                            @else
                                                <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/ABO-logo.svg') }}" class="logo"></a>
                                            @endif
                                            {{-- <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/ABO-logo.svg') }}" class="logo"></a> --}}
                                            {{-- <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/abo-xmas.png') }}" class="logo"></a> --}}
                                        </li>
                                        {{-- <li class="nav-item">
                                            <div class="cd-dropdown-wrapper">
                                                <a class="cd-dropdown-trigger" href="#0"><img src="{{ asset('assets/frontend/images/singapore-flag.svg') }}"> {{ !empty($setting['lang_country']) ? $setting['lang_country'] : 'Singapore' }}</a>
                                                <nav class="cd-dropdown">
                                                    <h2>{{ trans('frontend/general.title') }}</h2>
                                                    <a href="#0" class="cd-close">{{ trans('frontend/general.close') }}</a>
                                                    <ul class="cd-dropdown-content">
                                                        <li class="has-childern">
                                                            <a href="#">{{ trans('frontend/general.select_country_language') }}</a>
                                                        </li>
                                                        <li class="has-childern">
                                                            <div class="countryList">
                                                                <ul>
                                                                    <li class="lang-box">
                                                                        <a href="#" class="no-arrow language" data-lang="">
                                                                            <img src="{{ asset('assets/frontend/images/asia.svg') }}"><br>
                                                                            <span>Asia</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="lang-box">
                                                                        <a href="#" class="lang-link">
                                                                            <img src="{{ asset('assets/frontend/images/singaporebig-flag.svg') }}"><br>
                                                                            Singapore
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </a>
                                                                        <ul>
                                                                            <li><a href="#" class="language" data-lang="en" data-country="Singapore">English</a></li>
                                                                            <li><a href="#" class="language" data-lang="zh" data-country="Singapore">简体中文</a></li>
                                                                        </ul>
                                                                    </li>
                                                                    <li class="lang-box">
                                                                        <a href="#" class="lang-link">
                                                                            <img src="{{ asset('assets/frontend/images/malaysiabig-flag.svg') }}"><br>
                                                                            Malaysia
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </a>
                                                                        <ul>
                                                                            <li><a href="#" class="language" data-lang="en" data-country="Malaysia">English</a></li>
                                                                            <li><a href="#" class="language" data-lang="zh" data-country="Malaysia">简体中文</a></li>
                                                                        </ul>
                                                                    </li>
                                                                    <li class="lang-box">
                                                                        <a href="#" class="lang-link">
                                                                            <img src="{{ asset('assets/frontend/images/indonesiabig-flag.svg') }}"><br>
                                                                            Indonesia
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </a>
                                                                        <ul>
                                                                            <li><a href="#" class="language" data-lang="id" data-country="Indonesia">Bahasa</a></li>
                                                                            <li><a href="#" class="language" data-lang="zh" data-country="Indonesia">简体中文</a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </li> --}}
                                        <li class="nav-item nav-third">
                                            <div class="nav-search">
                                                <form action="{{route('event-search-get')}}" method="get">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="addon-search">
                                                            <i class="fa fa-search icon-search-header"></i>
                                                        </span>
                                                        <input type="text" name="q" autocomplete="off" value="{{@$q}}" class="form-control input-search" placeholder="{{ trans('frontend/general.search') }}..." id="input-search">
                                                        {{-- <input type="hidden" id="sort-text" name="sort" value="date"> --}}
                                                    </div>
                                                    <ul class="notification-drawer" data-type="inbox" id="ul-search" style="display:none">
                                                        <span class="append-search"></span>
                                                    </ul>
                                                </form>
                                            </div>
                                        </li>
                                        <li class="nav-item list-menu">
                                            <a href="{{ URL::route('discover')}}">{{ trans('frontend/general.discover_events') }}</a>
                                        </li>
                                        <li class="nav-item list-menu">
                                            <a href="{{ URL::route('promotion')}}">{{ trans('frontend/general.promotions') }}</a>
                                        </li>
                                        <li class="nav-item list-menu">
                                            <a href="{{URL::route('ways-to-buy-tickets')}}">How to Buy Tickets</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="pull-right right-header">
                                <ul>
                                    {{-- <li><a href="{{ URL::route('discover')}}">{{ trans('frontend/general.discover_events') }}</a></li>
                                    <li class="second-child"><a href="{{ URL::route('promotion')}}">{{ trans('frontend/general.promotions') }}</a></li>
                                    <li class="second-child"><a href="{{URL::route('ways-to-buy-tickets')}}">How to Buy Tickets</a></li> --}}
                                    <li><a href="{{URL::route('support')}}">{{ trans('frontend/general.support') }}</a></li>
                                </ul>
                            </div> 
                        </div>
                    </div>
                    <div id="mobile-header">
                        <div class="mobile-header mobile-header-xmas">
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
                                                @if(isset($setting['header_logo']))
                                                    <a href="{{URL::route('home')}}"><img src="{{ file_url('settings/'.$setting['header_logo'], env('FILESYSTEM_DEFAULT')) }}"></a>
                                                @else
                                                    <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/ABO-logo.svg') }}" class="logo"></a>
                                                @endif
                                                {{-- <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/footer-logo.svg') }}"></a> --}}
                                                {{-- <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/abo-xmas.png') }}"></a> --}}
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
                                                                <img src="{{ asset('assets/frontend/images/singapore-flag.svg') }}">
                                                                Singapore
                                                            </a>
                                                            <ul class="list-unstyled mobile-flag-collapse">
                                                                <li class="li-flag">
                                                                    <a href="#" class="no-arrow language" data-lang="">
                                                                        <img src="{{ asset('assets/frontend/images/mobile-asia-expand.svg') }}">
                                                                      Asia
                                                                    </a>
                                                                </li>
                                                                <li class="li-flag">
                                                                    <a href="#" class="flag-expand">
                                                                        <img src="{{ asset('assets/frontend/images/mobile-singapore-expand.svg') }}">
                                                                        Singapore
                                                                        <i class="fa fa-angle-down"></i>
                                                                    </a>
                                                                    <ul class="list-unstyled collapse-flag">
                                                                        <li><a href="#" class="language" data-lang="en" data-country="Singapore">English</a></li>
                                                                        <li><a href="#" class="language" data-lang="zh" data-country="Singapore">简体中文</a></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="li-flag">
                                                                    <a href="#" class="flag-expand">
                                                                        <img src="{{ asset('assets/frontend/images/mobile-malay-expand.svg') }}">
                                                                        Malaysia
                                                                        <i class="fa fa-angle-down"></i>
                                                                    </a>
                                                                    <ul class="list-unstyled collapse-flag">
                                                                        <li><a href="#" class="language" data-lang="en" data-country="Malaysia">English</a></li>
                                                                        <li><a href="#" class="language" data-lang="zh" data-country="Malaysia">简体中文</a></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="li-flag">
                                                                    <a href="#" class="flag-expand">
                                                                        <img src="{{ asset('assets/frontend/images/mobile-indo-expand.svg') }}">
                                                                        Indonesia
                                                                        <i class="fa fa-angle-down"></i>
                                                                    </a>
                                                                    <ul class="list-unstyled collapse-flag">
                                                                        <li><a href="#" class="language" data-lang="id" data-country="Indonesia">Bahasa</a></li>
                                                                        <li><a href="#" class="language" data-lang="zh" data-country="Indonesia">简体中文</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="{{ URL::route('discover')}}">{{ trans('frontend/general.discover_events') }}</a></li>
                                                        <li><a class="support-mobile" href="{{ URL::route('promotion')}}">{{ trans('frontend/general.promotions') }}</a></li>
                                                        <li><a class="support-mobile" href="{{URL::route('support')}}">{{ trans('frontend/general.support') }}</a></li>
                                                        <li><a href="{{URL::route('subscribe')}}" class="login-mobile last-menu">{{ trans('frontend/general.subscribe') }}</li> --}}
                                                        <li><a href="{{ URL::route('discover')}}">{{ trans('frontend/general.discover_events') }}</a></li>
                                                        <li><a class="support-mobile" href="{{ URL::route('promotion')}}">{{ trans('frontend/general.promotions') }}</a></li>
                                                        <li><a class="support-mobile" href="{{URL::route('ways-to-buy-tickets')}}">How to Buy Tickets</a></li>
                                                        <li><a class="support-mobile" href="{{URL::route('support')}}">{{ trans('frontend/general.support') }}</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="mobile-search-show">
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
                                                                <input type="text" name="q" autocomplete="off" value="{{@$q}}" class="form-control input-search input-search-mobile" placeholder="{{ trans('frontend/general.search') }}..." id="input-search-mobile">
                                                                {{-- <input type="hidden" id="sort-text" name="sort" value="date"> --}}
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="notification-drawer" data-type="inbox" id="ul-search-mobile" style="display:none">
                                                <span class="append-search"></span>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
        @endif
          

      <!-- Start Main Content -->
        @yield('content')
      <!-- End Main Content -->

    @if(!Request::is('subscribe'))
        <footer>
            <div id="footer3">
                <div class="container">
                    <div class="row footer-bottom">
                        <div class="col-md-12 foot-bottom">
                            <div class="col-md-2 logo-footer">
                                <img src="{{ asset('assets/frontend/images/footer-logo.svg') }}">
                            </div>
                            <div class="col-md-10">
                                <p>&copy; {{ date('Y') }} Asia Box Office Pte Ltd. All rights reserved. All trademarks, pictures and brands are property of their respective owners. Use of this Website constitutes acceptance of our <a href="{{URL::route('terms-website-use')}}">Terms of Website Use</a> and <a href="{{URL::route('privacy-policy')}}">Privacy Policy</a>. For more information or enquiries, please contact us at <a href="mailto:connect@asiaboxoffice.com">connect@asiaboxoffice.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @endif
    {!! Html::script('assets/frontend/js/jquery-2.1.1.js') !!}
    {!! Html::script('assets/frontend/js/jquery.menu-aim.js') !!}
    {!! Html::script('assets/frontend/js/main.js') !!}
    {!! Html::script('assets/frontend/js/bootstrap.min.js') !!}
    {!! Html::script('assets/frontend/js/bootstrap-select.min.js') !!}
    {!! Html::script('assets/frontend/js/custom.js') !!}
    {!! Html::script('assets/frontend/js/smoothscroll.js') !!}
    {!! Html::script('assets/plugins/HoldOn/HoldOn.min.js') !!}
    {!! Html::script('assets/frontend/js/abo.js') !!}
    {!! Html::script('assets/frontend/js/icheck.js') !!}
    
    @yield('script')

    <script type="text/javascript">

    var base_url = {!! json_encode(url('/')) !!};

    </script>
    </body>
</html>
