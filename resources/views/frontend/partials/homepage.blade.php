@extends('layout.frontend.master.master')
@section('title', 'Page Title')
@section('content')
      <section class="slider-home">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img src="{{ asset('assets/frontend/images/slider-image.png') }}" alt="...">
              <div class="carousel-caption">
                <div class="container">
                    <h5>FAMILY ENTERTAINMENT</h5>
                    <h2>TORUK – The First Flight</h2>
                    <div class="eventDate"><i class="fa fa-calendar"></i>17 June 2016</div>
                    <div class="eventPlace"><i class="fa fa-map-marker"></i>Singapore Indoor Stadium</div>
                    <div class="moreDetail">
                        <button class="btn btnDetail">More Details</button>
                    </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="{{ asset('assets/frontend/images/slider-image.png') }}" alt="...">
              <div class="carousel-caption">
                <div class="container">
                    <h5>FAMILY ENTERTAINMENT</h5>
                    <h2>TORUK – The First Flight</h2>
                    <div class="eventDate"><i class="fa fa-calendar"></i>17 June 2016</div>
                    <div class="eventPlace"><i class="fa fa-map-marker"></i>Singapore Indoor Stadium</div>
                    <div class="moreDetail">
                        <button class="btn btnDetail">More Details</button>
                    </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="{{ asset('assets/frontend/images/slider-image.png') }}" alt="...">
              <div class="carousel-caption">
                <div class="container">
                    <h5>FAMILY ENTERTAINMENT</h5>
                    <h2>TORUK – The First Flight</h2>
                    <div class="eventDate"><i class="fa fa-calendar"></i>17 June 2016</div>
                    <div class="eventPlace"><i class="fa fa-map-marker"></i>Singapore Indoor Stadium</div>
                    <div class="moreDetail">
                        <button class="btn btnDetail">More Details</button>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
    </section>
    <section class="newRelease">
        <div class="container">
            <h2>New Release</h2>
            <div class="row">
                <a href="{{URL::route('event')}}">
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
                </a>
                <a href="{{URL::route('event-seated')}}">
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
                </a>
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
                <button class="btn btnLoad">Discover More Events</button>
            </div>
        </div>
    </section>
    <section class="latestPromo">
        <div class="container">
            <h2>Latest Promotions</h2>
            <div class="row">
                <div class="col-md-4 box-promo">
                    <img src="{{ asset('assets/frontend/images/mj-poster.png') }}" class="image-promo">
                    <div class="boxInfo promo1">
                        <ul>
                            <li class="eventType">EARLY BIRD</li>
                            <li class="eventName">Pre-sale for StarHub Customers <img src="{{ asset('assets/frontend/images/starhub-logo.png') }}"></li>
                            <li class="eventPlace">Valid From 1 - 10 June 2016</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 box-promo">
                    <img src="{{ asset('assets/frontend/images/dining-poster.png') }}" class="image-promo">
                    <div class="boxInfo promo1">
                        <ul>
                            <li class="eventType">DISCOUNTS</li>
                            <li class="eventName">Enjoy 5% off Dining Before Event <img src="{{ asset('assets/frontend/images/esplanade-logo.png') }}"></li>
                            <li class="eventPlace">Valid From May - October 2016</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 box-promo">
                    <img src="{{ asset('assets/frontend/images/blue-poster.png') }}" class="image-promo">
                    <div class="boxInfo promo1">
                        <ul>
                            <li class="eventType">DISCOUNTS</li>
                            <li class="eventName">Enjoy 10% off with MasterCard <img src="{{ asset('assets/frontend/images/master-logo.png') }}"></li>
                            <li class="eventPlace">Valid From 27 May - 20 August 2016</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="loadMore">
                <button class="btn btnLoad">More Promotions</button>
            </div>
        </div>
    </section>
@stop