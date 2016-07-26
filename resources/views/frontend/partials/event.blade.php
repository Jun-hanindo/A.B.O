@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
      <section class="eventBanner">
        <div class="imageBanner">
            <img src="{{ asset('assets/frontend/images/banner-bg.png') }}">
        </div>
        <div class="infoBanner">
            <div class="container">
                <div class="detail">
                    <h5>FOOD / BEVERAGE</h5>
                    <h2>SAVOUR Gourmet 2016</h2>
                </div>
                <div class="moreDetail">
                    <button class="btn btnDetail">Buy Now</button>
                </div>
            </div>
        </div>
    </section>
    <section class="eventInfo">
      <div class="container">
          <div class="row">
              <div class="col-md-4">
                  <div class="information-title">
                      <i class="fa fa-calendar"></i> 12 - 15 May 2016
                  </div>
                  <ul class="list-unstyled">
                      <li class="liParent">
                          <table>
                              <tr>
                                  <td>12 May, Thu</td>
                                  <td>Dinner</td>
                                  <td>6.00PM - 11.00PM</td>
                              </tr>
                          </table>
                      </li>
                      <li class="liParent">
                          <table>
                              <tr>
                                  <td>13 May, Fri</td>
                                  <td>Dinner</td>
                                  <td>6.00PM - 11.00PM</td>
                              </tr>
                          </table>
                      </li>
                      <li class="liParent">
                          <table>
                              <tr>
                                  <td>14 May, Sat</td>
                                  <td>Dinner</td>
                                  <td>6.00PM - 11.00PM</td>
                              </tr>
                          </table>
                      </li>
                      <li class="liParent">
                          <table>
                              <tr>
                                  <td>15 May, Sun</td>
                                  <td>Full-Day</td>
                                  <td>6.00PM - 11.00PM</td>
                              </tr>
                          </table>
                      </li>
                  </ul>
              </div>
              <div class="col-md-4 place">
                  <div class="information-title">
                      <i class="fa fa-map-marker"></i> Bayfront Avenue
                  </div>
                  <ul class="list-unstyled">
                      <li>12 Bayfront Avenue</li>
                      <li>Singapore 018956</li>
                      <li>(Next to Sands Expo and Convention Centre)</li>
                      <li><button class="btn btnSeemap">See Map</button></li>
                  </ul>
              </div>
              <div class="col-md-4 ticket">
                  <div class="information-title">
                      <i class="fa fa-ticket"></i> $30 / Person
                  </div>
                  <ul class="list-unstyled">
                      <li>Inclusive Of:</li>
                      <li>Food voucher value $30</li>
                      <li>Limited edition gift bag</li>
                      <li>Full version event programme</li>
                  </ul>
              </div>
          </div>
      </div>
  </section>
  <section class="newRelease">
    <div class="container">
        <div class="row">
            <div class="col-md-4 box-release">
                <img src="{{ asset('assets/frontend/images/mj-poster.png') }}">
                <div class="boxInfo info1">
                    <ul>
                        <li class="eventType">CONCERTS</li>
                        <li class="eventName">Michael Jackson ONE</li>
                        <li class="eventDate"><i class="fa fa-calendar-o"></i> 17 June 2016</li>
                        <li class="eventPlace">Singapore Indoor Stadium</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 box-release">
                <img src="{{ asset('assets/frontend/images/savour-poster.png') }}">
                <div class="boxInfo info2">
                    <ul>
                        <li class="eventType">FOOD / BEVERAGE</li>
                        <li class="eventName">SAVOUR Gourmet 2016</li>
                        <li class="eventDate"><i class="fa fa-calendar-o"></i> 12 - 15 May 2016</li>
                        <li class="eventPlace">Bayfront Avenue</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 box-release">
                <img src="{{ asset('assets/frontend/images/madona-poster.png') }}">
                <div class="boxInfo info3">
                    <ul>
                        <li class="eventType">CONCERTS</li>
                        <li class="eventName">Madonna Rebel Heart Tour</li>
                        <li class="eventDate"><i class="fa fa-calendar-o"></i> 28 Feb 2016</li>
                        <li class="eventPlace">National Stadium</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 box-release">
                <img src="{{ asset('assets/frontend/images/mj-poster.png') }}">
                <div class="boxInfo info1">
                    <ul>
                        <li class="eventType">CONCERTS</li>
                        <li class="eventName">Michael Jackson ONE</li>
                        <li class="eventDate"><i class="fa fa-calendar-o"></i> 17 June 2016</li>
                        <li class="eventPlace">Singapore Indoor Stadium</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 box-release">
                <img src="{{ asset('assets/frontend/images/savour-poster.png') }}">
                <div class="boxInfo info2">
                    <ul>
                        <li class="eventType">FOOD / BEVERAGE</li>
                        <li class="eventName">SAVOUR Gourmet 2016</li>
                        <li class="eventDate"><i class="fa fa-calendar-o"></i> 12 - 15 May 2016</li>
                        <li class="eventPlace">Bayfront Avenue</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 box-release">
                <img src="{{ asset('assets/frontend/images/madona-poster.png') }}">
                <div class="boxInfo info3">
                    <ul>
                        <li class="eventType">CONCERTS</li>
                        <li class="eventName">Madonna Rebel Heart Tour</li>
                        <li class="eventDate"><i class="fa fa-calendar-o"></i> 28 Feb 2016</li>
                        <li class="eventPlace">National Stadium</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 box-release">
                <img src="{{ asset('assets/frontend/images/mj-poster.png') }}">
                <div class="boxInfo info1">
                    <ul>
                        <li class="eventType">CONCERTS</li>
                        <li class="eventName">Michael Jackson ONE</li>
                        <li class="eventDate"><i class="fa fa-calendar-o"></i> 17 June 2016</li>
                        <li class="eventPlace">Singapore Indoor Stadium</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 box-release">
                <img src="{{ asset('assets/frontend/images/savour-poster.png') }}">
                <div class="boxInfo info2">
                    <ul>
                        <li class="eventType">FOOD / BEVERAGE</li>
                        <li class="eventName">SAVOUR Gourmet 2016</li>
                        <li class="eventDate"><i class="fa fa-calendar-o"></i> 12 - 15 May 2016</li>
                        <li class="eventPlace">Bayfront Avenue</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 box-release">
                <img src="{{ asset('assets/frontend/images/madona-poster.png') }}">
                <div class="boxInfo info3">
                    <ul>
                        <li class="eventType">CONCERTS</li>
                        <li class="eventName">Madonna Rebel Heart Tour</li>
                        <li class="eventDate"><i class="fa fa-calendar-o"></i> 28 Feb 2016</li>
                        <li class="eventPlace">National Stadium</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="loadMore">
            <button class="btn btnLoad">Load More Events</button>
        </div>
    </div>
</section>
@stop