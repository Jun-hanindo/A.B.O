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
                                  <a href="#">Way To Buy Tickets</a>
                              </li>
                              <li class="sidebar-menu active">
                                  <a href="#">Frequently Asked Questions</a>
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
                          <div class="career-desc">
                              <div class="row">
                                  <h3 class="head-about">Frequently Asked Questions</h3>
                                  <div class="col-md-4">
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
                                  <div class="col-md-12">
                                    <div class="faq-categories">
                                      <div class="tabbable tabs-left list-faq">
                                        <ul class="nav nav-tabs">
                                          <li class="top-faq active"><a href="#topquestion" data-toggle="tab">Top Questions</a></li>
                                          <li class="general-faq"><a href="#general" data-toggle="tab">General</a></li>
                                          <li class="account-faq"><a href="#account" data-toggle="tab">My Account</a></li>
                                          <li class="seat-faq"><a href="#seat" data-toggle="tab">Seat Allocation</a></li>
                                          <li class="payment-faq"><a href="#payment" data-toggle="tab">Payment</a></li>
                                          <li class="collection-faq"><a href="#collection" data-toggle="tab">Collection</a></li>
                                        </ul>
                                        <div class="tab-content">
                                         <div class="tab-pane active" id="topquestion">Lorem ipsum dolor sit amet, charetra varius quam sit amet vulputate. 
                                         Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero.</div>
                                         <div class="tab-pane" id="general">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
                                         Aliquam in felis sit amet augue.</div>
                                         <div class="tab-pane" id="account">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                                         Quisque mauris augue, molestie tincidunt condimentum vitae.</div>
                                        </div>
                                        <div class="tab-pane" id="seat">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
                                         Aliquam in felis sit amet augue.</div>
                                         <div class="tab-pane" id="payment">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                                         Quisque mauris augue, molestie tincidunt condimentum vitae.</div>
                                        </div>
                                        <div class="tab-pane" id="collection">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
                                         Aliquam in felis sit amet augue.</div>
                                      </div>
                                  </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
@stop