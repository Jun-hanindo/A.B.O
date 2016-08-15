@extends('layout.frontend.master.master')
@section('title', 'Asia Box Office')
@section('content')
        <section class="eventBanner">
          <div class="imageBanner">
              <img src="{{ $src.$event->featured_image1 }}">
          </div>
          <div class="infoBanner bg-purple">
              <div class="container">
                  <div class="detail">
                      <h5><!-- category --></h5>
                      <h2>{{ $event->title }}</h2>
                  </div>
                  <div class="moreDetail">
                      <form action="{{ $event->buylink }}">
                          <button class="btn btnDetail">Buy Now</button>
                      </form>
                  </div>
              </div>
          </div>
        </section>
        <section class="eventInfo">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="information-title">
                            <i class="fa fa-calendar"></i> 12 - 15 May 2016
                        </div>
                        <ul class="list-unstyled">
                            <li class="liParent">
                                <table>
                                    <tr>
                                        <td>12 May, Thu</td>
                                        <td>Dinner</td>
                                        <td>6.00PM - 11.00PM</td>
                                    </tr>
                                </table>
                            </li>
                            <li class="liParent">
                                <table>
                                    <tr>
                                        <td>13 May, Fri</td>
                                        <td>Dinner</td>
                                        <td>6.00PM - 11.00PM</td>
                                    </tr>
                                </table>
                            </li>
                            <li class="liParent">
                                <table>
                                    <tr>
                                        <td>14 May, Sat</td>
                                        <td>Dinner</td>
                                        <td>6.00PM - 11.00PM</td>
                                    </tr>
                                </table>
                            </li>
                            <li class="liParent">
                                <table>
                                    <tr>
                                        <td>15 May, Sun</td>
                                        <td>Full-Day</td>
                                        <td>6.00PM - 11.00PM</td>
                                    </tr>
                                </table>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 place">
                        <div class="information-title">
                            <i class="fa fa-map-marker"></i> {{ $event->Venue->name }}
                        </div>
                        <ul class="list-unstyled">
                            <li>{!! $event->Venue->address !!}</li>
                            <li>
                              <form action="{{ $event->Venue->link_map }}">
                                  <button class="btn btnSeemap">See Map</button>
                              </form>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 ticket">
                        <div class="information-title">
                            <i class="fa fa-ticket"></i> S$118-338/person
                        </div>
                        <ul class="list-unstyled">
                            <li class="liParent">
                                {!! $event->price_info !!}
                            </li>
                            <li class="liParent">
                              <form action="{{ $event->buylink }}">
                                  <button class="btn btnSeat bg-black">See Seat Map</button>
                              </form>
                              <form action="{{ $event->buylink }}">
                                  <button class="btn btnticket bg-white">More Ticket Info</button>
                              </form>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="container">
                            <div class="eventTab">
                                <ul class="nav nav-tabs" role="tablist">
                                  <li role="presentation" class="active"><a href="#aboutEvent" aria-controls="home" role="tab" data-toggle="tab">About This Event</a></li>
                                  <li role="presentation"><a href="#promotions" aria-controls="profile" role="tab" data-toggle="tab">Promotions</a></li>
                                  <li role="presentation"><a href="#venue" aria-controls="messages" role="tab" data-toggle="tab">Venue Info</a></li>
                                  <li role="presentation"><a href="#admission" aria-controls="settings" role="tab" data-toggle="tab">Admission Rules</a></li>
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
                                      <div class="aboutBox boxBorder">
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
                                      <div class="promoBox boxBorder">
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
                                                              <section id="promotion" class="sectionEvent">
                                                              </section>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="venueBox boxBorder">
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
                                                                  <h3>{!! $event->Venue->name !!}</h3>
                                                                  {!! $event->Venue->address !!}

                                                                  <div class="mapEvent">
                                                                      {!! $event->Venue->gmap_link !!}
                                                                  </div>

                                                                  <h3>Getting to the Venue</h3>
                                                                  <ul>
                                                                      <li class="mrt">
                                                                          <h3>By MRT</h3>
                                                                          {!! $event->Venue->mrtdirection !!}
                                                                      </li>
                                                                      <li class="taxi">
                                                                          <h3>By Taxi / UBER Drop Off</h3>
                                                                          {!! $event->Venue->cardirection !!}
                                                                      </li>
                                                                      <li class="car">
                                                                          <h3>By Car</h3>
                                                                          {!! $event->Venue->taxidirection !!}
                                                                      </li>
                                                                  </ul>
                                                              </section>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="admissionBox boxBorder">
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
                                                      <div class="col-md-6">
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
                                                      <div class="col-md-6">
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
                                                      <div class="col-md-6">
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
                                                      <div class="col-md-6">
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
                                                      <div class="col-md-6">
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
@stop
