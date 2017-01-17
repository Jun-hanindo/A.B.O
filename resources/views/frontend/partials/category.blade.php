@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.discover').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="discoverCategory">
    <div class="discover-desktop">
        <div class="container">
            <h2 class="font-light">{{ trans('frontend/general.discover_events') }}</h2>
            <div class="tabCategory">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation">
                        <a href="{{ URL::route('discover') }}" aria-controls="home" role="tab">
                            <i class="fa fa-certificate"></i><br>{{ trans('frontend/general.whats_new') }}
                        </a>
                    </li>
                    @if(!empty($categories))
                        @foreach($categories as $key => $cat) 
                            <li role="presentation" class="{{ $category->slug == $cat->slug ? 'active' : '' }}"><a href="{{ URL::route('category-detail', $cat->slug) }}" aria-controls="{{$cat->slug}}" role="tab">
                                @if(!empty($cat->icon))
                                    <i class="fa fa-{{ $cat->icon }}"></i>
                                @else
                                    <img src="{{ $cat->icon_image_url }}">
                                @endif
                                <br>{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="eventTabScroll tabCategories">
            <div class="container">
                <div class="tabCategory">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation">
                            <a href="{{ URL::route('discover') }}" aria-controls="home" role="tab">
                                <i class="fa fa-certificate"></i><br>{{ trans('frontend/general.whats_new') }}
                            </a>
                        </li>
                        @if(!empty($categories))
                            @foreach($categories as $key => $cat) 
                                <li role="presentation" class="{{ $category->slug == $cat->slug ? 'active' : '' }}"><a href="{{ URL::route('category-detail', $cat->slug) }}" aria-controls="{{$cat->slug}}" role="tab">
                                    @if(!empty($cat->icon))
                                        <i class="fa fa-{{ $cat->icon }}"></i>
                                    @else
                                        <img src="{{ $cat->icon_image_url }}">
                                    @endif
                                    <br>{{ $cat->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="discover-mobile">
        <div class="container categoryTab-mobile">
            <h2 class="font-light">{{ trans('frontend/general.discover_events') }}</h2>
            <div class="tabCategory">
                <ul class="list-category-mobile">
                    <li><a href="{{ URL::route('discover') }}"><i class="fa fa-certificate"></i><br>{{ trans('frontend/general.whats_new') }}</a></li>
                    <li class="dropdown active" role="presentation"><a href="#" data-toggle="dropdown" class="discover-category-mobile dropdown-toggle" id="dropcat">
                        <span id="selected-category">
                            @if(!empty($category->icon))
                                <i class="fa fa-{{ $category->icon }}"></i>
                            @else
                                <img src="{{ $category->icon_image_url }}">
                            @endif
                            <br>{{ $category->name }}
                        </span>
                        <span id="select-category" style="display:none"><i class="fa icat"></i><br>{{ trans('frontend/general.select_category') }}</span></a>
                        <ul class="dropdown-menu" aria-labelledby="dropcat" id="dropdown-menu-discover">
                            @if(!empty($categories))
                            @php 
                                $i = 1;
                            @endphp
                                @foreach($categories as $key => $cat) 
                                    @if($i % 3 == 1)
                                        <div class="row">
                                    @endif 
                                        <div class="col-xs-4">
                                            <a href="{{ URL::route('category-detail', $cat->slug) }}">
                                                @if(!empty($cat->icon))
                                                    <i class="fa fa-{{ $cat->icon }}"></i>
                                                @else
                                                    <img src="{{ $cat->icon_image_url }}">
                                                @endif
                                                <i class="fa fa-{{ $cat->icon }}"></i><br>{{ $cat->name }}</a>
                                        </div>
                                    @if($i % 3 == 0)
                                        </div>
                                    @endif 
                                    @php 
                                        $i++;
                                    @endphp
                                @endforeach
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="eventTabScroll-mobile tabCategories tabCategories-mobile">
            <div class="container">
                <div class="tabCategory">
                    <ul class="list-category-mobile">
                        <li><a href="{{ URL::route('discover') }}"><i class="fa fa-certificate"></i><br>{{ trans('frontend/general.whats_new') }}</a></li>
                        <li class="dropdown active" role="presentation"><a href="#" data-toggle="dropdown" class="discover-category-mobile dropdown-toggle" id="dropcat">
                            <span id="selected-category">
                                @if(!empty($category->icon))
                                    <i class="fa fa-{{ $category->icon }}"></i>
                                @else
                                    <img src="{{ $category->icon_image_url }}">
                                @endif
                                <br>{{ $category->name }}
                            </span>
                            <span id="select-category" style="display:none"><i class="fa icat"></i><br>{{ trans('frontend/general.select_category') }}</span></a>
                            <ul class="dropdown-menu" aria-labelledby="dropcat" id="dropdown-menu-discover">
                                @if(!empty($categories))
                                @php 
                                    $i = 1;
                                @endphp
                                    @foreach($categories as $key => $cat) 
                                        @if($i % 3 == 1)
                                            <div class="row">
                                        @endif 
                                            <div class="col-xs-4">
                                                <a href="{{ URL::route('category-detail', $cat->slug) }}">
                                                    @if(!empty($cat->icon))
                                                        <i class="fa fa-{{ $cat->icon }}"></i>
                                                    @else
                                                        <img src="{{ $cat->icon_image_url }}">
                                                    @endif
                                                    <br>{{ $cat->name }}</a>
                                            </div>
                                        @if($i % 3 == 0)
                                            </div>
                                        @endif 
                                        @php 
                                            $i++;
                                        @endphp
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@if(!empty($banner))
    <section class="slider-home">
        <div id="carouselSlider" class="carousel slide carousel-fade">
            <div class="carousel-inner" role="listbox"> 
                <div class="item active">
                    <a href="{{ URL::route('event-detail', $banner->slug) }}">
                        <img src="{{ $banner->featured_image1_url }}" class="hidden-xs">
                        <img src="{{ $banner->featured_image2_url }}" class="hidden-lg hidden-md hidden-sm" alt="...">
                    </a>
                    <div class="carousel-caption bg-green carousel-discover" style="background-color:{{ $banner->background_color }} !important">
                        <div class="container">
                            <h5 class="categorySlide">{{ $banner->cat_name }}</h5>
                            <h2 class="titleSlide font-light">{{ $banner->title }}</h2>
                            <ul>
                                <li><div class="eventDate"><i class="fa fa-calendar-o"></i>{{ $banner->schedule }}</div></li>
                                <li><div class="eventPlace"><i class="fa fa-map-marker"></i>{{ $banner->venue_name.$banner->city }}</div></li>
                            </ul>
                            <div class="moreDetail">
                                <a href="{{ URL::route('event-detail', $banner->slug) }}">
                                  <button class="btn btnDetail font-bold">{{ trans('frontend/general.more_details') }}</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <button class="btn btnLoad font-bold" data-slug="{{ $category->slug }}">{{ trans('frontend/general.load_more_events') }}</button>
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