@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
@php
  $tag = '<--mobile-->';
@endphp

<section class="about-content faq-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar sidebar-support">
                @include('layout.frontend.partial.static.support_left_side_static')
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <div class="support-desc">
                    <div class="row">
                        <h3 class="head-about head-ticket font-light">How To Buy Tickets</h3>
                        <div class="col-md-12 faq-content">
                            <div class="faq-categories">
                                <div class="tabbable tabs-left list-faq">
                                    <div class="tab-content tab-ticket col-md-8">
                                        <div class="tab-pane active" id="topquestion">
                                       
                                            <ul class="ul-faq-content ul-ticket-content">
                                                <li class="li-ticket-content">
                                                    <div class="circle-ticket step1-ticket">
                                                        <label class="font-light">1</label>
                                                    </div>
                                                    <a data-toggle="collapse" href="#collapseone" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Select Event & Tickets</a>
                                                    <div class="collapse" id="collapseone">
                                                        <ol class="ul-inside ol-ticket">
                                                            <li>Select the date of event you would like to attend.</li>
                                                            <li>Enter your promo code to unlock the discounted ticket price (hint: check on the event webpage for details of any current promotions).</li>
                                                            <li>Indicate the quantity of ticket or if this is a reserved seating event, choose your preferred seat .</li>
                                                        </ol>
                                                    </div>
                                                </li>
                                                <li class="li-ticket-content">
                                                    <div class="circle-ticket step2-ticket">
                                                        <label class="font-light">2</label>
                                                    </div>
                                                    <a data-toggle="collapse" href="#collapsetwo" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Make Payment</a>
                                                    <div class="collapse" id="collapsetwo">
                                                        <ol class="ul-inside ol-ticket">
                                                            <li>Review your ticket selection and subtotal amount on the order summary page before proceeding to checkout.</li>
                                                            <li>The standard ticket delivery method is E-Ticket (Print at Home) and is free of charge. If there is physical ticket for this event, you can request for this by selecting Mail on the dropdown option with an additional $3 delivery fee (for Singapore addresses only).</li>
                                                            <li>Ensure that you have your details entered correctly as we will be sending you an Order Confirmation and/or E-Ticket to your email.</li>
                                                            <li>Complete your payment details by entering your credit card information or via Visa Checkout (https://secure.checkout.visa.com/customer_support/faq?locale=en).</li>
                                                        </ol>
                                                    </div>
                                                </li>
                                                <li class="li-ticket-content">
                                                    <div class="circle-ticket step3-ticket">
                                                        <label class="font-light">3</label>
                                                    </div>
                                                    <a data-toggle="collapse" href="#collapsethree" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Receive Your Tickets</a>
                                                    <div class="collapse" id="collapsethree">
                                                        <ol class="ul-inside ol-ticket">
                                                            <li>Upon a successful purchase, you will receive an order confirmation number for your reference.</li>
                                                            <li>Your Order Confirmation and/or E-Ticket will be sent to you on email.</li>
                                                            <li>If you have selected for physical ticket, we will be in contact to update on the mailing status.</li>
                                                        </ol>
                                                    </div>
                                                </li>
                                                <li class="li-ticket-content">
                                                    <div class="circle-ticket step4-ticket">
                                                        <label class="font-light">4</label>
                                                    </div>
                                                    <a data-toggle="collapse" href="#collapsefour" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Attend and Enjoy Your Event</a>
                                                    <div class="collapse" id="collapsefour">
                                                        <ol class="ul-inside ol-ticket">
                                                            <li>Go green and go light on the event day by saving your E-Ticket on your mobile for us to scan you in. Alternatively, you can also bring along your E-Ticket printout.</li>
                                                            <li>If you have selected for physical ticket, please remember to have it with you when you come for the event.</li>
                                                        </ol>
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
                    @include('layout.frontend.partial.static.support_top_mobile_static')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 main-faq-mobile">
            <div class="container">
                <div class="mobile-page-title">
                    <h3 class="font-light">How To Buy Tickets</h3>
                </div>
                <div class="tabbable tabs-left list-faq">
                    <div class="tab-content tab-ticket col-md-8">
                        <div class="tab-pane active" id="topquestion">
                       
                            <ul class="ul-faq-content ul-ticket-content">
                                <li class="li-ticket-content-mobile">
                                    <div class="circle-ticket step1-ticket">
                                        <label class="font-light">1</label>
                                    </div>
                                    <a data-toggle="collapse" href="#collapseone-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Select Event & Tickets</a>
                                    <div class="collapse" id="collapseone-mobile">
                                        <ol class="ul-inside ol-ticket">
                                            <li>Select the date of event you would like to attend.</li>
                                            <li>Enter your promo code to unlock the discounted ticket price (hint: check on the event webpage for details of any current promotions).</li>
                                            <li>Indicate the quantity of ticket or if this is a reserved seating event, choose your preferred seat .</li>
                                        </ol>
                                    </div>
                                </li>
                                <li class="li-ticket-content-mobile">
                                    <div class="circle-ticket step2-ticket">
                                        <label class="font-light">2</label>
                                    </div>
                                    <a data-toggle="collapse" href="#collapsetwo-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Make Payment</a>
                                    <div class="collapse" id="collapsetwo-mobile">
                                        <ol class="ul-inside ol-ticket">
                                            <li>Review your ticket selection and subtotal amount on the order summary page before proceeding to checkout.</li>
                                            <li>The standard ticket delivery method is E-Ticket (Print at Home) and is free of charge. If there is physical ticket for this event, you can request for this by selecting Mail on the dropdown option with an additional $3 delivery fee (for Singapore addresses only).</li>
                                            <li>Ensure that you have your details entered correctly as we will be sending you an Order Confirmation and/or E-Ticket to your email.</li>
                                            <li>Complete your payment details by entering your credit card information or via Visa Checkout (https://secure.checkout.visa.com/customer_support/faq?locale=en).</li>
                                        </ol>
                                    </div>
                                </li>
                                <li class="li-ticket-content-mobile">
                                    <div class="circle-ticket step3-ticket">
                                        <label class="font-light">3</label>
                                    </div>
                                    <a data-toggle="collapse" href="#collapsethree-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Receive Your Tickets</a>
                                    <div class="collapse" id="collapsethree-mobile">
                                        <ol class="ul-inside ol-ticket">
                                            <li>Upon a successful purchase, you will receive an order confirmation number for your reference.</li>
                                            <li>Your Order Confirmation and/or E-Ticket will be sent to you on email.</li>
                                            <li>If you have selected for physical ticket, we will be in contact to update on the mailing status.</li>
                                        </ol>
                                    </div>
                                </li>
                                <li class="li-ticket-content-mobile">
                                    <div class="circle-ticket step4-ticket">
                                        <label class="font-light">4</label>
                                    </div>
                                    <a data-toggle="collapse" href="#collapsefour-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Attend and Enjoy Your Event</a>
                                    <div class="collapse" id="collapsefour-mobile">
                                        <ol class="ul-inside ol-ticket">
                                            <li>Go green and go light on the event day by saving your E-Ticket on your mobile for us to scan you in. Alternatively, you can also bring along your E-Ticket printout.</li>
                                            <li>If you have selected for physical ticket, please remember to have it with you when you come for the event.</li>
                                        </ol>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop