@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.login_regis_header') 

@php
$redirect_to 	= $_GET['redirect_to'] ?? '';
@endphp
<!-- <section class="home-banner position-relative"> <span class="plate-img"> <img class="img-block" src="{{ asset('public/front/images/plate.png') }}" alt=""> </span> </section> -->
<section class="regBanner" style="background: url(./public/front/images/logBanner.jpg) center center no-repeat"></section>
<section>
  <div class="sections section-grey2 section-checkout">
    <div class="container">
      <div class="row"> 
        <!--LEFT CONTENT-->
        <div class="search-wraps">
          <h1>Login &amp; Signup</h1>
          <p>sign up to start ordering</p>
        </div>
        <div class="col-md-6">
          <div class="box-grey rounded">
            <div class="section-label bottom20"> <a class="section-label-a"> <i class="ion-android-contact i-big"></i> <span class="bold" style="background:#fff;"> Log in to your account</span> <b></b> </a> </div>
            <form class="forms has-validation-callback" action="{{route('login')}}" method="POST" id="user_login_form" onsubmit="return false;">
              @csrf
              <input type="hidden" name="user_type" value="3" />
              <input type="hidden" id="login_redirect_to" name="redirect_to" value="{{$redirect_to}}" />
              <div class="row top10">
                <div class="col-md-12 ">
                  <input class="grey-fields full-width" placeholder="Email" required="required" type="text" value="" name="email" id="username">
                </div>
              </div>
              <!--row-->
              
              <div class="row top10">
                <div class="col-md-12 ">
                  <input class="grey-fields full-width" placeholder="Password" required="required" type="password" value="" name="password" id="password">
                </div>
              </div>
              <!--row-->
              
              <div class="row top15 align-items-center">
                <div class="col-md-6"> <a href="javascript:;" class="forgot-pass-link2 block orange-text text-center"> Forgot Password <i class="ion-help"></i> </a> </div>
                <div class="col-md-6">
                  <input type="submit" value="Login" class="orange-button medium full-width">
                </div>
              </div>
            </form>
          </div>
          <!--box-grey-->
          
          <form class="forms has-validation-callback" action="/" method="POST" id="user_forgotpass_form" onsubmit="return false;" style="display:none">
            @csrf
            <div class="section-forgotpass">
              <div class="box-grey rounded">
                <div class="section-label bottom20"> <a class="section-label-a"> <i class="ion-unlocked i-big"></i> <span class="bold" style="background:#fff;"> Forgot Password</span> <b></b> </a> </div>
                <div class="row top15">
                  <div class="col-md-12 ">
                    <input class="grey-fields full-width" placeholder="Email address" type="text" value="" name="username-email" id="username-email">
                  </div>
                </div>
                <!--row-->
                <input type="submit" value="Retrieve Password" class="top10 orange-button medium full-width">
                <div class="top10"> <a href="javascript:;" class="back-link  orange-text text-center"> Close </a> </div>
              </div>
              <!--box-grey--> 
            </div>
            <!--section-forgotpass-->
          </form>
        </div>
        <!--col--> 
        <!--END LEFT CONTENT--> 
        
        <!--RIGHT CONTENT-->
        <div class="col-md-6">
          <div class="box-grey rounded top-line-green">
            <form class="forms has-validation-callback" action="{{route('signup.save')}}" method="POST" id="user_signup_form" onsubmit="return false;">
              @csrf
              <input type="hidden" name="signup_redirect_to" value="{{$redirect_to}}" />
              <div class="section-label bottom20"> <a class="section-label-a"> <i class="ion-compose i-big green-color"></i> <span class="bold" style="background:#fff;"> Sign up</span> <b></b> </a> </div>
              <div class="row top10">
                <div class="col-md-12 ">
                  <input class="grey-fields full-width" placeholder="First Name" required="required" type="text" value="" name="first_name" id="first_name">
                </div>
              </div>
              <!--row-->
              
              <div class="row top10">
                <div class="col-md-12 ">
                  <input class="grey-fields full-width" placeholder="Last Name" required="required" type="text" value="" name="last_name" id="last_name">
                </div>
              </div>
              <!--row-->
              
              <div class="row top10">
                <div class="col-md-12 ">
                  <div class="intl-tel-input phone-input">
                    <input class="grey-fields mobile_inputs full-width" placeholder="Mobile" required="required" data-validation-length="max12" type="text" name="contact_phone" id="contact_phone" autocomplete="off">
                    <input type="hidden" class="countryiso" name="countryiso"/>
                    <input type="hidden" class="icocode" name="icocode"/>
                  </div>
                </div>
              </div>
              <!--row-->
              
              <div class="row top10">
                <div class="col-md-12 ">
                  <input class="grey-fields full-width" placeholder="Email address" required="required" type="text" value="" name="email" id="email">
                </div>
              </div>
              <!--row-->
              
              <div class="row top10">
                <div class="col-md-12 ">
                  <input class="grey-fields full-width" placeholder="Password" required="required" type="password" value="" name="password" id="password">
                </div>
              </div>
              <!--row-->
              
              <div class="row top10">
                <div class="col-md-12 ">
                  <input class="grey-fields full-width" placeholder="Confirm Password" required="required" type="password" value="" name="password_confirmation" id="password_confirmation">
                </div>
              </div>
              <!--row-->
              
              <p class="text-muted"> By creating an account, you agree to receive sms from vendor. </p>
              <div class="row top10">
                <div class="col-md-12 ">
                  <input type="submit" value="Create Account" class="orange-button medium block full-width">
                </div>
              </div>
            </form>
          </div>
          <!--box-grey--> 
          
        </div>
        <!--col--> 
        <!--END RIGHT CONTENT--> 
        
      </div>
      <!--row--> 
      
    </div>
    <!--container--> 
    
  </div>
</section>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.3.7/packaged/jquery.noty.packaged.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script> 
<script src="{{ asset('public/front/js/user.js/?t='.time()) }}"></script> 

<script>

</script> 
@endpush
@endsection