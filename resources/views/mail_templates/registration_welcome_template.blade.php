<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>GoRun- Confirmation of registration email</title>
</head>

<body>
<table width="560px" border="0" cellspacing="0" cellpadding="0" style=" font-size:14px;color:#333;font-family:Arial, Helvetica, sans-serif; margin:15px auto; border:#eee 1px solid;">
  <tr>
    <td colspan="2" style="padding:10px 15px; background: #f4f4f4;"><img src="{{asset('public/images/logo.png')}}" width="277" alt=""></td>
  </tr>
  <tr>
    <td style="background: #01a5ec;  font-size: 24px; font-weight: 400; color: #fff;     padding: 30px 26px;"> Confirm Your Registration</td>
  </tr>
  <tr>
    <td style="padding: 0 26px;"><p style="color: #606060; line-height: 22px;">HI {{ $uName ?? '' }}</p>
      <p style="color: #606060; line-height: 22px;">Thank for creating an account on the Go Run SA website.</p>
      <p style="color: #606060; line-height: 22px;">Verify your registration by clicking on the link below or by coping and pasting this link into your brouser.</p>
      <p style="color: #606060; line-height: 22px;">When prompted please enter the following One Time Pin:123456</p>
      <p style="color: #606060; line-height: 22px;"> Verification Link: <a href="{{ $event_approve_link ?? '' }}" style="color: #01a5ec; text-decoration: none; display: block;">{{ $user_verification_link ?? '' }}</a> </p>
      <p style="color: #606060; line-height: 22px;"> Best Regards <span style="color: #01a5ec; text-decoration: none; display: block;">Go Run Team</span> </p></td>
  </tr>
  <tr>
    <td style="padding:10px 15px; background: #2a303e;"><table width="558">
        <tr>
          <td style="color: #01a5ec;" widht="279" ><a href="javascript:;" style="width: 40px;
              display: inline-block;
              margin-right: 10px;
              "> <img src="{{asset('public/images/fb.png')}}" alt="" style="display: inline-block;vertical-align: middle;"> </a>GO RUN ON FACEBOOK</td>
          <td style="color: #01a5ec;" widht="279" ><a href="javascript:;" style="width: 40px; 
                  display: inline-block;
                  margin-right: 10px;
                  "> <img src="{{asset('public/images/tweet.png')}}" alt="" style="display: inline-block;vertical-align: middle;"> </a>GO RUN ON TWITTER</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>