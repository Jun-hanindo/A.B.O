@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.discover').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="discoverCategory">
    <div class="container">
        <h2>{{ trans('frontend/general.discover') }}</h2>
            <div class="tabCategory">
                <ul class="nav nav-tabs" role="tablist">
                <li role="presentation">
                    <a href="{{ URL::route('discover') }}">
                        <i class="fa fa-certificate" width="23px" height="23px"></i><br>What's New
                    </a>
                </li>
                @if(!empty($categories))
                    @foreach($categories as $key => $cat) 
                        <li role="presentation" class="{{ $category->slug == $cat->slug ? 'active' : '' }}"><a href="{{ URL::route('category-detail', $cat->slug) }}" aria-controls="{{$cat->slug}}" role="tab">
                            <i class="fa fa-{{ $cat->icon }}" width="23px" height="23px"></i><br>{{ $cat->name }}</a>
                        </li>
                    @endforeach
                @endif
                </ul>
            </div>
    </div>
</section>
@if(!$events->isEmpty())
    <section class="newRelease">
        <div class="container">
            <div class="row append-events">
                @foreach($events as $key => $event) 
                    <a href="{{ URL::route('event-detail', $event->slug) }}">
                        <div class="col-md-4 box-release">
                            <img src="{{ file_url('events/'.$event->featured_image2, env('FILESYSTEM_DEFAULT')) }}">
                            <div class="boxInfo bg-{{ $event->background_color }}">
                                <ul>
                                    <li class="eventType">{{ $event->cat_name }}</li>
                                    <li class="eventName">{{ $event->title }}</li>
                                    <li class="eventDate"><i class="fa fa-calendar-o"></i> {{ $event->date_at }}</li>
                                    <li class="eventPlace"><i class="fa fa-map-marker"></i>{{ $event->venue->name }}</li>
                                    
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if($events->nextPageUrl() != null)
                <div class="loadMore">
                    <a href="javascript:void(0)">
                        <button class="btn btnLoad" data-slug="{{ $category->slug }}">{{ trans('frontend/general.load_more_events') }}</button>
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
@include('frontend.partials.script.category_script')