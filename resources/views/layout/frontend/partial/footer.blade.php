<div class="bottom-content">
    <div class="bottom-centercontent text-center">
        <h2>iLive is the best way to discover talented broadcasters</h2>
        <p>Watch live streams and video chat live with people from around the world.</p>
        @if(empty($user_login))
        <a class="btn-red btn waves-effect waves-light hvr-shutter-out-horizontal" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">{!! Html::image('assets/frontend/img/icon-video.png','icon-video',array('title'=>'icon-video')) !!} GO LIVE NOW!</a>
        @endif
        <ul class="clearfix download-app">
            <li><p>Download iLive's Apps to watch and chat free on iOS and Android.</p></li>
            <li><a href="">{!! Html::image('assets/frontend/img/icon-appstore.png','icon-appstore',array('title'=>'icon-appstore')) !!}</a></li>
            <li><a href="">{!! Html::image('assets/frontend/img/icon-playstore.png','icon-playstore',array('title'=>'icon-playstore')) !!}</a></li>
        </ul>
    </div>
</div>

<footer>
    <div class="container">
        <div class="clearfix row">
            <div class="col-md-12 clearfix">
                <div class="pull-left copyright">&copy; 2015 iLive.com</div>
                <div class="pull-right clearfix">
                    <ul class="footer-menu">
                        <li><a href="">About iLive</a></li>
                        <li><a href="">Advice</a></li>
                        <li><a href="">Terms &amp; Conditions</a></li>
                        <li><a href="">Contact Us</a></li>
                    </ul>
                    <ul class="socmed-menu">
                        <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>