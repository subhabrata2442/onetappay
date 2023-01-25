@extends('layouts.admin.adminFrontLayout')
@section('mainContent')
<div class="login-bg"></div>
<section class="banner-sec">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="banner-lft">
          <h1>Reset Password</h1>
          @include('messages.flash_messages')</div>
        {!! Form::open(['url'=>'reset-password', 'class'=>'admin-login-form', 'id' => 'admin-login-form', 'autocomplete' => 'off']) !!}
        @php 
        $segment = Request::fullUrl();
        $explode = explode('?',$segment);
        $token = Input::get('token');
        @endphp
        {{ Form::hidden('token', $token) }}
        <div class="bnr-loginfrm">
          <div class="log-input relative form-group w-100">
            <div class="user-icn-lft"><i class="fa fa-key"></i></div>
            <input type="password" name="password" id="password-field1" value="" class="form-control input-style" placeholder="Enter Password" autocomplete="cc-number">
            <div class="eye-icon"><span toggle="#password-field1" class="fa fa-eye-slash toggle-password"></span></div>
          </div>
          <div class="log-input relative form-group w-100">
            <div class="user-icn-lft"><i class="fa fa-key"></i></div>
            <input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control input-style" placeholder="Enter Password" autocomplete="cc-number">
            <div class="eye-icon"><span toggle="#password_confirmation" class="fa fa-eye-slash toggle-password"></span></div>
          </div>
          <div class="login-btn">
            <button type="submit" class="commonBtn">Submit</button>
          </div>
        </div>
        {!! Form::close() !!} </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="banner-rgt"> <img class="img-fluid" src="{{ asset('public/images/log-in-bnr.png')}}" alt=""> </div>
      </div>
    </div>
  </div>
</section>
@push('scripts') 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
$("#admin-login-form").validate({
    rules: {
        password: {
            required: true,
			 minlength: 5
        },
        password_confirmation: {
            required: true,
            minlength: 5,
            equalTo: "#password-field1"
        }
    },

    messages: {},
    submitHandler: function(form) {
        form.submit();
    }
});
</script> 
@endpush
@endsection 