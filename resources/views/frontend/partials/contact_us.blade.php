@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.contact_us').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
@php
  $tag = '<--mobile-->';
@endphp
<section class="about-content contact-content ways-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar sidebar-support">
                @if(Request::segment(1) == 'support')
                    @include('layout.frontend.partial.support_left_side')
                @else
                    @include('layout.frontend.partial.our_company_left_side')
                @endif
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <div class="contact-desc">
                    <div class="row">
                        <h3 class="head-about font-light">{{ trans('frontend/general.contact_us') }}</h3>
                        {!! strstr($content, $tag, true) !!}
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
                    @if(Request::segment(1) == 'support')
                        @include('layout.frontend.partial.support_top_mobile')
                    @else
                        @include('layout.frontend.partial.our_company_top_mobile')
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="mobile-page-title">
                    <h3 class="font-light">{{ trans('frontend/general.contact_us') }}</h3>
                </div>
                {!! str_replace($tag, '', strstr($content, $tag)) !!}
                  
            </div>
        </div>
    </div>
</section>

@stop
@include('frontend.partials.script.message_script')