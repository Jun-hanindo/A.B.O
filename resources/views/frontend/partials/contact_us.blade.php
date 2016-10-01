@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
@php
    $tag = '<--mobile-->';
@endphp

<section class="about-content contact-content ways-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <ul>
                    <li class="sidebar-head">
                            <h4>{{ trans('general.support') }}</h4>
                    </li>
                    {{-- <li class="sidebar-menu-top active">
                            <a href="{{URL::route('support-way-to-buy-tickets')}}">{{ trans('general.ways_to_buy_tickets') }}</a>
                    </li> --}}
                    <li class="sidebar-menu-top">
                            <a href="{{URL::route('support-faq')}}">{{ trans('general.frequently_asked_questions') }}</a>
                    </li>
                    <li class="sidebar-menu active">
                        <a href="{{URL::route('contact-us')}}">{{ trans('general.contact_us') }}</a>
                    </li>
                    <li class="sidebar-menu">
                            <a href="{{URL::route('support-terms-and-conditions')}}">{{ trans('general.terms_and_conditions') }}</a>
                    </li>
                    <li class="sidebar-menu">
                            <a href="{{URL::route('support-privacy-policy')}}">{{ trans('general.privacy_policy') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <div class="support-desc">
                    <div class="row">
                        <h3 class="head-about font-light">{{ trans('general.contact_us') }}</h3>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="hotline">
                                        <div class="iconWays">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <h4 class="headWays font-light">Hotline</h4>
                                        <h5>Talk to a customer service officers.</h5>
                                        <br>
                                        <button class="btn btnBlackDefault font-bold"><i class="fa fa-phone"></i>Call +65 6733 0360</button>
                                        <br>
                                        <div class="operating">
                                            <label class="font-bold">Hotline Operating Hours</label>
                                            <br>
                                            <label>Mon to Fri: 10am - 6pm</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- {!! strstr($content, $tag, true) !!} --}}
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
                    <a class="menu" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">Support</a>
                    <div class="collapse" id="mobile-sidebar-collapse">
                        <ul>
                            {{-- <li><a href="{{URL::route('support-way-to-buy-tickets')}}">{{ trans('general.ways_to_buy_tickets') }}</a></li> --}}
                            <li><a href="{{URL::route('support-faq')}}">{{ trans('general.frequently_asked_questions') }}</a></li>
                            <li><a href="{{URL::route('contact-us')}}">{{ trans('general.contact-us') }}</a></li>
                            <li><a href="{{URL::route('support-terms-and-conditions')}}">{{ trans('general.terms_and_conditions') }}</a></li>
                            <li><a href="{{URL::route('support-privacy-policy')}}">{{ trans('general.privacy_policy') }}</a></li>
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
                    <h3 class="font-light">{{ trans('general.contact_us') }}</h3>
                </div>
                <div class="mobileTab">
                    <ul class="nav nav-tabs tab-mobile tab-mobile-contact" role="tablist">
                        {{-- <li role="presentation" class="active"><a href="#boxoffice" aria-controls="home" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-ticket"></i></div><br>Box Office</a></li> --}}
                        <li role="presentation"><a href="#hotline" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-phone"></i></div><br>Hotline</a></li>
                        {{-- <li role="presentation"><a href="#website" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-laptop"></i></div><br>Website</a></li> --}}
                    </ul>
                </div>
                <div class="contentTab">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="hotline">
                            <h4 class="head-mobile-ways">Talk to a customer service officers.</h4>
                            <div class="office-button-mobile">
                                <button class="btn btnSeeContact btnBlackDefault font-bold"><i class="fa fa-phone" style="margin-right: 10px;"></i>Call +65 6733 0360</button>
                            </div>
                            <div class="hotline-operating-mobile">
                                <label class="label-head font-bold">Hotline Operating Hours</label><br>
                                <label>Mon to Fri: 10am - 6pm</label>
                            </div>
                        </div>
                        {{-- {!! str_replace($tag, '', strstr($content, $tag)) !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop