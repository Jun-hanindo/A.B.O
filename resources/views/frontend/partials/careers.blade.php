@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
          <section class="about-content career-content">
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
                                  <a href="#" class="active-career">Careers</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('contact-us')}}">Contact Us</a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-9">
                      <div class="main-content">
                          <div class="career-desc">
                              <div class="row">
                                  <h3 class="head-about">Careers</h3>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat laoreet eros, eget aliquet mi maximus eu. Donec nec blandit nisi. Aliquam volutpat eros id nibh congue elementum. Nam lectus quam, feugiat in faucibus orci luctus commodo ut, sollicitudin.</p>
                                  <div class="job-head">
                                    <h4>We Have 4 Job Openings</h4>
                                    <select class="form-control">
                                      <option>All Departments</option>
                                      <option>Departments 1</option>
                                      <option>Departments 2</option>
                                    </select>
                                  </div>
                                  <div class="job-list job-list-head">
                                    <table>
                                      <tr>
                                        <td class="jobs">Application Support Programmer</td>
                                        <td class="divisions">IT Services</td>
                                        <td class="job-type">Full Time</td>
                                        <td class="payroll">$3,000</td>
                                      </tr>
                                    </table>
                                  </div>

                                  <div class="job-list">
                                    <table>
                                      <tr>
                                        <td class="jobs">System Analyst</td>
                                        <td class="divisions">IT Services</td>
                                        <td class="job-type">Full Time</td>
                                        <td class="payroll">$3,000</td>
                                      </tr>
                                    </table>
                                  </div>

                                  <div class="job-list">
                                    <table>
                                      <tr>
                                        <td class="jobs">Customer Service Executive</td>
                                        <td class="divisions">Operations</td>
                                        <td class="job-type">Full Time</td>
                                        <td class="payroll">$3,000</td>
                                      </tr>
                                    </table>
                                  </div>

                                  <div class="job-list">
                                    <table>
                                      <tr>
                                        <td class="jobs">Customer Service Assistant</td>
                                        <td class="divisions">Operations</td>
                                        <td class="job-type">Full Time</td>
                                        <td class="payroll">$3,000</td>
                                      </tr>
                                    </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>

          <section class="career-mobile mobile-content">
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
                    <h3>Careers</h3>
                  </div>
                  <div class="mobile-page-desc">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat laoreet eros, eget aliquet mi maximus eu. Donec nec blandit nisi. Aliquam volutpat eros id nibh congue elementum. Nam lectus quam, feugiat in faucibus orci luctus commodo ut, sollicitudin.</p>
                  </div>
                  <div class="mobile-jobs-available">
                    <h3>We Have 4 Job Openings</h3>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mobile-filter">
                        <select class="form-control">
                          <option>All Departments</option>
                          <option>IT</option>
                          <option>Design</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <a href="#" class="mobile-jobs-a">
                        <div class="mobile-job-list">
                          <div class="mobile-job-head">
                            <h4>Application Support Programmer</h4>
                          </div>
                          <div class="mobile-job-desc">
                            <ul>
                              <li class="divisions">IT Services</li>
                              <li class="job-type">Full Time</li>
                              <li class="payroll">$3,000</li>
                            </ul>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <a href="#" class="mobile-jobs-a">
                        <div class="mobile-job-list">
                          <div class="mobile-job-head">
                            <h4>System Analyst</h4>
                          </div>
                          <div class="mobile-job-desc">
                            <ul>
                              <li class="divisions">IT Services</li>
                              <li class="job-type">Full Time</li>
                              <li class="payroll">$3,000</li>
                            </ul>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <a href="#" class="mobile-jobs-a">
                        <div class="mobile-job-list">
                          <div class="mobile-job-head">
                            <h4>Customer Service Executive</h4>
                          </div>
                          <div class="mobile-job-desc">
                            <ul>
                              <li class="divisions">Operations</li>
                              <li class="job-type">Full Time</li>
                              <li class="payroll">$3,000</li>
                            </ul>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <a href="#" class="mobile-jobs-a">
                        <div class="mobile-job-list">
                          <div class="mobile-job-head">
                            <h4>Customer Service Assistant</h4>
                          </div>
                          <div class="mobile-job-desc">
                            <ul>
                              <li class="divisions">Operations</li>
                              <li class="job-type">Full Time</li>
                              <li class="payroll">$3,000</li>
                            </ul>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          

@stop