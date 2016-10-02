@extends('layout.frontend.master.master')
@section('title', 'Jessica Jung Ho Chi Minh Fan Meeting')
@section('content')
<section class="eventBanner" id="eventBanner">
    <div class="imageBanner">
        <!-- <div class="btnPlayEvent"><a data-toggle="modal" data-target="#eventVideo"><i class="fa fa-play-circle-o"></i></a></div> -->
        <img src="{{ asset('assets/frontend/images/jessica-jung-hochiminh-fullweb.jpg') }}" class="hidden-xs">
        <img src="{{ asset('assets/frontend/images/jessica-jung-hochiminh-mobile.jpg') }}" class="hidden-lg hidden-md hidden-sm" alt="...">
    </div>
    <div class="infoBanner bg-peach" id="eventTabShow">
        <div class="container">
            <div class="detail">
                <h5>MEET &amp; GREET</h5>
                <h2 class="font-light">Jessica Jung Ho Chi Minh Fan Meeting</h2>
            </div>
            <div class="moreDetail">
                <a href="https://asiaboxoffice.nliven.co/tickets/series/JESSICAJUNGHOCHIMINH" target="_blank">
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
                    <li><a href="https://asiaboxoffice.nliven.co/tickets/series/JESSICAJUNGHOCHIMINH" target="_blank"><button class="btn btnBuy btnABO font-bold">Buy Now</button></a></li>
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
                    <li><a href="https://asiaboxoffice.nliven.co/tickets/series/JESSICAJUNGHOCHIMINH"><button class="btn btnBuy btnABO font-bold">Buy</button></a></li>
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
                    <i class="fa fa-calendar-o"></i> 27 November 2016
                </div>
                <div class="information-event">
                    <p>Sunday, 5.00PM</p>
                    <ul>
                        <li>Duration: Approx. 1.5 Hours</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 place">
                <div class="information-title">
                    <i class="fa fa-map-marker"></i> Quan Khu 7
                </div>
                <ul class="list-unstyled">
                    <li>202 Hoàng Văn Thụ, Phường 2, Tân Bình,<br>Hồ Chí Minh, Vietnam</li><br>
                    <li><a href="https://www.google.com.sg/maps/place/Quan+Khu+7+Stadium/@10.8020398,106.6650767,17z/data=!3m1!4b1!4m5!3m4!1s0x317529257fe2e80d:0x45efd6c1787e881a!8m2!3d10.8020398!4d106.6672654" class="btn btnSeemap font-bold" target="_blank">See Map</a></li>
                </ul>
            </div>
            <div class="col-md-4 ticket" id="ticket">
                <div class="information-title">
                    <i class="fa fa-ticket"></i> US$40-100/person
                </div>
                <ul class="list-unstyled">
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 1</td>
                                <td><span>US$100</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 1 (Standing)</td>
                                <td><span>US$100</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 2</td>
                                <td><span>US$80</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 2 (Standing)</td>
                                <td><span>US$80</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 3</td>
                                <td><span>US$60</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile">
                        <table>
                            <tr>
                                <td>Category 3 (Standing)</td>
                                <td><span>US$60</span></td>
                            </tr>
                        </table>
                    </li>
                    <li class="liParent li-mobile parentLast">
                        <table>
                            <tr>
                                <td>Category 4</td>
                                <td><span>US$40</span></td>
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
                                                        <h3 class="font-bold">Jessica Jung Ho Chi Minh Fan Meeting</h3>
                                                        <p>Korean American K-Pop sensation Jessica Jung will be holding her first fan meeting in Ho Chi Minh on 27 November 2016. Following the release of her first solo album ‘With Love J’, which topped charts in Korea and 9 other countries in Asia, Jessica is back and ready to entertain her fans with an Asia Fan meeting Tour. Fans can expect fun interaction, stage games and performances in this 90 minutes party.
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
                                                        <h3 class="font-bold">Quan Khu 7</h3>
                                                        <p>202 Hoàng Văn Thụ, Phường 2, Tân Bình, Hồ Chí Minh, Vietnam</p>

                                                        <div class="mapEvent">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.1209815478337!2d106.66507671427702!3d10.802045061675328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529257fe2e80d%3A0x45efd6c1787e881a!2sQuan+Khu+7+Stadium!5e0!3m2!1sen!2sid!4v1475327037862" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                                                        </div>
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
                            <img src="{{ asset('assets/frontend/images/jessica-jung-hochiminh-seatmap.jpg') }}">
                        </div>
                        <div class="col-md-5">
                            <div class="seat-map-price">
                                <ul>
                                    <li>
                                        <span class="seat-dot dot-hochi1"></span>
                                        <span class="box-line">
                                            <span class="category">Category 1</span>
                                            <span class="price">US$100</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-hochi1"></span>
                                        <span class="box-line">
                                            <span class="category">Category 1 (Standing)</span>
                                            <span class="price">US$100</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-hochi2"></span>
                                        <span class="box-line">
                                            <span class="category">Category 2</span>
                                            <span class="price">US$80</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-hochi2"></span>
                                        <span class="box-line">
                                            <span class="category">Category 2 (Standing)</span>
                                            <span class="price">US$80</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-hochi3"></span>
                                        <span class="box-line">
                                            <span class="category">Category 3</span>
                                            <span class="price">US$60</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-hochi3"></span>
                                        <span class="box-line">
                                            <span class="category">Category 3 (Standing)</span>
                                            <span class="price">US$60</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="seat-dot dot-hochi4"></span>
                                        <span class="box-line">
                                            <span class="category">Category 4</span>
                                            <span class="price">US$40</span>
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
