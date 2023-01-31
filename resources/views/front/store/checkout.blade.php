@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.header')

@php
$country_code=isset($default_address_book->country_code)?$default_address_book->country_code:'';
@endphp
<input type="hidden" value="checkout" id="page_id" />
<section class="cart-sec-page">
  <div class="container-fluid left-right-gap">
    <div class="row">
      <div class="col-12">
        <div class="sec-wrap-heading">
          <h3><a class="cmn-abtn2" href="{{'/'}}"><i class="fa-solid fa-reply"></i>back</a> Indian resturent</h3>
        </div>
      </div>
      @if(count($cartinfo)>0)
      <form class="forms has-validation-callback" action="{{route('order_place.save')}}" method="POST" id="order_place_form" onsubmit="return false;">
        @csrf
        <div class="col-12">
          <div class="row g-4">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
              <div class="table-responsive cart-list-wrap code-box-wrap">
                <h4>Cart Items</h4>
                <table class="table mb-0">
                  <thead class="text-nowrap">
                    <tr>
                      <th style="width: 50px;">#</th>
                      <th>Image</th>
                      <th class="text-start">Name</th>
                      <th class="text-center">Quantity</th>
                      <th class="text-end">Unit Price</th>
                      <th class="text-end">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php $count=1;@endphp
                  @foreach($cartinfo as $cart)
                  @php
                  $item_img=Helpers::item_thumb($cart['image']);
                  @endphp
                  <tr>
                  <td>{{$count}}</td>
                    <!--<td><button type="button" class="cart-item-delete"><i class="fa-solid fa-trash-can"></i></button></td>-->
                    <td><div class="crt-product-img"> <a class="d-block" href="javascript:;"> <img class="img-block" src="{{$item_img}}"> </a> </div></td>
                    <td class="text-start"><div class="crt-product-name"> <a href="javascript:;">{{$cart['name']}}</a> </div></td>
                    <td class="text-center"><div class="crt-product-qty2">
                        <div class="d-flex qty-item-add align-items-center priceControl">
                          <button type="button" class="qty-add sub controls2" value="-" data-id="{{$cart['cart_id']}}"><i class="fa-solid fa-minus"></i></button>
                          <input type="number" class="form-control qty-show count qty qtyInput2" min="1" max="20" data-max-lim="20" value="{{$cart['quantity']}}">
                          <button type="button" class="qty-add add controls2" value="+" data-id="{{$cart['cart_id']}}"><i class="fa-solid fa-plus"></i></button>
                        </div>
                      </div></td>
                    <td class="text-end text-nowrap">${{$cart['price']}}</td>
                    <td class="text-end text-nowrap">$<span id="product_prict_127" class="cart_product_price">{{$cart['grand_total']}}</span></td>
                  </tr>
                  @php $count++;@endphp
                  @endforeach
                    </tbody>
                  
                  <tfoot class="text-nowrap">
                    <tr>
                      <td class="text-end" colspan="5"><strong>Total :</strong></td>
                      <td class="text-end"><strong><span class="d-block">$ {{$total_cart_amount}}</span></strong></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="code-box-wrap">
                <h4>Address</h4>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="log-input-wrap">
                      <input type="text" name="street" id="street" class="form-control log-input-style" placeholder="Address" value="{{ $default_address_book->street ?? "" }} " required="required">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="log-input-wrap">
                      <input type="text" name="city" id="city" class="form-control log-input-style" placeholder="City" value="{{ $default_address_book->city ?? "" }} " required="required">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="log-input-wrap">
                      <input type="text" name="state" id="state" class="form-control log-input-style" placeholder="State" value="{{ $default_address_book->state ?? "" }} " required="required">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="log-input-wrap">
                      <input type="text" name="zipcode" id="zipcode" class="form-control log-input-style" placeholder="Zip Code" value="{{ $default_address_book->zipcode ?? "" }} " required="required">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="log-input-wrap">
                      <input type="text" name="location_name" id="location_name" class="form-control log-input-style" placeholder="Location" value="{{ $default_address_book->location_name ?? "" }} " required="required">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="log-select-wrap">
                      <select class="form-control log-select-style selectOption_1" name="country" id="country" required>
                        <option value="">Select Country</option>
                        
                              @foreach($countrie as $country)
                      
                        <option value="{{ $country->sortname }}" {{ ($country_code == $country->sortname) ? 'selected="selected"' : '' }} >{{$country->name}}</option>
                        
                      
                              @endforeach
                    
                    
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="code-box-wrap">
                <h4>Stripe card details</h4>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="log-input-wrap">
                      <label>Card Holder Name</label>
                      <input type="text" name="card_holder_name" id="card_holder_name" class="form-control log-input-style" placeholder="Name" required="required">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="log-input-wrap">
                      <label>Card Number</label>
                      <input type="text" name="card_number" id="card_number" class="form-control log-input-style only-numeric" placeholder="xxxx xxxx xxxx xxxx" maxlength="16" autocomplete="off" required aria-required="true" >
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="log-input-wrap">
                      <label>Ex. Month</label>
                      <input type="text" name="card_exp_month" id="card_exp_month" class="form-control log-input-style only-numeric" placeholder="MM" required="required">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="log-input-wrap">
                      <label>Ex. Year</label>
                      <input type="text" name="card_exp_year" id="card_exp_year" class="form-control log-input-style only-numeric" placeholder="YYYY" required="required">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="log-input-wrap">
                      <label>CVV</label>
                      <input type="text" name="card_cvc" id="card_cvc" class="form-control log-input-style only-numeric" placeholder="XXX" required="required">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <div class="code-box-wrap sticky-bar">
                <h4>Your cart details</h4>
                <div class="table-responsive text-nowrap cart-list-wrap">
                  <table class="table mb-0">
                    <tbody>
                      <tr>
                        <td>Sub-Total :</td>
                        <td class="text-end">$<span id="sub_total">{{$total_cart_amount}}</span></td>
                      </tr>
                      <tr>
                        <td>Shipping Rate :</td>
                        <td class="text-end">$<span id="shipping_charge">0.00</span></td>
                      </tr>
                      <tr>
                        <td>Taxes :</td>
                        <td class="text-end">$<span id="total_vat">0.00</span></td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td><strong>Total pay :</strong></td>
                        <td class="text-end"><strong>$<span id="total_pay">{{$total_cart_amount}}</span></strong></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="crt-chkout">
                  <button type="submit" class="cmn-abtn">Continue</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      @else
      <div class="col-12">
        <div class="row align-items-center justify-content-center h-100">
          <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12">
            <div class="no-cart-found"> <span class="empty-cart-icon"><i class="fa-solid fa-cart-shopping"></i></span>
              <h3>Your basket is empty</h3>
              <a href="{{url('/')}}" class="contiue-shop">continue shopping</a> </div>
          </div>
        </div>
      </div>
      @endif </div>
  </div>
</section>
@push('scripts') 
<script src="{{ asset('public/front/js/cart.js/?t='.time()) }}"></script> 
@endpush
@endsection