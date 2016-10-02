<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') {{ env('APP_WEB_ADMIN_NAME', 'AsiaBoxOffice') }}</title>
        <meta property="og:image" content="@yield('og_image')" />
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:description" content="" />

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
        @if(!Request::is('subscribe'))
            <div class="page-wrapper">
                <header>
                    <div id="top-header">
                        <div class="container">
                            <div class="pull-left left-header">
                                <nav class="main-menu" role="navigation">
                                    <ul class="nav-menu">
                                        <li class="nav-item">
                                            <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/ABO-logo.svg') }}" class="logo"></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="pull-right right-header">
                                <ul>
                                    <li><a href="{{URL::route('support')}}">Support</a></li>
                                </ul>
                            </div> 
                        </div>
                    </div>
                    <div id="mobile-header">
                        <div class="mobile-header">
                            <div class="container">
                                <div class="mobile-header-show">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="mobile-logo">
                                                <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/footer-logo.svg') }}"></a>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="mobile-menu">
                                                <div class="mobile-collapse-top">
                                                    <div class="mobile-collapse-header-top">
                                                        <i class="fa fa-bars"></i>
                                                    </div>
                                                    <ul class="list-unstyled mobile-collapse-body-top">
                                                        <li><a href="{{URL::route('support')}}">Support</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
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
                                <p>&copy; 2016 Asia Box Office Pte Ltd. All rights reserved. All trademarks, pictures and brands are property of their respective owners. Use of this Website constitutes acceptance of our <a href="{{URL::route('support-terms-website-use')}}">Terms of Website Use</a> and <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a>. For more information or enquiries, please contact us at <a href="mailto:connect@asiaboxoffice.com">connect@asiaboxoffice.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
          </div>
    @endif
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
