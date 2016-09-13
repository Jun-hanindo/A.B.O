@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
          <section class="about-content contact-content">
              <div class="row">
                  <div class="col-md-3">
                      <div class="sidebar">
                          <ul>
                              <li class="sidebar-head">
                                  <h4>Our Company</h4>
                              </li>
                              <li class="sidebar-menu-top">
                                  <a href="{{URL::route('our-company')}}">About Asia Box Office</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('careers')}}">Careers</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('contact-us')}}" class="active-contact">Contact Us</a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-9">
                      <div class="main-content">
                          <div class="contact-desc">
                              <div class="row">
                                  <h3 class="head-about">Contact Us</h3>
                                  {!! $content !!}
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
          
          <section class="contact-mobile mobile-content">
            <div class="row">
              <div class="col-md-12 mobile-sidebar">
                <div class="container">
                  <div class="mobile-sidebar-menu">
                    <a class="menu" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">Our Company</a>
                    <div class="collapse" id="mobile-sidebar-collapse">
                      <ul>
                        <li><a href="{{URL::route('our-company')}}">About Asia Box Office</a></li>
                        <li><a href="{{URL::route('careers')}}">Careers</a></li>
                        <li><a href="{{URL::route('contact-us')}}">Contact Us</a></li>
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
                    <h3>Contact Us</h3>
                  </div>
                  <div class="eventTab">
                    <ul class="nav nav-tabs tab-mobile tab-mobile-contact" role="tablist">
                      <li role="presentation" class="active"><a href="#sendmessage" aria-controls="home" role="tab" data-toggle="tab">Send a Message</a></li>
                      <li role="presentation"><a href="#callus" aria-controls="profile" role="tab" data-toggle="tab">Call or Locate Us</a></li>
                    </ul>
                  </div>
                  <div class="contentTab">
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="sendmessage">
                        <ul class="list-contact">
                          <li class="general contact"><a href="#">General Enquiries ></a></li>
                          <li class="customer contact"><a href="#">Customer Feedback ></a></li>
                          <li class="corporate contact"><a href="#">Corporate / Group Bookings ></a></li>
                          <li class="media contact"><a href="#">Media Enquiries ></a></li>
                          <li class="ticket contact"><a href="#">Ticketing Solution for Your Event ></a></li>
                          <li class="partner contact"><a href="#">Partnerships ></a></li>
                          <li class="marketing contact"><a href="#">Marketing or Promotion Services ></a></li>
                        </ul>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="callus">
                        <div class="hotline-mobile">
                          <div class="box-inside">
                            <label class="label-small"><div class="label-top">TICKETING HOTLINE</div><div class="label-bottom">Call +65 6733 0360</div></label>
                          </div>
                        </div>
                        <div class="hotline-operating-mobile">
                          <label class="label-head">Hotline Operating Hours</label><br>
                          <label>Mon to Sat: 10am - 8pm, Sun and PH: 12pm - 8pm</label>
                        </div>
                        <div class="office-address-mobile">
                          <label class="label-head">Asia Box Office Pte Ltd</label>
                          <p>390 Orchard Road, Palais Renaissance #15-01, Singapore 238871</p>
                        </div>
                        <div class="office-button-mobile">
                          <button class="btn btnSeeContact">See Map & Directions</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

@stop
@include('frontend.partials.script.message_script')