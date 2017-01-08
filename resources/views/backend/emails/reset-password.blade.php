<!DOCTYPE html>
<!-- todo: Add more css to this template... -->
<html style="font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:;" >
    <head>
        <title>Reset Password</title>
    </head>
    <body>
        <h3>Hi {{ $name }},</h3>

        <p>We got request to reset your AsiaBoxOffice Web Admin password.</p>
        <p align="center">{!! link_to_action('Auth\AuthController@getChangePassword', 'Reset Password', ['id' => $id, 'code' => $code]) !!}</p>
        <p>If you ignore this message, your password won't be changed.</p>
    </body>
</html>