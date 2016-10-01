@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
@php
    $tag = '<--mobile-->';
@endphp
<section class="faq-mobile mobile-content">
    <div class="row">
      <div class="col-md-12 mobile-sidebar">
        <div class="container">
          <div class="mobile-sidebar-menu">
            <a class="menu collapsed" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">Support</a>
            <div class="collapse" id="mobile-sidebar-collapse">
              <ul>
                {{-- <li><a href="{{URL::route('support-way-to-buy-tickets')}}">{{ trans('general.ways_to_buy_tickets') }}</a></li> --}}
                <li><a href="{{URL::route('support-faq')}}">{{ trans('general.frequently_asked_questions') }}</a></li>
                <li><a href="{{URL::route('contact-us')}}">{{ trans('general.contact_us') }}</a></li>
                <li><a href="{{URL::route('support-terms-and-conditions')}}">{{ trans('general.terms_and_conditions') }}</a></li>
                <li><a href="{{URL::route('support-privacy-policy')}}">{{ trans('general.privacy_policy') }}</a></li>
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
                    <h3 class="font-light">Top Questions</h3>
                </div>
                <div class="list-ask-mobile top-ask">
                    <ul class="ul-faq-content">
                        <li>
                            <a data-toggle="collapse" href="#collapseonemobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What should I do if my tickets are lost?</a>
                            <div class="collapse" id="collapseonemobile">
                                <p>Please contact us at +65 6733 0360 and have ready the following to get a replacement ticket issued with a new barcode:</p>
                                <ul class="ul-inside">
                                    <li>Order Confirmation Number</li>
                                    <li>Name</li>
                                    <li>Contact Number</li>
                                </ul>
                                <p>A service fee of $5 per ticket reprint, in addition to the standard ticket delivery costs (if applicable), will be applicable for this change.</p>
                                <p>General Admission tickets cannot be replaced.</p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#collapsetwomobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What happens if an event is cancelled?</a>
                            <div class="collapse" id="collapsetwomobile">
                                <p>Cancellation policies are event specific and will be communicated by the show organiser. Given that refunds are offered, procedures will be provided on the event page and major media channels.</p>

                                <p>Given that refunds are offered, funds will be automatically returned into the same credit card you used to make the purchase.</p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#collapsethreemobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">How long does it take for my tickets to be delivered?</a>
                            <div class="collapse" id="collapsethreemobile">
                                <p>Tickets will be dispatched 1 month before the date of event. If you did not receive your tickets, please contact us at +65 6733 0360.</p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#collapsefourmobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Does my child require a ticket?</a>
                            <div class="collapse" id="collapsefourmobile">
                                <p>Admission rules vary between events. Please refer to the specific event page for information.</p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#collapsefivemobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What is a Booking Fee?</a>
                            <div class="collapse" id="collapsefivemobile">
                                <p>It is a worldwide standard practice by ticketing services company to support investment in systems technology and to improve the online purchase experience.</p>
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