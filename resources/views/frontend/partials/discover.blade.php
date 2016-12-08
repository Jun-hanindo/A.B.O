@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.discover_events').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="discoverCategory">
    <div class="discover-desktop">
        <div class="container">
            <h2 class="font-light">{{ trans('frontend/general.discover_events') }}</h2>
            <div class="tabCategory">
                <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="{{ URL::route('discover') }}" aria-controls="home" role="tab" data-toggle="tab">
                        <i class="fa fa-certificate"></i><br>{{ trans('frontend/general.whats_new') }}
                    </a>
                </li>
                @if(!empty($categories))
                    @foreach($categories as $key => $category) 
                        <li role="presentation"><a href="{{ URL::route('category-detail', $category->slug) }}" aria-controls="{{$category->slug}}" role="tab">
                            <i class="fa fa-{{ $category->icon }}"></i><br>{{ $category->name }}</a>
                        </li>
                    @endforeach
                @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="discover-mobile">
        <div class="container">
            <h2 class="font-light">{{ trans('frontend/general.discover_events') }}</h2>
            <div class="tabCategory">
                <ul class="list-category-mobile">
                    <li class="active"><a href="{{ URL::route('discover') }}"><i class="fa fa-certificate"></i><br>{{ trans('frontend/general.whats_new') }}</a></li>
                    <li class="dropdown" role="presentation"><a href="#" data-toggle="dropdown" class="discover-category-mobile dropdown-toggle" id="dropcat"><i class="fa icat"></i><br>{{ trans('frontend/general.select_category') }}</a>
                        <ul class="dropdown-menu" aria-labelledby="dropcat" id="dropdown-menu-discover">
                            <div class="row">
                                @if(!empty($categories))
                                    @foreach($categories as $key => $category) 
                                        <div class="col-xs-4">
                                            <a href="{{ URL::route('category-detail', $category->slug) }}" aria-controls="{{$category->slug}}" role="tab"><i class="fa fa-{{ $category->icon }}"></i><br>{{ $category->name }}</a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

@if(!empty($sliders))
<section class="slider-home">
    <div id="carouselSlider" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($sliders as $key => $slider)
                <li data-target="#carouselSlider" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : ' '}}"></li> 
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
                                <li><div class="eventDate"><i class="fa fa-calendar-o"></i>{{ (!empty($slider->event->schedule_title)) ? $slider->event->schedule_title : $slider->schedule_range }}</div></li>
                                <li><div class="eventPlace"><i class="fa fa-map-marker"></i>{{ $slider->venue_name.$slider->city }}</div></li>
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
        <a class="left carousel-control" href="#carouselSlider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carouselSlider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
@endif
@if(!$events->isEmpty())
    <section class="newRelease discover-content">
        <div class="container">
            <div class="row append-events">
                @foreach($events as $key => $event) 
                    <a href="{{ URL::route('event-detail', $event->slug) }}">
                        <div class="col-md-6 box-release">
                            <img src="{{ $event->featured_image2_url }}">
                            <div class="boxInfo info1 bg-green" style="background-color:{{ $event->background_color }} !important">
                                <ul>
                                    <li class="eventType">{{ $event->cat_name }}</li>
                                    <li class="eventName">{{ $event->title }}</li>
                                    <li class="eventDate"><i class="fa fa-calendar-o"></i>{{ $event->schedule }}</li>
                                    <li class="eventPlace"><i class="fa fa-map-marker"></i>{{$event->venue_name.$event->city}}</li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if($events->nextPageUrl() != null)
                <div class="loadMore">
                    <a href="javascript:void(0)">
                        <button class="btn btnLoad">{{ trans('frontend/general.load_more_events') }}</button>
                    </a>
                </div>
            @endif
        </div>
    </section>
@else
    <section class="newRelease">
        <div class="container">
            <div class="row append-events">
                <div class="box-release">
                    <h3 class="text-center">{{ trans('frontend/general.there_are_no_event') }}</h3>
                </div>
            </div>
        </div>
    </section>
@endif
@stop
@include('frontend.partials.script.discover_script')