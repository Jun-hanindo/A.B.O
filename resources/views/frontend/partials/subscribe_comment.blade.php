@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
        <div class="subscription-page">
            <div class="container">
                <header>
                    <div class="close-subscription">
                        <a href="{{ URL::previous() }}">
                            <i class="fa fa-close"></i> Cancel
                        </a>
                    </div>
                </header>
                <section class="subscription-main">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content">
                                    <img src="{{ asset('assets/frontend/images/subscription-logo.svg') }}" class="logo-web">
                                    <img src="{{ asset('assets/frontend/images/subscribe-mobile-logo.svg') }}" class="logo-mobile">
                                    <h2 class="font-light">Sign-up for the latest updates to the hottest events near you!</h2>
                                    <!-- <div class="profit-subscribe">
                                        <ul class="profit">
                                            <li><i class="fa fa-check"></i> Receive news and updates on upcoming events in Singapore.</li>
                                            <li><i class="fa fa-check"></i> Be the first to know about the best deals and promotions.</li>
                                            <li><i class="fa fa-check"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                        </ul>
                                    </div> -->
                                    <form class="form-subscribe" id="form-subscribe">
                                        <div class="error"></div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-xs-6 first-name first_name">
                                                        <input type="text" name="first_name" id="first_name" placeholder="First Name" class="input-subscribe form-control">
                                                    </div>
                                                    <div class="col-xs-6 last-name last_name">
                                                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="input-subscribe form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-7 email">
                                                        <input type="text" name="email" id="email" placeholder="Email" class="input-subscribe form-control">
                                                    </div>
                                                    <div class="col-md-5 button">
                                                        <button type="button" class="btn btnBlackDefault font-bold" id="btnSubscribe">Subscribe</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <p>We respect your privacy and will not share your contact information with third parties without your consent.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="modal fade" id="modalSubscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Thanks for Your Subscription</h4>
                    </div>
                    <div class="modal-body">
                        <p>You are now part of our mailing list!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btnBlackDefault" data-dismiss="modal">Dismiss</button>
                    </div>
                </div>
            </div>
        </div>
@stop
@include('frontend.partials.script.subscribe_script')
