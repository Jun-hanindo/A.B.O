@extends('layout.frontend.master.master')
@section('title', 'Contact Us - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="about-content contact-content ways-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar sidebar-support">
                @include('layout.frontend.partial.static.support_left_side_static')
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
                    @include('layout.frontend.partial.static.support_top_mobile_static')
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