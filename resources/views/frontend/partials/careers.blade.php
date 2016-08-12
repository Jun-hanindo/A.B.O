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

@stop