@extends('layout.frontend.master.master')
@section('title', 'Asia Box Office')
@section('content')
<section class="discoverCategory">
  <div class="container">
      <h2>Discover</h2>
      <div class="tabCategory">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#new" aria-controls="home" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catNew.png') }}"><br>What's New</a></li>
            <li role="presentation"><a href="#art" aria-controls="profile" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catArt.png') }}"><br>Arts / Culture</a></li>
            <li role="presentation"><a href="#comedy" aria-controls="messages" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catComedy.png') }}"><br>Comedy</a></li>
            <li role="presentation"><a href="#concert" aria-controls="settings" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catConcert.png') }}"><br>Concerts</a></li>
            <li role="presentation"><a href="#dance" aria-controls="home" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catDance.png') }}"><br>Dance</a></li>
            <li role="presentation"><a href="#family" aria-controls="profile" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catFamily.png') }}"><br>Family</a></li>
            <li role="presentation"><a href="#food" aria-controls="messages" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catFood.png') }}"><br>F & B</a></li>
            <li role="presentation"><a href="#mice" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-briefcase"></i><br>MICE</a></li>
            <li role="presentation"><a href="#music" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-music"></i><br>Musical</a></li>
            <li role="presentation"><a href="#sport" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-trophy"></i><br>Sports</a></li>
        </ul>
    </div>
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
                        <div class="item {{ $key == 0 ? 'active' : ' '}}">
                          <img src="{{ $src.$slider->Event->featured_image1 }}" alt="...">
                          <div class="carousel-caption">
                            <div class="container">
                                <h5></h5>
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
            <div class="row">
                @foreach($events as $key => $event) 
                    <a href="{{ URL::route('event-detail', $event->slug) }}">
                        <div class="col-md-4 box-release">
                            <img src="{{ $src.$event->featured_image2 }}">
                            <div class="boxInfo info1">
                                <ul>
                                    <li class="eventType">{{ $event->event_type == true ? trans('general.general') : trans('general.seated') }}</li>
                                    <li class="eventName">{{ $event->title }}</li>
                                    @php 
                                        $schedule = $event->EventSchedule;
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
                                    <li class="eventPlace">{{ $event->Venue->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="loadMore">
                <button class="btn btnLoad">Load More Events</button>
            </div>
        </div>
    </section>
@endif
@stop