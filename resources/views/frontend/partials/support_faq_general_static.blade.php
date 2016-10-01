@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
@php
$tag = '<--mobile-->';
@endphp
<section class="about-content faq-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <ul>
                    <li class="sidebar-head">
                        <h4 class="font-light">Support</h4>
                    </li>
                    <li class="sidebar-menu-top active">
                        <a href="{{URL::route('support-faq')}}">Frequently Asked Questions</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('contact-us')}}">Contact Us</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('support-terms-ticket-sales')}}">Terms of Ticket Sales</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('support-terms-website-use')}}">Terms of Website Use</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <div class="support-desc">
                    <div class="row">
                        <h3 class="head-about font-light">Frequently Asked Questions</h3>
                        <div class="col-md-12">
                            <div class="faq-categories">
                                <div class="tabbable tabs-left list-faq">
                                    <ul class="nav nav-tabs col-md-4">
                                        <li class="top-faq active"><a href="#topquestion" data-toggle="tab">Top Questions</a></li>
                                        <li class="general-faq"><a href="#general" data-toggle="tab">General</a></li>
                                        <!-- <li class="account-faq"><a href="#account" data-toggle="tab">My Account</a></li> -->
                                        <li class="seat-faq"><a href="#seatallocation" data-toggle="tab">Seat Allocation</a></li>
                                        <li class="payment-faq"><a href="#payment" data-toggle="tab">Payment</a></li>
                                        <!-- <li class="collection-faq"><a href="#collection" data-toggle="tab">Collection</a></li> -->
                                    </ul>
                                    <div class="tab-content col-md-8">
                                        <div class="tab-pane active" id="topquestion">
                                            <h3 class="font-light">Top Questions</h3>
                                            <ul class="ul-faq-content">
                                                <li>
                                                    <a data-toggle="collapse" href="#collapseone" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What should I do if my tickets are lost?</a>
                                                    <div class="collapse" id="collapseone">
                                                        <p>Please contact us at +65 6733 0360 and have ready the following to get a replacement ticket issued with a new barcode:</p>
                                                        <ul class="ul-inside">
                                                            <li>Order Confirmation Number</li>
                                                            <li>Name</li>
                                                            <li>Contact Number</li>
                                                        </ul>
                                                        <p>A service fee of $5 per ticket reprint, in addition to the standard ticket delivery costs (if applicable), will be applicable for this change.</p>
                                                        <p>General Admission tickets cannot be replaced.
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsetwo" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What happens if an event is cancelled?</a>
                                                    <div class="collapse" id="collapsetwo">
                                                        <p>Cancellation policies are event specific and will be communicated by the show organiser. Given that refunds are offered, procedures will be provided on the event page and major media channels.</p>

                                                        <p>Given that refunds are offered, funds will be automatically returned into the same credit card you used to make the purchase.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsethree" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">How long does it take for my tickets to be delivered?</a>
                                                    <div class="collapse" id="collapsethree">
                                                        <p>Tickets will be dispatched 1 month before the date of event. If you did not receive your tickets, please contact us at +65 6733 0360.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsefour" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Does my child require a ticket?</a>
                                                    <div class="collapse" id="collapsefour">
                                                        <p>Admission rules vary between events. Please refer to the specific event page for information.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsefive" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What is a Booking Fee?</a>
                                                    <div class="collapse" id="collapsefive">
                                                        <p>It is a worldwide standard practice by ticketing services company to support investment in systems technology and to improve the online purchase experience.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="general">
                                            <h3 class="font-light">General</h3>
                                            <ul class="ul-faq-content">
                                                <li>
                                                    <a data-toggle="collapse" href="#collapseoneGeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I reserve my tickets online?</a>
                                                    <div class="collapse" id="collapseoneGeneral">
                                                        <p>All transactions must be completed along with full payment at the time of booking.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsetwoGeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I bring cameras and/or video cameras into the venue?</a>
                                                    <div class="collapse" id="collapsetwoGeneral">
                                                        <p>There are restrictions/limitations on items you can bring into each venue. Please refer to the event page for admission rules and regulations to the specific venue.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsethreeGeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I buy tickets from unauthorised ticket vendors?</a>
                                                    <div class="collapse" id="collapsethreeGeneral">
                                                        <p>Tickets purchased from unauthorised ticket vendors come with high uncertainty of the sources. As such, they could lost/stolen tickets or duplicated tickets, which will be identified on site once scanned and denied entry.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsefourGeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What if I do not live in Singapore and/or do not have a local address, can I still buy tickets to Singapore events?</a>
                                                    <div class="collapse" id="collapsefourGeneral">
                                                        <p>You can make your purchase online or via our ticketing hotline at +65 6733 0360. We accept major credit cards for payment. For collection of tickets, you either select e-ticket for the tickets to be emailed to you or choose to pick up from the event venue which will be available 1 hour before event commence.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsefiveGeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">How do I make corporate and group purchases? </a>
                                                    <div class="collapse" id="collapsefiveGeneral">
                                                        <p>Corporate and group purchases may be available from time to time, on an event to event basis. Please refer to the specific event page for information. Alternatively, you can also call us on the corporate hotline at +65 6733 0360.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="seatallocation">
                                            <h3 class="font-light">Seat Allocation</h3>
                                            <ul class="ul-faq-content">
                                                <li>
                                                    <a data-toggle="collapse" href="#collapseoneSeat" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Why can’t I choose my own seat online?</a>
                                                    <div class="collapse" id="collapseoneSeat">
                                                        <p>You may choose your preferred seat category and section. However, exact seat selection will only be available to events as granted by promoters.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsetwoSeat" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What is an obstructed or restricted view?</a>
                                                    <div class="collapse" id="collapsetwoSeat">
                                                        <p>Due to the different event configuration, stage setup and props arrangement for each event, some seats may not have a full view of the stage. These seats, with obstructed or restricted view, will be identified on the seat map diagram of the event webpage.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="payment">
                                            <h3 class="font-light">Payment</h3>
                                            <ul class="ul-faq-content">
                                                <li>
                                                    <a data-toggle="collapse" href="#collapseonePayment" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What are the modes of payment?</a>
                                                    <div class="collapse" id="collapseonePayment">
                                                        <p>Visa, MasterCard, Amex are accepted via all booking channels.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsetwoPayment" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What is the CVV code?</a>
                                                    <div class="collapse" id="collapsetwoPayment">
                                                        <p>It is a 3-digit number embossed or imprinted on the reverse side of your credit card. For Amex card, it is a 4-digit number on the front side of your card.</p>
                                                    </div>
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
        </div>
    </div>
