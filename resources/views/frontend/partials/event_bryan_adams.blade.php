@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
<section class="eventBanner" id="eventBanner">
    <div class="imageBanner">
        <img src="{{ asset('assets/frontend/images/bryan-adams-fullweb.jpg') }}" class="hidden-xs">
        <img src="{{ asset('assets/frontend/images/bryan-adams-mobile.jpg') }}" class="hidden-lg hidden-md hidden-sm" alt="...">
    </div>
    <div class="infoBanner bg-red" id="eventTabShow">
        <div class="container">
            <div class="detail">
                <h5>CONCERTS</h5>
                      <h2 class="font-light">Bryan Adams Get Up Tour</h2>
            </div>
            <div class="moreDetail">
                <button class="btn btnDetail font-bold">Buy Now</button>
            </div>
        </div>
    </div>
</section>
<div class="eventTabScroll bg-red">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <ul class="" role="">
                    <li><a href="#eventBanner" class="smoothScroll backtop">Back To Summary</a></li>
                    <li><a href="#ticket" class="smoothScroll active">About This Event</a></li>
                    <li><a href="#aboutBox" class="smoothScroll">Venue Info</a></li>
                    <li><a href="#getvenue" class="smoothScroll">Admission Rules</a></li>
                    <li><a href="#"><button class="btn btnBuy btnABO font-bold">Buy Now</button></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="eventTabScroll-mobile bg-red">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li><a href="#eventBanner" class="smoothScroll backtop"></a></li>
                    <li><a href="#ticket" class="smoothScroll active">About</a></li>
                    <li><a href="#aboutBox" class="smoothScroll">Venue</a></li>
                    <li><a href="#getvenue" class="smoothScroll">Admission</a></li>
                    <li><a href="#"><button class="btn btnBuy btnABO font-bold">Buy</button></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="eventTabScroll-mobile bg-red">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li><a href="#eventBanner" class="smoothScroll backtop"></a></li>
                    <li><a href="#ticket" class="smoothScroll active">About</a></li>
                    <li><a href="#aboutBox" class="smoothScroll">Venue</a></li>
                    <li><a href="#getvenue" class="smoothScroll">Admission</a></li>
                    <li><a href="#"><button class="btn btnBuy btnABO font-bold">Buy</button></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="eventInfo">
    <div class="container">
        <div class="row">
            <div class="col-md-4 date">
                <div class="information-title">
                    <i class="fa fa-calendar-o"></i> 17 June 2016
                </div>
                <div class="information-event">
                  <p>Saturday, 8.00PM</p>
                  <ul>
                    <li>Duration: Approx. 2 Hours</li>
                    <li>Doors Open Time: 6.30PM</li>
                  </ul>
                </div>
            </div>
            <div class="col-md-4 place">
                <div class="information-title">
                    <i class="fa fa-map-marker"></i> Singapore Indoor Stadium
                </div>
                <ul class="list-unstyled">
                    <li>2 Stadium Walk</li>
                    <li>Singapore 018956</li><br>
                    <li><button class="btn btnSeemap font-bold">See Map</button></li>
                </ul>
            </div>
            <div class="col-md-4 ticket">
                <div class="information-title">
                    <i class="fa fa-ticket"></i> S$118-338/person
                </div>
                <ul class="list-unstyled">
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 1</td>
                                <td><span>S$338</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 2</td>
                                <td><span>S$338</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 3</td>
                                <td><span>S$338</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent parentLast li-mobile">
                        <table>
                            <tr>
                                <td>Category 4</td>
                                <td><span>S$338</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent parentButton">
                      <button class="btn btnBlackDefault font-bold" data-target="#modalSeatMap" data-toggle="modal">See Seat Map</button>
                      <!-- <button class="btn btnticket bg-white font-bold">More Ticket Info</button> -->
                    </li>
                </ul>
            </div>
            <div class="col-md-12 tabEvent">
                <div class="eventTab">
                  <ul class="nav nav-tabs" role="tablist">
                    <li><a href="#eventTabShow" class="smoothScroll active">About This Event</a></li>
                    <li><a href="#aboutBox" class="smoothScroll">Venue Info</a></li>
                    <li><a href="#getvenue" class="smoothScroll">Admission Rules</a></li>
                  </ul>
                </div>
            </div>
            <div class="eventTab-mobile">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                  <li><a href="#ticket" class="smoothScroll active">About</a></li>
                  <li><a href="#aboutBox" class="smoothScroll">Venue</a></li>
                  <li><a href="#getvenue" class="smoothScroll">Admission</a></li>
                </ul>
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
                                                  <h3 class="font-bold">What is SAVOUR?</h3>
                                                  <p>The SAVOUR concept remains the only one of its kind in Singapore; a relentless pursuit to unite the best in food and drink with a wide range of unique activities that is accessible to all.</p>
                                                  <p>Over 18,000 foodie comrades gathered at SAVOUR's alfresco event venue last year to indulge in Michelin star and award winning cuisine from Singapore and around the world. The 2015 line-up of restaurants will feature over 50 signature dishes will be on offer for you to create your very own culinary adventure.</p>
                                              </section>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                              </div>                               
                              <div class="venueBox boxBorder" id="venueBox">
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
                                                      <h3 class="font-bold">Bayfront Avenue</h3>
                                                      <p>12 Bayfront Avenue <br>Singapore 018956 <br>(Next to Sands Expo and Convention Centre)</p>

                                                      <div class="mapEvent">
                                                          <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:200px;width:100%;'><div id='gmap_canvas' style='height:200px;width:100%;'></div><div><small><a href="http://embedgooglemaps.com">                                   embed google maps                           </a></small></div><div><small><a href="https://privacypolicygenerator.info">privacy policy generator</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {zoom:11,center:new google.maps.LatLng(1.2821156,103.85918100000004),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(1.2821156,103.85918100000004)});infowindow = new google.maps.InfoWindow({content:'<strong>Savour 2016</strong><br>bayfront avenue, singapore<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                                                      </div>

                                                      <h3 class="font-bold">Getting to the Venue</h3>
                                                      <ul id="getvenue">
                                                          <li class="mrt">
                                                              <h3 class="font-bold">By MRT</h3>
                                                              <p>Take the Circle Line to Bayfront MRT Station and take Exit A  or you can alight at Downtown MRT Station and take Exit B</p>
                                                          </li>
                                                          <li class="taxi">
                                                              <h3 class="font-bold">By Taxi / UBER Drop Off</h3>
                                                              <p>If you are taking a taxi or an UBER, the closest drop off point is at Marina Bay Sands Exhibition Centre, just a 3 min walk from SAVOUR 2016.</p>
                                                          </li>
                                                          <li class="car">
                                                              <h3 class="font-bold">By Car</h3>
                                                              <p>No parking on site. There is public parking available at the Wilson Open Air Carpark on Bayfront Avenue. Parking will not be validated. We encourage guests to carpool or explore one of the many public transport options if you plan on drinking at this event. Please drink responsibly.</p>
                                                          </li>
                                                      </ul>
                                                  </section>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
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
                                                          <h3 class="font-bold">Rating / Age Limit</h3>
                                                          <ul>
                                                              <li>Children under 3 years of age may be admitted free of charge provided they do not occupy a seat (they must be seated on the lap of a parent or guardian).</li>
                                                              <li>Children aged 3 years and above must purchase a ticket for admission.</li>
                                                              <li>All children below 12 years of age must be accompanied by a parent or guardian.</li>
                                                          </ul>
                                                          <h3 class="font-bold">Late Seating Advisory</h3>
                                                          <ul>
                                                              <li>For the enjoyment of all audience members, all events start promptly at the time printed on the ticket.</li>
                                                              <li>Please be seated 15 minutes before the performance start time.</li>
                                                              <li>Late arrival may result in non-admittance until a suitable break in the performance.</li>
                                                          </ul>
                                                          <h3 class="font-bold">Photography / Video Recording Rules</h3>
                                                          <ul>
                                                              <li>Photography, Video Recording and Audio Recording is strictly prohibited during the performance.</li>
                                                              <li>All DSLR / Cameras with interchangeable lens is strictly prohibited inside the auditorium and must be checked in into the Theatres Cloak Room.</li>
                                                          </ul>
                                                          <h3 class="font-bold">Booster Seats</h3>
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
                          <div class="col-md-4">
                              <!-- <div class="formPromo">
                                  <form class="form-group">
                                      <label class="labelHead">Get the Latest News or Promotions for SAVOUR 2016</label>
                                      <div class="row">
                                          <div class="col-xs-6 col-1">
                                              <input type="text" class="form-control first" placeholder="First Name">
                                          </div>
                                          <div class="col-xs-6 col-2">
                                              <input type="text" class="form-control last" placeholder="Last Name">
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-xs-12">
                                              <input type="email" placeholder="Email" class="form-control">
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-xs-3 col-1">
                                              <input type="text" class="form-control" value="+62">
                                          </div>
                                          <div class="col-xs-9 col-2">
                                              <input type="text" class="form-control" placeholder="Mobile Number (Optional)">
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
                              <div class="featuredEvent">
                                  <div class="featuredLabel">
                                    <label>Featured Events</label>
                                  </div>
                                  <a href="#">
                                      <div class="eventList listRed">
                                          <div class="row">
                                              <div class="col-xs-3">
                                                  <img src="image/event1.png">
                                              </div>
                                              <div class="col-xs-8 box-cap">
                                                  <div class="caption caption-first">
                                                      <h5>Cameron Mackintosh's Les Misérables</h5>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </a>
                                  <a href="#">
                                      <div class="eventList listGrey">
                                          <div class="row">
                                              <div class="col-xs-3">
                                                  <img src="image/event2.png">
                                              </div>
                                              <div class="col-xs-8 box-cap">
                                                  <div class="caption caption-two">
                                                      <h5>Shakespeare in the Park - Romeo and Juliet</h5>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </a>
                                  <a href="#">
                                      <div class="eventList listPurple">
                                          <div class="row">
                                              <div class="col-xs-3">
                                                  <img src="image/event3.png">
                                              </div>
                                              <div class="col-xs-8 box-cap">
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
                                              <div class="col-xs-3">
                                                  <img src="image/event4.png">
                                              </div>
                                              <div class="col-xs-8 box-cap">
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
                                              <div class="col-xs-3">
                                                  <img src="image/event5.png">
                                              </div>
                                              <div class="col-xs-8 box-cap">
                                                  <div class="caption">
                                                      <h5>Blue Man Group</h5>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </a>
                                  <div class="buttonBrowse">
                                      <button class="btn btnBrowse font-bold">Browse More Events</button>
                                  </div>
                              </div> -->
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalSeatMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Seat Map</h4>
            </div>
            <div class="modal-body">
                <div class="seat-map-modal">
                    <div class="row">
                        <div class="col-md-7">
                            <img src="{{ asset('assets/frontend/images/seat-map.jpg') }}">
                        </div>
                        <div class="col-md-5">
                            <div class="seat-map-price">
                                <ul>
                                    <li>
                                        <span class="seat-dot dot-blue"></span>
                                        <span class="box-line">
                                            <span class="category">Category</span>
                                            <span class="price">$338</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-purple1"></span>
                                        <span class="box-line">
                                            <span class="category">Category</span>
                                            <span class="price">$338</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-green1"></span>
                                        <span class="box-line">
                                            <span class="category">Category</span>
                                            <span class="price">$338</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-green"></span>
                                        <span class="box-line">
                                            <span class="category">Category</span>
                                            <span class="price">$338</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-purple"></span>
                                        <span class="box-line">
                                            <span class="category">Category</span>
                                            <span class="price">$338</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-creme"></span>
                                        <span class="box-line">
                                            <span class="category">Category</span>
                                            <span class="price">$338</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@include('frontend.partials.script.subscribe_script')
