<!DOCTYPE html>
<html>
<head>
    <title>ABO Subscription</title>
    <style>
        @font-face {
            font-family: 'proxima_nova_rgregular';
            src: url('../assets/frontend/fonts/mark_simonson_-_proxima_nova_regular-webfont.woff2') format('woff2'),
                 url('../assets/frontend/fonts/mark_simonson_-_proxima_nova_regular-webfont.woff') format('woff');
            font-weight: normal;
            font-style: normal;

        }
    </style>
</head>

<body style="margin:0">
    <table width="100%">
        <thead>
            <tr>
                <th align="center" style="background: #000; padding: 15px">
                    <img src="{{ asset('assets/frontend/images/ABO-logo.svg') }}" width="100" class="logo">
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center" style="display:table-cell; vertical-align: bottom; height: 100px; width: 100%">
                    <p style="font-family:'proxima_nova_rgregular'; font-size: 16px; font-weight: 400;">Your Subscription to our list has been confirmed.</p>
                </td>
            </tr>
            <tr>
                <td align="center" style="display:table-cell; vertical-align: bottom; height: 30px; width: 100%">
                    <a href="{{URL::route('home')}}" style="background:#000; padding:12px 30px; border:none; color:#fff; text-decoration:none;border-radius:5px; font-family: 'proxima_nova_rgregular'; font-size: 13px">Continue to Our Website</a>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>