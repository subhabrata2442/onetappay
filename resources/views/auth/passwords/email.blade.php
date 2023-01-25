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
            <li>Password Reset</li>
          </ul>
        </div>
        <div class="full">
          <div class="logingArea">
            <h2>Password Reset</h2>
            @include('messages.flash_messages')
            {!! Form::open(['url'=>'password/forgot', 'class'=>'login-form', 'id' => 'login-form']) !!}
            <div class="form-group">
              <label for="">Email Id:</label>
              <input type="email" name="email" class="form-control input1 userEmail" id="email" value="{{ old('email') }}">
            </div>
            <div class="full text-center">
              <button type="submit"  class="btn btn-primary pull-right">Send Password Reset Link</button>
              @if (Session::has('success')) <a href="{{ url('/') }}"  class="btn btn-warning pull-left">Back to home</a> @endif </div>
            {!! Form::close() !!} </div>
        </div>
      </div>
    </div>
  </div>
</section>
@push('scripts') 
<script>
    $(document).ready(function(){
      //Remove flash message
        setTimeout(function() {
            $('#successMessage').fadeOut('slow');
            $('#errorMessage').fadeOut('slow');
            $("#displayErrorMessage").fadeOut('slow');
        }, 5000); // <-- time in milliseconds
      });
  </script> 
@endpush
@endsection 