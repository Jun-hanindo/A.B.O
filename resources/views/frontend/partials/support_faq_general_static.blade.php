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
    </div>
</section>
@stop
@include('frontend.partials.script.message_script')