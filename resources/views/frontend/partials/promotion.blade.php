@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.promotions').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
    <section class="discoverCategory promo-category">
          <div class="container">
              <h2 class="font-light">{{ trans('frontend/general.promotions') }}</h2>
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
                                    <li class="eventName">
                                        <div class="col-md-9 col-xs-9 promoNameThumb" >{{ $event->promo_title }}</div> 
                                        <div class="col-md-3 col-xs-3 promoLogoThumb" ><img src="{{ $event->featured_image_url }}" onload="this.width/=2;this.onload=null;"></div> 
                                    </li>
                                    
                                    {{-- <br><li class="eventPlace">{{ (!empty($event->valid)) ? trans('frontend/general.valid_from').' '.$event->valid : '&nbsp;' }}</li> --}}
                                </ul>
                          </div>
                        </a>
                        <div class="modal fade promoModal full-modal" id="promoModal{{ $event->ep_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">{{ucwords(strtolower($event->category)).' - '.$event->title}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="desc-promo-modal">
                                            <div class="promoBanner">
                                                <img src="{{ $event->featured_image1_url }}" class="promo-modal-web">
                                                <img src="{{ $event->featured_image2_url }}" class="promo-modal-mobile">
                                            </div>
                                            <div class="descPromoModal">
                                                {{-- <h4>{{ trans('frontend/general.about_this_promotion') }}</h4> --}}
                                                <div class="promoBannerDesc">
                                                    <div class="row">
                                                        <div class="col-md-12 col-xs-12">
                                                            @if(!empty($event->banner_image))
                                                                <a {!! (!empty($event->featured_image_link)) ? 'href="'.$event->featured_image_link.'" target="_blank"' : '' !!}>
                                                                    <img class="promoBanner" src="{{ $event->banner_image_url }}">
                                                                </a>
                                                            @else
                                                                @if(!empty($event->featured_image))
                                                                    <a {!! (!empty($event->featured_image_link)) ? 'href="'.$event->featured_image_link.'" target="_blank"' : '' !!}>
                                                                        <img class="promoLogo" src="{{ $event->featured_image_url }}" onload="this.width/=2;this.onload=null;">
                                                                    </a>
                                                                @endif
                                                            @endif
                                                            <h3 class="font-bold">{{ $event->promo_title }}</h3>
                                                            {!! $event->promo_desc !!}
                                                            @if(!empty($event->link_title_more_description))
                                                                <a id="link_title_more_promotion" data-toggle="collapse" href="#more_description{{ $event->ep_id }}" aria-expanded="false"><u> {!! $event->link_title_more_description !!} </u></a>
                                                            @endif
                                                            @if(!empty($event->more_description))
                                                                <span class="collapse" id="more_description{{ $event->ep_id }}"> {!! $event->more_description !!} </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <h4>How to Participate </h4>
                                                <p>Show StarHub bill or subscription on any device such as mobile phone or tablet.</p> -->

                                                
                                                @if($event->discount > 0 || $event->discount_nominal > 0)
                                                    <p>{{ trans('general.discount') }}: 
                                                        @if($event->discount > 0)
                                                            {{ number_format_drop_zero_decimals($event->discount).'%' }}
                                                        @else
                                                            @if($event->currency_id == 0)
                                                                @php
                                                                    $code = '';
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $code = $event->currency->code;
                                                                @endphp
                                                            @endif
                                                            {{ $code.' '.number_format_drop_zero_decimals($event->discount_nominal) }}
                                                        @endif
                                                    </p>
                                                @endif

                                                @if(!empty($event->start_date))
                                                    <h4>{{ trans('frontend/event.promotion_period') }}</h4>
                                                    <p>{{ trans('frontend/general.start_date') }}: {{ $event->start_date }}</p>
                                                    <br>
                                                @endif
                                                @if(!empty($event->end_date))
                                                    <p>{{ trans('frontend/general.end_date') }}: {{ $event->end_date }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="content-footer-modal">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h4>Enjoy This Promotion Now</h4>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ $event->buylink }}">
                                                        <button type="button" class="btn btn-primary btnBlackDefault font-bold">{{ trans('frontend/general.buy_now') }}</button>
                                                    </a>
                                                    
                                                </div>
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