@extends('layout.frontend.master.master')
@section('title', 'Asia Box Office')
@section('content')
        @php
            $promotions = $event->promotions;
        @endphp
        <section class="eventBanner" id="eventBanner">
          <div class="imageBanner">
              @if(!empty($event->video_link))
                <div class="btnPlayEvent"><a data-toggle="modal" data-target="#eventVideo"><i class="fa fa-play-circle-o"></i></a></div>
              @endif
              <img src="{{ $src.$event->featured_image1 }}">
          </div>
          <div class="infoBanner bg-{{ $event->background_color }}" id="eventTabShow">
              <div class="container">
                  <div class="detail">
                      <h5 class="font-light">{{ (!empty($event->category)) ? strtoupper($event->category->name) : '&nbsp;' }}</h5>
                      <h2 class="font-light">{{ $event->title }}</h2>
                  </div>
                  <div class="moreDetail">
                      <a action="{{ $event->buylink }}">
                          <button class="btn btnDetail">Buy Now</button>
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
                    <li><a href="#eventBanner" class="smoothScroll backtop font-light">Back To Summary</a></li>
                    <li><a href="#eventTabShow" class="smoothScroll active">About This Event</a></li>
                    @if(!$promotions->isEmpty())
                        <li><a href="#aboutBox" class="smoothScroll">Promotions</a></li>
                    @endif
                    <li><a href="#promoBox" class="smoothScroll">Venue Info</a></li>
                    @if(!empty($event->admission))
                        <li><a href="#getvenue" class="smoothScroll">Admission Rules</a></li>
                    @endif
                    <li><a href="#"><button class="btn btnBuy btnABO">Buy Now</button></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <section class="eventInfo">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
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
                            <div class="information-event">
                              {!! $event->price_info !!}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4 place">
                        <div class="information-title">
                            <i class="fa fa-map-marker"></i> {{ $event->Venue->name }}
                        </div>
                        <ul class="list-unstyled">
                            <li>{!! $event->Venue->address !!}</li>
                            <li>
                              <a href="{{ $event->Venue->link_map }}"><button class="btn btnSeemap">See Map</button></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 ticket">
                        <div class="information-title">
                            <i class="fa fa-ticket"></i> {{ !empty($min) ? '$'.$min->price: '' }}
                        </div>
                        <ul class="list-unstyled">
                            @foreach($schedules as $sch)
                              <li class="liParent">
                                  <table>
                                      <tr>
                                          <td>{{ date('d F, D', strtotime($sch->date_at)) }}</td>
                                          <td>
                                              @php 
                                                  $prices = $sch->EventScheduleCategory()->first();
                                              @endphp
                                              @if(!empty($prices))
                                                  {{ $prices->additional_info }}
                                              @endif
                                          </td>
                                          <td>{{ $sch->start_time.'-'.$sch->end_time }}</td>
                                      </tr>
                                  </table>
                              </li>  
                              @endforeach
                            <li class="liParent parentButton">
                              <a href="{{ $event->Venue->link_map }}"><button class="btn btnSeat bg-black">See Seat Map</button></a>
                              <a href="{{ $event->buylink }}"><button class="btn btnticket bg-white">More Ticket Info</button></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="container">
                            <div class="eventTab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li><a href="#eventTabShow" class="smoothScroll">About This Event</a></li>
                                    @if(!$promotions->isEmpty())
                                        <li><a href="#aboutBox" class="smoothScroll">Promotions</a></li>
                                    @endif
                                    <li><a href="#promoBox" class="smoothScroll">Venue Info</a></li>
                                    @if(!empty($event->admission))
                                        <li><a href="#getvenue" class="smoothScroll">Admission Rules</a></li>
                                    @endif
                                </ul>
                            </div>
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
                                              <div class="side-left col-md-3">
                                                  <div class="aboutDesc">
                                                      <h4>About This Event</h4>
                                                  </div>
                                              </div>
                                              <div class="col-md-9">
                                                  <div class="main-content">
                                                      <div class="row">
                                                          <div class="">
                                                              <section id="about" class="sectionEvent">
                                                                  {!! $event->description !!} 
                                                              </section>
                                                          </div>
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
                                                        <div class="row">
                                                            <div class="">
                                                                      @foreach($promotions as $key => $promotion) 
                                                                          <section id="promotion" class="sectionEvent">
                                                                              <img src="{{ $src2.$promotion->featured_image }}">
                                                                              <h3>{{ $promotion->title }}</h3>
                                                                              {!! $promotion->description !!}
                                                                              <p>Discount: {{ ($promotion->discount > 0) ? $promotion->discount.'%' : '$'.$promotion->discount_nominal }}</p>
                                                                              <p>Start Date: {{ date('d F Y', strtotime($promotion->start_date)) }}</p>
                                                                              <p>End Date: {{ date('d F Y', strtotime($promotion->end_date)) }}</p>
                                                                          </section>
                                                                      @endforeach
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      @endif
                                      <div class="venueBox boxBorder" id="venueBox">
                                          <div class="row">
                                              <div class="side-left col-md-3">
                                                  <div class="aboutDesc">
                                                      <h4>Venue Info</h4>
                                                  </div>
                                              </div>
                                              <div class="col-md-9">
                                                  <div class="main-content">
                                                      <div class="row">
                                                          <div class="">
                                                              <section id="venue" class="sectionEvent">
                                                                  <h3 class="font-bold">{!! $event->Venue->name !!}</h3>
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
                                      </div>
                                      @if(!empty($event->admission))
                                        <div class="admissionBox boxBorder" id="admissionBox">
                                            <div class="row">
                                                <div class="side-left col-md-3">
                                                    <div class="aboutDesc">
                                                        <h4>Admission Rules</h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="main-content">
                                                        <div class="row">
                                                            <div class="">
                                                                <section id="rules" class="sectionEvent">
                                                                    {!! $event->admission !!}
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      @endif
                                  </div>
                                  <div class="col-md-4">
                                      <div class="formPromo">
                                          <form class="form-group">
                                              <label class="labelHead">Get the Latest News or Promotions for SAVOUR 2016</label>
                                              <div class="row">
                                                  <div class="col-md-6 col-1">
                                                      <input type="text" class="form-control first" placeholder="First Name">
                                                  </div>
                                                  <div class="col-md-6 col-2">
                                                      <input type="text" class="form-control last" placeholder="Last Name">
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-12">
                                                      <input type="email" placeholder="Email" class="form-control">
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-3 col-1">
                                                      <input type="text" placeholder="+62" disabled="disabled" class="form-control">
                                                  </div>
                                                  <div class="col-md-9 col-2">
                                                      <input type="text" class="form-control" placeholder="Mobile Number (Optional)">
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-12">
                                                      <button class="btn btn-primary btnSend" type="submit">Send Me Updates</button>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-12">
                                                      <label class="labelFoot">We respect your privacy and will not share your contact information with third parties without your consent.</label>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                      <div class="featuredEvent">
                                          <label>Featured Events</label>
                                          <a href="#">
                                              <div class="eventList listRed">
                                                  <div class="row">
                                                      <div class="col-md-5">
                                                          <img src="{{ asset('assets/frontend/images/event1.png') }}">
                                                      </div>
                                                      <div class="col-md-6 box-cap">
                                                          <div class="caption">
                                                              <h5>Cameron Mackintosh's Les Misérables</h5>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </a>
                                          <a href="#">
                                              <div class="eventList listGrey">
                                                  <div class="row">
                                                      <div class="col-md-5">
                                                          <img src="{{ asset('assets/frontend/images/event2.png') }}">
                                                      </div>
                                                      <div class="col-md-6 box-cap">
                                                          <div class="caption">
                                                              <h5>Shakespeare in the Park - Romeo and Juliet</h5>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </a>
                                          <a href="#">
                                              <div class="eventList listPurple">
                                                  <div class="row">
                                                      <div class="col-md-5">
                                                          <img src="{{ asset('assets/frontend/images/event3.png') }}">
                                                      </div>
                                                      <div class="col-md-6 box-cap">
                                                          <div class="caption">
                                                              <h5>An Evening with Tom Jones</h5>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </a>
                                          <a href="#">
                                              <div class="eventList listOrange">
                                                  <div class="row">
                                                      <div class="col-md-5">
                                                          <img src="{{ asset('assets/frontend/images/event4.png') }}">
                                                      </div>
                                                      <div class="col-md-6 box-cap">
                                                          <div class="caption">
                                                              <h5>Madagascar Live!</h5>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </a>
                                          <a href="#">
                                              <div class="eventList listBlue">
                                                  <div class="row">
                                                      <div class="col-md-5">
                                                          <img src="{{ asset('assets/frontend/images/event5.png') }}">
                                                      </div>
                                                      <div class="col-md-6 box-cap">
                                                          <div class="caption">
                                                              <h5>Blue Man Group</h5>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </a>
                                          <div class="buttonBrowse">
                                              <button class="btn btnBrowse">Browse More Events</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="promotions">aaaa</div>
                      <div role="tabpanel" class="tab-pane" id="venue">...</div>
                      <div role="tabpanel" class="tab-pane" id="admission">...</div>
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
