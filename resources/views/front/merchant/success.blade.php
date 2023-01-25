@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.login_regis_header')
<section class="regBanner" style="background: url(../public/front/images/logBanner.jpg) center center no-repeat"></section>
<section class="successArea">
    <div class="container">
        <div class="rew">
            <div class="col-12">
                <div class="successInner text-center">
                    <span><i class="fa-regular fa-circle-check"></i></span>
                    <h3>You are Successfully Registration</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias error officiis numquam deserunt id beatae quos quidem et pariatur, incidunt eaque sint placeat distinctio officia perspiciatis vero nesciunt, vel autem? Saepe accusantium iusto dolorum quos.</p>
                    <a href="{{url('/merchant_admin')}}">Go To Merchant Login</a>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts') 

@endpush
@endsection