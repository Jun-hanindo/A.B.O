@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.faq').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
@php
    $tag = '<--mobile-->';
@endphp
<section class="about-content faq-content">
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
                        <h3 class="head-about font-light">{{ trans('frontend/general.frequently_asked_questions') }}</h3>
                        {!! str_replace('[captcha]', Recaptcha::render(), strstr($content, $tag, true)); !!}
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
        <div class="col-md-12">
            <div class="container">
                <div class="mobile-page-title">
                    <h3 class="font-light">{{ trans('frontend/general.frequently_asked_questions') }}</h3>
                </div>
                @php 
                    $mobile = str_replace($tag, '', strstr($content, $tag));
                    $mobile = str_replace('@back_support', URL::route('support-faq'), $mobile);
                @endphp
              {!! str_replace('[captcha]', Recaptcha::render(), $mobile); !!}
            </div>
        </div>
    </div>
</section>
@stop
@include('frontend.partials.script.message_script')