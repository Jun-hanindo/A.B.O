<!DOCTYPE html>
<html>
<head>
    <title>ABO Email Subscription</title>
</head>
<body>
    <table width="100%">
        <tr>
            <td align="center" style="display:table-cell; vertical-align: middle; height: 100px; width: 100%">
                <img src="http://www.asiaboxoffice.com//assets/frontend/images/abo-logo-email.png" width="170">
            </td>
        </tr>
        <tr>
            <td align="center" style="display:table-cell; vertical-align: middle; height: 50px; width: 100%">
                <a href="{{ URL::route('subscribe-confirm', 'token='.$token)}}" style="background:#000; padding:12px 30px; border:none; color:#fff; text-decoration:none;border-radius:5px; font-family:arial, helvetica, open-sans; font-size: 14px; font-weight:bold;">Yes, subscribe me to this list!</a>
            </td>
        </tr>
        <tr>
            <td align="center" style="display:table-cell; vertical-align: middle; height: 80px; width: 100%">
                <p style="font-family:arial, helvetica, open-sans, sans-serif; font-size: 13px; font-weight: 400;margin: 0; padding-bottom: 5px">
                    If you received this email by mistake, simply delete it.
                </p>
                <p style="font-family:arial, helvetica, open-sans, sans-serif; font-size: 13px; font-weight: 400;margin: 0">
                    You won't be subscribed if you don't click the confirmation link above.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>