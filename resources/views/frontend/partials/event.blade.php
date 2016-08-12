@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
      <section class="eventBanner">
          <div class="imageBanner">
              <img src="{{ asset('assets/frontend/images/banner-bg.png') }}">
          </div>
          <div class="infoBanner bg-green">
              <div class="container">
                  <div class="detail">
                      <h5>FOOD / BEVERAGE</h5>
                      <h2>SAVOUR Gourmet 2016</h2>
                  </div>
                  <div class="moreDetail">
                      <button class="btn btnDetail">Buy Now</button>
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
                            <i class="fa fa-map-marker"></i> Bayfront Avenue
                        </div>
                        <ul class="list-unstyled">
                            <li>12 Bayfront Avenue</li>
                            <li>Singapore 018956</li>
                            <li>(Next to Sands Expo and Convention Centre)</li>
                            <li><button class="btn btnSeemap">See Map</button></li>
                        </ul>
                    </div>
                    <div class="col-md-4 ticket">
                        <div class="information-title">
                            <i class="fa fa-ticket"></i> $30 / Person
                        </div>
                        <ul class="list-unstyled">
                            <li>Inclusive Of:</li>
                            <li>Food voucher value $30</li>
                            <li>Limited edition gift bag</li>
                            <li>Full version event programme</li>
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
                                                                  <h3>What is SAVOUR?</h3>
                                                                  <p>The SAVOUR concept remains the only one of its kind in Singapore; a relentless pursuit to unite the best in food and drink with a wide range of unique activities that is accessible to all.</p>
                                                                  <p>Over 18,000 foodie comrades gathered at SAVOUR's alfresco event venue last year to indulge in Michelin star and award winning cuisine from Singapore and around the world. The 2015 line-up of restaurants will feature over 50 signature dishes will be on offer for you to create your very own culinary adventure.</p>
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
                                                                  <img src="{{ asset('assets/frontend/images/dbs.png') }}">
                                                                  <h3>DBS Credit Card Discount</h3>
                                                                  <ul>
                                                                      <li>10 percent for lunch sessions</li>
                                                                      <li>15 percent for dinner sessions</li>
                                                                      <li>Every additional $30 spent qualifies for 1 Live Your Passion vote</li>
                                                                  </ul>
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
                                                                  <h3>Bayfront Avenue</h3>
                                                                  <p>12 Bayfront Avenue <br>Singapore 018956 <br>(Next to Sands Expo and Convention Centre)</p>

                                                                  <div class="mapEvent">
                                                                      <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:200px;width:100%;'><div id='gmap_canvas' style='height:200px;width:100%;'></div><div><small><a href="http://embedgooglemaps.com">                                   embed google maps                           </a></small></div><div><small><a href="https://privacypolicygenerator.info">privacy policy generator</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {zoom:11,center:new google.maps.LatLng(1.2821156,103.85918100000004),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(1.2821156,103.85918100000004)});infowindow = new google.maps.InfoWindow({content:'<strong>Savour 2016</strong><br>bayfront avenue, singapore<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                                                                  </div>

                                                                  <h3>Getting to the Venue</h3>
                                                                  <ul>
                                                                      <li class="mrt">
                                                                          <h3>By MRT</h3>
                                                                          <p>Take the Circle Line to Bayfront MRT Station and take Exit A  or you can alight at Downtown MRT Station and take Exit B</p>
                                                                      </li>
                                                                      <li class="taxi">
                                                                          <h3>By Taxi / UBER Drop Off</h3>
                                                                          <p>If you are taking a taxi or an UBER, the closest drop off point is at Marina Bay Sands Exhibition Centre, just a 3 min walk from SAVOUR 2016.</p>
                                                                      </li>
                                                                      <li class="car">
                                                                          <h3>By Car</h3>
                                                                          <p>No parking on site. There is public parking available at the Wilson Open Air Carpark on Bayfront Avenue. Parking will not be validated. We encourage guests to carpool or explore one of the many public transport options if you plan on drinking at this event. Please drink responsibly.</p>
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
                                                                  <h3>Rating / Age Limit</h3>
                                                                  <ul>
                                                                      <li>Children under 3 years of age may be admitted free of charge provided they do not occupy a seat (they must be seated on the lap of a parent or guardian).</li>
                                                                      <li>Children aged 3 years and above must purchase a ticket for admission.</li>
                                                                      <li>All children below 12 years of age must be accompanied by a parent or guardian.</li>
                                                                  </ul>
                                                                  <h3>Late Seating Advisory</h3>
                                                                  <ul>
                                                                      <li>For the enjoyment of all audience members, all events start promptly at the time printed on the ticket.</li>
                                                                      <li>Please be seated 15 minutes before the performance start time.</li>
                                                                      <li>Late arrival may result in non-admittance until a suitable break in the performance.</li>
                                                                  </ul>
                                                                  <h3>Photography / Video Recording Rules</h3>
                                                                  <ul>
                                                                      <li>Photography, Video Recording and Audio Recording is strictly prohibited during the performance.</li>
                                                                      <li>All DSLR / Cameras with interchangeable lens is strictly prohibited inside the auditorium and must be checked in into the Theatres Cloak Room.</li>
                                                                  </ul>
                                                                  <h3>Booster Seats</h3>
                                                                  <ul>
                                                                      <li>Booster seats are available on a "first come, first served" basis from 1 hour prior to show up until show time.</li>
                                                                      <li>Booster seats are not guaranteed and are not included with the purchase of your ticket. Patrons are welcome to bring their own booster seats.</li>
                                                                      <li>Booster seats provided by Marina Bay Sands may not be taken out of the Theatre Foyer at any time.</li>
                                                                  </ul>
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