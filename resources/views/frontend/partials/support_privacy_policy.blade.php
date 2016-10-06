@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.privacy_policy').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="about-content ways-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                @include('layout.frontend.partial.support_left_side')
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content main-terms">
                <div class="support-desc">
                    <div class="row">
                        <h3 class="head-support font-light">{{ trans('frontend/general.privacy_policy') }}</h3>
                        <div class="col-md-12">
                            <div class="privacy-content">
                                 {!! $content !!} 
                            </div>
                        </div>
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
                    <h3 class="font-light">{{ trans('frontend/general.privacy_policy') }}</h3>
                </div>
                <div class="privacy-content">
                    {!! $content !!} 
                </div>
            </div>
        </div>
    </div>
</section>
@stop