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
        <div class="subscription-page">
            <div class="container">
                <header>
                    <div class="close-subscription">
                        <a href="{{ URL::previous() }}">
                            <i class="fa fa-close"></i> Cancel
                        </a>
                    </div>
                </header>
                <section class="subscription-main">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content">
                                    <img src="{{ asset('assets/frontend/images/subscription-logo.svg') }}" class="logo-web">
                                    <img src="{{ asset('assets/frontend/images/subscribe-mobile-logo.svg') }}" class="logo-mobile">
                                    <h2 class="font-light">Sign-up for the latest updates to the hottest events near you!</h2>
                                    <!-- <div class="profit-subscribe">
                                        <ul class="profit">
                                            <li><i class="fa fa-check"></i> Receive news and updates on upcoming events in Singapore.</li>
                                            <li><i class="fa fa-check"></i> Be the first to know about the best deals and promotions.</li>
                                            <li><i class="fa fa-check"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                        </ul>
                                    </div> -->
                                    <form class="form-subscribe">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-xs-6 first-name">
                                                        <input type="text" name="first" placeholder="First Name" class="input-subscribe form-control">
                                                    </div>
                                                    <div class="col-xs-6 last-name">
                                                        <input type="text" name="last" placeholder="Last Name" class="input-subscribe form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-7 email">
                                                        <input type="text" name="email" placeholder="Email" class="input-subscribe form-control">
                                                    </div>
                                                    <div class="col-md-5 button">
                                                        <button type="button" class="btn btnBlackDefault font-bold" data-target="#modalSubscribe" data-toggle="modal">Subscribe</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <p>We respect your privacy and will not share your contact information with third parties without your consent.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="modal fade" id="modalSubscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Thanks for Your Subscription</h4>
                    </div>
                    <div class="modal-body">
                        <p>You are now part of our mailing list!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btnBlackDefault" data-dismiss="modal">Dismiss</button>
                    </div>
                </div>
            </div>
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
