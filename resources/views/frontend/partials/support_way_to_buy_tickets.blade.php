@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
          <section class="about-content ways-content">
              <div class="row">
                  <div class="col-md-3">
                      <div class="sidebar">
                          <ul>
                              <li class="sidebar-head">
                                  <h4>Support</h4>
                              </li>
                              <li class="sidebar-menu-top active">
                                  <a href="{{URL::route('support-way-to-buy-tickets')}}">Way To Buy Tickets</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('support-faq')}}">Frequently Asked Questions</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="#">Terms and Conditions</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="#">Privacy Policy</a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-9">
                      <div class="main-content">
                          <div class="support-desc">
                              <div class="row">
                                  <h3 class="head-about">Ways To Buy Tickets</h3>
                                  <div class="col-md-4">
                                    <div class="boxOffice">
                                      <div class="iconWays">
                                        <i class="fa fa-ticket"></i>
                                      </div>
                                      <h4 class="headWays font-bold">Box Office</h4>
                                      <h5>Purchase or collect your tickets here.</h5>
                                      <br>
                                      <h5><b class="font-bold">Asia Box Office Pte Ltd</b></h5>
                                      <label>390 Orchard Road, Palais Renaissance #15-01, Singapore 238871</label>
                                      <button class="btn btnBlackDefault">See Map & Directions</button>
                                      <br>
                                      <div class="operating">
                                        <label>Box Office Operating Hours</label>
                                        <label>Mon to Sat: 10am - 8pm, Sun and PH: 12pm - 8pm</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="hotline">
                                      <div class="iconWays">
                                        <i class="fa fa-phone"></i>
                                      </div>
                                      <h4 class="headWays font-bold">Hotline</h4>
                                      <h5>Speak to our customer service officers.</h5>
                                      <br>
                                      <button class="btn btnBlackDefault"><i class="fa fa-phone"></i>Call +65 6733 0360</button>
                                      <br>
                                      <div class="operating">
                                        <label>Box Office Operating Hours</label>
                                        <label>Mon to Sat: 10am - 8pm, Sun and PH: 12pm - 8pm</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="website">
                                      <div class="iconWays">
                                        <i class="fa fa-laptop"></i>
                                      </div>
                                      <h4 class="headWays font-bold">Website</h4>
                                      <h5>Browse and purchase tickets conveniently.</h5>
                                      <br>
                                      <button class="btn btnBlackDefault">See Our Events</button>
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
                        <li><a href="#">Way To Buy Tickets</a></li>
                        <li><a href="#">Frequently Asked Questions</a></li>
                        <li><a href="#">Terms and Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
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
                    <h3>Ways To Buy Tickets</h3>
                  </div>
                  <div class="eventTab">
                    <ul class="nav nav-tabs tab-mobile tab-mobile-contact" role="tablist">
                      <li role="presentation" class="active"><a href="#boxoffice" aria-controls="home" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-ticket"></i></div><br>Box Office</a></li>
                      <li role="presentation"><a href="#hotline" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-phone"></i></div><br>Hotline</a></li>
                      <li role="presentation"><a href="#website" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-laptop"></i></div><br>Website</a></li>
                    </ul>
                  </div>
                  <div class="contentTab">
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="boxoffice">
                        <h4 class="head-mobile-ways">Purchase or collect your tickets here.</h4>
                        <div class="office-address-mobile">
                          <label class="label-head">Asia Box Office Pte Ltd</label>
                          <p>390 Orchard Road, Palais Renaissance #15-01, Singapore 238871</p>
                        </div>
                        <div class="office-button-mobile">
                          <button class="btn btnSeeContact">See Map & Directions</button>
                        </div>
                        <div class="hotline-operating-mobile">
                          <label class="label-head">Box Office Operating Hours</label><br>
                          <label>Mon to Sat: 10am - 8pm, Sun and PH: 12pm - 8pm</label>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="hotline">
                        <h4 class="head-mobile-ways">Speak to our customer service officers.</h4>
                        <div class="office-button-mobile">
                          <button class="btn btnSeeContact"><i class="fa fa-phone" style="margin-right: 10px;"></i>Call +65 6733 0360</button>
                        </div>
                        <div class="hotline-operating-mobile">
                          <label class="label-head">Hotline Operating Hours</label><br>
                          <label>Mon to Sat: 10am - 8pm, Sun and PH: 12pm - 8pm</label>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="website">
                        <h4 class="head-mobile-ways">Browse and purchase tickets conveniently.</h4>
                        <div class="office-button-mobile">
                          <button class="btn btnSeeContact">See Our Events</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
@stop