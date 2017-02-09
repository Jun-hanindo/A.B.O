<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ 'Please Confirm Subscriptipn - '.env('APP_NAME') }}</title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,800,700,900' rel='stylesheet' type='text/css'>
        <style type="text/css">
        </style>
    </head>
    <body>
        <table border="0" cellpadding="20" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#eeeeee">
            <tr>
                <td><a href="{{ URL::route('subscribe-confirm', 'token='.$token)}}" target="_blank">Yes, subscribe me to the list</a></td>
            </tr>
        </table>
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
            </header>
        </div>
    </body>
</html>