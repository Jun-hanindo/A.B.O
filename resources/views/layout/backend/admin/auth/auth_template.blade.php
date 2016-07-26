<!DOCTYPE html>
<html>
    <head>
        {!! Html::meta(null, null, ['charset' => 'UTF-8']) !!}
        {!! Html::meta('robots', 'noindex, nofollow') !!}
        {!! Html::meta('product', env('APP_WEB_ADMIN_NAME', 'The Clip web Admin')) !!}
        {!! Html::meta('description', env('APP_WEB_ADMIN_NAME', 'The Clip Web Admin')) !!}
        {!! Html::meta('author', 'The Clip') !!}
        {!! Html::meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') !!}

        <title>{{ env('APP_WEB_ADMIN_NAME', 'AHLOO Web Admin') }} - Sign In</title>

        {!! Html::style('assets/plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('assets/plugins/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('assets/backend/admin/css/AdminLTE.min.css') !!}
        {!! Html::style('assets/plugins/iCheck/square/blue.css') !!}
        <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favico.ico') }}">

        <!-- todo: Link shorcut icon will be here. -->
    </head>
    <!-- todo: Add dynamic skin... -->
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ route('admin-dashboard') }}"><b>{{ env('APP_WEB_ADMIN_NAME', 'AHLOO Web Admin') }}</b></a>
            </div>

            <div class="login-box-body">
                @yield('content')
            </div>
        </div>

        {!! Html::script('assets/plugins/jQuery/jQuery-2.2.0.min.js') !!}
        {!! Html::script('assets/plugins/bootstrap/js/bootstrap.min.js') !!}
        {!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

        <script>
            $(document).ready(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue'
                });
            });
        </script>
    </body>
</html>
