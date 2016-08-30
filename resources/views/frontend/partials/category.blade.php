@extends('layout.frontend.master.master')
@section('title', 'Asia Box Office')
@section('content')
<section class="discoverCategory">
    <div class="container">
        <h2>{{ $category->name }}</h2>
        @if(!empty($categories))
            <div class="tabCategory">
                <ul class="nav nav-tabs" role="tablist">
                <li role="presentation">
                    <a href="{{ URL::route('discover') }}">
                        <i class="fa fa-certificate" width="23px" height="23px"></i><br>What's New
                    </a>
                </li>
                @foreach($categories as $key => $cat) 
                    <li role="presentation" class="{{ $category->slug == $cat->slug ? 'active' : '' }}"><a href="{{ URL::route('category-detail', $cat->slug) }}" aria-controls="{{$cat->slug}}" role="tab">
                        <i class="fa fa-{{ $cat->icon }}" width="23px" height="23px"></i><br>{{ $cat->name }}</a>
                    </li>
                @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>
@if(!empty($events))
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
                                    <li class="eventDate"><i class="fa fa-calendar-o"></i> {{ $event->first_date }}</li>
                                    <li class="eventPlace">{{ $event->Venue->name }}</li>
                                    
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if($events->nextPageUrl() != null)
                <div class="loadMore">
                  <a href="javascript:void(0)" class="btn btnLoad" data-slug="{{ $category->slug }}">Load More Events</a>
                </div>
            @endif
        </div>
    </section>
@endif
@stop
@include('frontend.partials.script.category_script')