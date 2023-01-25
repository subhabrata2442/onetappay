<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title or 'No title'}}</title>

<!-- Fonts -->
<link rel="stylesheet" href="{{ asset('public/front/fonts/stylesheet.css') }}" media="all">
<!-- Owl Style -->
<link rel="stylesheet" href="{{ asset('public/front/css/owl.carousel.min.css') }}" media="all">
    <!-- Ui -->
<link rel="stylesheet" href="{{ asset('public/front/css/jquery-ui.css') }}" type="text/css" media="all" />
<!-- Style -->
<link rel="stylesheet" href="{{ asset('public/front/toast/jquery.toast.css') }}" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<link rel="stylesheet" href="{{ asset('public/front/css/style.css') }}" media="all">
<link rel="stylesheet" href="{{ asset('public/front/css/custom.css') }}" media="all">

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;libraries=places&amp;key=AIzaSyB-7feg-Hv8BUptW-3NbsqhjCizcGWRrKo"></script>
<script>
 var base_url = "{{url('/')}}";
 var csrf_token = "{{csrf_token()}}";
 var prop = <?php echo json_encode(array('url'=>url('/'), 'ajaxurl' => url('/ajaxpost'),  'csrf_token'=>csrf_token()));?>;
 var imageUrl = base_url+"/public/image/loader_icon.gif";
</script>
</head>
<body>

@yield('frontContent')
<footer class="footer">
  <div class="container-fluid left-right-gap">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="ftr-about d-flex flex-column justify-content-between h-100"> <span class="ftr-logo"> <img class="img-block" src="{{ asset('public/front/images/logo-white.png') }}" alt=""> </span>
          <div class="ftr-social">
            <ul class="d-flex">
              <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-google-plus-g"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="ftr-menu-box">
          <ul>
            <li><a href="#">About us</a></li>
            <li><a href="#">Team</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Blog</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="ftr-menu-box">
          <ul>
            <li><a href="#">Get Help</a></li>
            <li><a href="#">Buy gift cards</a></li>
            <li><a href="#">Add your restaurant</a></li>
            <li><a href="#">Sign up for booking</a></li>
            <li><a href="#">Create a business account</a></li>
            <li><a href="#">Promotions</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="ftr-menu-box">
          <ul>
            <li><a href="#">Restaurants near me</a></li>
            <li><a href="#">Restaurants Login</a></li>
            <li><a href="#">View all cities</a></li>
            <li><a href="#">View all countries</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <section class="ftr-btm">
    <div class="container-fluid left-right-gap">
      <div class="row">
        <div class="col-12">
          <div class="ftr-btm-text">
            <p>&copy; 2022 by Onetabpay.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</footer>

<script src="{{ asset('public/front/js/jquery-3.6.1.min.js') }}"></script> 
<script src="{{ asset('public/front/js/bootstrap.js') }}"></script>
<script src="{{ asset('public/front/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/front/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('public/front/js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{ asset('public/front/toast/jquery.toast.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="{{ asset('public/front/js/custom.js') }}"></script>


@stack('scripts')
</body>
</html>
