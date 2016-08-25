@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
<section class="about-content search-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <ul>
                    <form id="filter-form">
                    <li class="sidebar-head">
                            <h4>Filters</h4>
                    </li>
                    <li class="sidebar-menu-top sidebar-search">
                        <a data-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Categories</a>
                        <div class="collapse" id="categories">
                            <div class="collapse-search">
                                <ul>
                                    <li>
                                        @if(!empty($categories))
                                            @foreach($categories as $key => $category) 
                                                 <li class="checkbox"><label><input type="checkbox" name="cat[]" class="cat-filter" value="{{$category->slug}}"
                                                    @if(!empty($cats_sel))
                                                        @foreach($cats_sel as $k => $cat_sel) 
                                                            @if($cat_sel == $category->slug)
                                                                checked
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    > {{ $category->name }}</label></li>
                                            @endforeach
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="sidebar-menu sidebar-search">
                        <a data-toggle="collapse" href="#languages" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Languages</a>
                        <div class="collapse" id="languages">
                            <div class="collapse-search">
                                <ul>
                                    <li><a href="#">Language 1</a></li>
                                    <li><a href="#">Language 2</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="sidebar-menu sidebar-search">
                        <a data-toggle="collapse" href="#time" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Time Period</a>
                        <div class="collapse" id="time">
                            <div class="collapse-search">
                                <ul>
                                    <li>
                                        <select id="filter-period" name="period" class="form-control">
                                            <option value="all" >All</option>

                                            @for($x = 1; $x < 12; $x+=2) 
                                                @if($x == 1)
                                                    <option value="{{ $x }}" {{ $period_sel == $x ? 'selected' : '' }}>{{ $x }} month from now</option>
                                                @else
                                                    <option value="{{ $x }}" {{ $period_sel == $x ? 'selected' : '' }}>{{ $x }} months from now</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                        <li class="sidebar-menu sidebar-search">
                                <a data-toggle="collapse" href="#venue" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Venues</a>
                                <div class="collapse" id="venue">
                                    <div class="collapse-search">
                                        <ul>
                                            <li>
                                                @if(!empty($venues))
                                                    <select id="filter-venue" name="venue" class="form-control">
                                                        <option value="all" >All</option>

                                                        @foreach($venues as $key => $venue) 
                                                            <option value="{{ $venue->slug }}" {{ $venue_sel == $venue->slug ? 'selected' : '' }} >{{ $venue->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif 
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                        </li>
                    </form>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <div class="career-desc">
                    <div class="row">
                        <div class="job-head search-head">
                            <h4 class="head-about">Search result for <span>"{{$q}}"</span></h4>
                            <select id="sort-search" name="sort" class="form-control">
                                <option value="date" {{ $sort == 'date' ? 'selected' : '' }}>Sort By Date</option>
                                <option value="price" {{ $sort == 'price' ? 'selected' : '' }}>Sort By Price</option>
                                <!-- <option value="popularity" {{ $sort == 'popularity' ? 'selected' : '' }}>Sort By Popularity</option> -->
                            </select>
                        </div>
                        <div class="search-list search-list-head">
                            <table>
                                @if(!empty($events))
                                    @foreach($events as $key => $event) 
                                        <tr class="bg-{{ $event->background_color }} tr-search">
                                            <td class="searchpic"><a href="{{ URL::route('event-detail', $event->slug) }}"><img src="{{ $event->featured_image3_url }}"></a></td>
                                            <td class="jobs"><a href="{{ URL::route('event-detail', $event->slug) }}">{{ $event->title }}</a></td>
                                            <td class="date"><a href="{{ URL::route('event-detail', $event->slug) }}">{{ date('d M Y', strtotime($event->date)) }}</a></td>
                                            </td>
                                            <td class="place"><a href="{{ URL::route('event-detail', $event->slug) }}">{{ $event->venue }}</a></td>
                                            <td class="type"><a href="{{ URL::route('event-detail', $event->slug) }}">
                                                @php
                                                        $cat = explode(',', $event->category)
                                                @endphp
                                                {{ $cat[0] }}</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="search-mobile mobile-content">
    <div class="row">
        <div class="col-md-12 mobile-sidebar">
            <div class="container">
                <div class="mobile-sidebar-menu">
                    <a class="menu" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">Filters</a>
                    <div class="collapse" id="mobile-sidebar-collapse">
                        <ul class="search-mobile">
                            <li class="sidebar-menu-top sidebar-search">
                                    <a data-toggle="collapse" href="#categories-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Categories</a>
                                    <div class="collapse" id="categories-mobile">
                                        <div class="collapse-search">
                                            <ul>
                                                <li><a href="#">Categories 1</a></li>
                                                <li><a href="#">Categories 2</a></li>
                                            </ul>
                                        </div>
                                    </div>
                            </li>
                            <li class="sidebar-menu-top sidebar-search">
                                    <a data-toggle="collapse" href="#language-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Language</a>
                                    <div class="collapse" id="language-mobile">
                                        <div class="collapse-search">
                                            <ul>
                                                <li><a href="#">Language 1</a></li>
                                                <li><a href="#">Language 2</a></li>
                                            </ul>
                                        </div>
                                    </div>
                            </li>
                            <li class="sidebar-menu-top sidebar-search">
                                    <a data-toggle="collapse" href="#time-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Time Period</a>
                                    <div class="collapse" id="time-mobile">
                                        <div class="collapse-search">
                                            <ul>
                                                <li><a href="#">Time 1</a></li>
                                                <li><a href="#">Time 2</a></li>
                                            </ul>
                                        </div>
                                    </div>
                            </li>
                            <li class="sidebar-menu-top sidebar-search">
                                    <a data-toggle="collapse" href="#venue-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Venues</a>
                                    <div class="collapse" id="venue-mobile">
                                        <div class="collapse-search">
                                            <ul>
                                                <li><a href="#">Venue 1</a></li>
                                                <li><a href="#">Venue 2</a></li>
                                            </ul>
                                        </div>
                                    </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="filter-search-mobile">
                    <select id="sort-search" name="sort" class="form-control">
                        <option value="date" {{ $sort == 'date' ? 'selected' : '' }}>Sort By Date</option>
                        <option value="price" {{ $sort == 'price' ? 'selected' : '' }}>Sort By Price</option>
                        <!-- <option value="popularity" {{ $sort == 'popularity' ? 'selected' : '' }}>Sort By Popularity</option> -->
                    </select>
                </div>
                @if(!empty($events))
                    @foreach($events as $key => $event) 
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="mobile-jobs-a">
                                    <div class="mobile-job-list">
                                        <div class="mobile-search-head bg-{{ $event->background_color }}">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <img src="{{ $event->featured_image3_url }}">
                                                </div>
                                                <div class="col-xs-8">
                                                    <div class="mobile-search-title">
                                                        <h4>{{ $event->title }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mobile-search-desc">
                                            <ul>
                                                <li class="date">{{ date('d M Y', strtotime($event->date)) }}</li>
                                                <li class="place">{{ $event->venue }}</li>
                                                <li class="type">
                                                    @php
                                                        $cat = explode(',', $event->category)
                                                    @endphp
                                                    {{ $cat[0] }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@include('frontend.partials.script.search_script')
@stop