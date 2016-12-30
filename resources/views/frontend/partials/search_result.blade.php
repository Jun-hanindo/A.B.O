@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.search_result').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="about-content faq-content result-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar sidebar-search">
                <ul>
                    <form id="filter-form">
                    <li class="sidebar-head">
                        <h4 class="font-light">{{ trans('frontend/general.filters') }}</h4>
                        <a href="javascript:void(0)" class="reset-filter"><i class="fa fa-undo"></i> {{ trans('frontend/general.reset') }} </a>
                    </li>
                    <li class="sidebar-menu-top filter-search">
                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseCategories" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.categories') }}</a>
                        <div class="collapse" id="collapseCategories">
                            <div class="filter-child filter-categories">
                                <ul>
                                    @if(!empty($categories))
                                        <li><input type="checkbox" name="cat[]" class="cat-filter-all" value="all"
                                                @if(!empty($cats_sel))
                                                    @foreach($cats_sel as $k => $cat_sel) 
                                                        @if($cat_sel == 'all')
                                                            checked
                                                        @endif
                                                    @endforeach
                                                @endif
                                                > All Categories</li>
                                        @foreach($categories as $key => $category) 
                                             <li><input type="checkbox" name="cat[]" class="cat-filter" value="{{$category->slug}}"
                                                @if(!empty($cats_sel))
                                                    @foreach($cats_sel as $k => $cat_sel) 
                                                        @if($cat_sel == $category->slug)
                                                            checked
                                                        @endif
                                                    @endforeach
                                                @endif
                                                > {{ $category->name }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </li>
                    {{-- <li class="sidebar-menu filter-search">
                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseLanguages" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.languages') }}</a>
                        <div class="collapse" id="collapseLanguages">
                            <div class="filter-child filter-categories">
                                <ul>
                                    <li><a href="#">Language 1</a></li>
                                    <li><a href="#">Language 2</a></li>
                                </ul>
                            </div>
                        </div>
                    </li> --}}
                    {{-- <li class="sidebar-menu filter-search">
                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseTime" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.time_period') }}</a>
                        <div class="collapse" id="collapseTime">
                            <div class="filter-child filter-categories">
                                <select id="filter-period" name="period" class="form-control">
                                    <option value="all" >All</option>

                                    @for($x = 3; $x < 4; $x+=2) 
                                        @if($x == 1)
                                            <option value="{{ $x }}" {{ $period_sel == $x ? 'selected' : '' }}>{{ $x }} month from now</option>
                                        @else
                                            <option value="{{ $x }}" {{ $period_sel == $x ? 'selected' : '' }}>{{ $x }} months from now</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </li> --}}
                    <li class="sidebar-menu filter-search filter-last">
                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseVenue" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.venues') }}</a>
                        <div class="collapse" id="collapseVenue">
                            <div class="filter-child filter-categories">
                                @if(!empty($venues))
                                    <select id="filter-venue" name="venue" class="form-control">
                                        <option value="all" >All</option>

                                        @foreach($venues as $key => $venue) 
                                            <option value="{{ $venue->slug }}" {{ $venue_sel == $venue->slug ? 'selected' : '' }} >{{ $venue->name }}</option>
                                        @endforeach
                                    </select>
                                @endif 
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
                            <h4 class="head-about head-search font-light">{!! (!empty($q)) ? trans('frontend/general.search_result_for').' <span>"'.$q.'"</span>' : 'Search results' !!}</h4>
                            {{-- <select id="sort-search" name="sort" class="form-control">
                                <option value="date" {{ $sort == 'date' ? 'selected' : '' }}>Sort By Date</option>
                                <option value="price" {{ $sort == 'price' ? 'selected' : '' }}>Sort By Price</option>
                                <!-- <option value="popularity" {{ $sort == 'popularity' ? 'selected' : '' }}>Sort By Popularity</option> -->
                            </select> --}}
                        </div>
                        <div class="search-list search-list-head">
                            <table>
                                @if(!empty($events) && !$events->isEmpty())
                                    @foreach($events as $key => $event) 
                                        <tr class="tr-search bg-green" style="background-color:{{ $event->background_color }} !important">
                                            <td class="searchpic"><a href="{{ URL::route('event-detail', $event->slug) }}"><img src="{{ $event->featured_image3_url }}"></a></td>
                                            <td class="jobs"><a href="{{ URL::route('event-detail', $event->slug) }}">{{ $event->title }}</a></td>
                                            <td class="date"><a href="{{ URL::route('event-detail', $event->slug) }}">{{ $event->schedule }}</a></td>
                                            <td class="place"><a href="{{ URL::route('event-detail', $event->slug) }}">{{$event->venue_name.$event->city}}</a></td>
                                            <td class="type"><a href="{{ URL::route('event-detail', $event->slug) }}">{{ $event->cat_name }}</a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td><h3 class='text-center' style="color:#000;">{{ trans('frontend/general.there_are_no_event') }}</h3></td></tr>
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
                    <a class="menu collapsed" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.filters') }}</a>
                    <div class="collapse" id="mobile-sidebar-collapse">
                        <ul class="search-mobile">
                            <form id="filter-form-mobile">
                                <li class="sidebar-menu-top sidebar-mobile filter-search">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapseCategories-mobile" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.categories') }}</a>
                                    <div class="collapse" id="collapseCategories-mobile">
                                        <div class="filter-child filter-categories-mobile">
                                            <ul>
                                                @if(!empty($categories))
                                                    <li class="checkbox"><label><input type="checkbox" name="cat[]" class="cat-filter-mobile-all" value="all"
                                                        @if(!empty($cats_sel))
                                                            @foreach($cats_sel as $k => $cat_sel) 
                                                                @if($cat_sel == 'all')
                                                                    checked
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        > All Categories</label></li>
                                                    @foreach($categories as $key => $category) 
                                                         <li class="checkbox"><label><input type="checkbox" name="cat[]" class="cat-filter-mobile" value="{{$category->slug}}"
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
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                {{-- <li class="sidebar-menu filter-search">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapseLanguages-mobile" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.languages') }}</a>
                                    <div class="collapse" id="collapseLanguages-mobile">
                                        <div class="filter-child filter-categories-mobile">
                                            <ul>
                                                <li><a href="#">Language 1</a></li>
                                                <li><a href="#">Language 2</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li> --}}
                                {{-- <li class="sidebar-menu filter-search">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapseTime-mobile" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.time_period') }}</a>
                                    <div class="collapse" id="collapseTime-mobile">
                                        <div class="filter-child filter-categories-mobile">
                                            <select id="filter-period-mobile" name="period" class="form-control">
                                                <option value="all" >All</option>

                                                @for($x = 3; $x < 4; $x+=2) 
                                                    @if($x == 1)
                                                        <option value="{{ $x }}" {{ $period_sel == $x ? 'selected' : '' }}>{{ $x }} month from now</option>
                                                    @else
                                                        <option value="{{ $x }}" {{ $period_sel == $x ? 'selected' : '' }}>{{ $x }} months from now</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </li> --}}
                                <li class="sidebar-menu filter-search">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapseVenue-mobile" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.venues') }}</a>
                                    <div class="collapse" id="collapseVenue-mobile">
                                        <div class="filter-child filter-categories-mobile">
                                            @if(!empty($venues))
                                                <select id="filter-venue-mobile" name="venue" class="form-control">
                                                    <option value="all" >All</option>

                                                    @foreach($venues as $key => $venue) 
                                                        <option value="{{ $venue->slug }}" {{ $venue_sel == $venue->slug ? 'selected' : '' }} >{{ $venue->name }}</option>
                                                    @endforeach
                                                </select>
                                            @endif 
                                        </div>
                                    </div>
                                </li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                {{-- <div class="filter-search-mobile">
                    <select id="sort-search-mobile" name="sort" class="form-control">
                        <option value="date" {{ $sort == 'date' ? 'selected' : '' }}>Sort By Date</option>
                        <option value="price" {{ $sort == 'price' ? 'selected' : '' }}>Sort By Price</option>
                        <!-- <option value="popularity" {{ $sort == 'popularity' ? 'selected' : '' }}>Sort By Popularity</option> -->
                    </select> 
                </div> --}}
                <div class="search-list-mobile">
                    @if(!empty($events))
                        @foreach($events as $key => $event) 
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ URL::route('event-detail', $event->slug) }}" class="mobile-jobs-a">
                                        <div class="mobile-job-list">
                                            <div class="mobile-search-head bg-green" style="background-color:{{ $event->background_color }} !important">
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
                                                    <li class="date">{{ $event->schedule }}</li>
                                                    <li class="place">{{ $event->venue_name.$event->city }}</li>
                                                    <li class="type">{{ $event->cat_name }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class='text-center'>{{ trans('frontend/general.there_are_no_event') }}</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partials.script.search_script')
@stop