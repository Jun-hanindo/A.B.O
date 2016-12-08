@extends('layout.frontend.master.master')
@section('title', 'Contact Us - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="about-content aboutus-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <ul>
                    <li class="sidebar-head">
                        <h4 class="font-light">Our Company</h4>
                    </li>
                    <li class="sidebar-menu-top active">
                        <a href="{{URL::route('about-us')}}">About Asia Box Office</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('careers')}}">Careers</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('contact-us')}}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <div class="about-desc about-update">
                    <div class="row">
                        <h3 class="head-about head-about-update">About Asia Box Office</h3>
                        <div class="col-md-8 desc-company">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat laoreet eros, eget aliquet mi maximus eu. Donec nec blandit nisi. Aliquam volutpat eros id nibh congue elementum. Nam lectus quam, feugiat in faucibus orci luctus commodo ut.</p><br>
                            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus sollicitudin condimentum ante, nec volutpat velit vehicula sit amet. Praesent at posuere ipsum. Etiam rutrum consequat risus sit amet dignissim. Nam lectus quam, feugiat in commodo ut, sollicitudin quis odio. Fusce vel tincidunt nisi, pharetra semper sem.</p>
                            <div class="company-info">
                                <a href="#" class="client-btn">Our Clients</a>
                                <a href="#" class="partner-btn">Our Partners</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="logo-about">
                                <img src="{{ asset('assets/frontend/images/about-logo.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="client-desc">
                    <h3>Our Clients</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="client-logo">
                                <img src="{{ asset('assets/frontend/images/client-logo-1.png') }}" class="img-center">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="client-logo">
                                <img src="{{ asset('assets/frontend/images/client-logo-2.png') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="client-logo">
                                <img src="{{ asset('assets/frontend/images/client-logo-3.png') }}">
                            </div>
                        </div>
                    </div>
                    <button class="btn btnAbout">Sell Events Through Us</button>
                </div>
                <div class="partner-desc">
                    <h3>Our Partners</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="client-logo">
                                <img src="{{ asset('assets/frontend/images/partner-logo-1.png') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="client-logo">
                                <img src="{{ asset('assets/frontend/images/partner-logo-2.png') }}" class="img-center">
                            </div>
                        </div>
                    </div>
                    <button class="btn btnAbout">Work With Us</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-mobile mobile-content">
    <div class="row">
        <div class="col-md-12 mobile-sidebar">
            <div class="container">
                <div class="mobile-sidebar-menu">
                    <a class="menu collapsed" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">Our Company</a>
                    <div class="collapse" id="mobile-sidebar-collapse">
                        <ul>
                            <li><a href="{{URL::route('about-us')}}">About Asia Box Office</a></li>
                            <li><a href="{{URL::route('careers')}}">Careers</a></li>
                            <li><a href="{{URL::route('contact-us')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="mobile-page-title">
                    <h3>About Asia Box Office</h3>
                </div>
                <div class="mobile-logo">
                    <img src="{{ asset('assets/frontend/images/about-logo.png') }}">
                </div>
                <div class="mobile-page-desc">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat laoreet eros, eget aliquet mi maximus eu. Donec nec blandit nisi. Aliquam volutpat eros id nibh congue elementum. Nam lectus quam, feugiat in faucibus orci luctus commodo ut.</p>
                    <br>
                    <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus sollicitudin condimentum ante, nec volutpat velit vehicula sit amet. Praesent at posuere ipsum. Etiam rutrum consequat risus sit amet dignissim. Nam lectus quam, feugiat in commodo ut, sollicitudin quis odio. Fusce vel tincidunt nisi, pharetra semper sem.</p>
                </div>
                <div class="mobile-about-categories">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="mobile-about-client">
                                <a href="#" class="client-btn">Our Clients</a>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="mobile-about-client">
                                <a href="#" class="partner-btn">Our Partners</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-page-title client-mobile">
                    <h3>Our Clients</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="client-logo">
                            <img src="{{ asset('assets/frontend/images/client-logo-1.png') }}" class="img-center">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="client-logo">
                            <img src="{{ asset('assets/frontend/images/client-logo-2.png') }}" class="img-center">
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="client-logo">
                            <img src="{{ asset('assets/frontend/images/client-logo-3.png') }}" class="img-center">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="btnAboutMobile btnAbout-mobile">
                            <button class="btn btnAbout">Sell Events Through Us</button>
                        </div>
                    </div>
                </div>
                <div class="mobile-page-title partner-mobile">
                    <h3>Our Partners</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="client-logo">
                            <img src="{{ asset('assets/frontend/images/partner-logo-1.png') }}" class="img-center">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="client-logo">
                            <img src="{{ asset('assets/frontend/images/partner-logo-2.png') }}" class="img-center">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="btnAboutMobile btnAbout-mobile btnAbout-work">
                            <button class="btn btnAbout">Work With Us</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop