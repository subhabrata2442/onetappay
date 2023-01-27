@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.header')
<section class="cart-sec-page">
  <div class="container-fluid left-right-gap">
    <div class="row">
      <div class="col-12">
        <div class="sec-wrap-heading">
          <h3>Cart Items</h3>
        </div>
      </div>
      @if(count($cartinfo)>0)
      <div class="col-12">
        <div class="row g-4">
          <div class="col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="table-responsive cart-list-wrap code-box-wrap">
              <table class="table mb-0">
                <thead class="text-nowrap">
                  <tr>
                    <th style="width: 50px;">Delete</th>
                    <th>Image</th>
                    <th class="text-start">Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-end">Unit Price</th>
                    <th class="text-end">Total</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($cartinfo as $cart)
                @php
                	$item_img=Helpers::item_logo($cart['image']);
                @endphp
                  <tr>
                    <td><button type="button" class="cart-item-delete"><i class="fa-solid fa-trash-can"></i></button></td>
                    <td><div class="crt-product-img"> <a class="d-block" href="javascript:;"> <img class="img-block" src="{{$item_img}}"> </a> </div></td>
                    <td class="text-start"><div class="crt-product-name"> <a href="javascript:;">{{$cart['name']}}</a> </div></td>
                    <td class="text-center"><div class="crt-product-qty2">
                        <div class="d-flex qty-item-add align-items-center">
                          <button type="button" class="qty-add sub controls2"><i class="fa-solid fa-minus"></i></button>
                          <input type="number" class="form-control qty-show count qty qtyInput2" min="1" max="20" value="{{$cart['quantity']}}">
                          <button type="button" class="qty-add add controls2" data-id="{{$cart['cart_id']}}"><i class="fa-solid fa-plus"></i></button>
                        </div>
                      </div></td>
                    <td class="text-end text-nowrap">${{$cart['price']}}</td>
                    <td class="text-end text-nowrap">$<span id="product_prict_127" class="cart_product_price">{{$cart['grand_total']}}</span></td>
                  </tr>
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
                    <input type="text" name="" id="" class="form-control log-input-style" placeholder="Address">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="log-input-wrap">
                    <input type="text" name="" id="" class="form-control log-input-style" placeholder="City">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="log-input-wrap">
                    <input type="text" name="" id="" class="form-control log-input-style" placeholder="State">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="log-input-wrap">
                    <input type="text" name="" id="" class="form-control log-input-style" placeholder="Zip Code">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="log-input-wrap">
                    <input type="text" name="" id="" class="form-control log-input-style" placeholder="Location">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="log-select-wrap">
                    <select class="form-control log-select-style selectOption_1">
                      <option> Select Country </option>
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
                      <label>Name</label>
                      <input type="text" name="" id="" class="form-control log-input-style" placeholder="Name">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="log-input-wrap">
                      <label>Card Number</label>
                      <input type="text" name="" id="" class="form-control log-input-style" placeholder="xxxx xxxx xxxx xxxx">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="log-input-wrap">
                      <label>Ex. Month</label>
                      <input type="text" name="" id="" class="form-control log-input-style" placeholder="MM">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="log-input-wrap">
                      <label>Ex. Year</label>
                      <input type="text" name="" id="" class="form-control log-input-style" placeholder="YYYY">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="log-input-wrap">
                      <label>CVV</label>
                      <input type="text" name="" id="" class="form-control log-input-style" placeholder="XXX">
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
              <div class="crt-chkout"> <a href="#" class="cmn-abtn">Continue</a> </div>
            </div>
          </div>
        </div>
      </div>
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
      @endif
    </div>
  </div>
</section>
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
              <tr>
                <td class="text-start"><strong>5</strong> Sugar Marmalade</td>
                <td class="text-end">$256.00</td>
              </tr>
              <tr>
                <td class="text-start"><strong>2</strong> Mission Hill </td>
                <td class="text-end">$256.00</td>
              </tr>
            </tbody>
          </table>
          <table class="table mb-0">
            <tbody class="bb-none">
              <tr>
                <td class="text-start"><strong>Subtotal</strong></td>
                <td class="text-end"><strong>$2254.36</strong></td>
              </tr>
              <tr>
                <td class="text-start">Service fee</td>
                <td class="text-end">$10.00</td>
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
                <td class="text-end">$10.00</td>
              </tr>
            </tbody>
            <tfoot class="bb-none2">
              <tr>
                <td class="text-start">
                  <ul class="payment-card d-flex">
                    <li><i class="fa-brands fa-cc-stripe"></i></li>
                    <li>
                      <strong>visa ****3698</strong>
                      <p>27/01/2023</p>
                    </li>
                  </ul>
                </td>
                <td class="text-end"><strong>$2368.00</strong></td>
              </tr>
            </tfoot>
          </table>
          <a href="{{url('/')}}" class="back-to-home">back to home</a> </div>
      </div>
    </div>
  </div>
</section>
<section class="not-found-wrap d-flex align-items-center justify-content-center" style="background: url('https://onetabpay.aqualeafitsol.com/public/front/images/404.jpg')">
  <div class="eror-404-text">
    <h3>404</h3>
    <p>Nothing to see here. try another link</p>
    <a href="/" class="error-bkhome">back to home</a> </div>
</section>
@push('scripts') 
{{-- <script>
      $(document).ready(function(){
         var bodyHeight = $(document).height();
         var fotterHeight = $('.footer').outerHeight();
         $('body').css({"padding-bottom": fotterHeight, "min-height": bodyHeight});
         $('.footer').css({"position": "absolute", "bottom": "0"});
      });
   </script>  --}}
@endpush
@endsection