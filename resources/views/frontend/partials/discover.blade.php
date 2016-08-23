@extends('layout.frontend.master.master')
@section('title', 'Asia Box Office')
@section('content')
<section class="discoverCategory">
    <div class="container">
        <h2>Discover</h2>
        @if(!empty($categories))
            <div class="tabCategory">
                <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#new" aria-controls="home" role="tab" data-toggle="tab">
                        <i class="fa fa-certificate" width="23px" height="23px"></i><br>What's New
                    </a>
                </li>
                @foreach($categories as $key => $category) 
                    <li role="presentation"><a href="{{ URL::route('category-detail', $category->slug) }}" aria-controls="{{$category->slug}}" role="tab">
                        <i class="fa fa-{{ $category->icon }}" width="23px" height="23px"></i><br>{{ $category->name }}</a>
                    </li>
                @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>
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
                        @php
                            $cat = $slider->Event->Categories->first();
                        @endphp          
                        <div class="item {{ $key == 0 ? 'active' : ' '}}">
                          <img src="{{ $src.$slider->Event->featured_image1 }}" alt="...">
                          <div class="carousel-caption">
                            <div class="container">
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
            <div class="row append-events">
                @foreach($events as $key => $event) 
                    <a href="{{ URL::route('event-detail', $event->slug) }}">
                        <div class="col-md-4 box-release">
                            <img src="{{ $event->featured_image2_url }}">
                            <div class="boxInfo info1">
                                <ul>
                                    <li class="eventType">{{ $event->cat_name }}</li>
                                    <li class="eventName">{{ $event->title }}</li>
                                    @if($event->first_date != '')
                                        <li class="eventDate"><i class="fa fa-calendar-o"></i> {{ $event->first_date }}</li>
                                    @endif
                                    <li class="eventPlace">{{ $event->venue->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if($events->nextPageUrl() != null)
                <div class="loadMore">
                  <a href="javascript:void(0)" class="btn btnLoad">Load More Events</a>
                </div>
            @endif
        </div>
    </section>
@endif
@stop
@include('frontend.partials.script.discover_script')