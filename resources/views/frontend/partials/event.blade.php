@extends('layout.frontend.master.master')
@section('title', $event->title.' - ')
@section('og_image', file_url('events/'.$event->featured_image1, env('FILESYSTEM_DEFAULT')))
@section('content')
@php
    $promotions = $event->promotions;
@endphp
<section class="eventBanner" id="eventBanner">
    <div class="imageBanner">
        {{-- @if(!empty($event->video_link))
            <div class="btnPlayEvent"><a data-toggle="modal" data-target="#eventVideo"><i class="fa fa-play-circle-o"></i></a></div>
        @endif --}}
        <img src="{{ file_url('events/'.$event->featured_image1, env('FILESYSTEM_DEFAULT')) }}" class="hidden-xs">
        <img src="{{ file_url('events/'.$event->featured_image1, env('FILESYSTEM_DEFAULT')) }}" class="hidden-lg hidden-md hidden-sm" alt="...">
    </div>
    <div class="infoBanner bg-{{ $event->background_color }}" id="eventTabShow">
        <div class="container">
            <div class="detail">
                <h5>{{ (!empty($event->category)) ? strtoupper($event->category->name) : '&nbsp;' }}</h5>
                <h2 class="font-light">{{ $event->title }}</h2>
            </div>
            <div class="moreDetail">
                <a href="{{ $event->buylink }}">
                    <button class="btn btnDetail font-bold">{{ trans('frontend/general.buy_now') }}</button>
                </a>
            </div>
        </div>
    </div>
