@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
    <section class="discoverCategory">
          <div class="container">
                <h2>
                    @if($slug == 'discounts')
                        {{ 'DISCOUNTS' }}
                    @elseif($slug == 'early-bird')
                        {{ 'EARLY BIRD' }}
                    @else
                        {{ 'LUCKY DRAW' }}
                    @endif
                </h2>
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
    <section class="latestPromo">
        <div class="container">
            <div class="row append-events">
                @foreach($events as $key => $event)
                    <div class="col-md-4 box-promo">
                        <img src="{{ $event->featured_image2_url }}" class="image-promo">
                        <div class="boxInfo promo1">
                            <ul>
                                <li class="eventType">{{ $event->category }}</li>
                                <li class="eventName">{{ $event->promo_title }} <img src="{{ $event->featured_image_url }}"></li>
                                <li class="eventPlace">Valid From {{ $event->start.' - '.$event->end }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($events->nextPageUrl() != null)
                <div class="loadMore">
                  <a href="javascript:void(0)" class="btn btnLoad" data-slug="{{ $slug }}">Load More Promotions</a>
                </div>
            @endif
        </div>
    </section>
    @endif
@stop
@include('frontend.partials.script.promotion_category_script')