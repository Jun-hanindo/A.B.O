@extends('layout.frontend.master.master_static')
@section('title', 'Event Asia Box Office')
@section('content')
@php
  $tag = '<--mobile-->';
@endphp

          <section class="about-content ways-content">
              <div class="row">
                  <div class="col-md-3">
                      <div class="sidebar">
                          <ul>
                              <li class="sidebar-head">
                                  <h4>{{ trans('general.support') }}</h4>
                              </li>
                              <li class="sidebar-menu-top active">
                                  <a href="{{URL::route('way-to-buy-tickets')}}">{{ trans('general.ways_to_buy_tickets') }}</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('faq')}}">{{ trans('general.frequently_asked_questions') }}</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('terms-and-conditions')}}">{{ trans('general.terms_and_conditions') }}</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('privacy-policy')}}">{{ trans('general.privacy_policy') }}</a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-9">
                      <div class="main-content">
                          <div class="support-desc">
                              <div class="row">
                                  <h3 class="head-about">{{ trans('general.ways_to_buy_tickets') }}</h3>
                                      
                                    <div class="col-md-12">
                                        <div class="row">
                                            {!! strstr($content, $tag, true) !!}
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
                        <li><a href="{{URL::route('way-to-buy-tickets')}}">{{ trans('general.ways_to_buy_tickets') }}</a></li>
                        <li><a href="{{URL::route('faq')}}">{{ trans('general.frequently_asked_questions') }}</a></li>
                        <li><a href="{{URL::route('terms-and-conditions')}}">{{ trans('general.terms_and_conditions') }}</a></li>
                        <li><a href="{{URL::route('privacy-policy')}}">{{ trans('general.privacy_policy') }}</a></li>
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
                    <h3>{{ trans('general.ways_to_buy_tickets') }}</h3>
                  </div>
                  <div class="mobileTab">
                    <ul class="nav nav-tabs tab-mobile tab-mobile-contact" role="tablist">
                      {{-- <li role="presentation" class="active"><a href="#boxoffice" aria-controls="home" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-ticket"></i></div><br>Box Office</a></li> --}}
                      <li role="presentation"><a href="#hotline" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-phone"></i></div><br>Hotline</a></li>
                      {{-- <li role="presentation"><a href="#website" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-laptop"></i></div><br>Website</a></li> --}}
                    </ul>
                  </div>
                  <div class="contentTab">
                    <div class="tab-content">
                      {!! str_replace($tag, '', strstr($content, $tag)) !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
@stop