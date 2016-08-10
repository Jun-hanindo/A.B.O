<!DOCTYPE html>
<html>
    <head>
        {!! Html::meta(null, null, ['charset' => 'UTF-8']) !!}
        {!! Html::meta('robots', 'noindex, nofollow') !!}
        {!! Html::meta('product', env('APP_WEB_ADMIN_NAME', 'Asia Box Office web Admin')) !!}
        {!! Html::meta('description', env('APP_WEB_ADMIN_NAME', 'Asia Box Office Web Admin')) !!}
        {!! Html::meta('author', 'Asia Box Office') !!}
        {!! Html::meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') !!}

        <title>{{ env('APP_WEB_ADMIN_NAME', 'Asia Box Office Web Admin') }} - @yield('title')</title>

        {!! Html::style('assets/plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('assets/plugins/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('assets/plugins/select2/select2.css') !!}
        {!! Html::style('assets/plugins/select2/select2-bootstrap.css') !!}
        {!! Html::style('assets/plugins/HoldOn/HoldOn.min.css') !!}

        @yield('header')

        {!! Html::style('assets/backend/admin/css/AdminLTE.min.css') !!}
        {!! Html::style('assets/backend/admin/css/skins/skin-'.$skin.'.min.css') !!}
        {!! Html::style('assets/plugins/pace/pace.min.css') !!}
        {!! Html::style('assets/plugins/sweetalert/sweetalert.css') !!}
        {!! Html::style('assets/backend/admin/css/style.css') !!}
        {!! Html::style('assets/plugins/datepicker/datepicker3.css') !!}
        {!! Html::style('assets/plugins/bootstrap-switch/bootstrap-switch.min.css') !!}
        {!! Html::style('assets/plugins/submodal/bs.sm.min.css') !!}
        <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favico.ico') }}">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


        <!-- todo: Link shorcut icon will be here. -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="skin-{{ $skin }} sidebar-mini">

        <div class="wrapper">
            <header class="main-header">
                <a href="{{ route('admin-dashboard') }}" class="logo" title="{{ env('APP_WEB_ADMIN_NAME', 'Asia Box Office Web Admin') }}">
                    <span class="logo-mini"><b>{{ env('APP_NAME_INITIAL', 'A') }}</b></span>
                    <span class="logo-lg"><b>{{ env('APP_NAME', 'Asia Box Office') }}</b></span>
                </a>

                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#"  class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ link_to_avatar(user_info('avatar')) }}" alt="{{ user_info('full_name') }}" class="user-image">
                                    <span class="hidden-xs" title="{{ user_info('full_name') }}">{{ user_info('full_name') }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="{{ link_to_avatar(user_info('avatar')) }}" alt="{{ user_info('full_name') }}" class="img-circle">
                                        <p>
                                            {{ user_info('full_name') }}
                                            <small>{{ user_info('role')->name }}</small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{!! route('admin-profile') !!}" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{!! route('admin-logout') !!}" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign Out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ link_to_avatar(user_info('avatar')) }}" alt="{{ user_info('full_name') }}" class="img-circle">
                        </div>
                        <div class="pull-left info">
                            <p>{{ user_info('full_name') }}</p>
                            <a href="#" title="{{ user_info('full_name') }}"><!--<i class="fa fa-circle text-success"></i> Online --></a>
                        </div>
                    </div>
                    @include('layout.backend.admin.partial.side_menu')
                </section>
            </aside>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>@yield('page-header')</h1>

                    @yield('breadcrumb')
                </section>

                <section class="content">
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <strong>Copyright &copy; {{ date('Y') }} {{ env('APP_NAME', 'Asia Box Office') }}</strong>. All rights reserved.
            </footer>
        </div>

        {!! Html::script('assets/plugins/jQuery/jQuery-2.2.0.min.js') !!}
        {!! Html::script('assets/plugins/bootstrap/js/bootstrap.min.js') !!}
        {!! Html::script('assets/backend/admin/js/app.min.js') !!}
        {!! Html::script('assets/plugins/select2/select2.min.js') !!}
        {!! Html::script('assets/plugins/HoldOn/HoldOn.min.js') !!}
        {!! Html::script('assets/plugins/pace/pace.min.js') !!}
        {!! Html::script('assets/plugins/sweetalert/sweetalert.min.js') !!}
        {!! Html::script('assets/backend/admin/js/custom.js') !!}
        {!! Html::script('assets/plugins/tinymce/tinymce.min.js') !!}
        {!! Html::script('assets/plugins/datepicker/bootstrap-datepicker.js') !!}
        {!! Html::script('assets/plugins/bootstrap-switch/bootstrap-switch.min.js') !!}
        {!! Html::script('assets/plugins/submodal/bs.sm.min.js') !!}

        <script>
            $(document).ajaxStart(function() {
                Pace.restart();
            });
        </script>

        @yield('scripts')
    </body>
</html>
