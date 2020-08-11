<!doctype html>
<html>
<head>
    <title>Email Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->

    <style>
        @import 'https://fonts.googleapis.com/css?family=Raleway:300,400,500,700';
        body{font-family: 'Raleway', sans-serif;}
    </style>
</head>

<body>
<table width="100%" cellspacing="50" cellpadding="50" border="0" bgcolor="#E7E7E7" class="wrapper">
    <tbody>
    <tr>
        <td>
            <table bgcolor="#ffffff" cellpadding="0" cellspacing="0" align="center" style="border:1px solid #acacac; border-radius:4px; padding:20px 50px 100px; width:632px;" >
                <tr>
                    <td>
                        <table>
                            <tr style="text-align:center">
                                <td><img src="{{ asset('uploads/'.$logo) }}" /></td>
                            </tr>

                            <tr>
                                <td style="text-align:left"><h1 style="font-weight:normal; color:#2e2e2e; font-size:30px; margin:0px; padding-top:60px;">Support Message!</h1>
                                    <p style="font-size:18px; color:#2e2e2e; line-height:25px; margin:0px; padding-top:20px;">Hello Admin,</p>
                                    <p style="font-size:16px; color:#2e2e2e; line-height:25px; margin:0px; padding-top:20px;">
                                        You have received a new Support Message .Below is details</p>
                                    <p style="font-size:16px; color:#2e2e2e; line-height:25px; margin:0px; padding-top:20px;">
                                        <span>Name : <strong>{{$name}}</strong></span>
                                        <br>
                                        <span>Email : <strong>{{$user_email}}</strong></span>
                                        <br>
                                        <span>Subject : <strong>{{$subject}}</strong></span>
                                    </p>
                                    <p>
                                        <span>Message : <strong>{{ $msg }}</strong></span>
                                    </p>

                                </td>
                            </tr>


                        </table>
                    </td>
                </tr>
            </table>
            <p style="text-align:center; margin:35px auto 0px; font-size:14px; color:#5d5d5d; width:500px; line-height:25px;" >This email was intended for www.webexert.com admininistrator.
                © {{ date('Y') }} www.webexert.com</p>
        </td>
    </tr>

    </tbody>
</table>
</body>
</html>