@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
  <section class="about-content">
      <div class="row">
          <div class="col-md-3">
              <div class="sidebar">
                  <ul>
                      <li class="sidebar-head">
                          <h4>Filters</h4>
                      </li>
                      <li class="sidebar-menu-top sidebar-search">
                          <a data-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Categories</a>
                          <div class="collapse" id="categories">
                            <div class="collapse-search">
                              <ul>
                                <li><a href="#">Categories 1</a></li>
                                <li><a href="#">Categories 2</a></li>
                              </ul>
                            </div>
                          </div>
                      </li>
                      <li class="sidebar-menu sidebar-search">
                          <a data-toggle="collapse" href="#languages" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Languages</a>
                          <div class="collapse" id="languages">
                            <div class="collapse-search">
                              <ul>
                                <li><a href="#">Language 1</a></li>
                                <li><a href="#">Language 2</a></li>
                              </ul>
                            </div>
                          </div>
                      </li>
                      <li class="sidebar-menu sidebar-search">
                          <a data-toggle="collapse" href="#time" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Time Period</a>
                          <div class="collapse" id="time">
                            <div class="collapse-search">
                              <ul>
                                <li><a href="#">Time 1</a></li>
                                <li><a href="#">Time 2</a></li>
                              </ul>
                            </div>
                          </div>
                      </li>
                      <li class="sidebar-menu sidebar-search">
                          <a data-toggle="collapse" href="#venue" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter">Venues</a>
                          <div class="collapse" id="venue">
                            <div class="collapse-search">
                              <ul>
                                <li><a href="#">Venue 1</a></li>
                                <li><a href="#">Venue 2</a></li>
                              </ul>
                            </div>
                          </div>
                      </li>
                  </ul>
              </div>
          </div>
          <div class="col-md-9">
              <div class="main-content">
                  <div class="career-desc">
                      <div class="row">
                          <div class="job-head search-head">
                            <h4 class="head-about">Search resulst for <span>"concerts"</span></h4>
                            <select class="form-control">
                              <option>Sort By Date</option>
                              <option>Sort By Price</option>
                              <option>Sort By Popularity</option>
                            </select>
                          </div>
                          <div class="search-list search-list-head">
                            <table>
                              <tr class="bg-purple tr-search">
                                <td class="searchpic"><img src="{{ asset('assets/frontend/images/searchpic1.png') }}"></td>
                                <td class="jobs">Michael Jackson ONE</td>
                                <td class="date">17 June 2016</td>
                                <td class="place">Singapore Indoor Stadium</td>
                                <td class="type">Concerts</td>
                              </tr>
                              <tr class="bg-grey tr-search">
                                <td class="searchpic"><img src="{{ asset('assets/frontend/images/searchpic2.png') }}"></td>
                                <td class="jobs">Weezer Live in Singapore</td>
                                <td class="date">17 June 2016</td>
                                <td class="place">Singapore Indoor Stadium</td>
                                <td class="type">Concerts</td>
                              </tr>
                              <tr class="bg-purple2 tr-search">
                                <td class="searchpic"><img src="{{ asset('assets/frontend/images/searchpic3.png') }}"></td>
                                <td class="jobs">An Evening with Tom Jones</td>
                                <td class="date">17 June 2016</td>
                                <td class="place">Singapore Indoor Stadium</td>
                                <td class="type">Concerts</td>
                              </tr>
                              <tr class="bg-red tr-search">
                                <td class="searchpic"><img src="{{ asset('assets/frontend/images/searchpic4.png') }}"></td>
                                <td class="jobs">Madonna Rebel Heart Tour</td>
                                <td class="date">17 June 2016</td>
                                <td class="place">Singapore Indoor Stadium</td>
                                <td class="type">Concerts</td>
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