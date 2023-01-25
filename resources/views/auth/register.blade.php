@extends('layouts.layout')
@section('title', 'Registration')
@section('middle_content')
<div class="login-bg"></div>
<section class="reg-banner-sec">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="banner-lft">
          <h1>Register Now</h1>
          <p>Fill in the fields given below for further uses</p>
        </div>
        {!! Form::open(['url'=>'registration', 'class'=>'admin-register-form', 'id' => 'admin-register-form', 'autocomplete' => 'off']) !!}
        <div class="bnr-registerfrm">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="log-input relative form-group w-100">
                <div class="user-icn-lft"><i class="fa fa-user"></i></div>
                <input type="text" name="fullName" id="fullName" class="form-control input-style" placeholder="Name">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="log-input relative form-group w-100">
                <div class="user-icn-lft"><i class="fa fa-calendar"></i></div>
                <input type="text" name="dob" id="dob" class="form-control input-style" placeholder="Date of Birth">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="log-input relative form-group w-100">
                <div class="user-icn-lft"><i class="fa fa-users"></i></div>
                <select name="gender" id="gender"class="form-control select-style">
                  <option value="">Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="log-input relative form-group w-100">
                <div class="user-icn-lft"><i class="fa fa-envelope-open"></i></div>
                <input type="text" name="email" id="email" class="form-control input-style register_email" placeholder="Email Address">
                <div class="chk-icon"><img class="img-fluid" src="{{ asset('public/images/chk.png')}}" alt=""></div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="log-input relative form-group w-100">
                <div class="user-icn-lft"><i class="fa fa-phone"></i></div>
                <input type="text" name="phone" id="phone" class="form-control input-style" placeholder="Phone Number">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="log-input relative form-group w-100">
                <div class="user-icn-lft"><i class="fa fa-phone"></i></div>
                <input type="text" name="alternet_phone" id="alternet_phone" class="form-control input-style" placeholder="Alternet Phone Number">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="log-input relative form-group w-100">
                <div class="user-icn-lft"><i class="fa fa-key"></i></div>
                <input type="password" name="password" id="password" class="form-control input-style" placeholder="Enter Password" autocomplete="cc-number">
                <div class="eye-icon"><span toggle="#password" class="fa fa-eye-slash toggle-password"></span></div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="log-input relative form-group w-100">
                <div class="user-icn-lft"><i class="fa fa-key"></i></div>
                <input type="text" name="password_confirmation" id="password_confirmation" class="form-control input-style" placeholder="Re-Enter Password">
                <div class="eye-icon"><span toggle="#password_confirmation" class="fa fa-eye-slash toggle-password"></span></div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="log-input relative form-group w-100">
                <div class="user-icn-lft"><i class="fa fa-map"></i></div>
                <select name="country" id="country" class="form-control select-style">
                  <option value="">Select Country</option>
                  <?php foreach($countries as $c){ ?>
                  <option value="<?php echo $c->name;?>"><?php echo $c->name;?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="log-input relative form-group w-100">
                <div class="user-icn-lft"><i class="fa fa-map-marker"></i></div>
                <input type="text" name="city" id="city" class="form-control input-style" placeholder="City">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="frm-chk-box">
                <input type="checkbox" name="terms" id="terms_accept">
                <label class="Ihover" for="terms_accept"> I agree with the Licence agreement. Yes, I would like to receive your Newsletter.
                  I accept the Terms of service. I accept the Refund policy </label>
              </div>
            </div>
          </div>
          <div class="sign-up-ftrbtn">
            <ul class="d-flex">
              <li>
                <button type="submit" class="commonBtn">Confirm</button>
              </li>
              <li><a href="{{ url('login') }}">cancel</a></li>
            </ul>
          </div>
          {!! Form::close() !!} </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="banner-rgt"> <img class="img-fluid" src="{{ asset('public/images/sign-up-bnr.png')}}" alt=""> </div>
      </div>
    </div>
  </div>
</section>
@push('scripts') 
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
<script type = "text/javascript">
$(function(){                                               
    setTimeout(function(){
        $("input#password_confirmation").attr("type","password");
    },2000);
});

 $(function () {
        $("#dob").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0'
        });
    });
$("#admin-register-form").validate({
    rules: {
        fullName: "required",
        dob: "required",
        gender: "required",
        phone: "required",
        country: "required",
        city: "required",
        email: {
            required: true,
            email: true,
            remote: {
                url: "{{ route('check.email') }}",
                type: "get",
                data: {
                    email: function() {
                        return $(".register_email").val();
                    }

                }
            }
        },
        password: {
            required: true,
            minlength: 5
        },
        password_confirmation: {
            required: true,
            minlength: 5,
            equalTo: "#password"
        },
		terms: "required"
    },

    messages: {
        password_signup: {
            required: "Input a password you will remember",
            minlength: "Your password must be at least 5 characters long"
        },
        confirm_password: {
            required: "Password does not match",
            minlength: "Your password must be at least 5 characters long",
            equalTo: "Please enter the same password as above"
        },
        email: {
            required: "Input a valid email address",
            email: "Input a valid email address",
            remote: "This email is already taken."
        },
    },
    errorElement: "em",
    errorPlacement: function(error, element) {
        error.addClass("help-block");
        error.insertAfter(element);
		<!--error.insertAfter(element.parent("div"));-->
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass("has-error").removeClass("has-success");
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).addClass("has-success").removeClass("has-error");
    },
    submitHandler: function(form) {
        var formData = new FormData($(form)[0]);
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            url: form.action,
            dataType: 'json',
            data: formData,
            success: function(data) {
                if (data.success == 0) {
                    $('#message_show').html(data.error_message);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                } else {
                    //window.location = base_url+"/"+data.redirect;
                    window.location = base_url + "/administrator/dashboard";
                }
            },
            beforeSend: function() {
                $(".loadingSpan").show();
            },
            complete: function() {
                $(".loadingSpan").hide();
            }
        });
    }
});
</script> 
@endpush
@endsection 