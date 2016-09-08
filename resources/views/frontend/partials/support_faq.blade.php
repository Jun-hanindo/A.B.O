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
                                  <div class="col-md-12">
                                    <div class="faq-categories">
                                      <div class="tabbable tabs-left list-faq">
                                        <ul class="nav nav-tabs col-md-4">
                                          <li>
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
                                          </li>
                                          <li class="top-faq active"><a href="#topquestion" data-toggle="tab">Top Questions</a></li>
                                          <li class="general-faq"><a href="#general" data-toggle="tab">General</a></li>
                                          <li class="account-faq"><a href="#account" data-toggle="tab">My Account</a></li>
                                          <li class="seat-faq"><a href="#seat" data-toggle="tab">Seat Allocation</a></li>
                                          <li class="payment-faq"><a href="#payment" data-toggle="tab">Payment</a></li>
                                          <li class="collection-faq"><a href="#collection" data-toggle="tab">Collection</a></li>
                                        </ul>
                                        <div class="tab-content col-md-8">
                                         <div class="tab-pane active" id="topquestion">
                                           <h3>Top Questions</h3>
                                           <ul class="ul-faq-content">
                                             <li>
                                               <a data-toggle="collapse" href="#collapseone" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">What should I do if my tickets are lost?</a>
                                                <div class="collapse" id="collapseone">
                                                  <p>Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                                                  Quisque mauris augue, molestie tincidunt condimentum vitae.</p>
                                                  <div class="helpful-box">
                                                    <h5>Was this answer helpful?</h5>
                                                    <button class="btn btnYes" data-toggle="modal" data-target="#modalYes"><i class="fa fa-check"></i><br>Yes</button>
                                                    <button class="btn btnNo" data-toggle="modal" data-target="#modalNo"><i class="fa fa-close"></i><br>No</button>
                                                    <div class="modal fade" id="modalYes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                      <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Thanks for Your Feedback</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>We are glad we could be helpful to you.</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btnDismiss" data-dismiss="modal">Dismiss</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="modal fade" id="modalNo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                      <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Sorry We Couldn’t Be Helpful</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>Help us improve this article with your feedback.</p>
                                                            <form>
                                                              <input type="text" name="email" placeholder="Email" class="form-control">
                                                              <select class="form-control">
                                                                <option>Need More Information</option>
                                                                <option>Need More Information</option>
                                                              </select>
                                                              <textarea class="form-control" placeholder="Write Your Message (If Any)"></textarea>
                                                            </form>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btnFeedback">Send Feedback</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                             </li>
                                             <li>
                                               <a data-toggle="collapse" href="#collapsetwo" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">What happens if an event is cancelled?</a>
                                                <div class="collapse" id="collapsetwo">
                                                  <p>Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                                                  Quisque mauris augue, molestie tincidunt condimentum vitae.</p>
                                                </div>
                                             </li>
                                             <li>
                                               <a data-toggle="collapse" href="#collapsethree" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">How long does it take for my tickets to be delivered?</a>
                                                <div class="collapse" id="collapsethree">
                                                  <p>Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                                                  Quisque mauris augue, molestie tincidunt condimentum vitae.</p>
                                                </div>
                                             </li>
                                             <li>
                                               <a data-toggle="collapse" href="#collapsefour" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Does my child require a ticket?</a>
                                                <div class="collapse" id="collapsefour">
                                                  <p>Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                                                  Quisque mauris augue, molestie tincidunt condimentum vitae.</p>
                                                </div>
                                             </li>
                                             <li>
                                               <a data-toggle="collapse" href="#collapsefive" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">What is a Booking Fee?</a>
                                                <div class="collapse" id="collapsefive">
                                                  <p>Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                                                  Quisque mauris augue, molestie tincidunt condimentum vitae.</p>
                                                </div>
                                             </li>
                                           </ul>
                                           <div class="ask">
                                             <a href="#">Ask a Question</a>
                                           </div>
                                         </div>
                                         <div class="tab-pane" id="general">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
                                         Aliquam in felis sit amet augue.</div>
                                         <div class="tab-pane" id="account">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                                         Quisque mauris augue, molestie tincidunt condimentum vitae.</div>
                                        <div class="tab-pane" id="seatallocation">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
                                         Aliquam in felis sit amet augue.</div>
                                         <div class="tab-pane" id="payment">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                                         Quisque mauris augue, molestie tincidunt condimentum vitae.</div>
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