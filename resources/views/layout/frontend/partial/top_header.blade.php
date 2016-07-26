<header class="home-header">
    <div class="content-header">
        <div class="container">
            <div class="header-top row">
                @if(!empty($user_login))
                    <div class="col-md-2 text-left">
                        <h1><a href="{{ route('/') }}">{!! Html::image('assets/frontend/img/logo.png','logo the clip',array('title'=>'Home Ilive')) !!}</a></h1>
                    </div>
                    <div class="col-md-5">
                      <form>
                        <ul class="center-search clearfix">
                          <li>
                            <div class="box-search">
                              <input type="text" placeholder="Search iLive...">
                            </div>
                          </li>
                          <li>
                            <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">All categories
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">JavaScript</a></li>
                              </ul>
                            </div>
                          </li>
                          <li>
                            <button type="submit"><i class="fa fa-search"></i></button>
                          </li>
                        </ul>
                      </form>
                    </div>

                    <div class="col-md-1 text-right">
                      <a class="btn-red top-header in-btn btn waves-effect waves-light hvr-shutter-out-horizontal">{!! Html::image('assets/frontend/img/icon-video.png','logo the clip',array('title'=>'Go Ilive')) !!} GO LIVE NOW!</a>
                    </div>            
                    <div class="col-md-2 text-right" style="display:none">
                      <a class="btn-black-outline top-header btn waves-effect waves-light hvr-shutter-out-horizontal">{!! Html::image('assets/frontend/img/icon-report.png','logo the clip',array('title'=>'Report User')) !!} REPORT USER</a>
                    </div>            
                    <div class="col-md-2 text-right">
                      <a class="btn-outline top-header btn bell waves-effect waves-light hvr-shutter-out-horizontal">{!! Html::image('assets/frontend/img/icon-bell.png','logo the clip',array('title'=>'Notification')) !!}</a>
                    </div>            
                    <div class="col-md-1 text-right navbar-nav">
                        <div class="dropdown  user-menu">
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                @if(!empty($user_login->avatar))
                                  <div class="img-warp">{!! Html::image('uploads/users/'.$user_login->id.'/profile/'.$user_login->avatar,'',array('title'=>'Profile')) !!}</div>
                                @elseif(!empty($user_login->avatar_social_media))
                                  <div class="img-warp"><img src="{{ $user_login->avatar_social_media }}" title="{{$user_login->username}}" onerror="this.onerror=null;this.src='{{env('APP_URL').'/assets/frontend/img/default_user.png'}}'"></div>
                                @else
                                  <div class="img-warp">{!! Html::image('assets/frontend/img/default_user.png','',array('title'=>'Profile')) !!}</div>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    @if(!empty($user_login->avatar))
                                      {!! Html::image('uploads/users/'.$user_login->id.'/profile/'.$user_login->avatar,'',array('title'=>'Profile','class'=>'img-circle')) !!}
                                    @elseif(!empty($user_login->avatar_social_media))
                                      <img src="{{ $user_login->avatar_social_media }}" title="{{$user_login->username}}" class="img-circle" onerror="this.onerror=null;this.src='{{env('APP_URL').'/assets/frontend/img/default_user.png'}}'">
                                    @else
                                      {!! Html::image('assets/frontend/img/default_user.png','',array('title'=>'Profile','class'=>'img-circle')) !!}
                                    @endif
                                    <p>
                                        {{ $user_login->username }}
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('/',$user_login->username) }}" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign Out</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else

                    <div class="col-md-3 text-left">
                        <h1><a >{!! Html::image('assets/frontend/img/logo.png','logo the clip',array('title'=>'Ilive')) !!}</a></h1>
                    </div>
                    <div class="col-md-6">
                        <form>
                            <ul class="center-search clearfix">
                                <li>
                                    <div class="box-search">
                                        <input type="text" placeholder="Search iLive...">
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">All categories
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">HTML</a></li>
                                            <li><a href="#">CSS</a></li>
                                            <li><a href="#">JavaScript</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="col-md-3 text-right">
                        <ul class="right-socmed">
                            <li><span>Sign In with:</span></li>
                            <li><a href="javascript:void(0)" onclick="loginFB()"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ route('redirect-socialmedia','twitter') }}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript:void(0)" id="google_login_2"><!-- <i class="" id="google_login_2"></i> --></a></li>
                        </ul>
                    </div>

                @endif
                
            </div>
        </div>
    </div>

    <div class="content-headerbottom">
        <h2>iLive Stream Video Chat</h2>
        <p>iLive is the best way to discover talented broadcasters, watch live streams and video chat<br/>live with people from around the world.</p>
        @if(empty($user_login))
            <a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();" class="btn-red btn waves-effect waves-light hvr-shutter-out-horizontal">{!! Html::image('assets/frontend/img/icon-video.png','logo the clip',array('title'=>'logo the clip')) !!} GO LIVE NOW!</a>
        @endif
    </div>
</header>