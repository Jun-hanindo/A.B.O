@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
          <section class="about-content">
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
                                  <a href="#" class="active-contact">Contact Us</a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-9">
                      <div class="main-content">
                          <div class="contact-desc">
                              <div class="row">
                                  <h3 class="head-about">Contact Us</h3>
                                  <div class="col-md-7">
                                      <h4 class="head-sub">Send a Message</h4>
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
                                  <div class="col-md-5">
                                      <h4 class="head-sub">Call or Locate Us</h4>
                                      <div class="contact-hotline">
                                        <i class="fa fa-phone"></i>
                                        <label class="label-small"><div class="label-top">TICKETING HOTLINE</div><div class="label-bottom">Call +65 6733 0360</div></label>
                                      </div>
                                      <div class="hotline-operating">
                                        <label class="label-head">Hotline Operating Hours</label>
                                        <label>Mon to Sat: 10am - 8pm, Sun and PH: 12pm - 8pm</label>
                                      </div>
                                      <div class="office-address">
                                        <label class="label-head">Asia Box Office Pte Ltd</label>
                                        <p>390 Orchard Road, Palais Renaissance #15-01, Singapore 238871</p>
                                      </div>
                                      <div class="office-button">
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