</section>
<section class="faq-mobile mobile-content">
    <div class="row">
        <div class="col-md-12 mobile-sidebar">
            <div class="container">
                <div class="mobile-sidebar-menu">
                    <a class="menu collapsed" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">Support</a>
                    <div class="collapse" id="mobile-sidebar-collapse">
                        <ul>
                            <li><a href="{{URL::route('support-faq')}}">Frequently Asked Questions</a></li>
                            <li><a href="{{URL::route('contact-us')}}">Contact Us</a></li>
                            <li><a href="{{URL::route('support-terms-ticket-sales')}}">Terms of Ticket Sales</a></li>
                            <li><a href="{{URL::route('support-terms-website-use')}}">Terms of Website Use</a></li>
                            <li><a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="mobile-page-title mobile-title-faq">
                    <a href="{{URL::route('support-faq')}}" class="back-faq">FAQ</a>
                    <h3 class="font-light">General</h3>
                </div>
                <div class="list-ask-mobile top-ask">
                    <ul class="ul-faq-content">
                        <li>
                            <a data-toggle="collapse" href="#collapseonemobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I reserve my tickets online?</a>
                            <div class="collapse" id="collapseonemobile">
                                <p>All transactions must be completed along with full payment at the time of booking.</p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#collapsetwomobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I bring cameras and/or video cameras into the venue?</a>
                            <div class="collapse" id="collapsetwomobile">
                                <p>There are restrictions/limitations on items you can bring into each venue. Please refer to the event page for admission rules and regulations to the specific venue.</p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#collapsethreemobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I buy tickets from unauthorised ticket vendors?</a>
                            <div class="collapse" id="collapsethreemobile">
                                <p>Tickets purchased from unauthorised ticket vendors come with high uncertainty of the sources. As such, they could lost/stolen tickets or duplicated tickets, which will be identified on site once scanned and denied entry.</p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#collapsefourmobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What if I do not live in Singapore and/or do not have a local address, can I still buy tickets to Singapore events?</a>
                            <div class="collapse" id="collapsefourmobile">
                                <p>You can make your purchase online or via our ticketing hotline at +65 6733 0360. We accept major credit cards for payment. For collection of tickets, you either select e-ticket for the tickets to be emailed to you or choose to pick up from the event venue which will be available 1 hour before event commence.</p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#collapsefivemobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">How do I make corporate and group purchases?</a>
                            <div class="collapse" id="collapsefivemobile">
                                <p>Corporate and group purchases may be available from time to time, on an event to event basis. Please refer to the specific event page for information. Alternatively, you can also call us on the corporate hotline at +65 6733 0360.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@include('frontend.partials.script.message_script')