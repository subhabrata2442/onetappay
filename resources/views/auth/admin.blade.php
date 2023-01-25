@extends('layouts.admin.adminFrontLayout')
@section('mainContent')
<section class="m-T-120">
  <div class="baNNer">
    <div class="captions text-center">
      <h2>Fotafot Admin Panel</h2>
    </div>
  </div>
  <div class="container">
    <div class="row"> 
      <!--<div class="col-md-3 col-sm-2 col-xs-12"></div>-->
      <div class="adminLogin">
        <div class="loginMain dTable p-v-50">
          <div class="dcell signin">
            <div class="adminLoginHead">
              <h3>Signin</h3>
            </div>
            <div class="adminLogBox full"> @include('messages.flash_messages')
              {!! Form::open(['url'=>'administrator', 'class'=>'admin-login-form', 'id' => 'admin-login-form', 'autocomplete' => 'off']) !!}
              <input type="hidden" name="user_type" value="1" />
              <div class="form-group full">
                <label for="">Email:</label>
                <input type="text" name="email" class="form-control textBox" id="userEmail" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; }else{ echo old('email'); } ?>">
              </div>
              <div class="form-group full">
                <label for="">Password:</label>
                <input type="password" name="password" class="form-control textBox" id="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; }else{ echo old('password'); } ?>">
                {{-- <span class=""><a href="{{url('admin-password')}}" class="f-green">Forgot Password?</a></span>  --}}
              </div>
              <div class="checkbox autowidthL">
                <input id="checkbox1" class="styled" type="checkbox" name="remember" <?php if(isset($_COOKIE["email"])) { ?> checked <?php } ?>>
                <label for="checkbox1">Remember me</label>
              </div>
              <div class="clearfix"></div>
              <button type="submit" class="commonBtn m-t-10 radius3">Submit</button>
              {!! Form::close() !!} </div>
          </div>
        </div>
      </div>
      <!--<div class="col-md-3 col-sm-2 col-xs-12"></div>	--> 
    </div>
  </div>
</section>
@endsection 