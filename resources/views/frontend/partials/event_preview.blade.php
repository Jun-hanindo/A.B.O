@extends('layout.frontend.master.master')
@section('title', (!empty($event->title_meta_tag)) ? $event->title_meta_tag.' - ' : (!empty($event->title)) ? $event->title.' - ' : '')
@section('description_meta', (!empty($event->title_meta_tag)) ? $event->description_meta_tag : '')
@section('keywords_meta', (!empty($event->keywords_meta_tag)) ? $event->keywords_meta_tag : '')
@section('content')
<section class="eventBanner" id="eventBanner">
    <div class="imageBanner">
        @if(!empty($event->video_link))
            <div class="btnPlayEvent"><a data-toggle="modal" data-target="#eventVideo"><i class="fa fa-play-circle-o"></i></a></div>
        @endif
        <img src="{{ (!empty($event->featured_image1)) ? $event->featured_image1 : '' }}" class="hidden-xs">
        <img src="{{ (!empty($event->featured_image1)) ? $event->featured_image2 : '' }}" class="hidden-lg hidden-md hidden-sm" alt="...">
    </div>
    <div class="infoBanner bg-green" style="background-color:{{ (!empty($event->background_color)) ? $event->background_color : '' }} !important" id="eventTabShow">
        <div class="container">
            <div class="detail">
                <h5>{{ (!empty($event->cat)) ? strtoupper($event->cat->name) : '&nbsp;' }}</h5>
                <h2 class="font-light">{{ (!empty($event->title)) ? $event->title : '' }}</h2>
            </div>
            <div class="moreDetail">
                <a href="{{ (!empty($event->buylink)) ? $event->buylink : '' }}" target="_blank">
                    @if(!empty($event->buy_button_disabled))
                        <button class="btn btnDetail font-bold" disabled>{{ (!empty($event->buy_button_disabled_message)) ? $event->buy_button_disabled_message : '' }}</button>
                    @else
                        <button class="btn btnDetail font-bold">{{ trans('frontend/general.buy_now') }}</button>
                    @endif
                </a>
            </div>
        </div>
    </div>
