@extends('layout.frontend.master.master')
@section('title', '')
@section('content')
    @if(!empty($sliders))
        <section class="slider-home">
            <div id="carouselHacked" class="carousel slide carousel-fade" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach($sliders as $key => $slider)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : ' '}}"></li> 
                    @endforeach
                </ol>


                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox"> 
                        @foreach($sliders as $key => $slider)
                            <div class="item {{ $key == 0 ? 'active' : ' '}}">
                                <img src="{{ file_url('events/'.$slider->event->featured_image1, env('FILESYSTEM_DEFAULT')) }}" class="hidden-xs" alt="...">
                                <img src="{{ file_url('events/'.$slider->event->featured_image1, env('FILESYSTEM_DEFAULT')) }}" class="hidden-lg hidden-md hidden-sm" alt="...">
                                <div class="carousel-caption bg-{{ $slider->event->background_color }}">
                                    <div class="container">
                                        <h5 class="categorySlide">{{ strtoupper($slider->cat_name) }}</h5>
                                        <h2 class="titleSlide font-light">{{ $slider->event->title }}</h2>
                                        <ul>
                                            <li><div class="eventDate">
                                                @if(!empty($slider->schedule))
                                                    <i class="fa fa-calendar-o"></i>{{ full_text_date($slider->schedule->date_at) }}
                                                @endif</div>
                                            </li>
                                            <li><div class="eventPlace"><i class="fa fa-map-marker"></i>{{ $slider->venue->name }}</div></li>
                                        </ul>
                                        <div class="moreDetail">
                                            <a href="{{ URL::route('event-detail', $slider->event->slug) }}">
                                              <button class="btn btnDetail font-bold">{{ trans('general.more_details') }}</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                

                <!-- Controls -->
                <a class="left carousel-control" href="#carouselHacked" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carouselHacked" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
    @endif
    @if(!empty($events))
    <section class="newRelease">
        <div class="container">
            <h2 class="font-light">{{ trans('general.new_release') }}</h2>
            <div class="row">
                @foreach($events as $key => $event)  
                    <a href="{{ URL::route('event-detail', $event->event->slug) }}">
                        <div class="col-md-4 box-release">
                            <img src="{{ file_url('events/'.$event->event->featured_image2, env('FILESYSTEM_DEFAULT')) }}">
                            <div class="boxInfo box-info1 bg-{{ $event->event->background_color }}">
                                <ul>      
                                    <li class="eventType">{{ strtoupper($event->cat_name) }}</li>
                                    <li class="eventName">{{ string_limit($event->event->title) }}</li>
                                    <li class="eventDate"><i class="fa fa-calendar-o"></i> 
                                        @if(!empty($event->schedule))
                                            {{ full_text_date($event->schedule->date_at) }}
                                        @endif
                                    </li>
                                    <li class="eventPlace"><i class="fa fa-map-marker"></i>{{ $event->venue->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="loadMore">
                <a href="{{ URL::route('discover')}}">
                  <button class="btn btnLoad font-bold">{{ trans('general.discover_more_events') }}</button>
                </a>
            </div>
        </div>
    </section>
    @endif
    @if(!empty($promotions))
    <section class="latestPromo">
        <div class="container">
            <h2 class="font-light">{{ trans('general.latest_promotions') }}</h2>
            <div class="row">                
                @foreach($promotions as $key => $promotion) 
                    @if(!empty($promotion->promo))
                        <div class="col-md-4 box-promo">
                            <a href="#promoModal{{ $promotion->id }}" data-toggle="modal">
                                <img src="{{ file_url('events/'.$promotion->event->featured_image2, env('FILESYSTEM_DEFAULT')) }}" class="image-promo">
                                <div class="boxInfo promo1">
                                    <ul>
                                        <li class="eventType">
                                            {{ $promotion->promo->category }}
                                        </li>
                                        <li class="eventName">{{ string_limit($promotion->promo->title) }} <img src="{{ file_url('promotions/'.$promotion->promo->featured_image, env('FILESYSTEM_DEFAULT')) }}"></li>
                                        <br>
                                        <li class="eventPlace">{{ trans('general.valid_from') }}
                                            {{ $promotion->promo->valid }}
                                        </li>
                                    </ul>
                                </div>
                            </a>
                            <div class="modal fade promoModal" id="promoModal{{ $promotion->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">{{$promotion->promo->title}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="promoBanner">
                                                <img src="{{ file_url('events/'.$promotion->event->featured_image1, env('FILESYSTEM_DEFAULT')) }}">
                                            </div>
                                            <div class="descPromoModal">
                                                <h4>{{ trans('general.about_this_promotion') }}</h4>
                                                <div class="promoBannerDesc">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            {!! $promotion->promo->description !!}
                                                        </div>
                                                        <div class="col-md-3">
                                                            <img src="{{ file_url('promotions/'.$promotion->promo->featured_image, env('FILESYSTEM_DEFAULT')) }}" class="promoLogo">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <h4>How to Participate </h4>
                                                <p>Show StarHub bill or subscription on any device such as mobile phone or tablet.</p> -->

                                                <p>{{ trans('general.discount') }}: {{ $promotion->promo->disc }}
                                                </p>
                                                <h4>Promotion Period</h4>
                                                <p>{{ trans('general.start_date') }}: {{ full_text_date($promotion->promo->start_date) }}</p>
                                                <br>
                                                <p>{{ trans('general.end_date') }}: {{ full_text_date($promotion->promo->end_date) }}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h4>{{ trans('general.get_your_early_bird_tickets_now') }}</h4>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ $promotion->Event->buylink }}">
                                                      <button type="button" class="btn btn-primary">{{ trans('general.buy_now') }}</button>
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="loadMore">
                <a href="{{ URL::route('promotion')}}">
                  <button class="btn btnLoad font-bold">{{ trans('general.more_promotions') }}</button>
                </a>
            </div>
        </div>
    </section>
    @endif
@stop