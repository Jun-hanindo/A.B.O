@extends('layout.frontend.master.master_static')
@section('title', 'Contact Us - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="about-content contact-content ways-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <ul>
                    <li class="sidebar-head">
                        <h4 class="font-light">Support</h4>
                    </li>
                    <li class="sidebar-menu-top">
                        <a href="{{URL::route('support-faq')}}">Frequently Asked Questions</a>
                    </li>
                    <li class="sidebar-menu active">
                        <a href="{{URL::route('contact-us')}}">Contact Us</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('support-terms-ticket-sales')}}">Terms of Ticket Sales</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('support-terms-website-use')}}">Terms of Website Use</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <div class="support-desc">
                    <div class="row">
                        <h3 class="head-about font-light">Contact Us</h3>
                        <div class="col-md-4">
                            <div class="hotline">
                                <div class="iconWays">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <h4 class="headWays font-light">Talk to Us</h4>
                                <h5>Reach out to our customer service team.</h5>
                                <br>
                                <a href="mailto:connect@asiaboxoffice.com">
                                    <button class="btn btnBlackDefault font-bold button-email"><i class="fa fa-envelope"></i>connect@asiaboxoffice.com</button>
                                </a>
                                <button class="btn btnBlackDefault font-bold"><i class="fa fa-phone"></i>Call +65 6733 0360</button>
                                
                                <br>
                                <div class="operating">
                                    <label class="font-bold">Hotline Operating Hours</label>
                                    <br>
                                    <label>Mon to Fri: 10am - 6pm</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ways-mobile contact-mobile mobile-content">
    <div class="row">
        <div class="col-md-12 mobile-sidebar">
            <div class="container">
                <div class="mobile-sidebar-menu">
                    <a class="menu collapsed" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">Support</a>
                    <div class="collapse" id="mobile-sidebar-collapse">
                        <ul>
                            <li><a href="{{URL::route('support-faq')}}">Frequently Asked Questions</a></li>
                            <li><a href="{{URL::route('contact-us')}}">Contact Us</a></li>
                            <li><a href="{{URL::route('support-terms-ticket-sales')}}">Terms of Ticket Sales</a></li>
                            <li><a href="{{URL::route('support-terms-website-use')}}">Terms of Website Use</a></li>
                            <li><a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a></li>
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
                    <h3 class="font-light">Contact Us</h3>
                </div>
                <div class="mobileTab">
                    <ul class="nav nav-tabs tab-mobile tab-mobile-contact" role="tablist">
                        <!-- <li role="presentation" class="active"><a href="#boxoffice" aria-controls="home" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-ticket"></i></div><br>Box Office</a></li> -->
                        <li role="presentation"><a href="#hotline" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-envelope"></i></div><br>Talk to Us</a></li>
                        <!-- <li role="presentation"><a href="#website" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-laptop"></i></div><br>Website</a></li> -->
                    </ul>
                </div>
                <div class="contentTab">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="hotline">
                            <h4 class="head-mobile-ways">Reach out to our customer service team.</h4>
                            <div class="office-button-mobile">
                                <a href="mailto:connect@asiaboxoffice.com">
                                    <button class="btn btnBlackDefault font-bold button-email"><i class="fa fa-envelope"></i>connect@asiaboxoffice.com</button>
                                </a>
                                <a href="tel:+6567330360">
                                    <button class="btn btnSeeContact btnBlackDefault font-bold"><i class="fa fa-phone" style="margin-right: 10px;"></i>Call +65 6733 0360</button>
                                </a>
                            </div>
                            <div class="hotline-operating-mobile">
                                <label class="label-head font-bold">Hotline Operating Hours</label><br>
                                <label>Mon to Fri: 10am - 6pm</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop