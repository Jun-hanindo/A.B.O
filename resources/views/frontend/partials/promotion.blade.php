@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
      <section class="discoverCategory">
          <div class="container">
              <h2>Promotions</h2>
              <div class="tabCategory">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#new" aria-controls="home" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catNew.png') }}"><br>What's New</a></li>
                    <li role="presentation"><a href="#discount" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-tag"></i><br>Discounts</a></li>
                    <li role="presentation"><a href="#lucky" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-gift"></i><br>Lucky Draws</a></li>
                    <li role="presentation"><a href="#early" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-ticket"></i><br>Early Bird</a></li>
                  </ul>
              </div>
          </div>
      </section>
    <section class="promotionList">
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