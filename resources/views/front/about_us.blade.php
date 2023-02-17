@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.login_regis_header')
<section class="regBanner" style="background: url(./public/front/images/logBanner.jpg) center center no-repeat"></section>
<section>
  <div class="sections section-grey2">
    <div class="container">
      <div class="row">
        <div class="col-md-12 ">
          <div class="search-wraps about-content">
            <h1>About us</h1>
            <p>OneTab is an all-in-one AI-based intelligent restaurant service platform, which provides smart restaurant
              recommendations, smart reservations, online waiting, online order, and online payment.</p>
            <p>We use various innovative technologies and unique algorithms to achieve these features</p>
            <p>For restaurant operators, the OneTab platform helps restaurants save labor costs and increase customer
              satisfaction rates. It can manage reservations, assign tables, identify repeat customers, and remembers
              diners' preferences. In addition, it offers rewards and loyalty incentives. OneTab dramatically improves
              the efficiency of restaurant operations and optimizes the customer experience. </p>
            <p>For diners, the OneTab platform helps guests enjoy a more seamless and positive dining experience by
              planning. It facilitates online reservations, menu browsing and payments for customers. Therefore, it
              saves diners a lot of time searching for restaurants and waiting in line. In addition, all restaurant-related
              information can be easily managed and personalized by our platform.</p>
            <p>OneTab is committed to transforming the traditional restaurant industry more efficiently and
              conveniently.</p>
          </div>
          
          <!--box-grey--> 
          
        </div>
        <!--col--> 
        
      </div>
      <!--row--> 
    </div>
    <!-- <div class="regModel"><img class="img-block" src="{{ asset('public/front/images/logModel.jpg') }}" alt=""></div> -->
    <!--container--> 
  </div>
</section>
@push('scripts')
@endpush
@endsection