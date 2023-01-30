@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.header')
<section class="order-success-sec">
  <div class="container-fluid left-right-gap">
    <div class="row justify-content-center">
      <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="order-success"> <span class="success-icon"><i class="fa-solid fa-check"></i></span>
          <h3>Order successful</h3>
          <p>Thank you so much for your order.</p>
          <div class="row g-2 mt-3">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="order-user-details">
                <p>Customer Name : <strong>{{$orderDetails['order_info'][0]->customer_name}}</strong></p>
                <p>Customer Email : <strong>{{$orderDetails['order_info'][0]->customer_email}}</strong></p>
                <p>Telephone : <strong>{{$orderDetails['order_info'][0]->customer_phone}}</strong></p>
                <p>Reference # : <strong>{{$orderDetails['order_info'][0]->order_id_token}}</strong></p>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="order-user-details">
                <p>Merchant Name : <strong>{{$orderDetails['order_info'][0]->restaurant_name}}</strong></p>
                <p>TRN Type : <strong>Delivery</strong></p>
                <p>Payment Type : <strong>Stripe</strong></p>
                <p>TRN Date : <strong>{{$orderDetails['order_info'][0]->created_at}}</strong></p>
              </div>
            </div>
            <div class="col-12">
              <div class="order-user-details">
                <p>Address : <strong>{{$orderDetails['delivery_address'][0]->street}}</strong></p>
              </div>
            </div>
          </div>
          {{-- <table class="table table-striped">
            <tbody>
              <tr>
                <td>Customer Name</td>
                <td class="text-right">{{$orderDetails['order_info'][0]->customer_name}}</td>
              </tr>
              <tr>
                <td>Customer Email</td>
                <td class="text-right">{{$orderDetails['order_info'][0]->customer_email}}</td>
              </tr>
              <tr>
                <td>Merchant Name</td>
                <td class="text-right">{{$orderDetails['order_info'][0]->restaurant_name}}</td>
              </tr>
              <tr>
                <td>Telephone</td>
                <td class="text-right">{{$orderDetails['order_info'][0]->customer_phone}}</td>
              </tr>
              <tr>
                <td>Address</td>
                <td class="text-right">{{$orderDetails['delivery_address'][0]->street}}</td>
              </tr>
              <tr>
                <td>TRN Type</td>
                <td class="text-right">delivery</td>
              </tr>
              <tr>
                <td>Payment Type</td>
                <td class="text-right"> Stripe </td>
              </tr>
              <tr>
                <td>Reference #</td>
                <td class="text-right">{{$orderDetails['order_info'][0]->order_id_token}}</td>
              </tr>
              <tr>
                <td>TRN Date</td>
                <td class="text-right"> {{$orderDetails['order_info'][0]->created_at}}</td>
              </tr>
            </tbody>
          </table> --}}
          <table class="table mb-0">
            <thead>
              <tr>
                <th class="text-start"><strong>Total</strong></th>
                <th class="text-end"><strong>${{$orderDetails['grand_total']}}</strong></th>
              </tr>
            </thead>
            <tbody class="bb-none">
            
            @foreach($orderDetails['product_data'] as $cart)
            <tr>
              <td class="text-start"><strong>{{$cart['quantity']}}</strong> x {{$cart['name']}}</td>
              <td class="text-end">${{$cart['grand_total']}}</td>
            </tr>
            @endforeach
              </tbody>
            
          </table>
          <table class="table mb-0">
            <tbody class="bb-none">
              <tr>
                <td class="text-start"><strong>Subtotal</strong></td>
                <td class="text-end"><strong>${{$orderDetails['grand_total']}}</strong></td>
              </tr>
              <tr>
                <td class="text-start">Service fee</td>
                <td class="text-end">$0.00</td>
              </tr>
              <tr>
                <td class="text-start">Delivery fee</td>
                <td class="text-end">$0.00</td>
              </tr>
              <tr>
                <td class="text-start">Tax</td>
                <td class="text-end">$0.00</td>
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
                <td class="text-end"><strong>${{$orderDetails['grand_total']}}</strong></td>
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