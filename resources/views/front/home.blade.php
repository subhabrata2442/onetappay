@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.home_header')
<section class="home-banner position-relative"> <span class="plate-img"> <img class="img-block" src="{{ asset('public/front/images/plate.png') }}" alt=""> </span>
  <div class="position-relative"> <img class="img-block" src="{{ asset('public/front/images/red-yellow-watercolor.png') }}" alt="">
    <div class="bannar-box">
      <div class="container-fluid left-right-gap">
        <div class="banner-text-wrap">
          <!--<p>Lorem ipsum dolor</p>-->
          <h2>An intelligent gateway to your favorite restaurants.</h2>
          <p>Onetabpay provides intelligent food and restaurants recommendations and online seat reservation order placement services.</p>
          <div class="bannar-src">
            <div class="position-relative">
            {!! Form::open(['url'=>'/searcharea', 'class'=>'validate-form', 'id' => 'location-form', 'autocomplete' => 'off', 'method'=>'GET']) !!}
              <input type="text" class="form-control input-style-bnr" placeholder="Enter your address" id="location-input" name="location">
              <button type="submit" class="bnr-src-icon"><i class="fa-solid fa-magnifying-glass"></i></button>
            {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="sec-gap">
  <div class="container-fluid left-right-gap">
    <div class="row g-3">
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="table-hotel-box"> <a href="{{url('/searcharea?location=Canada')}}"> <span class="table-hotel-box-img"> <img class="img-block" src="{{ asset('public/front/images/hotels/img1.jpg') }}" alt=""> </span>
          <h4>AI Recommendation</h4>
          </a> </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="table-hotel-box"> <a href="{{url('/searcharea?location=Canada')}}"> <span class="table-hotel-box-img"> <img class="img-block" src="{{ asset('public/front/images/hotels/img2.jpg') }}" alt=""> </span>
          <h4>Online Reservation</h4>
          </a> </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="table-hotel-box"> <a href="{{url('/searcharea?location=Canada')}}"> <span class="table-hotel-box-img"> <img class="img-block" src="{{ asset('public/front/images/hotels/img3.jpg') }}" alt=""> </span>
          <h4>Online Order Placement</h4>
          </a> </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="table-hotel-box"> <a href="{{url('/searcharea?location=Canada')}}"> <span class="table-hotel-box-img"> <img class="img-block" src="{{ asset('public/front/images/hotels/img4.jpg') }}" alt=""> </span>
          <h4>Split Bills with Friends</h4>
          </a> </div>
      </div>
    </div>
  </div>
</section>
<section class="papular-location-sec sec-gap position-relative" style="background: url({{ asset('public/front/images/papular-location.jpg') }}) no-repeat center center;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="sec-heading">
          <h3>Popular Location</h3>
        </div>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="location-box"> <a href="{{$popular_city[0]['link']}}">
          <h4>{{$popular_city[0]['city']}}</h4>
          <p>{{$popular_city[0]['total_restaurant']}}</p>
          </a> </div>
        <div class="location-box"> <a href="{{$popular_city[1]['link']}}">
          <h4>{{$popular_city[1]['city']}}</h4>
          <p>{{$popular_city[1]['total_restaurant']}}</p>
          </a> </div>
        
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="location-box"> <a href="{{$popular_city[2]['link']}}">
          <h4>{{$popular_city[2]['city']}}</h4>
          <p>{{$popular_city[2]['total_restaurant']}}</p>
          </a> </div>
        <div class="location-box"> <a href="{{$popular_city[3]['link']}}">
          <h4>{{$popular_city[3]['city']}}</h4>
          <p>{{$popular_city[3]['total_restaurant']}}</p>
          </a> </div>
        
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="location-box"> <a href="{{$popular_city[4]['link']}}">
          <h4>{{$popular_city[4]['city']}}</h4>
          <p>{{$popular_city[4]['total_restaurant']}}</p>
          </a> </div>
        <div class="location-box"> <a href="{{$popular_city[5]['link']}}">
          <h4>{{$popular_city[5]['city']}}</h4>
          <p>{{$popular_city[5]['total_restaurant']}}</p>
          </a> </div>
        
      </div>
    </div>
  </div>
</section>
<section class="sec-gap">
  <div class="container-fluid left-right-gap">
    <div class="row">
      <div class="col-12">
        <div class="sec-heading">
          <h3>Collection</h3>
          <p>Browse restaurants by categories:</p>
        </div>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="collection-box"> <a href="{{url('/searcharea?location=Canada')}}"> <img class="img-block" src="{{ asset('public/front/images/collection/colection1.jpg') }}" alt="">
          <div class="collection-desc">
            <h4>Restaurant</h4>
            <p>12 Places</p>
          </div>
          </a> </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="collection-box"> <a href="{{url('/searcharea?location=Canada')}}"> <img class="img-block" src="{{ asset('public/front/images/collection/colection2.jpg') }}" alt="">
          <div class="collection-desc">
            <h4>Cafe</h4>
            <p>12 Places</p>
          </div>
          </a> </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="collection-box"> <a href="{{url('/searcharea?location=Canada')}}"> <img class="img-block" src="{{ asset('public/front/images/collection/colection3.jpg') }}" alt="">
          <div class="collection-desc">
            <h4>Buffet</h4>
            <p>12 Places</p>
          </div>
          </a> </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="collection-box"> <a href="{{url('/searcharea?location=Canada')}}"> <img class="img-block" src="{{ asset('public/front/images/collection/colection4.jpg') }}" alt="">
          <div class="collection-desc">
            <h4>Bar</h4>
            <p>12 Places</p>
          </div>
          </a> </div>
      </div>
    </div>
  </div>
</section>
@push('scripts') 
<script src="{{ asset('public/front/js/search.js/?t='.time()) }}"></script> 
@endpush
@endsection