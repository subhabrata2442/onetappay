@extends('layouts.admin.adminFrontLayout')
@section('mainContent')
<div class="login-bg"></div>
<section class="banner-sec">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="banner-lft">
          <h1>Password Reset</h1>
          @include('messages.flash_messages')</div>
        {!! Form::open(['url'=>'password-forgot', 'class'=>'admin-login-form', 'id' => 'admin-login-form', 'autocomplete' => 'off']) !!}
        <div class="bnr-loginfrm">
          <div class="log-input relative form-group w-100">
            <div class="user-icn-lft"><i class="fa fa-user-circle"></i></div>
            <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control input-style" placeholder="Enter Email Address">
            <div class="chk-icon"><img class="img-fluid" src="{{ asset('public/images/chk.png')}}" alt=""></div>
          </div>
          <div class="login-btn">
            <button type="submit" class="commonBtn">Submit</button>
          </div>
          <div class="dont-have-acc">
            <p><a href="{{ url('login') }}">Back to Login</a></p>
          </div>
        </div>
        {!! Form::close() !!} </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="banner-rgt"> <img class="img-fluid" src="{{ asset('public/images/log-in-bnr.png')}}" alt=""> </div>
      </div>
    </div>
  </div>
</section>
@endsection 