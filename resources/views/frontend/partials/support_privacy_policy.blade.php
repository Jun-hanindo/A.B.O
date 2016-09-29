@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
          <section class="about-content ways-content">
              <div class="row">
                  <div class="col-md-3">
                      <div class="sidebar">
                          <ul>
                              <li class="sidebar-head">
                                  <h4>{{ trans('general.support') }}</h4>
                              </li>
                              {{-- <li class="sidebar-menu-top">
                                  <a href="{{URL::route('support-way-to-buy-tickets')}}">{{ trans('general.ways_to_buy_tickets') }}</a>
                              </li> --}}
                              <li class="sidebar-menu-top">
                                  <a href="{{URL::route('support-faq')}}">{{ trans('general.frequently_asked_questions') }}</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('contact-us')}}">{{ trans('general.contact_us') }}</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('support-terms-and-conditions')}}">{{ trans('general.terms_and_conditions') }}</a>
                              </li>
                              <li class="sidebar-menu active">
                                  <a href="{{URL::route('support-privacy-policy')}}">{{ trans('general.privacy_policy') }}</a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-9">
                      <div class="main-content main-terms">
                          <div class="support-desc">
                              <div class="row">
                                  <h3 class="head-about">{{ trans('general.privacy_policy') }}</h3>
                                    <div class="col-md-12">
                                        <div class="privacy-content">
                                            {!! $content !!}
                                        </div>
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
          <section class="ways-mobile mobile-content">
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
                  <div class="mobile-page-title">
                    <h3 class="font-light">{{ trans('general.privacy_policy') }}</h3>
                  </div>
                    <div class="col-md-12">
                        <div class="privacy-content">
                            {!! $content !!}
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </section>
@stop