</section>
<div class="eventTabScroll bg-{{ $event->background_color }}">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <ul class="" role="">
                    <li><a href="#eventBanner" class="smoothScroll backtop">{{ trans('frontend/general.back_to_summary') }}</a></li>
                    <li><a href="#aboutBox" class="smoothScroll active">{{ trans('frontend/general.about_this_event') }}</a></li>
                    @if(!$promotions->isEmpty())
                        <li><a href="#promoBox" class="smoothScroll">{{ trans('frontend/general.promotions') }}</a></li>
                    @endif
                    <li><a href="#venueBox" class="smoothScroll">{{ trans('frontend/general.venue_info') }}</a></li>
                    @if(!empty($event->admission))
                        <li><a href="#admissionBox" class="smoothScroll">{{ trans('frontend/general.admission_rules') }}</a></li>
                    @endif
                    <li><a href="{{ $event->buylink }}"><button class="btn btnBuy btnABO font-bold">{{ trans('frontend/general.buy_now') }}</button></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="eventTabScroll-mobile bg-{{ $event->background_color }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li><a href="#eventBanner" class="smoothScroll backtop"></a></li>
                    <li><a href="#aboutBox" class="smoothScroll active">{{ trans('frontend/general.about') }}</a></li>
                    @if(!$promotions->isEmpty())
                        <li><a href="#promoBox" class="smoothScroll">{{ trans('frontend/general.promotions') }}</a></li>
                    @endif
                    <li><a href="#venueBox" class="smoothScroll">{{ trans('frontend/general.venue') }}</a></li>
                    @if(!empty($event->admission))
                        <li><a href="#admissionBox" class="smoothScroll">{{ trans('frontend/general.admission') }}</a></li>
                    @endif
                    <li><a href="{{ $event->buylink }}"><button class="btn btnBuy btnABO font-bold">{{ trans('frontend/general.buy') }}</button></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="eventInfo">
    <div class="container">
        <div class="row">
            <div class="col-md-4 date">
                @php 
                    $schedules = $event->schedules;
                    $i = 0;
                    $count = count($schedules);
                @endphp
                @if(!empty($schedules))
                    <div class="information-title">
                        <i class="fa fa-calendar-o"></i> 
                        @foreach($schedules as $sch)
                            @if ($i == 0 && $count > 1)
                                {!! date('d', strtotime($sch->date_at)) !!}
                            @elseif ($i == 0 && $count == 1)
                                {!! date('d F Y', strtotime($sch->date_at)) !!} 
                            @elseif ($i == $count - 1 && $count > 1)
                                {!! ' - '.date('d F Y', strtotime($sch->date_at)) !!} 
                            @endif
                            @php 
                                $i++
                            @endphp
                        @endforeach
                    </div>
                    <ul class="list-unstyled">
                        @foreach($schedules as $sch)
                            <li class="liParent li-mobile">
                                <table>
                                    <tr>
                                        <td>{{ date('d M, D', strtotime($sch->date_at)) }}</td>
                                        <td><span>
                                                @php 
                                                        $prices = $sch->EventScheduleCategory()->first();
                                                @endphp
                                                @if(!empty($prices))
                                                        {{ $prices->additional_info }}
                                                @endif</span>
                                        </td>
                                        <td>{{ $sch->start_time.'-'.$sch->end_time }}</td>
                                    </tr>
                                </table>
                            </li>  
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-md-4 place">
                <div class="information-title">
                    <i class="fa fa-map-marker"></i> {{ $event->Venue->name }}
                </div>
                <ul class="list-unstyled">
                    <li>{!! $event->Venue->address !!}</li>
                    <li>
                        <a href="{{ $event->Venue->link_map }}" class="btn btnSeemap font-bold" target="_blank">See Map</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 ticket" id="ticket">
                <div class="information-title">
                    <i class="fa fa-ticket"></i> 
                    {{ !empty($min) ? $min->symbol_left.$min->price.$min->symbol_right: '' }}
                </div>
                <div class="information-event">
                    {!! $event->price_info !!}
                </div>
            </div>
            <div class="col-md-12 tabEvent">
                <div class="eventTab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a href="#aboutBox" class="smoothScroll active">About This Event</a></li>
                        @if(!$promotions->isEmpty())
                            <li><a href="#promoBox" class="smoothScroll">Promotions</a></li>
                        @endif
                        <li><a href="#venueBox" class="smoothScroll">Venue Info</a></li>
                        @if(!empty($event->admission))
                            <li><a href="#admissionBox" class="smoothScroll">Admission Rules</a></li>
                        @endif
                    </ul>
                </div>
                <div class="eventTab-mobile">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li><a href="#aboutBox" class="smoothScroll active">About</a></li>
                        @if(!$promotions->isEmpty())
                            <li><a href="#promoBox" class="smoothScroll">Promotions</a></li>
                        @endif
                        <li><a href="#venueBox" class="smoothScroll">Venue Info</a></li>
                        @if(!empty($event->admission))
                            <li><a href="#admissionBox" class="smoothScroll">Admission Rules</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="contentTab">
        <div class="container">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="aboutEvent">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="aboutBox boxBorder" id="aboutBox">
                                    <div class="row">
                                        <div class="side-left side-first col-md-3">
                                            <div class="aboutDesc">
                                                <h4>About This Event</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="main-content">
                                                <div class="">
                                                    <section id="about" class="sectionEvent">
                                                        {!! $event->description !!}    
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$promotions->isEmpty())
                                    <div class="promoBox boxBorder" id="promoBox">
                                        <div class="row">
                                            <div class="side-left col-md-3">
                                                <div class="aboutDesc">
                                                    <h4>Promotions</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="main-content">
                                                    <div class="">
                                                        @foreach($promotions as $key => $promotion) 
                                                            <section id="promotion" class="sectionEvent">
                                                                <img src="{{ file_url('promotions/'.$promotion->featured_image, env('FILESYSTEM_DEFAULT')) }}">
                                                                <h3 class="font-bold">{{ $promotion->title }}</h3>
                                                                {!! $promotion->description !!}
                                                                <p>{{ trans('general.discount') }}: 
                                                                    @if($promotion->discount > 0)
                                                                        {{ $promotion->discount.'%' }}
                                                                    @else
                                                                        @if($promotion->currency_id == 0)
                                                                            @php
                                                                                $currency_symbol_left = '';
                                                                                $currency_symbol_right = '';
                                                                            @endphp
                                                                        @else
                                                                            @php
                                                                                $currency_symbol_left = $promotion->currency->symbol_left;
                                                                                $currency_symbol_right = $promotion->currency->symbol_right;
                                                                            @endphp
                                                                        @endif
                                                                        {{ $currency_symbol_left.$promotion->discount_nominal.$currency_symbol_right }}
                                                                    @endif
                                                                </p>
                                                                <p>Start Date: {{ date('d F Y', strtotime($promotion->start_date)) }}</p>
                                                                <p>End Date: {{ date('d F Y', strtotime($promotion->end_date)) }}</p>
                                                            </section>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="venueBox {{ (!empty($event->admission)) ? 'boxBorder': '' }}" id="venueBox">
                                    <div class="row">
                                        <div class="side-left col-md-3">
                                            <div class="aboutDesc">
                                                <h4>Venue Info</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="main-content">
                                                <div class="">
                                                    <section id="venue" class="sectionEvent">
                                                        <h3 class="font-bold">{{ $event->Venue->name }}</h3>
                                                        {!! $event->Venue->address !!}

                                                        <div class="mapEvent">
                                                            {!! $event->Venue->gmap_link !!}
                                                        </div>

                                                        <h3 class="font-bold">Getting to the Venue</h3>
                                                        <ul id="getvenue">
                                                            <li class="mrt">
                                                                <h3 class="font-bold">By MRT</h3>
                                                                {!! $event->Venue->mrtdirection !!}
                                                            </li>
                                                            <li class="taxi">
                                                                <h3 class="font-bold">By Taxi / UBER Drop Off</h3>
                                                                {!! $event->Venue->taxidirection !!}
                                                            </li>
                                                            <li class="car">
                                                                <h3 class="font-bold">By Car</h3>
                                                                {!! $event->Venue->cardirection !!}
                                                            </li>
                                                        </ul>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!empty($event->admission))
                                    <div class="admissionBox" id="admissionBox">
                                        <div class="row">
                                            <div class="side-left col-md-3">
                                                <div class="aboutDesc">
                                                        <h4>Admission Rules</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="main-content">
                                                    <div class="">
                                                        <section id="rules" class="sectionEvent">
                                                            {!! $event->admission !!}
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                        </div>
                        <div class="col-md-4">
                            <div class="formPromo">
                                <form class="form-group" id="form-subscribe" action="{{URL::route('subscribe-event-store')}}" method="POST">
                                    <label class="labelHead">Get the Latest News or Promotions for {{ $event->title }}</label>
                                    <div class="error"></div>
                                    @include('flash::message')
                                    <div class="row">
                                        <input type="hidden" class="form-control" name="event" id="event" value="{{ $event->id }}">
                                        <div class="col-xs-6 col-1 first_name">
                                            <input type="text" class="form-control first" name="first_name" id="first_name" placeholder="First Name">
                                        </div>
                                        <div class="col-xs-6 col-2 last_name">
                                            <input type="text" class="form-control last" name="last_name" id="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 email">
                                            <input type="email" placeholder="Email" name="email" id="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-3 col-1">
                                            <input type="text" class="form-control" name="country_code" id="country_code" placeholder="+62">
                                        </div>
                                        <div class="col-xs-9 col-2">
                                            <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Mobile Number (Optional)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="btn btn-primary btnSend font-bold" type="submit">Send Me Updates</button>
                                        </div>
                                    </div>
                                    <div class="row last-row">
                                        <div class="col-md-12">
                                            <label class="labelFoot">We respect your privacy and will not share your contact information with third parties without your consent.</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if(!empty($category_events))
                            <div class="featuredEvent">
                                <div class="featuredLabel">
                                    <label>Featured Events</label>
                                </div>
                                @foreach ($category_events as $key => $category_event)
                                    <a href="{{ URL::route('event-detail', $category_event->slug) }}">
                                        <div class="eventList bg-{{ $category_event->background_color }}">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <img src="{{ file_url('events/'.$category_event->featured_image3, env('FILESYSTEM_DEFAULT')) }}">
                                                </div>
                                                <div class="col-xs-8 box-cap">
                                                    <div class="caption caption-first">
                                                        <h5>{{ $category_event->title }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="buttonBrowse">
                                    <a href="{{ URL::route('category-detail', $event->category->slug) }}">
                                        <button class="btn btnBrowse font-bold">Browse More Events</button>
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="eventVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Event Promotion Video</h4>
            </div>
            <div class="modal-body">
                {!! $event->video_link !!}
            </div>
        </div>
    </div>
</div>
@stop
@include('frontend.partials.script.subscribe_script')
