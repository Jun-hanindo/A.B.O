@extends('layout.frontend.master.master')
@section('title', 'Page Title')
@section('content')
    @if(!empty($sliders))
        <section class="slider-home">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @php 
                        $i = 0;
                    @endphp 
                    @foreach($sliders as $key => $slider)
                        @php
                            $cat = $slider->Event->Categories()->where('status', true)->first();
                        @endphp 
                        @if($slider->Event->avaibility && !empty($cat)) 
                            <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : ' '}}"></li>
                            @php 
                                $i++
                            @endphp
                        @endif
                    @endforeach
                </ol>


                    <!-- Wrapper for slides -->
                    <div class="carousel-inner"> 
                        @php 
                            $i = 0;
                        @endphp
                        @foreach($sliders as $key => $slider)
                            @php
                                $cat = $slider->Event->Categories()->where('status', true)->first();
                            @endphp 
                            @if($slider->Event->avaibility && !empty($cat))
                                <div class="item {{ $i == 0 ? 'active' : ' '}}">
                                    <img src="{{ $src.$slider->Event->featured_image1 }}" class="hidden-xs" alt="...">
                                    <img src="{{ $src.$slider->Event->featured_image1 }}" class="hidden-lg hidden-md hidden-sm" alt="...">
                                  <div class="carousel-caption bg-{{ $slider->Event->background_color }}">
                                    <div class="container">
                                        <h5 class="categorySlide">{{ (!empty($cat)) ? strtoupper($cat->name) : '&nbsp;' }}</h5>
                                        <h2 class="titleSlide font-light">{{ $slider->Event->title }}</h2>
                                        <ul>
                                            @php 
                                                $schedule = $slider->Event->EventSchedule()->orderBy('date_at', 'asc')->first();
                                            @endphp
                                            <li><div class="eventDate">
                                                @if(!empty($schedule))
                                                    <i class="fa fa-calendar-o"></i>{{ date('d F Y', strtotime($schedule->date_at)) }}
                                                @endif
                                            </div></li>
                                            <li><div class="eventPlace"><i class="fa fa-map-marker"></i>{{ $slider->Event->Venue->name }}</div></li>
                                        </ul>
                                        <div class="moreDetail">
                                            <a href="{{ URL::route('event-detail', $slider->Event->slug) }}">
                                              <button class="btn btnDetail font-bold">{{ trans('general.more_details') }}</button>
                                            </a>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                @php 
                                    $i++
                                @endphp
                            @endif
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
            <h2 class="font-light">{{ trans('general.new_release') }}</h2>
            <div class="row">
                @foreach($events as $key => $event) 
                    @php
                        $cat = $event->Event->Categories()->where('status', true)->first();
                    @endphp
                    @if($event->Event->avaibility && !empty($cat))  
                        <a href="{{ URL::route('event-detail', $event->Event->slug) }}">
                            <div class="col-md-4 box-release">
                                <img src="{{ $src.$event->Event->featured_image2 }}">
                                <div class="boxInfo box-info1 bg-{{ $event->Event->background_color }}">
                                    <ul>      
                                        <li class="eventType">
                                            @if(!empty($cat))
                                                {{ strtoupper($cat->name) }}
                                            @else
                                                &nbsp;
                                            @endif
                                        </li>
                                        <li class="eventName">{{ string_limit($event->Event->title) }}</li>
                                        @php 
                                            $schedule = $event->Event->EventSchedule()->orderBy('date_at', 'asc')->first();
                                        @endphp
                                        <li class="eventDate"><i class="fa fa-calendar-o"></i> 
                                            @if(!empty($schedule))
                                                {{ date('d F Y', strtotime($schedule->date_at)) }}
                                            @endif
                                        </li>
                                        <li class="eventPlace"><i class="fa fa-map-marker"></i>{{ $event->Event->Venue->name }}</li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
            {{-- <div class="loadMore">
                <a href="{{ URL::route('discover')}}">
                  <button class="btn btnLoad font-bold">{{ trans('general.discover_more_events') }}</button>
                </a>
            </div> --}}
        </div>
    </section>
    @endif
    @if(!empty($promotions))
    {{-- <section class="latestPromo">
        <div class="container">
            <h2 class="font-light">{{ trans('general.latest_promotions') }}</h2>
            <div class="row">                
                @foreach($promotions as $key => $promotion) 
                    @if($promotion->Event->avaibility)
                        @php
                            $data = $promotion->Event->promotions()->where('avaibility', true)->orderBy('start_date')->first();
                        @endphp
                        @if(!empty($data))
                            <div class="col-md-4 box-promo">
                                <a href="#promoModal{{ $promotion->id }}" data-toggle="modal">
                                    <img src="{{ $src.$promotion->Event->featured_image2 }}" class="image-promo">
                                    <div class="boxInfo promo1">
                                        <ul>
                                            <li class="eventType">
                                                @if($data->category == 'discounts')
                                                    {{ $data->category = 'DISCOUNTS' }}
                                                @elseif($data->category == 'early-bird')
                                                    {{ $data->category = 'EARLY BIRD' }}
                                                @else
                                                    {{ $data->category = 'LUCKY DRAW' }}
                                                @endif
                                            </li>
                                            <li class="eventName">{{ string_limit($data->title) }} <img src="{{ $src2.$data->featured_image }}"></li>
                                            <br>
                                            <li class="eventPlace">{{ trans('general.valid_from') }}
                                                @php
                                                    $m_start = date('m', strtotime($data->start_date));
                                                    $m_end = date('m', strtotime($data->end_date));

                                                    $y_start = date('Y', strtotime($data->start_date));
                                                    $y_end = date('Y', strtotime($data->end_date));
                                                @endphp

                                                
                                                @if($m_start == $m_end && $y_start == $y_end)
                                                    {{ date('d', strtotime($data->start_date)).' - '.date('d F Y', strtotime($data->end_date)) }}
                                                @elseif($m_start != $m_end && $y_start == $y_end)
                                                    {{ date('d F', strtotime($data->start_date)).' - '.date('d F Y', strtotime($data->end_date)) }}
                                                @else
                                                    {{ date('d F Y', strtotime($data->start_date)).' - '.date('d F Y', strtotime($data->end_date)) }}
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                                <div class="modal fade promoModal" id="promoModal{{ $promotion->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">{{$data->title}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="promoBanner">
                                                    <img src="{{ $src.$promotion->Event->featured_image1 }}">
                                                </div>
                                                <div class="descPromoModal">
                                                    <h4>{{ trans('general.about_this_promotion') }}</h4>
                                                    <div class="promoBannerDesc">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                {!! $data->description !!}
                                                            </div>
                                                            <div class="col-md-3">
                                                                <img src="{{ $src2.$data->featured_image }}" class="promoLogo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <h4>How to Participate </h4>
                                                    <p>Show StarHub bill or subscription on any device such as mobile phone or tablet.</p> -->
                                                    <p>{{ trans('general.discount') }}: {{ ($data->discount > 0) ? $data->discount.'%' : '$'.$data->discount_nominal }}</p>
                                                    <h4>Promotion Period</h4>
                                                    <p>{{ trans('general.start_date') }}: {{ date('d F Y', strtotime($data->start_date)) }}</p>
                                                    <br>
                                                    <p>{{ trans('general.end_date') }}: {{ date('d F Y', strtotime($data->end_date)) }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h4>{{ trans('general.get_your_early_bird_tickets_now') }}</h4>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="{{ $promotion->Event->buylink }}">
                                                          <button type="button" class="btn btn-primary">{{ trans('general.buy_now') }}</button>
                                                        </a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            <div class="loadMore">
                <a href="{{ URL::route('promotion')}}">
                  <button class="btn btnLoad font-bold">{{ trans('general.more_promotions') }}</button>
                </a>
            </div>
        </div>
    </section> --}}
    @endif
@stop