@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.ways_to_buy_tickets').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
@php
  $tag = '<--mobile-->';
@endphp
<section class="about-content contact-content ways-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                @include('layout.frontend.partial.support_left_side')
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <div class="support-desc">
                    <div class="row">
                        <h3 class="head-about font-light">{{ trans('frontend/general.ways_to_buy_tickets') }}</h3>
                        {!! strstr($content, $tag, true) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ways-mobile mobile-content">
    <div class="row">
        <div class="col-md-12 mobile-sidebar">
            <div class="container">
                <div class="mobile-sidebar-menu">
                    @include('layout.frontend.partial.support_top_mobile')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="mobile-page-title">
                    <h3>{{ trans('frontend/general.ways_to_buy_tickets') }}</h3>
                </div>
                <div class="mobileTab">
                    <ul class="nav nav-tabs tab-mobile tab-mobile-contact" role="tablist">
                        <li role="presentation" class="active"><a href="#boxoffice" aria-controls="home" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-ticket"></i></div><br>Box Office</a></li>
                        <li role="presentation"><a href="#hotline" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-phone"></i></div><br>Hotline</a></li>
                        <li role="presentation"><a href="#website" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-laptop"></i></div><br>Website</a></li>
                    </ul>
                </div>
                <div class="contentTab">
                    <div class="tab-content">
                        {!! str_replace($tag, '', strstr($content, $tag)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop