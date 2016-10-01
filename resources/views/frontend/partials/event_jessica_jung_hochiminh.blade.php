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
                <h5>MEET & GREET</h5>
                <h2 class="font-light">Jessica Jung Ho Chi Minh Fan Meeting</h2>
            </div>
            <div class="moreDetail">
                <a href="https://asiaboxoffice.nliven.co/tickets/series/JESSICAJUNGSINGAPORE" target="_blank">
                    <button class="btn btnDetail font-bold">Buy Now</button>
                </a>
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
                    <li><a href="https://asiaboxoffice.nliven.co/tickets/series/JESSICAJUNGSINGAPORE" target="_blank"><button class="btn btnBuy btnABO font-bold">Buy Now</button></a></li>
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
                    <li><a href="https://asiaboxoffice.nliven.co/tickets/series/JESSICAJUNGSINGAPORE"><button class="btn btnBuy btnABO font-bold">Buy</button></a></li>
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
                    <i class="fa fa-calendar-o"></i> 25 November 2016
                </div>
                <div class="information-event">
                  <p>Friday, 5.00PM</p>
                  <ul>
                    <li>Duration: Approx. 1,5 Hours</li>
                    <li>Doors Open Time: 3.30PM</li>
                  </ul>
                </div>
            </div>
            <div class="col-md-4 place">
                <div class="information-title">
                    <i class="fa fa-map-marker"></i> Quan Khu 7 
                </div>
                <ul class="list-unstyled">
                    <li>202 Hoàng Văn Thụ, Phường 2</li>
                    <li>Hồ Chí Minh, Vietnam</li><br>
                    <li><a href="https://www.google.com.sg/maps/place/Suntec+Singapore+Convention+%26+Exhibition+Centre/@1.2936604,103.8550043,17z/data=!3m1!4b1!4m5!3m4!1s0x31da19af38dd2bf3:0xd63e8cb2dacf54c7!8m2!3d1.2936604!4d103.857193" class="btn btnSeemap font-bold" target="_blank">See Map</a></li>
                </ul>
            </div>
            <div class="col-md-4 ticket" id="ticket">
                <div class="information-title">
                    <i class="fa fa-ticket"></i> S$40-100/person
                </div>
                <ul class="list-unstyled">
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 1</td>
                                <td><span>S$100</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 1 (Standing)</td>
                                <td><span>S$100</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 2</td>
                                <td><span>S$80</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 2 (Standing)</td>
                                <td><span>S$80</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 3</td>
                                <td><span>S$60</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 3 (Standing)</td>
                                <td><span>S$60</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile parentLast">
                        <table>
                            <tr>
                                <td>Category 4</td>
                                <td><span>S$40</span></td>
                            </tr>
                        </table>
                    </li>
                    <!-- <p class="additional-info">* Restricted view (Price inclusive on S$3 booking fee per ticket)</p> -->
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
                                                        <h3 class="font-bold">Jessica Jung Singapore Fan Meeting</h3>
                                                        <p>Korean American K-Pop sensation Jessica Jung will be holding her first fan meeting in Singapore on 11 November 2016. Following the release of her first solo album ‘With Love J’, which topped charts in Korea and 9 other countries in Asia, Jessica is back and ready to entertain her fans with an Asia Fan meeting Tour with Singapore being her first stop. Fans can expect fun interaction, stage games and performances in this 90 minutes party.
                                                        </p>
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
                                                      <h3 class="font-bold">Suntec Convention Centre Hall 601</h3>
                                                      <p>1 Raffles Boulevard <br>Suntec City <br>Singapore 039593</p>

                                                      <div class="mapEvent">
                                                        <div style="width: 100%"><iframe width="100%" height="300" src="http://www.maps.ie/create-google-map/map.php?width=100%&amp;height=300&amp;hl=en&amp;q=202%20Ho%C3%A0ng%20V%C4%83n%20Th%E1%BB%A5%2C%20Ph%C6%B0%E1%BB%9Dng%202%2C%20H%E1%BB%93%20Ch%C3%AD%20Minh%2C%20Vietnam+(Quan%20Khu%207)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="http://www.mapsdirections.info/nl/maak-een-google-map/">Google Maps toevoegen op website</a> aan <a href="http://www.mapsdirections.info/nl/">Bereken route</a></iframe></div>
                                                      </div>

                                                      <h3 class="font-bold">Getting to the Venue</h3>
                                                      <ul id="getvenue">
                                                          <li class="mrt">
                                                              <h3 class="font-bold">By MRT</h3>
                                                              <p>Take the Circle Line to Esplanade MRT Station and take Exit A.</p>
                                                          </li>
                                                          <li class="taxi">
                                                              <h3 class="font-bold">By Taxi / UBER Drop Off</h3>
                                                              <p>If you are taking a taxi, you may alight directly at the venue.</p>
                                                          </li>
                                                          <li class="car">
                                                              <h3 class="font-bold">By Car</h3>
                                                              <p>Parking is available at the venue. There are 4 access routes to Suntec City:</p>
                                                              <ul class="car-route">
                                                                <li>Nicoll Highway</li>
                                                                <li>Raffles Boulevard (from Bras Basah Road)</li>
                                                                <li>Temasek Avenue (from Raffles Boulevard)</li>
                                                                <li>Rochor Road Exit from East Coast Expressway (ECP)</li>
                                                              </ul>
                                                              <p>Suntec Convention Centre is located in the West Wing, the closest parking location will be in the Green Zone.</p>
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
                                                              <li>No admission for infant and children aged below 10 years old.</li>
                                                              <li>Children aged 10 years and above must purchase a ticket for admission.</li>
                                                              <li>All children below 12 years of age must be accompanied by a parent or guardian.</li>
                                                          </ul>
                                                          <h3 class="font-bold">Photography / Video Recording Rules</h3>
                                                          <ul>
                                                              <li>Photography, Video Recording and Audio Recording is strictly prohibited during the performance.</li>
                                                              <li>All DSLR / Cameras with interchangeable lens is strictly prohibited inside the venue.</li>
                                                          </ul>
                                                          <p>All information is accurate at the time of publishing.</p>
                                                      </section>
                                                  </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    
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
                                <span class="seat-dot dot-pink"></span>
                                <span class="box-line">
                                  <span class="category">Category 1</span>
                                  <span class="price">S$231</span>
                                </span>
                              </li>
                              <li>
                                <span class="seat-dot dot-blue"></span>
                                <span class="box-line">
                                  <span class="category">Category 2</span>
                                  <span class="price">S$191</span>
                                </span>
                              </li>
                              <li>
                                <span class="seat-dot dot-purple"></span>
                                <span class="box-line">
                                  <span class="category">Category 3</span>
                                  <span class="price">S$161</span>
                                </span>
                              </li>
                              <li>
                                <span class="seat-dot dot-green"></span>
                               <span class="box-line">
                                  <span class="category">Category 4</span>
                                  <span class="price">S$141</span>
                                </span>
                              </li>
                              <li>
                                <span class="seat-dot dot-green1"></span>
                                <span class="box-line">
                                  <span class="category">Category 5</span>
                                  <span class="price">S$101</span>
                                </span>
                              </li>
                              <li>
                                <span class="seat-dot dot-creme"></span>
                                <span class="box-line">
                                  <span class="category">Category 6 *</span>
                                  <span class="price">S$71</span>
                                </span>
                              </li>
                            </ul>
                            <p>* Restricted view (Price inclusive on S$3 booking fee per ticket)</p>
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
