@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.discover_events').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="discoverCategory">
    <div class="container">
        <h2 class="font-light">{{ trans('frontend/general.discover_events') }}</h2>
    </div>
</section>
@if(!$events->isEmpty())
    <section class="newRelease">
        <div class="container">
            <div class="row append-events">
                @foreach($events as $key => $event) 
                    <a href="{{ URL::route('event-detail', $event->slug) }}">
                        <div class="col-md-6 box-release">
                            <img src="{{ $event->featured_image2_url }}">
                            <div class="boxInfo bg-green" style="background-color:{{ $event->background_color }} !important">
                                <ul>
                                    <li class="eventType">{{ $event->cat_name }}</li>
                                    <li class="eventName">{{ $event->title }}</li>
                                    <li class="eventDate"><i class="fa fa-calendar-o"></i>{{ (!empty($event->schedule_title)) ? $event->schedule_title : $event->schedule_range }}</li>
                                    <li class="eventPlace"><i class="fa fa-map-marker"></i> {{ $event->venue_name.$event->city }}</li>
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