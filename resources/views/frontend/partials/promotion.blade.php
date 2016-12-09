@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.promotions').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
    <section class="discoverCategory">
          <div class="container">
              <h2>{{ trans('frontend/general.promotions') }}</h2>
              {{-- <div class="tabCategory">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#new" aria-controls="home" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catNew.png') }}"><br>{{ trans('frontend/general.whats_new') }}</a></li>
                    <li role="presentation"><a href="{{ URL::route('promotion-detail', 'discounts') }}"><i class="fa fa-tag"></i><br>{{ trans('frontend/general.discounts') }}</a></li>
                    <li role="presentation"><a href="{{ URL::route('promotion-detail', 'lucky-draws') }}"><i class="fa fa-gift"></i><br>{{ trans('frontend/general.lucky_draws') }}</a></li>
                    <li role="presentation"><a href="{{ URL::route('promotion-detail', 'early-bird') }}"><i class="fa fa-ticket"></i><br>{{ trans('frontend/general.early_bird') }}</a></li>
                  </ul>
              </div> --}}
          </div>
    </section>

    @if(!empty($events))
    <section class="promotionList">
        <div class="container">
            <div class="row append-events">
                @foreach($events as $key => $event)
                    <div class="col-md-4 box-promo">
                        <a href="#promoModal{{ $event->ep_id }}" data-toggle="modal">
                            <img src="{{ $event->featured_image2_url }}" class="image-promo">
                            <div class="boxInfo promo1">
                                <ul>
                                    <li class="eventType">{{ strtoupper($event->category) }}</li>
                                    <li class="eventName">{{ $event->promo_title }} <img src="{{ $event->featured_image_url }}" class="esplanade"></li>
                                    <br>
                                    <li class="eventPlace">{{ trans('frontend/general.valid_from') }} {{ $event->valid }}</li>
                                </ul>
                          </div>
                        </a>
                        <div class="modal fade promoModal" id="promoModal{{ $event->ep_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">{{$event->promo_title}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="promoBanner">
                                            <img src="{{ $event->featured_image1_url }}">
                                        </div>
                                        <div class="descPromoModal">
                                            <h4>{{ trans('frontend/general.about_this_promotion') }}</h4>
                                            <div class="promoBannerDesc">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <p>{!! $event->promo_desc !!}</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <img src="{{ $event->featured_image_url }}" class="promoLogo">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <h4>How to Participate </h4>
                                            <p>Show StarHub bill or subscription on any device such as mobile phone or tablet.</p> -->

                                            <p>{{ $event->disc }}</p>
                                            <h4>{{ trans('frontend/general.promotion_period') }}</h4>
                                            <p>{{ trans('frontend/general.start_date') }}: {{ $event->start_date }}</p>
                                            <br>
                                            <p>{{ trans('frontend/general.end_date') }}: {{ $event->end_date }}</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4>{{ trans('frontend/general.get_your_early_bird_tickets_now') }}</h4>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{ $event->buylink }}">
                                                    <button type="button" class="btn btn-primary">{{ trans('frontend/general.buy_now') }}</button>
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($events->nextPageUrl() != null)
                <div class="loadMore">
                    <a href="javascript:void(0)">
                      <button class="btn btnLoad font-bold">{{ trans('frontend/general.load_more_promotions') }}</button>
                    </a>
                </div>
            @endif
        </div>
    </section>
@else
    <section class="promotionList">
        <div class="container">
            <div class="row append-events">
                <div class="box-promo">
                    <h3 class="text-center">{{ trans('frontend/general.there_are_no_promotion') }}</h3>
                </div>
            </div>
        </div>
    </section>
@endif
@stop
@include('frontend.partials.script.promotion_script')