<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="html5, html 5, video, audio, html5video, html 5 video, html 5 audio, flash, h.264, h264, mp4, mp3, wav, aac, web, internet"/>
<title>{{ $title ?? 'No title'}}</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('public/backoffice/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/backoffice/css/material-design-iconic-font.min.css') }}">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{ asset('public/backoffice/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/backoffice/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/backoffice/dist/css/login.css') }}">
</head>

<body class="hold-transition login-page">
<div class="limiter">
  <div class="container-login100" style="background-image: url({{ asset('public/backoffice/images/bg-01.jpg') }});">
    <div class="wrap-login100"> {!! Form::open(['url'=>'administrator', 'class'=>'login100-form validate-form', 'id' => 'admin-login-form', 'autocomplete' => 'off']) !!}
      <div class="logArea">
        <!--<div class="logAreaLeft">
            <img src="{{ asset('public/images/logo.png') }}" alt="">
        </div>-->
        <div class="logAreaRight">
            <h3 class="logoText"><b style="font-size:24px">Admin</b> </h3>
            
        </div>
      </div>
        <!-- <div class="card-header text-center mb-3">
        <a href="javascript" class="logoText"><b>FF PLAY</b> ADMIN PANEL</a>
        <span class="login100-form-title">Sign to continue FF Play</span>
      </div> -->
      <!-- <span class="login100-form-logo">
    <i class="zmdi zmdi-landscape"></i>
    </span> --> 
      @include('messages.flash_messages') 
      <div class="wrap-input100 validate-input" data-validate="Enter username">
        <label for="">User Name</label>
        <input type="hidden" name="user_type" value="1" />
        <input type="text" name="email" id="email" class="input100" placeholder="Email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; }else{ echo old('email'); } ?>">
        <span class="focus-input100" data-placeholder=""></span>
      </div>
      <div class="wrap-input100 validate-input" data-validate="Enter password">
        <label for="">Password</label>
        <input type="password" name="password" id="password" class="input100" placeholder="Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; }else{ echo old('password'); } ?>">
        <span class="focus-input100" data-placeholder=""></span>
      </div>
      <div class="contact100-form-checkbox">
        <input class="input-checkbox100" name="remember" id="checkbox1" type="checkbox" <?php if(isset($_COOKIE["email"])) { ?> checked <?php } ?>>
        <label class="label-checkbox100" for="checkbox1"> Remember me </label>
      </div>
      <div class="container-login100-form-btn">
        <button type="submit" class="login100-form-btn">Login</button>
       
      </div>
      <!--<div class="text-center p-t-90"> <a class="txt1" href="#"> Forgot Password? </a> </div>--> 
      {!! Form::close() !!} </div>
  </div>
</div>

<!-- /.login-box --> 

<!-- jQuery --> 
<script src="{{ asset('public/backoffice/plugins/jquery/jquery.min.js') }}"></script> 
<!-- Bootstrap 4 --> 
<script src="{{ asset('public/backoffice/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
<!-- AdminLTE App --> 
<script src="{{ asset('public/backoffice/dist/js/adminlte.min.js') }}"></script> 
<!-- <script src="{{ asset('public/js/main.js') }}"></script> --> 
<script>
  (function($) {
    "use strict";
    $('.input100').each(function() {
        $(this).on('blur', function() {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            } else {
                $(this).removeClass('has-val');
            }
        })
    })
    var input = $('.validate-input .input100');
   
    $('.validate-form .input100').each(function() {
        $(this).focus(function() {
            hideValidate(this);
        });
    });

    function validate(input) {
        if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        } else {
            if ($(input).val().trim() == '') {
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).removeClass('alert-validate');
    }
    var showPass = 0;
    $('.btn-show-pass').on('click', function() {
        if (showPass == 0) {
            $(this).next('input').attr('type', 'text');
            $(this).addClass('active');
            showPass = 1;
        } else {
            $(this).next('input').attr('type', 'password');
            $(this).removeClass('active');
            showPass = 0;
        }
    });
})(jQuery);
</script>
</body>
</html>