</section>
<div class="eventTabScroll bg-green" style="background-color:{{ (!empty($event->background_color)) ? $event->background_color : '' }} !important">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <ul class="" role="">
                    <li><a href="#eventBanner" class="smoothScroll backtop">{{ trans('frontend/general.back_to_summary') }}</a></li>
                    <li><a href="#aboutBox" class="smoothScroll active">{{ trans('frontend/general.about_this_event') }}</a></li>
                    @if(!empty($event->promotions) && !$event->promotions->isEmpty())
                        <li><a href="#promoBox" class="smoothScroll">{{ trans('frontend/general.promotions') }}</a></li>
                    @endif
                    @if(!empty($event->venue))
                        <li><a href="#venueBox" class="smoothScroll">{{ trans('frontend/general.venue_info') }}</a></li>
                    @endif
                    @if(!empty($event->admission))
                        <li><a href="#admissionBox" class="smoothScroll">{{ trans('frontend/general.admission_rules') }}</a></li>
                    @endif
                    <li><a href="{{ (!empty($event->buylink)) ? $event->buylink : '' }}" target="_blank">
                        @if(!empty($event->buy_button_disabled))
                            <button class="btn btnBuy btnABO font-bold" disabled>{{ (!empty($event->buy_button_disabled_message)) ? $event->buy_button_disabled_message : '' }}</button>
                        @else
                            <button class="btn btnBuy btnABO font-bold">{{ trans('frontend/general.buy_now') }}</button>
                        @endif
                    </a></li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="eventTabScroll-mobile bg-green" style="background-color:{{ (!empty($event->background_color)) ? $event->background_color : '' }} !important">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li><a href="#eventBanner" class="smoothScroll backtop"></a></li>
                    <li><a href="#aboutBox" class="smoothScroll active">{{ trans('frontend/general.about') }}</a></li>
                    @if(!empty($event->promotions) && !$event->promotions->isEmpty())
                        <li><a href="#promoBox" class="smoothScroll">{{ trans('frontend/general.promotions') }}</a></li>
                    @endif
                    @if(!empty($event->venue))
                        <li><a href="#venueBox" class="smoothScroll">{{ trans('frontend/general.venue') }}</a></li>
                    @endif
                    @if(!empty($event->admission))
                        <li><a href="#admissionBox" class="smoothScroll">{{ trans('frontend/general.admission') }}</a></li>
                    @endif
                    <li><a href="{{ (!empty($event->buylink)) ? $event->buylink : '' }}">
                        @if(!empty($event->buy_button_disabled))
                            <button class="btn btnBuy btnABO font-bold" disabled>{{ (!empty($event->buy_button_disabled_message)) ? $event->buy_button_disabled_message : '' }}</button>
                        @else
                            <button class="btn btnBuy btnABO font-bold">{{ trans('frontend/general.buy') }}</button>
                        @endif
                    </a></li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="eventInfo">
    <div class="container">
        <div class="row">
            <div class="col-md-4 date">
                @if(!empty($event->schedules))
                    @php 
                        $count = count($event->schedules)
                    @endphp
                    @if($count > 1)
                        <div class="information-title">
                            <i class="fa fa-calendar-o"></i> 
                            @if(!empty($event->schedule_title))
                                {{ $event->schedule_title }}
                            @else
                                {{ date_from_to($event->start_range, $event->end_range) }}
                            @endif
                            
                        </div>

                        @if(empty($event->hide_schedule))
                            <ul class="list-unstyled">
                                @php 
                                    $i = 1; 
                                @endphp
                                @foreach($event->schedules as $sch)
                                    <li class="liParent {{ ($i == $count) ? 'parentLast' : '' }} li-mobile">
                                        <table>
                                            <tr>
                                                <td>{{ get_day_date($sch->date_at) }}</td>
                                                <td>{{ $sch->description }}</span>
                                                </td>
                                                <td>{{ $sch->start_time.'-'.$sch->end_time }}</td>
                                            </tr>
                                        </table>
                                    </li>
                                    @php 
                                        $i++; 
                                    @endphp  
                                @endforeach
                            </ul>
                        @endif
                            <div class="information-event">
                                {!! $event->schedule_info !!}
                            </div>
                    @else
                        <div class="information-title">
                            <i class="fa fa-calendar-o"></i> 
                            @if(!empty($event->schedule_title))
                                {{ $event->schedule_title }}
                            @else
                                {{ !empty($event->schedule_range) ? $event->schedule_range : '' }}
                            @endif
                        </div>
                            <div class="information-event">
                                @if(empty($event->hide_schedule))
                                    @foreach($event->schedules as $sch)
                                        <p>{{ get_day_name($sch->date_at) }}, {{ $sch->start_time }}</p>
                                    @endforeach
                                @endif
                                {!! $event->schedule_info !!}
                            </div>
                    @endif
                @endif
            </div>
            @if(!empty($event->venue))
            <div class="col-md-4 place">
                <div class="information-title information-place">
                    <span> {{ $event->venue->name }}</span>
                </div>
                <ul class="list-unstyled">
                    <li>{!! $event->venue->address !!}</li>
                    <li>
                        <a href="{{ $event->venue->link_map }}" class="btn btnSeemap font-bold" target="_blank">{{ trans('frontend/general.see_map') }}</a>
                    </li>
                </ul>
            </div>
            @endif
            <div class="col-md-4 ticket" id="ticket">
                <div class="information-title">
                    <i class="fa fa-ticket"></i>
                    @if(!empty($event->price_title)) 
                        {{ $event->price_title }}
                    @else
                        @if(!empty($event->ranges))
                            @php 
                                $count = count($event->ranges)
                            @endphp
                            @if($count > 1)
                                @if($event->min_range > 0)
                                    {{ $event->code.' '.$event->min_range.'-'.$event->max_range.trans('frontend/general.per_person') }}
                                @else
                                    {{ $event->code.' '.$event->max_range.trans('frontend/general.per_person') }}
                                @endif
                            @else
                                {{ !empty($event->price_range) ? $event->price_range.trans('frontend/general.per_person') : '' }}
                            @endif
                        @endif
                    @endif
                </div>
                <ul class="list-unstyled">
                    @if(!empty($event->prices))
                        @php 
                            $count = count($event->prices)
                        @endphp
                            @php 
                                $i = 1; 
                            @endphp
                            @foreach($event->prices as $prc)
                                <li class="liParent {{ ($i == $count) ? 'parentLast' : '' }} li-mobile">
                                    <table>
                                        <tr>
                                            <td>{{ $prc->additional_info }}</td>
                                            <td><span>{{ ($prc->price > 0) ? $prc->code.' '.number_format_drop_zero_decimals($prc->price) : '' }}</span></td>
                                        </tr>
                                    </table>
                                </li>
                                @php 
                                    $i++; 
                                @endphp  
                            @endforeach
                    @endif
                    <div class="additional-info">{!! (!empty($event->price_info)) ? $event->price_info : '' !!}</div>
                    @if(isset($event->event_type))
                        @if($event->event_type == false)
                            <li class="liParent parentButton">
                              <button class="btn btnBlackDefault font-bold" data-target="#modalSeatMap" data-toggle="modal">See Seat Map</button>
                              <!-- <button class="btn btnticket bg-white font-bold">More Ticket Info</button> -->
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
            <div class="col-md-12 tabEvent">
                <div class="eventTab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a href="#aboutBox" class="smoothScroll active">{{ trans('frontend/general.about_this_event') }}</a></li>
                        @if(!empty($event->promotions) && !$event->promotions->isEmpty())
                            <li><a href="#promoBox" class="smoothScroll">{{ trans('frontend/general.promotions') }}</a></li>
                        @endif
                        @if(!empty($event->venue))
                            <li><a href="#venueBox" class="smoothScroll">{{ trans('frontend/general.venue_info') }}</a></li>
                        @endif
                        @if(!empty($event->admission))
                            <li><a href="#admissionBox" class="smoothScroll">{{ trans('frontend/general.admission_rules') }}</a></li>
                        @endif
                    </ul>
                </div>
                <div class="eventTab-mobile">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li><a href="#aboutBox" class="smoothScroll active">{{ trans('frontend/general.about') }}</a></li>
                        @if(!empty($event->promotions) && !$event->promotions->isEmpty())
                            <li><a href="#promoBox" class="smoothScroll">{{ trans('frontend/general.promotions') }}</a></li>
                        @endif
                        @if(!empty($event->venue))
                            <li><a href="#venueBox" class="smoothScroll">{{ trans('frontend/general.venue') }}</a></li>
                        @endif
                        @if(!empty($event->admission))
                            <li><a href="#admissionBox" class="smoothScroll">{{ trans('frontend/general.admission') }}</a></li>
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
                                                <h4>{{ trans('frontend/general.about_this_event') }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="main-content">
                                                <div class="">
                                                    <section id="about" class="sectionEvent">
                                                        {!! (!empty($event->description)) ? $event->description : '' !!}    
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!empty($event->promotions) && !$event->promotions->isEmpty())
                                    <div class="promoBox boxBorder" id="promoBox">
                                        <div class="row">
                                            <div class="side-left col-md-3">
                                                <div class="aboutDesc">
                                                    <h4>{{ trans('frontend/general.promotions') }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="main-content">
                                                    <div class="">
                                                        @foreach($event->promotions as $key => $promotion) 
                                                            <section id="promotion" class="sectionEvent">
                                                                @if(!empty($promotion->banner_image))
                                                                    <a {!! (!empty($promotion->featured_image_link)) ? 'href="'.$promotion->featured_image_link.'" target="_blank"' : '' !!}>
                                                                        <img class="promo-banner" src="{{ file_url('promotions/'.$promotion->banner_image, env('FILESYSTEM_DEFAULT')) }}">
                                                                    </a>
                                                                @else
                                                                    @if(!empty($promotion->featured_image))
                                                                        <a {!! (!empty($promotion->featured_image_link)) ? 'href="'.$promotion->featured_image_link.'" target="_blank"' : '' !!}>
                                                                            <img src="{{ file_url('promotions/'.$promotion->featured_image, env('FILESYSTEM_DEFAULT')) }}" onload="this.width/=2;this.onload=null;">
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                                <h3 class="font-bold">{{ $promotion->title }}</h3>
                                                                {!! $promotion->description !!}
                                                                @if(!empty($promotion->link_title_more_description))
                                                                    <a id="link_title_more_promotion" data-toggle="collapse" href="#more_description" aria-expanded="false"> {!! $promotion->link_title_more_description !!} </a>
                                                                @endif
                                                                @if(!empty($promotion->more_description))
                                                                    <span class="collapse" id="more_description"> {!! $promotion->more_description !!} </span>
                                                                @endif
                                                                @if($promotion->discount > 0 || $promotion->discount_nominal > 0)
                                                                    <p>{{ trans('general.discount') }}: 
                                                                        @if($promotion->discount > 0)
                                                                            {{ number_format_drop_zero_decimals($promotion->discount).'%' }}
                                                                        @else
                                                                            @if($promotion->currency_id == 0)
                                                                                @php
                                                                                    $symbol_left = '';
                                                                                    $symbol_right = '';
                                                                                @endphp
                                                                            @else
                                                                                @php
                                                                                    $code = $promotion->currency->code;
                                                                                @endphp
                                                                            @endif
                                                                            {{ $code.' '.number_format_drop_zero_decimals($promotion->discount_nominal) }}
                                                                        @endif
                                                                    </p>
                                                                @endif
                                                                @if(!empty($promotion->start_date))
                                                                    <p>{{ trans('frontend/general.start_date') }}: {{ full_text_date($promotion->start_date) }}</p>
                                                                @endif
                                                                @if(!empty($promotion->end_date))
                                                                    <p>{{ trans('frontend/general.end_date') }}: {{ full_text_date($promotion->end_date) }}</p>
                                                                @endif
                                                            </section>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($event->venue))
                                <div class="venueBox {{ (!empty($event->admission)) ? 'boxBorder': '' }}" id="venueBox">
                                    <div class="row">
                                        <div class="side-left col-md-3">
                                            <div class="aboutDesc">
                                                <h4>{{ trans('frontend/general.venue_info') }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="main-content">
                                                <div class="">
                                                    <section id="venue" class="sectionEvent">
                                                        <h3 class="font-bold">{{ $event->venue->name }}</h3>
                                                        {!! $event->venue->address !!}

                                                        <div class="mapEvent">
                                                            {!! $event->venue->gmap_link !!}
                                                        </div>

                                                        <h3 class="font-bold">{{ trans('frontend/general.getting_to_the_venue') }}</h3>
                                                        <ul id="getvenue">
                                                            <li class="mrt">
                                                                <h3 class="font-bold">{{ trans('frontend/general.by_mrt') }}</h3>
                                                                {!! $event->venue->mrtdirection !!}
                                                            </li>
                                                            <li class="taxi">
                                                                <h3 class="font-bold">{{ trans('frontend/general.by_taxi') }}</h3>
                                                                {!! $event->venue->taxidirection !!}
                                                            </li>
                                                            <li class="car">
                                                                <h3 class="font-bold">{{ trans('frontend/general.by_car') }}</h3>
                                                                {!! $event->venue->cardirection !!}
                                                            </li>
                                                        </ul>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($event->admission))
                                    <div class="admissionBox" id="admissionBox">
                                        <div class="row">
                                            <div class="side-left col-md-3">
                                                <div class="aboutDesc">
                                                        <h4>{{ trans('frontend/general.admission_rules') }}</h4>
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
                                <form class="form-group" id="form-subscribe" action="{{URL::route('subscribe-store')}}" method="POST">
                                    <label class="labelHead">{{ trans('frontend/general.sign_up_latest_updates') }}</label>
                                    <div class="error"></div>
                                    @include('flash::message')
                                    <div class="row">
                                        <div class="col-xs-6 col-1 first_name">
                                            <input type="text" class="form-control first" name="first_name" id="first_name" placeholder="{{ trans('frontend/general.first_name') }}">
                                        </div>
                                        <div class="col-xs-6 col-2 last_name">
                                            <input type="text" class="form-control last" name="last_name" id="last_name" placeholder="{{ trans('frontend/general.last_name') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 email">
                                            <input type="email" placeholder="{{ trans('frontend/general.email') }}" name="email" id="email" class="form-control">
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-xs-3 col-1">
                                            <input type="text" class="form-control" name="country_code" id="country_code" placeholder="+62">
                                        </div>
                                        <div class="col-xs-9 col-2">
                                            <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="{{ trans('frontend/general.mobile_number_optional') }}">
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="btn btn-primary btnSend font-bold" type="submit">{{ trans('frontend/general.send_me_updates') }}</button>
                                        </div>
                                    </div>
                                    <div class="row last-row">
                                        <div class="col-md-12">
                                            <label class="labelFoot">{{ trans('frontend/general.respect_privacy_subscription') }}</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if(!empty($category_events))
                            {{-- <div class="featuredEvent">
                                <div class="featuredLabel">
                                    <label>{{ trans('frontend/general.featured_events') }}</label>
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
                                        <button class="btn btnBrowse font-bold">{{ trans('frontend/general.browse_more_events') }}</button>
                                    </a>
                                </div>
                            </div> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
@if(isset($event->event_type))
    @if($event->event_type == 0)
        <div class="modal fade modal-hochi full-modal" id="modalSeatMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{ trans('frontend/general.seat_map') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="seat-map-modal">
                            <div class="row">
                                <div class="col-md-7">
                                    @if(!empty($event->seat_image2) || !empty($event->seat_image3))
                                    <div class="navigation-level">
                                        <ul class="nav nav-tabs nav-level" role="tablist">
                                            @if(!empty($event->seat_image))
                                                <li role="presentation" class="active"><a href="#level1" aria-controls="home" role="tab" data-toggle="tab">Level 1</a></li>
                                            @endif
                                            @if(!empty($event->seat_image2))
                                                <li role="presentation"><a href="#level2" aria-controls="profile" role="tab" data-toggle="tab">Level 2</a></li>
                                            @endif
                                            @if(!empty($event->seat_image3))
                                                <li role="presentation"><a href="#level3" aria-controls="messages" role="tab" data-toggle="tab">Level 3</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        @if(!empty($event->seat_image))
                                            <div role="tabpanel" class="tab-pane active" id="level1"><img src="{{ $event->seat_image  }}"></div>
                                        @endif
                                        @if(!empty($event->seat_image2))
                                            <div role="tabpanel" class="tab-pane" id="level2"><img src="{{ $event->seat_image2  }}"></div>
                                        @endif
                                        @if(!empty($event->seat_image3))
                                            <div role="tabpanel" class="tab-pane" id="level3"><img src="{{ $event->seat_image3  }}"></div>
                                        @endif
                                    </div>
                                @else
                                    <img src="{{ (!empty($event->seat_image)) ? $event->seat_image : '' }}">
                                @endif
                                </div>
                                <div class="col-md-5">
                                    <div class="seat-map-price">
                                        <ul>
                                            @if(!empty($event->prices))
                                                @php 
                                                    $count = count($event->prices)
                                                @endphp
                                                    @php 
                                                        $i = 1; 
                                                    @endphp
                                                    @foreach($event->prices as $prc)
                                                        <li>
                                                            <span class="seat-dot" style="background-color:{{ $prc->seat_color }}"></span>
                                                            <span class="box-line">
                                                                <span class="category">{{ $prc->additional_info }}</span>
                                                                <span class="price">{{ ($prc->price > 0) ? $prc->code.' '.number_format_drop_zero_decimals($prc->price) : '' }}</span>
                                                            </span>
                                                        </li>
                                                        @php 
                                                            $i++; 
                                                        @endphp  
                                                    @endforeach
                                            @endif
                                        </ul>
                                        {!! $event->price_info !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
@if(!empty($event->video_link))
<div class="modal fade" id="eventVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ trans('frontend/general.event_promotion_video') }}</h4>
            </div>
            <div class="modal-body">
                <div class='embed-container'>
                    {!! $event->video_link !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@stop
@include('frontend.partials.script.subscribe_script')
