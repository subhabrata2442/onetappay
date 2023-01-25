<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>STEM Academy - Otp</title>
</head>
<body>
<table width="560px" border="0" cellspacing="0" cellpadding="0" style="background:#E8EEFF; font-size:14px;color:#333;font-family:Arial, Helvetica, sans-serif; padding:15px; margin:15px auto; border:#eee 1px solid;">
  <tr>
    <td colspan="2" style="padding:20px 15px 40px;"><center><img src="{{asset('public/images/logo.png')}}" width="277" alt=""></center></td>
  </tr>
   <tr>
	<td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#fff; padding:20px 30px;">
		<tr>
    <td colspan="2" style="padding:0 15px 10px;line-height:20px; font-weight:bold; font-size:20px; color:#4169e1; text-align: center;">
    Hii! {{ $email }}
    </td>
  </tr>
 	    <tr>
     <td colspan="2" style="padding:5px 15px; color:#333; text-align: center;">
      Here is your otp <strong>{{$otp}}</strong></td>   
  </tr>
	</table>
	</td>
 </tr>
  <tr>
    <td style="padding:0 15px;" align="center">
      <table width="560px" style=" margin:20px 0 20px; border-top: 1px solid #ddd; padding:20px 0 0;">
            <tr>
                <td colspan="2"  width="" style="padding:0; font-size:12px; color:#666; text-align:center;  opacity: 0.7;">© {{date('Y')}} Aqualeaf for Young Kids, 1665 Oak Tree Road, Edison, NJ 08820 732-243-979.</td>
            </tr>
        </table>
    </td>
  </tr>
</table>
</body>
</html>