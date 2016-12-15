@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.ways_to_buy_tickets').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
@php
  $tag = '<--mobile-->';
@endphp
<section class="about-content faq-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar sidebar-support">
                @include('layout.frontend.partial.support_left_side')
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <div class="support-desc">
                    <div class="row">
                        <h3 class="head-about head-ticket font-light">How To Buy Tickets</h3>
                        <div class="col-md-12 faq-content">
                            <div class="faq-categories">
                                {!! strstr($content, $tag, true) !!}
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="faq-mobile mobile-content">
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
        <div class="col-md-12 main-faq-mobile">
            <div class="container">
                <div class="mobile-page-title">
                    <h3 class="font-light">How To Buy Tickets</h3>
                </div>
                {!! str_replace($tag, '', strstr($content, $tag)) !!}
            </div>
        </div>
    </div>
</section>
@stop