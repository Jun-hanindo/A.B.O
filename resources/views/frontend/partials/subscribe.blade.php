@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.subscribe_us').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<div class="subscription-page">
    <div class="container">
        <header>
            <div class="close-subscription">
                <a href="{{ URL::previous() }}">
                    <i class="fa fa-close"></i>{{ trans('frontend/general.cancel') }}
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
                            <h2 class="font-light">{{ trans('frontend/general.sign_up_latest_updates') }}</h2>
                                    <form class="form-subscribe" id="form-subscribe">
                                        <div class="error"></div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-xs-6 first-name first_name">
                                                        <input type="text" name="first_name" id="first_name" placeholder="{{ trans('frontend/general.first_name') }}" class="input-subscribe form-control">
                                                    </div>
                                                    <div class="col-xs-6 last-name last_name">
                                                        <input type="text" name="last_name" id="last_name" placeholder="{{ trans('frontend/general.last_name') }}" class="input-subscribe form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-7 email">
                                                        <input type="text" name="email" id="email" placeholder="{{ trans('frontend/general.email') }}" class="input-subscribe form-control">
                                                    </div>
                                                    <div class="col-md-5 button">
                                                        <button type="button" class="btn btnBlackDefault font-bold" id="btnSubscribe">{{ trans('frontend/general.subscribe') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <p>{{ trans('frontend/general.respect_privacy_subscription') }}</p>
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
                        <h4 class="modal-title" id="myModalLabel">{{ trans('frontend/general.thanks_subscription') }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ trans('frontend/general.you_are_part_mailing_list') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btnBlackDefault" data-dismiss="modal">{{ trans('frontend/general.dismiss') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalAlready" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{ trans('frontend/general.sorry') }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ trans('frontend/general.already_sucribed_us') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btnBlackDefault" data-dismiss="modal">{{ trans('frontend/general.dismiss') }}</button>
                    </div>
                </div>
            </div>
        </div>
@stop
@include('frontend.partials.script.subscribe_script')
