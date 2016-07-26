<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Weclome to The Clip</title>
        <link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,300' rel='stylesheet' type='text/css'>
        <style type="text/css">
            .sos-med>ul {
            padding-left:0;
            margin-bottom:0;
            list-style:none;
            text-align: left;
            }
            .sos-med>ul>li {
            display:inline-block;
            }
            .sos-med>ul>li>a>img {
            transition:all 0.3s;
            -webkit-transition:all 0.3s;
            -moz-transition:all 0.3s;
            }
            .sos-med>ul>li>a:hover>img {
            transform:scale(1.12);
            -webkit-transform:scale(1.12);
            -moz-transform:scale(1.12);
            }
           
        </style>
    </head>
    <body style="#f3f3f3;margin:0;padding:0">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#f3f3f3">
            <tbody>
                <tr>
                    <td>
                        <table width="550"  cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
                            <tbody>
                                <tr bgcolor="#f3f3f3">
                                    <td align="left" style="padding:20px 30px;"><a href="http://www.theclip.com"><img src="{{ url('assets/frontend/img/logo.png') }}"  style="display:block" border="0" alt=""/></a></td>
                                    <td style="text-align:right">
                                     <font style="font-family: 'Nunito', sans-serif;font-size:14px;color:#585858;"> www.theclip.com</font>
                                    </td>
                                </tr>
                                <tr bgcolor="#f38ab0">
                                    <td style="padding:0 30px" colspan="2">
                                        <h2 style="color:#fff;font-family: 'Yanone Kaffeesatz', sans-serif;text-transform:uppercase;letter-spacing:1px">Welcome to The Clip</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url({{ url('assets/frontend/img/bg_arrow.png') }}) no-repeat 30px 0">
                                            <tbody>
                                                <tr>
                                                    <td width="30px">&nbsp;</td>
                                                    <td  align="left" valign="top">
                                                        <table width="100%" style="margin: 0 auto">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="padding:40px 0 10px ">
                                                                        <font style="font-family: 'Nunito', sans-serif;color:#000000; font-size:16px;">Hi {{$email}}, Thanks for join us iLive!</font>
                                                                        <p style="font-family: 'Nunito', sans-serif;color:#585858; font-size:14px;">
                                                                            @if(isset($text_message))
                                                                                {{ $text_message }}
                                                                            @endif
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 10px 15px ;border:2px solid #b7b7b7;font-family: 'Nunito', sans-serif;color:#585858; font-size:14px;">
                                                                        Email: <b>{{$email}}</b><br />
                                                                        Username: <b>{{$username}}</b><br />
                                                                        Password: <b>{{$password}}</b>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding:20px 0 30px">
                                                                        <div style="font-family: 'Nunito', sans-serif;color:#585858; font-size:14px;max-width:500px">
                                                                        @if(!empty($activation_code))
                                                                            To activate your account, <a href="{{ URL::to('auth/activation-user', array($id,$activation_code)) }}" style="word-wrap:break-word;color:#376edc">click this link</a>
                                                                            <br /><br />
                                                                        @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td width="30px">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="550" cellspacing="0" cellpadding="0" align="center" style="margin-top: 10px; margin-bottom: 10px">
                            <tbody>
                                
                                
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style="background:#e8e8e8;">
                    <td align="center" colspan="2" style="padding:10px;">
                        <font style="font-family: 'Nunito', sans-serif;color:#949494; font-size:12px;">&copy;Copyright 2016 The Clip | All right reserved</font>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>