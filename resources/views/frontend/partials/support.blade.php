@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.support').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="support-page-main">
    <div class="row">
        <div class="col-md-12">
            <div class="support-title">
                <h2 class="font-light">{{ trans('frontend/general.support') }}</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="support-menu">
            <div class="row">
                <div class="col-md-4">
                    <div class="waystobuy">
                        <div class="iconWays">
                            <i class="fa fa-ticket"></i>
                        </div>
                        <a href="{{URL::route('support-way-to-buy-tickets')}}">
                            {{ trans('frontend/general.ways_to_buy_tickets') }}
                        </a>
                        <br>
                        <span>{{ trans('frontend/general.how_to_buy_tickets_from_us') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-support">
                        <div class="iconWays">
                            <i class="fa fa-comments"></i>
                        </div>
                        <a href="{{URL::route('support-faq')}}">
                            {{ trans('frontend/general.frequently_asked_questions') }}
                        </a>
                        <br>
                        <span>{{ trans('frontend/general.browse_or_ask') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-support">
                        <div class="iconWays">
                            <i class="fa fa-phone"></i>
                        </div>
                        <a href="{{URL::route('support-contact-us')}}">
                            {{ trans('frontend/general.contact_us') }}
                        </a>
                        <br>
                        <span>{{ trans('frontend/general.send_message_call_visit') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="terms">
        <div class="row">
            <div class="col-md-12">
                <a href="{{URL::route('support-terms-and-conditions')}}">{{ trans('frontend/general.terms_and_conditions') }}</a>
                <br>
                <a href="{{URL::route('support-privacy-policy')}}">{{ trans('frontend/general.privacy_policy') }}</a>
            </div>
        </div>
    </div>
</section>
@stop
@include('frontend.partials.script.message_script')