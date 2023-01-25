@extends('layouts.admin.adminFrontLayout')
@section('mainContent')
<section class="m-T-120">
  <div class="baNNer">
    <div class="captions text-center">
      <h2>Admin Panel</h2>
    </div>
  </div>
  <div class="container">
    <div class="row"> 
      <!--<div class="col-md-3 col-sm-2 col-xs-12"></div>-->
      <div class="adminLogin">
        <div class="loginMain dTable p-v-50">
          <div class="dcell signin">
            <div class="adminLoginHead">
              <h3>Password Reset</h3>
            </div>
            <div class="adminLogBox full"> @include('messages.flash_messages')
              {!! Form::open(['url'=>'administrator-password-forgot', 'class'=>'admin-login-form', 'id' => 'admin-login-form', 'autocomplete' => 'off']) !!}
              <input type="hidden" name="user_type" value="1" />
              <div class="form-group full">
                <label for="">Email:</label>
                <input type="text" name="email" class="form-control textBox" id="email" value="{{ old('email') }}">
              </div>
              <div class="clearfix"></div>
              <button type="submit" class="commonBtn m-t-10 radius3 pull-right">Submit</button><a href="{{ url('/administrator') }}"  class="btn btn-warning  m-t-10 radius3  pull-left">Back to Login</a>
              {!! Form::close() !!} </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection 