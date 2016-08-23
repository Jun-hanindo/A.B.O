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
    @if(!empty($promotions))
    <section class="latestPromo">
        <div class="container">
            <h2>Latest Promotions</h2>
            <div class="row">                
                @foreach($promotions as $key => $promotion) 
                @php
                    $data = $promotion->Event->promotions()->where('avaibility', true)->orderBy('start_date')->first();
                @endphp
                    {{-- <a href="{{ URL::route('event-detail', $promotion->Event->slug) }}"> --}}
                        <div class="col-md-4 box-promo">
                            <img src="{{ $src.$promotion->Event->featured_image2 }}" class="image-promo">
                            <div class="boxInfo promo1">
                                <ul>
                                    <li class="eventType">
                                        @if($data->category == 'discounts')
                                            {{ $data->category = 'DISCOUNTS' }}
                                        @elseif($data->category == 'early-bird')
                                            {{ $data->category = 'EARLY BIRD' }}
                                        @else
                                            {{ $data->category = 'LUCKY DRAW' }}
                                        @endif
                                    </li>
                                    <li class="eventName">{{$data->title}} <img src="{{ $src2.$data->featured_image }}"></li>
                                    <li class="eventPlace">
                                        @php
                                            $d_start = date('d', strtotime($data->start_date));
                                            $m_start = date('m', strtotime($data->start_date));
                                            $y_start = date('Y', strtotime($data->start_date));
                                            $d_end = date('d', strtotime($data->end_date));
                                            $m_end = date('m', strtotime($data->end_date));
                                            $y_end =  date('Y', strtotime($data->end_date));
                                        @endphp
                                        Valid From {{ date('d F Y', strtotime($data->start_date)).' - '.date('d F Y', strtotime($data->end_date)) }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <!-- </a> -->
                @endforeach
            </div>
            <div class="loadMore">
                <a href="{{ URL::route('promotion')}}" class="btn btnLoad">More Promotions</a>
            </div>
        </div>
    </section>
    @endif
@stop