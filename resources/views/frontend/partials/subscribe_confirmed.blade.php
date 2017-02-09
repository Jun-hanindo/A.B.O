<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ 'Subscription Confirmed - '.env('APP_NAME') }}</title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,800,700,900' rel='stylesheet' type='text/css'>
        <style type="text/css">
            body{
                margin:0;
                padding:75px 0 0 0;
                text-align:center;
                -webkit-text-size-adjust:none;
            } 
            .wrapper{
                width: 600px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <a href="{{URL::route('home')}}"><img src="{{ asset('assets/frontend/images/ABO-logo.svg') }}" class="logo"></a>
            <h3>Subscription Confirmed</h3>
            <table border="0" cellpadding="20" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#eeeeee">
                <tr>
                    <td></td>
                </tr>
            </table>
        </div>
    </body>
</html>