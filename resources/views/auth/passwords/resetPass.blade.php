@extends('layouts.layout')
@section('title', 'home')
@section('middle_content')
<section class="lightbg p-v-20">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="full c_breadcrumb">
          <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="{{ route('my-account') }}">Account</a></li>
            <li>Change Password</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="p-v-30 registerPage">
  <div class="container">
    <div class="whitebg p20 addShadow w500">
          <h4>Resets Password</h4>
          @include('messages.flash_messages')
          {!! Form::open(['url'=>'password/request', 'class'=>'reset-password', 'id' =>'reset-password', 'autocomplete' => 'off']) !!}
          <input type="hidden" name="user_id" value="{{ $user_info->id }}" />
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group full">
                <label for="">{{ __('Type New Password') }}: <span class="req">*</span></label>
                {!! Form::password('password',['class'=> 'form-control textBox', 'id'=>'password']) !!} </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group full">
                <label for="">{{ __('Confirm Password') }}: <span class="req">*</span></label>
                {!! Form::password('password_confirmation',['class'=> 'form-control textBox', 'id'=>'password-confirm']) !!} </div>
              <span class="pull-left"><a href="{{ route('my-account') }}" class="btn btn-warning">Back</a></span>
              <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>
          </div>
          {!! Form::close() !!}
          <div class="clearfix"></div>
        </div>
  </div>
</section>
@push('scripts')
@endpush 
@endsection