@extends('layouts.layout')
@section('title', 'Registration')
@section('middle_content')
<section class="homeBody pv-30-60">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full bradeCamp">
          <ul>
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
            <li>Reset Password</li>
          </ul>
        </div>
        <div class="full">
          <div class="logingArea">
            <h2>Reset Password</h2>
            @include('messages.flash_messages')
            {!! Form::open(['url'=>'password/request', 'class'=>'smart-form client-form']) !!}
            @php 
            $segment = Request::fullUrl();
            $explode = explode('?',$segment);
            $token = Input::get('token');
            @endphp
            {{ Form::hidden('token', $token) }}
            <div class="form-group">
              <label for="">Password:</label>
              {!! Form::password('password',['class'=> 'input1 form-control radius3', 'id'=>'password']) !!} </div>
            <div class="form-group">
              <label for="">Confirm Password:</label>
              {!! Form::password('password_confirmation',['class'=> 'input1 form-control radius3', 'id'=>'password-confirm']) !!} </div>
            <div class="full text-center">
              <button type="submit"  class="btn btn-primary">Reset Password</button>
            </div>
            {!! Form::close() !!} </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection 