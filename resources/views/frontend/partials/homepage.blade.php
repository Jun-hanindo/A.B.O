@extends('layout.frontend.master.master')
@section('title', 'Page Title')
@section('content')
    @if(!empty($sliders))
        <section class="slider-home">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach($sliders as $key => $slider) 
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : ' '}}"></li>
                    @endforeach
                </ol>


                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">   
                        @foreach($sliders as $key => $slider)        
                            <div class="item {{ $key == 0 ? 'active' : ' '}}">
                              <img src="{{ $src.$slider->Event->featured_image1 }}" alt="...">
                              <div class="carousel-caption">
                                <div class="container">
                                    @php
                                        $cat = $slider->Event->Categories->first();
                                    @endphp 
                                    <h5>{{ $cat['name'] }}</h5>
                                    <h2>{{ $slider->Event->title }}</h2>
                                    @php 
                                        $schedule = $slider->Event->EventSchedule;
                                        $first = true;
                                    @endphp
                                    @if(!empty($schedule))
                                        @foreach($schedule as $sch)
                                            @if($first)
                                                <div class="eventDate"><i class="fa fa-calendar"></i> {{ date('d F Y', strtotime($sch->date_at)) }}</div>
                                                {{ $first = false }}
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="eventPlace"><i class="fa fa-map-marker"></i>{{ $slider->Event->Venue->name }}</div>
                                    <div class="moreDetail">
                                        <form action="{{ URL::route('event-detail', $slider->Event->slug) }}">
                                            <button class="btn btnDetail">More Details</button>
                                        </form>
                                        
                                    </div>
                                </div>
                              </div>
                            </div>
                        @endforeach
                    </div>
                

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </section>
    @endif
    @if(!empty($events))
    <section class="newRelease">
        <div class="container">
            <h2>New Release</h2>
            <div class="row">
                @foreach($events as $key => $event) 
                    <a href="{{ URL::route('event-detail', $event->Event->slug) }}">
                        <div class="col-md-4 box-release">
                            <img src="{{ $src.$event->Event->featured_image2 }}">
                            <div class="boxInfo info1">
                                <ul>
                                    @php
                                        $cat = $event->Event->Categories->first();
                                    @endphp      
                                    <li class="eventType">{{ $cat['name'] }}</li>
                                    <li class="eventName">{{ $event->Event->title }}</li>
                                    @php 
                                        $schedule = $event->Event->EventSchedule;
                                        $first = true;
                                    @endphp
                                    @if(!empty($schedule))
                                        @foreach($schedule as $sch)
                                            @if($first)
                                                <li class="eventDate"><i class="fa fa-calendar-o"></i> {{ date('d F Y', strtotime($sch->date_at)) }}</li>
                                                {{ $first = false }}
                                            @endif
                                        @endforeach
                                    @endif
                                    <li class="eventPlace">{{ $event->Event->Venue->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="loadMore">
                        <a href="{{ URL::route('discover')}}" class="btn btnLoad">Discover More Events</a>
            </div>
        </div>
    </section>
    @endif
    <section class="latestPromo">
        <div class="container">
            <h2>Latest Promotions</h2>
            <div class="row">
                <div class="col-md-4 box-promo">
                    <img src="{{ asset('assets/frontend/images/mj-poster.png') }}" class="image-promo">
                    <div class="boxInfo promo1">
                        <ul>
                            <li class="eventType">EARLY BIRD</li>
                            <li class="eventName">Pre-sale for StarHub Customers <img src="{{ asset('assets/frontend/images/starhub-logo.png') }}"></li>
                            <li class="eventPlace">Valid From 1 - 10 June 2016</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 box-promo">
                    <img src="{{ asset('assets/frontend/images/dining-poster.png') }}" class="image-promo">
                    <div class="boxInfo promo1">
                        <ul>
                            <li class="eventType">DISCOUNTS</li>
                            <li class="eventName">Enjoy 5% off Dining Before Event <img src="{{ asset('assets/frontend/images/esplanade-logo.png') }}"></li>
                            <li class="eventPlace">Valid From May - October 2016</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 box-promo">
                    <img src="{{ asset('assets/frontend/images/blue-poster.png') }}" class="image-promo">
                    <div class="boxInfo promo1">
                        <ul>
                            <li class="eventType">DISCOUNTS</li>
                            <li class="eventName">Enjoy 10% off with MasterCard <img src="{{ asset('assets/frontend/images/master-logo.png') }}"></li>
                            <li class="eventPlace">Valid From 27 May - 20 August 2016</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="loadMore">
                <button class="btn btnLoad">More Promotions</button>
            </div>
        </div>
    </section>
@stop