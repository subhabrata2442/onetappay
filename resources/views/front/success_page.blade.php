@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.header')
<section class="order-success-sec">
  <div class="container-fluid left-right-gap">
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12">
        <div class="order-success"> <span class="success-icon"><i class="fa-solid fa-check"></i></span>
          <h3>Order successful</h3>
          <p>Thank you so much for your order.</p>
          <table class="table mb-0">
            <thead>
              <tr>
                <th class="text-start"><strong>Total</strong></th>
                <th class="text-end"><strong>$2254.36</strong></th>
              </tr>
            </thead>
            <tbody class="bb-none">
            @foreach($cartinfo as $cart)
              <tr>
                <td class="text-start"><strong>{{$cart['quantity']}}</strong> {{$cart['name']}}</td>
                <td class="text-end">${{$cart['grand_total']}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <table class="table mb-0">
            <tbody class="bb-none">
              <tr>
                <td class="text-start"><strong>Subtotal</strong></td>
                <td class="text-end"><strong>${{$total_cart_amount}}</strong></td>
              </tr>
              <tr>
                <td class="text-start">Service fee</td>
                <td class="text-end">$0.00</td>
              </tr>
              <tr>
                <td class="text-start">Delivery fee</td>
                <td class="text-end">$10.00</td>
              </tr>
              <tr>
                <td class="text-start">Tax</td>
                <td class="text-end">$10.00</td>
              </tr>
              <tr>
                <td class="text-start">Tip</td>
                <td class="text-end">$0.00</td>
              </tr>
            </tbody>
            <tfoot class="bb-none2">
              <tr>
                <td class="text-start"><ul class="payment-card d-flex">
                    <li><i class="fa-brands fa-cc-stripe"></i></li>
                    <li> <strong>visa ****3698</strong>
                      <p>27/01/2023</p>
                    </li>
                  </ul></td>
                <td class="text-end"><strong>${{$total_cart_amount}}</strong></td>
              </tr>
            </tfoot>
          </table>
          <a href="{{url('/')}}" class="back-to-home">back to home</a> </div>
      </div>
    </div>
  </div>
</section>
@push('scripts') 
@endpush
@endsection