@extends('layout.frontend.master.master')
@section('title', '')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
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
                            <a href="{{ URL::route('event-detail', $slider->event->slug) }}">
                                <img src="{{ file_url('events/'.$slider->event->featured_image1, env('FILESYSTEM_DEFAULT')) }}" class="hidden-xs" alt="...">
                                <img src="{{ file_url('events/'.$slider->event->featured_image2, env('FILESYSTEM_DEFAULT')) }}" class="hidden-lg hidden-md hidden-sm" alt="...">
                            </a>
                            <div class="carousel-caption bg-green" style="background-color:{{ $slider->event->background_color }} !important">
                                <div class="container">
                                    <h5 class="categorySlide">{{ strtoupper($slider->cat_name) }}</h5>
                                    <h2 class="titleSlide font-light">{{ $slider->event->title }}</h2>
                                    <ul>
                                        <li><div class="eventDate">
                                                <i class="fa fa-calendar-o"></i>{{ $slider->schedule_range }}
                                            </div>
                                        </li>
                                        <li><div class="eventPlace"><i class="fa fa-map-marker"></i>{{ $slider->venue_name.$slider->country_name }}</div></li>
                                    </ul>
                                    <div class="moreDetail">
                                        <a href="{{ URL::route('event-detail', $slider->event->slug) }}">
                                          <button class="btn btnDetail font-bold">{{ trans('frontend/general.more_details') }}</button>
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
            <h2 class="font-light">{{ trans('frontend/general.new_release') }}</h2>
            <div class="row">
                @foreach($events as $key => $event)  
                    <a href="{{ URL::route('event-detail', $event->event->slug) }}">
                        <div class="col-md-6 box-release">
                            <img src="{{ file_url('events/'.$event->event->featured_image2, env('FILESYSTEM_DEFAULT')) }}">
                            <div class="boxInfo box-info1 bg-green" style="background-color:{{ $event->event->background_color }} !important">
                                <ul>      
                                    <li class="eventType">{{ strtoupper($event->cat_name) }}</li>
                                    <li class="eventName">{{ string_limit($event->event->title) }}</li>
                                    <li class="eventDate"><i class="fa fa-calendar-o"></i> 
                                        {{ $event->schedule_range }}
                                    </li>
                                    <li class="eventPlace"><i class="fa fa-map-marker"></i>{{ $event->venue_name.$event->country_name }}</li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="loadMore">
                <a href="{{ URL::route('discover')}}">
                  <button class="btn btnLoad font-bold">{{ trans('frontend/general.discover_more_events') }}</button>
                </a>
            </div>
        </div>
    </section>
    @endif
@stop