@extends('layout.frontend.master.master_static')
@section('title', '')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('google_tag_manager')
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NQKFR7');</script>
    <!-- End Google Tag Manager -->
@stop
@section('no_script_google_tag_manager')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQKFR7"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
@stop
@section('content')
<section class="slider-home">
    <div id="carouselHacked" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <a href="{{URL::route('bryan-adams')}}">
                    <img src="{{ asset('assets/frontend/images/bryan-adams-fullweb.jpg') }}" class="hidden-xs" alt="...">
                    <img src="{{ asset('assets/frontend/images/bryan-adams-mobile.jpg') }}" class="hidden-lg hidden-md hidden-sm" alt="...">
                </a>  
                <div class="carousel-caption bg-red">
                    <div class="container">
                        <h5 class="categorySlide">CONCERT</h5>
                        <h2 class="titleSlide font-light">Bryan Adams “Get Up Tour”</h2>
                        <ul>
                            <li><div class="eventDate"><i class="fa fa-calendar-o"></i>20 January 2017</div></li>
                            <li><div class="eventPlace"><i class="fa fa-map-marker"></i>Suntec Convention Centre Hall 601, Singapore</div></li>
                        </ul>
                        <div class="moreDetail">
                            <a href="{{URL::route('bryan-adams')}}">
                                <button class="btn btnDetail font-bold">More Details</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <a href="{{URL::route('jessica-jung-singapore')}}">
                    <img src="{{ asset('assets/frontend/images/jessica-jung-singapore-fullweb.jpg') }}" class="hidden-xs" alt="...">
                    <img src="{{ asset('assets/frontend/images/jessica-jung-singapore-mobile.jpg') }}" class="hidden-lg hidden-md hidden-sm" alt="...">
                </a>
                <div class="carousel-caption bg-peach">
                    <div class="container">
                        <h5 class="categorySlide">EVENT</h5>
                        <h2 class="titleSlide font-light">Jessica Jung Singapore Fan Meeting</h2>
                        <ul>
                            <li><div class="eventDate"><i class="fa fa-calendar-o"></i>11 November 2016</div></li>
                            <li><div class="eventPlace"><i class="fa fa-map-marker"></i>Suntec Convention Centre Hall 601, Singapore</div></li>
                        </ul>
                        <div class="moreDetail">
                            <a href="{{URL::route('jessica-jung-singapore')}}">
                                <button class="btn btnDetail font-bold">More Details</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <a href="{{URL::route('jessica-jung-manila')}}">
                    <img src="{{ asset('assets/frontend/images/jessica-jung-manila-fullweb.jpg') }}" class="hidden-xs" alt="...">
                    <img src="{{ asset('assets/frontend/images/jessica-jung-manila-mobile.jpg') }}" class="hidden-lg hidden-md hidden-sm" alt="...">
                </a>
                <div class="carousel-caption bg-peach">
                    <div class="container">
                        <h5 class="categorySlide">EVENT</h5>
                        <h2 class="titleSlide font-light">Jessica Jung Manila Fan Meeting</h2>
                        <ul>
                            <li><div class="eventDate"><i class="fa fa-calendar-o"></i>25 November 2016</div></li>
                            <li><div class="eventPlace"><i class="fa fa-map-marker"></i>Philippine International Convention Center (PICC) The Plenary Hall, Manila</div></li>
                        </ul>
                        <div class="moreDetail">
                            <a href="{{URL::route('jessica-jung-manila')}}">
                                <button class="btn btnDetail font-bold">More Details</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <a href="{{URL::route('jessica-jung-hochiminh')}}">
                    <img src="{{ asset('assets/frontend/images/jessica-jung-hochiminh-fullweb.jpg') }}" class="hidden-xs" alt="...">
                    <img src="{{ asset('assets/frontend/images/jessica-jung-hochiminh-mobile.jpg') }}" class="hidden-lg hidden-md hidden-sm" alt="...">
                </a>
                <div class="carousel-caption bg-peach">
                    <div class="container">
                        <h5 class="categorySlide">EVENT</h5>
                        <h2 class="titleSlide font-light">Jessica Jung Ho Chi Minh Fan Meeting</h2>
                        <ul>
                            <li><div class="eventDate"><i class="fa fa-calendar-o"></i>27 November 2016</div></li>
                            <li><div class="eventPlace"><i class="fa fa-map-marker"></i>Quan Khu 7, Ho Chi Minh</div></li>
                        </ul>
                        <div class="moreDetail">
                            <a href="{{URL::route('jessica-jung-hochiminh')}}">
                                <button class="btn btnDetail font-bold">More Details</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Controls -->
        <a class="left carousel-control" href="#carouselHacked" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carouselHacked" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<section class="newRelease">
    <div class="container">
        <h2 class="font-light">New Release</h2>
        <div class="row">
            <a href="{{URL::route('bryan-adams')}}">
                <div class="col-md-6 box-release">
                    <img src="{{ asset('assets/frontend/images/bryan-adams-mobile.jpg') }}">
                    <div class="boxInfo info1">
                        <ul>
                            <li class="eventType">CONCERTS</li>
                            <li class="eventName">Bryan Adams “Get Up Tour”</li>
                            <li class="eventDate"><i class="fa fa-calendar-o"></i> 20 January 2017</li>
                            <li class="eventPlace"><i class="fa fa-map-marker"></i> Suntec Convention Centre Hall 601, Singapore</li>
                        </ul>
                    </div>
                </div>
            </a>
            <a href="{{URL::route('jessica-jung-singapore')}}">
                <div class="col-md-6 box-release">
                    <img src="{{ asset('assets/frontend/images/jessica-jung-singapore-mobile.jpg') }}">
                    <div class="boxInfo info2">
                        <ul>
                            <li class="eventType">EVENT</li>
                            <li class="eventName">Jessica Jung Singapore Fan Meeting</li>
                            <li class="eventDate"><i class="fa fa-calendar-o"></i> 11 November 2016</li>
                            <li class="eventPlace"><i class="fa fa-map-marker"></i> Suntec Convention Centre Hall 601, Singapore</li>
                        </ul>
                    </div>
                </div>
            </a>
            <a href="{{URL::route('jessica-jung-manila')}}">
                <div class="col-md-6 box-release">
                    <img src="{{ asset('assets/frontend/images/jessica-jung-manila-mobile.jpg') }}">
                    <div class="boxInfo info2">
                        <ul>
                            <li class="eventType">EVENT</li>
                            <li class="eventName">Jessica Jung Manila Fan Meeting</li>
                            <li class="eventDate"><i class="fa fa-calendar-o"></i> 25 November 2016</li>
                            <li class="eventPlace"><i class="fa fa-map-marker"></i> Philippine International Convention Center (PICC) The Plenary Hall, Manila</li>
                        </ul>
                    </div>
                </div>
            </a>
            <a href="{{URL::route('jessica-jung-hochiminh')}}">
                <div class="col-md-6 box-release">
                    <img src="{{ asset('assets/frontend/images/jessica-jung-hochiminh-mobile.jpg') }}">
                    <div class="boxInfo info2">
                        <ul>
                            <li class="eventType">EVENT</li>
                            <li class="eventName">Jessica Jung Ho Chi Minh Fan Meeting</li>
                            <li class="eventDate"><i class="fa fa-calendar-o"></i> 27 November 2016</li>
                            <li class="eventPlace"><i class="fa fa-map-marker"></i> Quan Khu 7, Ho Chi Minh</li>
                        </ul>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@stop