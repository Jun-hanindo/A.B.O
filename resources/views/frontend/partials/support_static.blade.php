@extends('layout.frontend.master.master')
@section('title', 'Support - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="support-page-main">
    <div class="row">
        <div class="col-md-12">
            <div class="support-title">
                <h2 class="font-light">Support</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="support-menu">
            <div class="row">
                <div class="col-md-12">
                    <div class="faq-support">
                        <a href="{{URL::route('support-faq')}}" class="font-light">
                            <div class="iconWays">
                                <i class="fa fa-comments"></i>
                            </div>
                            Frequently Asked Questions
                        </a>
                        <br>
                        <span>Browse our topics.</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="contact-support">
                        <a href="{{URL::route('contact-us')}}" class="font-light">
                            <div class="iconWays">
                                <i class="fa fa-envelope"></i>
                            </div>
                            Contact Us
                        </a>
                        <br>
                        <span>Send us an email or call us.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="terms">
        <div class="row">
            <div class="col-md-12">
                <a href="{{URL::route('support-terms-ticket-sales')}}">Terms of Ticket Sales</a>
                <br>
                <a href="{{URL::route('support-terms-website-use')}}">Terms of Website Use</a>
                <br>
                <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a>
            </div>
        </div>
    </div>
</section>
@stop
@include('frontend.partials.script.message_script')