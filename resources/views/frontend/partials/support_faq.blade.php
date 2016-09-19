@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
          <section class="about-content faq-content">
              <div class="row">
                  <div class="col-md-3">
                      <div class="sidebar">
                          <ul>
                              <li class="sidebar-head">
                                  <h4>Support</h4>
                              </li>
                              <li class="sidebar-menu-top">
                                  <a href="{{URL::route('support-way-to-buy-tickets')}}">Way To Buy Tickets</a>
                              </li>
                              <li class="sidebar-menu active">
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
                                  <h3 class="head-about">Frequently Asked Questions</h3>
                                  {!! str_replace('[captcha]', Recaptcha::render(), $content); !!}
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
                    <h3>Frequently Asked Questions</h3>
                  </div>
                  <div class="search-mobile">
                    <div class="search-faq">
                      <form>
                          <div class="input-group">
                              <span class="input-group-addon addon-faq">
                                  <i class="fa fa-search"></i>
                              </span>
                              <input type="text" class="form-control input-search" placeholder="Search...">
                          </div>
                      </form>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="top-faq-mobile faq-menu-mobile">
                        <a href="top_faq_mobile.html">
                          <div class="row">
                            <div class="col-md-12">
                              <i class="fa fa-star"></i>
                            </div>
                            <div class="col-md-12">
                              <p>Top Questions</p>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="general-faq-mobile faq-menu-mobile">
                        <a href="general_faq_mobile.html">
                          <div class="row">
                            <div class="col-md-12">
                              <i class="fa fa-question-circle"></i>
                            </div>
                            <div class="col-md-12">
                              <p>General</p>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="account-faq-mobile faq-menu-mobile">
                        <a href="account_faq_mobile.html">
                          <div class="row">
                            <div class="col-md-12">
                              <i class="fa fa-user"></i>
                            </div>
                            <div class="col-md-12">
                              <p>My Account</p>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="seat-faq-mobile faq-menu-mobile">
                        <a href="seat_faq_mobile.html">
                          <div class="row">
                            <div class="col-md-12">
                              <i class="fa fa-th-large"></i>
                            </div>
                            <div class="col-md-12">
                              <p>Seat Allocation</p>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="payment-faq-mobile faq-menu-mobile">
                        <a href="payment_faq_mobile.html">
                          <div class="row">
                            <div class="col-md-12">
                              <i class="fa fa-money"></i>
                            </div>
                            <div class="col-md-12">
                              <p>Payment</p>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="collection-faq-mobile faq-menu-mobile">
                        <a href="collection_faq_mobile.html">
                          <div class="row">
                            <div class="col-md-12">
                              <i class="fa fa-ticket"></i>
                            </div>
                            <div class="col-md-12">
                              <p>Collection</p>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
@stop
@include('frontend.partials.script.message_script')