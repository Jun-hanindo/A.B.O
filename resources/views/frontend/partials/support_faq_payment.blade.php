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
            <a class="menu" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">Support</a>
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
                    <a href="{{URL::route('support-faq')}}" class="back-faq"> < FAQ</a>
                    <h3 class="font-light">Payment</h3>
                </div>
                <div class="list-ask-mobile top-ask">
                    <ul class="ul-faq-content">
                        <li>
                            <a data-toggle="collapse" href="#collapseonemobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">What are the modes of payment?</a>
                            <div class="collapse" id="collapseonemobile">
                                <p>Visa, MasterCard, Amex are accepted via all booking channels.</p>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#collapsetwomobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">What is the CVV code?</a>
                            <div class="collapse" id="collapsetwomobile">
                                <p>It is a 3-digit number embossed or imprinted on the reverse side of your credit card. For Amex card, it is a 4-digit number on the front side of your card.</p>
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