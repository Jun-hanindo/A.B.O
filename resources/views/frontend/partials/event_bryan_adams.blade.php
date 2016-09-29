<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asia Box Office - Event GA</title>

          <!-- Bootstrap -->
        {!! Html::style('assets/frontend/css/bootstrap.min.css') !!}
        {!! Html::style('assets/frontend/font-awesome-4.6.3/css/font-awesome.css') !!}
        {!! Html::style('assets/frontend/css/style.css') !!}
        {!! Html::style('assets/frontend/css/custom.css') !!}
        {!! Html::style('assets/frontend/css/color.css') !!}
        {!! Html::style('assets/frontend/css/responsive.css') !!}

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,800,700,900' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favico.ico') }}">
        {!! Html::script('assets/frontend/js/modernizr.js') !!}
    </head>
    <body>
        <div class="page-wrapper">
            <header>
                <div id="top-header">
                    <div class="container">
                        <div class="pull-left left-header">
                            <nav class="main-menu" role="navigation">
                                <ul class="nav-menu">
                                    <li class="nav-item">
                                        <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/ABO-logo.svg') }}" class="logo"></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div id="mobile-header">
                    <div class="mobile-header">
                        <div class="container">
                            <div class="mobile-header-show">
                                <div class="row">
                                    <div class="col-xs-3">
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="mobile-logo">
                                            <img src="{{ asset('assets/frontend/images/footer-logo.svg') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
          
            <section class="eventBanner" id="eventBanner">
                <div class="imageBanner">
                    <img src="{{ asset('assets/frontend/images/bryan-adams-fullweb.jpg') }}" class="hidden-xs">
                    <img src="{{ asset('assets/frontend/images/bryan-adams-mobile.jpg') }}" class="hidden-lg hidden-md hidden-sm" alt="...">
                </div>
                <div class="infoBanner bg-red" id="eventTabShow">
                        <div class="container">
                                <div class="detail">
                                        <h5>CONCERTS</h5>
                                        <h2 class="font-light">Bryan Adams “Get Up Tour”</h2>
                                </div>
                                <div class="moreDetail">
                                        <a href="https://asiaboxoffice.nliven.co/tickets/series/BRYANADAMSGETUP/" target="_blank">
                                            <button class="btn btnDetail font-bold">Buy Now</button>
                                        </a>
                                </div>
                        </div>
                </div>
            </section>
            <div class="eventTabScroll bg-red">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <ul class="" role="">
                                <li><a href="#eventBanner" class="smoothScroll backtop">Back To Summary</a></li>
                                <li><a href="#ticket" class="smoothScroll active">About This Event</a></li>
                                <li><a href="#aboutBox" class="smoothScroll">Venue Info</a></li>
                                <li><a href="#getvenue" class="smoothScroll">Admission Rules</a></li>
                                <li><a href="https://asiaboxoffice.nliven.co/tickets/series/BRYANADAMSGETUP/" target="_blank"><button class="btn btnBuy btnABO font-bold">Buy Now</button></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="eventTabScroll-mobile bg-red">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                    <li><a href="#eventBanner" class="smoothScroll backtop"></a></li>
                                    <li><a href="#ticket" class="smoothScroll active">About</a></li>
                                    <li><a href="#aboutBox" class="smoothScroll">Venue</a></li>
                                    <li><a href="#getvenue" class="smoothScroll">Admission</a></li>
                                    <li><a href="https://asiaboxoffice.nliven.co/tickets/series/BRYANADAMSGETUP/"><button class="btn btnBuy btnABO font-bold">Buy</button></a></li>
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
            <section class="eventInfo">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 date">
                            <div class="information-title">
                                <i class="fa fa-calendar-o"></i> 20 January 2017
                            </div>
                            <div class="information-event">
                                <p>Friday, 8.00PM</p>
                                <ul>
                                    <li>Duration: Approx. 2 Hours</li>
                                    <li>Doors Open Time: 6.30PM</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 place">
                            <div class="information-title">
                                <i class="fa fa-map-marker"></i> Suntec Convention Centre Hall 601
                            </div>
                            <ul class="list-unstyled">
                                <li>1 Raffles Boulevard</li>
                                <li>Suntec City</li>
                                <li>Singapore 039593</li><br>
                                <li><a href="https://www.google.com.sg/maps/place/Suntec+Singapore+Convention+%26+Exhibition+Centre/@1.2936604,103.8550043,17z/data=!3m1!4b1!4m5!3m4!1s0x31da19af38dd2bf3:0xd63e8cb2dacf54c7!8m2!3d1.2936604!4d103.857193" class="btn btnSeemap font-bold" target="_blank">See Map</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 ticket" id="ticket">
                            <div class="information-title">
                                <i class="fa fa-ticket"></i> S$71-231/person
                            </div>
                            <ul class="list-unstyled">
                                <li class="liParent li-mobile">
                                    <table>
                                        <tr>
                                            <td>Category 1</td>
                                            <td><span>S$231</span></td>
                                        </tr>
                                    </table>
                                </li>
                                <li class="liParent li-mobile">
                                    <table>
                                        <tr>
                                            <td>Category 2</td>
                                            <td><span>S$191</span></td>
                                        </tr>
                                    </table>
                                </li>
                                <li class="liParent li-mobile">
                                    <table>
                                        <tr>
                                            <td>Category 3</td>
                                            <td><span>S$161</span></td>
                                        </tr>
                                    </table>
                                </li>
                                <li class="liParent li-mobile">
                                    <table>
                                        <tr>
                                            <td>Category 4</td>
                                            <td><span>S$141</span></td>
                                        </tr>
                                    </table>
                                </li>
                                <li class="liParent li-mobile">
                                    <table>
                                        <tr>
                                            <td>Category 5</td>
                                            <td><span>S$101</span></td>
                                        </tr>
                                    </table>
                                </li>
                                <li class="liParent parentLast li-mobile">
                                    <table>
                                        <tr>
                                            <td>Category 6*</td>
                                            <td><span>S$71</span></td>
                                        </tr>
                                    </table>
                                </li>
                                <p class="additional-info">* Restricted view</p>
                                <li class="liParent parentButton">
                                    <button class="btn btnBlackDefault font-bold" data-target="#modalSeatMap" data-toggle="modal">See Seat Map</button>
                                    <!-- <button class="btn btnticket bg-white font-bold">More Ticket Info</button> -->
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12 tabEvent">
                            <div class="eventTab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li><a href="#eventTabShow" class="smoothScroll active">About This Event</a></li>
                                    <li><a href="#aboutBox" class="smoothScroll">Venue Info</a></li>
                                    <li><a href="#getvenue" class="smoothScroll">Admission Rules</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="eventTab-mobile">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li><a href="#ticket" class="smoothScroll active">About</a></li>
                                <li><a href="#aboutBox" class="smoothScroll">Venue</a></li>
                                <li><a href="#getvenue" class="smoothScroll">Admission</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="contentTab">
                    <div class="container">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="aboutEvent">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="aboutBox boxBorder" id="aboutBox">
                                                <div class="row">
                                                    <div class="side-left side-first col-md-3">
                                                        <div class="aboutDesc">
                                                            <h4>About This Event</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="main-content">
                                                            <div class="">
                                                                <section id="about" class="sectionEvent">
                                                                    <h3 class="font-bold">Bryan Adams “Get Up Tour”</h3>
                                                                    <p>Selling over 100 million records and singles worldwide and armed with numerous awards and nominations under his belt, the rock prodigy is ready to bring his Get Up Tour to Singapore. Besides his repertoire of famous hits, the concert will also feature tunes from his thirteenth studio album Get Up, made up of up-tempo tracks such as Brand New Day, You Belong To Me and Thunderbolt, to the gentler songs such as Don’t Even Try and We Did It All.</p>
                                                                    <p>With his unique ability to fuse rock anthems and power ballads, audience can expect a pure night of entertainment and a good time.</p>
                                                                    <p>This one night only performance marks his return to Singapore in 23 years, this is a show you definitely do not want to miss. Get your tickets today!</p>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="venueBox boxBorder" id="venueBox">
                                                <div class="row">
                                                    <div class="side-left col-md-3">
                                                        <div class="aboutDesc">
                                                            <h4>Venue Info</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="main-content">
                                                            <div class="">
                                                                <section id="venue" class="sectionEvent">
                                                                    <h3 class="font-bold">Suntec Convention Centre Hall 601</h3>
                                                                    <p>1 Raffles Boulevard <br>Suntec City <br>Singapore 039593</p>

                                                                    <div class="mapEvent">
                                                                        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:200px;width:100%;'><div id='gmap_canvas' style='height:200px;width:100%;'></div><div><small><a href="http://www.embedgooglemaps.com/en/">Generate your map here, quick and easy!                  Give your customers directions                  Get found</a></small></div><div><small><a href="https://top10geeks.com/top-10-best-basketball-shoes-2016/">Top 10 basketball shoes</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {zoom:13,center:new google.maps.LatLng(1.292937,103.85700199999997),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(1.292937,103.85700199999997)});infowindow = new google.maps.InfoWindow({content:'<strong>Suntec Convention Centre Hall 601</strong><br>1 Raffles Boulevard, Suntec City, Singapore 039593<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                                                                    </div>

                                                                    <h3 class="font-bold">Getting to the Venue</h3>
                                                                    <ul id="getvenue">
                                                                        <li class="mrt">
                                                                            <h3 class="font-bold">By MRT</h3>
                                                                            <p>Take the Circle Line to Esplanade MRT Station and take Exit A.</p>
                                                                        </li>
                                                                        <li class="taxi">
                                                                            <h3 class="font-bold">By Taxi / UBER Drop Off</h3>
                                                                            <p>If you are taking a taxi, you may alight directly at the venue.</p>
                                                                        </li>
                                                                        <li class="car">
                                                                            <h3 class="font-bold">By Car</h3>
                                                                            <p>Parking is available at the venue. There are 4 access routes to Suntec City:</p>
                                                                            <ul class="car-route">
                                                                                <li>Nicoll Highway</li>
                                                                                <li>Raffles Boulevard (from Bras Basah Road)</li>
                                                                                <li>Temasek Avenue (from Raffles Boulevard)</li>
                                                                                <li>Rochor Road Exit from East Coast Expressway (ECP)</li>
                                                                            </ul>
                                                                            <p>Suntec Convention Centre is located in the West Wing, the closest parking location will be in the Green Zone.</p>
                                                                        </li>
                                                                    </ul>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="admissionBox" id="admissionBox">
                                                <div class="row">
                                                    <div class="side-left col-md-3">
                                                        <div class="aboutDesc">
                                                            <h4>Admission Rules</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="main-content">
                                                            <div class="">
                                                                <section id="rules" class="sectionEvent">
                                                                    <h3 class="font-bold">Rating / Age Limit</h3>
                                                                    <ul>
                                                                        <li>No admission for infant and children aged below 10 years old.</li>
                                                                        <li>Children aged 10 years and above must purchase a ticket for admission.</li>
                                                                        <li>All children below 12 years of age must be accompanied by a parent or guardian.</li>
                                                                    </ul>
                                                                    <h3 class="font-bold">Photography / Video Recording Rules</h3>
                                                                    <ul>
                                                                        <li>Photography, Video Recording and Audio Recording is strictly prohibited during the performance.</li>
                                                                        <li>All DSLR / Cameras with interchangeable lens is strictly prohibited inside the venue.</li>
                                                                    </ul>
                                                                    <p>All information is accurate at the time of publishing.</p>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer>
                <div id="footer3">
                    <div class="container">
                        <div class="row footer-bottom">
                            <div class="col-md-12 foot-bottom">
                                <div class="col-md-2 logo-footer">
                                    <img src="{{ asset('assets/frontend/images/footer-logo.svg') }}">
                                </div>
                                <div class="col-md-10">
                                    <p>Asia Box Office serves to provide event-goers with an enjoyable one-stop platform in search of tickets to Live Entertainment ranging from Music, Theatre, Sports and other Event Genres.<br>
                                    <br>
                                    Copyright 2016. © Asia Box Office Pte Ltd. All rights reserved. All trademarks, pictures and brands are the property of their respective owners. Use of this Web site constitutes acceptance of the Asia Box Office’s Conditions of Access and Privacy Policy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <div class="modal fade" id="modalSeatMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Seat Map</h4>
                    </div>
                    <div class="modal-body">
                        <div class="seat-map-modal">
                            <div class="row">
                                <div class="col-md-7">
                                    <img src="{{ asset('assets/frontend/images/seat-map.jpg') }}">
                                </div>
                                <div class="col-md-5">
                                    <div class="seat-map-price">
                                        <ul>
                                            <li>
                                                <span class="seat-dot dot-pink"></span>
                                                <span class="box-line">
                                                    <span class="category">Category 1</span>
                                                    <span class="price">S$231</span>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="seat-dot dot-blue"></span>
                                                <span class="box-line">
                                                    <span class="category">Category 2</span>
                                                    <span class="price">S$191</span>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="seat-dot dot-purple"></span>
                                                <span class="box-line">
                                                    <span class="category">Category 3</span>
                                                    <span class="price">S$161</span>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="seat-dot dot-green"></span>
                                             <span class="box-line">
                                                    <span class="category">Category 4</span>
                                                    <span class="price">S$141</span>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="seat-dot dot-green1"></span>
                                                <span class="box-line">
                                                    <span class="category">Category 5</span>
                                                    <span class="price">S$101</span>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="seat-dot dot-creme"></span>
                                                <span class="box-line">
                                                    <span class="category">Category 6 *</span>
                                                    <span class="price">S$71</span>
                                                </span>
                                            </li>
                                        </ul>
                                        <p>* Restricted view</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    {!! Html::script('assets/frontend/js/jquery-2.1.1.js') !!}
    {!! Html::script('assets/frontend/js/jquery.menu-aim.js') !!}
    {!! Html::script('assets/frontend/js/main.js') !!}
    {!! Html::script('assets/frontend/js/bootstrap.min.js') !!}
    {!! Html::script('assets/frontend/js/custom.js') !!}
    {!! Html::script('assets/frontend/js/smoothscroll.js') !!}
    {!! Html::script('assets/plugins/HoldOn/HoldOn.min.js') !!}
    {!! Html::script('assets/frontend/js/abo.js') !!}
    <script type="text/javascript">
        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 800) {
                $('.eventTabScroll').fadeIn();
            } else {
                $('.eventTabScroll').fadeOut();
            }
        });
        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 1200) {
                $('.eventTabScroll-mobile').fadeIn();
            } else {
                $('.eventTabScroll-mobile').fadeOut();
            }
        });
    </script>
</html>
