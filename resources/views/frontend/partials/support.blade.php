@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
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
                <div class="col-md-4">
                    <div class="waystobuy">
                        <div class="iconWays">
                            <i class="fa fa-ticket"></i>
                        </div>
                        <a href="{{URL::route('support-way-to-buy-tickets')}}">
                            Ways To Buy Tickets
                        </a>
                        <br>
                        <span>How to buy tickets from us.</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faq-support">
                        <div class="iconWays">
                            <i class="fa fa-comments"></i>
                        </div>
                        <a href="{{URL::route('support-faq')}}">
                            Frequently Asked Questions
                        </a>
                        <br>
                        <span>Browse our topics or ask a question.</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-support">
                        <div class="iconWays">
                            <i class="fa fa-phone"></i>
                        </div>
                        <a href="{{URL::route('contact-us')}}">
                            Contact Us
                        </a>
                        <br>
                        <span>Send a message, call or visit us.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="terms">
        <div class="row">
            <div class="col-md-12">
                <a href="{{URL::route('support-terms-and-conditions')}}">Terms and Conditions</a>
                <br>
                <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a>
            </div>
        </div>
    </div>
</section>
@stop
@include('frontend.partials.script.message_script')