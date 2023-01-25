<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('public/favicon/site.webmanifest') }}">
<link rel="mask-icon" href="{{ asset('public/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<title>BET 16</title>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
</head>

<body>
<section>
  <div class="logoBann"><a href="javascript:;"><img src="{{ asset('public/images/logo.png') }}" alt=""></a></div>
  <div class="contactBann banner d-flex justify-content-center align-items-center">
    <div class="container">
      <div class="row align-items-center">
        <div class="contactBannLeft col-6">
          <div class="bannDtls">
            <h2 style="text-transform:uppercase">WELCOME TO {{$data['site_title']}}</h2>
            <h5>Overall Customer Satisfaction 100 %</h5>
            <div class="bdBtnArea">
              <ul class="d-flex flex-wrap mob-justify-content-center">
                <li><a href="{{$data['apk']}}" class="d" download> Download Now <i class="fas fa-download"></i> </a></li>
                <!--<li><a href="#" class="d"> Download Now <i class="fas fa-download"></i> </a></li>-->
                <!--<li><a href=""><i class="fas fa-share-alt"></i> Share</a></li>-->
                <li><a href="tel:{{$data['phone']}}" class="">{{$data['phone']}} <i class="fas fa-phone"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="contactBannRight col-6">
          <div class="contactImg"><img src="{{ asset('public/images/contact-bann.png') }}" alt=""></div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- <div class="banner d-flex justify-content-center align-items-center">
    <div class="bannerInner d-flex justify-content-center flex-wrap">
      <div class="header text-center">
        <div class="logoBann"><a href="javascript:;"><img src="{{ asset('public/images/logo.png') }}" alt=""></a></div>

        <div class="bannDtls text-center">
          <div class="contactImg"><img src="{{ asset('public/images/contact-bann.png') }}" alt=""></div>
          <h2>WELCOME TO FF LIVE</h2>
          <h5>Overall Customer Satisfaction 100 %</h5>
          <div class="bdBtnArea">
            <ul class="d-flex flex-wrap justify-content-center">
              <li><a href="https://ffplay.co.in/public/upload/apk/ffplay.apk" class="d" download> Download Now <i class="fas fa-download"></i> </a></li>
              <li><a href=""><i class="fas fa-share-alt"></i> Share</a></li>
              <li><a href="tel:+91 93826 29922" class=""><i class="fas fa-phone"></i>+91 93826 29922</a></li>
            </ul>
          </div>
        </div>

    </div>
  </div>--> 
</section>

<!-- <script type="text/javascript" src="{{ asset('public/js/jquery-3.5.1.min.js') }}"></script> 
<script>
        $(document).ready(function() {
            $(".contactBtn").on("click", function() {
                $(".contactWrap , .overlay").addClass("show");
            });
            $(".overlay , .close").on("click", function() {
                $(".contactWrap , .overlay").removeClass("show");

            });

        });
    </script> -->
</body>
</html>