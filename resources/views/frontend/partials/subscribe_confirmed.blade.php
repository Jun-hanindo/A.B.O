<!DOCTYPE html>
<html>
<head>
    <title>Subscription - AsiaBoxOffice</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favico.ico') }}">
    <style>
        @font-face {
            font-family: 'proxima_nova_rgregular';
            src: url('../assets/frontend/fonts/mark_simonson_-_proxima_nova_regular-webfont.woff2') format('woff2'),
                 url('../assets/frontend/fonts/mark_simonson_-_proxima_nova_regular-webfont.woff') format('woff');
            font-weight: normal;
            font-style: normal;

        }

        @font-face {
            font-family: 'proxima_nova_rgbold';
            src: url('../assets/frontend/fonts/mark_simonson_-_proxima_nova_bold-webfont.woff2') format('woff2'),
                 url('../assets/frontend/fonts/mark_simonson_-_proxima_nova_bold-webfont.woff') format('woff');
            font-weight: normal;
            font-style: normal;

        }  

        @font-face {
            font-family: 'proxima_nova_ltlight';
            src: url('../assets/frontend/fonts/mark_simonson_-_proxima_nova_light-webfont.woff2') format('woff2'),
                 url('../assets/frontend/fonts/mark_simonson_-_proxima_nova_light-webfont.woff') format('woff');
            font-weight: normal;
            font-style: normal;

        }

        @media (min-width: 991px) {
            .title-subscribe {
                font-size: 22px !important;
            }

        }
        @media (max-width: 1210px){
            .title-subscribe {
                font-size: 22px !important;
            }
            .header{
                height: 60px !important;
                padding: 0px !important;
            }
            .header img{
                height: 30px !important;
            }
        }
    </style>
</head>

<body style="margin:0">
    <table width="100%" style="border-spacing: 0">
        <thead>
            <tr>
                <th align="center" style="background: #000; padding: 15px; height: 50px;" class="header">
                    <img src="{{ asset('assets/frontend/images/ABO-logo.svg') }}" height="40">
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center" style="display:table-cell; vertical-align: bottom; height: 100px; width: 100%">
                    <p style="font-family:'proxima_nova_ltlight'; font-size: 26px; font-weight: 400;" class="title-subscribe">Your Subscription to our list has been confirmed.</p>
                </td>
            </tr>
            <tr>
                <td align="center" style="display:table-cell; vertical-align: bottom; height: 30px; width: 100%">
                    <a href="{{URL::route('home')}}" style="background:#000; padding:12px 30px; border:none; color:#fff; text-decoration:none;border-radius:5px; font-family: 'proxima_nova_rgbold'; font-size: 14px">Continue to Our Website</a>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>