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
        <meta property="og:description" content="&nbsp;" />
        <!-- Purpleclick head -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-NQKFR7');</script>
        <!-- End Purpleclick head -->
        {{-- @yield('google_tag_manager') --}}

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
        <!-- Google Analytic Production AWS -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-85168114-1', 'auto');
          ga('send', 'pageview');

        </script>
        <!-- End Google Analytic Production AWS -->
    </head>
    <body>
        <!-- Purpleclick body -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQKFR7"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Purpleclick body -->
        {{-- @yield('no_script_google_tag_manager') --}}
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
                                <p>&copy; 2016 Asia Box Office Pte Ltd. All rights reserved. All trademarks, pictures and brands are property of their respective owners. Use of this Website constitutes acceptance of our <a href="{{URL::route('terms-website-use')}}">Terms of Website Use</a> and <a href="{{URL::route('privacy-policy')}}">Privacy Policy</a>. For more information or enquiries, please contact us at <a href="mailto:connect@asiaboxoffice.com">connect@asiaboxoffice.com</a></p>
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
    {!! Html::script('assets/frontend/js/custom.js') !!}
    {!! Html::script('assets/frontend/js/smoothscroll.js') !!}
    {!! Html::script('assets/plugins/HoldOn/HoldOn.min.js') !!}
    {!! Html::script('assets/frontend/js/abo.js') !!}
    
    @yield('script')

    <script type="text/javascript">

    var base_url = {!! json_encode(url('/')) !!};

    </script>
    </body>
</html>
