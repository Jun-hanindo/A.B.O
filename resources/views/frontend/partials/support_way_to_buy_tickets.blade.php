@extends('layout.frontend.master.master')
@section('title', 'How to Buy Tickets - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
@php
    $search = '[visa_checkout]';
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
                        <h3 class="head-about head-ticket font-light">How to Buy Tickets</h3>
                        <div class="col-md-12 faq-content">
                            <div class="faq-categories">
                                @if(!empty($setting['visa_banner_image']))
                                    @php
                                        $img = file_url('settings/'.$setting['visa_banner_image'], env('FILESYSTEM_DEFAULT'));
                                        $replace = '<div class="banner_visa-checkout">
                                            <a href="'.$setting['visa_link'].'">
                                              <img src="'.$img.'">
                                            </a>
                                        </div>';
                                    @endphp
                                    {!! str_replace($search, $replace, $content) !!}
                                @else
                                    {!! str_replace($search, '', $content) !!}
                                @endif
                                
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
                    <h3 class="font-light">How to Buy Tickets</h3>
                </div>
                @if(!empty($setting['visa_banner_image_mobile']))
                    @php
                        $img = file_url('settings/'.$setting['visa_banner_image_mobile'], env('FILESYSTEM_DEFAULT'));
                        $replace = '<div class="banner_visa-checkout mobile">
                            <a href="'.$setting['visa_link'].'">
                              <img src="'.$img.'">
                            </a>
                        </div>';
                    @endphp
                    {!! str_replace($search, $replace, $responsive_content) !!}
                @else
                    {!! str_replace($search, '', $responsive_content) !!}
                @endif
            </div>
        </div>
    </div>
</section>
@stop