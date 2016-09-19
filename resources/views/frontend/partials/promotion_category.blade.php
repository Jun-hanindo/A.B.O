@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
    <section class="discoverCategory">
          <div class="container">
                <h2>Promotions</h2>
              <div class="tabCategory">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation"><a href="{{ URL::route('promotion') }}"><img src="{{ asset('assets/frontend/images/catNew.png') }}"><br>What's New</a></li>
                    <li role="presentation" class="{{ $slug == 'discounts' ? 'active' : '' }}"><a href="{{ URL::route('promotion-detail', 'discounts') }}"><i class="fa fa-tag"></i><br>Discounts</a></li>
                    <li role="presentation" class="{{ $slug == 'lucky-draws' ? 'active' : '' }}"><a href="{{ URL::route('promotion-detail', 'lucky-draws') }}"><i class="fa fa-gift"></i><br>Lucky Draws</a></li>
                    <li role="presentation" class="{{ $slug == 'early-bird' ? 'active' : '' }}"><a href="{{ URL::route('promotion-detail', 'early-bird') }}"><i class="fa fa-ticket"></i><br>Early Bird</a></li>
                  </ul>
              </div>
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
                                    <li class="eventName">{{ $event->promo_title }} <img src="{{ $event->featured_image_url }}"></li>
                                    <br>
                                    <li class="eventPlace">Valid From {{ $event->valid_date }}</li>
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
                                            <h4>About This Promotion</h4>
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
                                            <p>Discount: {{ ($event->discount > 0) ? $event->discount.'%' : '$'.$event->discount_nominal }}</p>
                                            <h4>Promotion Period</h4>
                                            <p>Start Date: {{ $event->start_date }}</p>
                                            <br>
                                            <p>End Date: {{ $event->end_date }}</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4>Get Your Early Bird Tickets Now!</h4>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{ $event->buylink }}">
                                                    <button type="button" class="btn btn-primary">Buy Now</button>
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
                      <button class="btn btnLoad" data-slug="{{ $slug }}">Load More Promotions</button>
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
                    <h3 class="text-center">There are no promotion.</h3>
                </div>
            </div>
        </div>
    </section>
@endif
@stop
@include('frontend.partials.script.promotion_category_script')