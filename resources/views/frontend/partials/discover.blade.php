@extends('layout.frontend.master.master')
@section('title', 'Asia Box Office')
@section('content')
<section class="discoverCategory">
    <div class="container">
        <h2>Discover</h2>
            <div class="tabCategory">
                <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#new" aria-controls="home" role="tab" data-toggle="tab">
                        <i class="fa fa-certificate" width="23px" height="23px"></i><br>What's New
                    </a>
                </li>
                @if(!empty($categories))
                    @foreach($categories as $key => $category) 
                        <li role="presentation"><a href="{{ URL::route('category-detail', $category->slug) }}" aria-controls="{{$category->slug}}" role="tab">
                            <i class="fa fa-{{ $category->icon }}" width="23px" height="23px"></i><br>{{ $category->name }}</a>
                        </li>
                    @endforeach
                @endif
                </ul>
            </div>
    </div>
</section>
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
                                    <h2 class="titleSlide font-light">{{ $slider->title }}</h2>
                                    <ul>
                                        <li><div class="eventDate">
                                            @if(!empty($slider->schedule))
                                                <i class="fa fa-calendar-o"></i>{{ full_text_date($slider->schedule->date_at) }}
                                            @endif</div>
                                        </li>
                                        <li><div class="eventPlace"><i class="fa fa-map-marker"></i>{{ $slider->venue->name }}</div></li>
                                    </ul>
                                    <div class="moreDetail">
                                        <a href="{{ URL::route('event-detail', $slider->slug) }}">
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
            </a>
        </div>
    </section>
@endif
@if(!$events->isEmpty())
    <section class="newRelease">
        <div class="container">
            <div class="row append-events">
                @foreach($events as $key => $event) 
                    <a href="{{ URL::route('event-detail', $event->slug) }}">
                        <div class="col-md-4 box-release">
                            <img src="{{ $event->featured_image2_url }}">
                            <div class="boxInfo bg-{{ $event->background_color }}">
                                <ul>
                                    <li class="eventType">{{ $event->cat_name }}</li>
                                    <li class="eventName">{{ $event->title }}</li>
                                    <li class="eventDate"><i class="fa fa-calendar-o"></i> {{ $event->date_at }}</li>
                                    <li class="eventPlace"><i class="fa fa-map-marker"></i> {{ $event->venue->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if($events->nextPageUrl() != null)
                <div class="loadMore">
                    <a href="javascript:void(0)">
                        <button class="btn btnLoad">Load More Events</button>
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
                    <h3 class="text-center">There are no event.</h3>
                </div>
            </div>
        </div>
    </section>
@endif
@stop
@include('frontend.partials.script.discover_script')