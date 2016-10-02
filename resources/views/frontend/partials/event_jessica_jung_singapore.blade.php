@extends('layout.frontend.master.master')
@section('title', 'Jessica Jung Singapore Fan Meeting')
@section('content')
<section class="eventBanner" id="eventBanner">
    <div class="imageBanner">
    <!-- <div class="btnPlayEvent"><a data-toggle="modal" data-target="#eventVideo"><i class="fa fa-play-circle-o"></i></a></div> -->
        <img src="{{ asset('assets/frontend/images/jessica-jung-singapore-fullweb.jpg') }} " class="hidden-xs">
        <img src="{{ asset('assets/frontend/images/jessica-jung-singapore-mobile.jpg') }}" class="hidden-lg hidden-md hidden-sm" alt="...">
    </div>
    <div class="infoBanner bg-peach" id="eventTabShow">
        <div class="container">
            <div class="detail">
                <h5>MEET &amp; GREET</h5>
                <h2 class="font-light">Jessica Jung Singapore Fan Meeting</h2>
            </div>
            <div class="moreDetail">
                <a href="https://asiaboxoffice.nliven.co/tickets/series/JESSICAJUNGSINGAPORE" target="_blank">
                    <button class="btn btnDetail font-bold">Buy Now</button>
                </a>
            </div>
        </div>
    </div>
</section>
<div class="eventTabScroll bg-peach">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <ul class="" role="">
                    <li><a href="#eventBanner" class="smoothScroll backtop">Back To Summary</a></li>
                    <li><a href="#aboutBox" class="smoothScroll active">About This Event</a></li>
                    <li><a href="#venueBox" class="smoothScroll">Venue Info</a></li>
                    <li><a href="#admissionBox" class="smoothScroll">Admission Rules</a></li>
                    <li><a href="https://asiaboxoffice.nliven.co/tickets/series/JESSICAJUNGSINGAPORE" target="_blank"><button class="btn btnBuy btnABO font-bold">Buy Now</button></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="eventTabScroll-mobile bg-peach">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li><a href="#eventBanner" class="smoothScroll backtop"></a></li>
                    <li><a href="#aboutBox" class="smoothScroll active">About</a></li>
                    <li><a href="#venueBox" class="smoothScroll">Venue</a></li>
                    <li><a href="#admissionBox" class="smoothScroll">Admission</a></li>
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
                    <i class="fa fa-calendar-o"></i> 11 November 2016
                </div>
                <div class="information-event">
                    <p>Friday, 8.00PM</p>
                    <ul>
                        <li>Duration: Approx. 1.5 Hours</li>
                        <li>Doors open at 7:00 PM</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 place">
                <div class="information-title">
                    <i class="fa fa-map-marker"></i> Suntec Convention Centre Hall 601
                </div>
                <ul class="list-unstyled">
                    <li>1 Raffles Boulevard</li>
                    <li>Suntec City</li>
                    <li>Singapore 039593</li><br>
                    <li><a href="https://www.google.com.sg/maps/place/Suntec+Singapore+Convention+%26+Exhibition+Centre/@1.2936604,103.8550043,17z/data=!3m1!4b1!4m5!3m4!1s0x31da19af38dd2bf3:0xd63e8cb2dacf54c7!8m2!3d1.2936604!4d103.857193" class="btn btnSeemap font-bold" target="_blank">See Map</a></li>
                </ul>
            </div>
            <div class="col-md-4 ticket" id="ticket">
                <div class="information-title">
                    <i class="fa fa-ticket"></i> S$81-201/person
                </div>
                <ul class="list-unstyled">
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 1</td>
                                <td><span>S$201</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 2</td>
                                <td><span>S$161</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 3</td>
                                <td><span>S$111</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile parentLast">
                        <table>
                            <tr>
                                <td>Category 4 *</td>
                                <td><span>S$81</span></td>
                            </tr>
                        </table>
                    </li>
                    <p class="additional-info">* Restricted view<br>(Price inclusive of S$3 booking fee per ticket)</p>
                    <li class="liParent parentButton">
                        <button class="btn btnBlackDefault font-bold" data-target="#modalSeatMap" data-toggle="modal">See Seat Map</button>
                        <!-- <button class="btn btnticket bg-white font-bold">More Ticket Info</button> -->
                    </li>
                </ul>
            </div>
            <div class="col-md-12 tabEvent">
                <div class="eventTab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a href="#aboutBox" class="smoothScroll active">About This Event</a></li>
                        <li><a href="#venueBox" class="smoothScroll">Venue Info</a></li>
                        <li><a href="#admissionBox" class="smoothScroll">Admission Rules</a></li>
                    </ul>
                </div>
            </div>
            <div class="eventTab-mobile">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li><a href="#aboutBox" class="smoothScroll active">About</a></li>
                    <li><a href="#venueBox" class="smoothScroll">Venue</a></li>
                    <li><a href="#admissionBox" class="smoothScroll">Admission</a></li>
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
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15955.205477837979!2d103.857193!3d1.2936604!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd63e8cb2dacf54c7!2sSuntec+Singapore+Convention+%26+Exhibition+Centre!5e0!3m2!1sen!2sid!4v1475148964605" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen ></iframe>
                                                        </div>

                                                        <h3 class="font-bold">Getting to the Venue</h3>
                                                        <ul id="getvenue">
                                                            <li class="mrt">
                                                                <h3 class="font-bold">By MRT</h3>
                                                                <p>Take the Circle Line to Esplanade MRT Station and take Exit A.</p>
                                                            </li>
                                                            <li class="taxi">
                                                                <h3 class="font-bold">By Taxi</h3>
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
                            <img src="{{ asset('assets/frontend/images/jessica-jung-singapore-seatmap.jpg') }}">
                        </div>
                        <div class="col-md-5">
                            <div class="seat-map-price">
                                <ul>
                                    <li>
                                        <span class="seat-dot dot-singapore1"></span>
                                        <span class="box-line">
                                            <span class="category">Category 1</span>
                                            <span class="price">S$201</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-singapore2"></span>
                                        <span class="box-line">
                                            <span class="category">Category 2</span>
                                            <span class="price">S$161</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-singapore3"></span>
                                        <span class="box-line">
                                            <span class="category">Category 3</span>
                                            <span class="price">S$111</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-singapore4"></span>
                                        <span class="box-line">
                                            <span class="category">Category 4</span>
                                            <span class="price">S$81</span>
                                        </span>
                                    </li>
                                </ul>
                                <p>* Restricted view<br>(Price inclusive of S$3 booking fee per ticket)</p>
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
