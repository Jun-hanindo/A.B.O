@extends('layout.frontend.master.master')
@section('title', 'Asia Box Office')
@section('content')
<section class="discoverCategory">
  <div class="container">
      <h2>Discover</h2>
      <div class="tabCategory">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#new" aria-controls="home" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catNew.png') }}"><br>What's New</a></li>
            <li role="presentation"><a href="#art" aria-controls="profile" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catArt.png') }}"><br>Arts / Culture</a></li>
            <li role="presentation"><a href="#comedy" aria-controls="messages" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catComedy.png') }}"><br>Comedy</a></li>
            <li role="presentation"><a href="#concert" aria-controls="settings" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catConcert.png') }}"><br>Concerts</a></li>
            <li role="presentation"><a href="#dance" aria-controls="home" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catDance.png') }}"><br>Dance</a></li>
            <li role="presentation"><a href="#family" aria-controls="profile" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catFamily.png') }}"><br>Family</a></li>
            <li role="presentation"><a href="#food" aria-controls="messages" role="tab" data-toggle="tab"><img src="{{ asset('assets/frontend/images/catFood.png') }}"><br>F & B</a></li>
            <li role="presentation"><a href="#mice" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-briefcase"></i><br>MICE</a></li>
            <li role="presentation"><a href="#music" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-music"></i><br>Musical</a></li>
            <li role="presentation"><a href="#sport" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-trophy"></i><br>Sports</a></li>
        </ul>
    </div>
</div>
</section>
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