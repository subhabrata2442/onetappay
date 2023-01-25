@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.header')


<section class="cart-sec-page">
   <div class="container-fluid left-right-gap">
      <div class="row">
         <div class="col-12">
               <div class="sec-wrap-heading">
                  <h3>Shopping Cart</h3>
               </div>
         </div>
         <div class="col-12">
            <div class="row g-4">
               <div class="col-lg-8 col-md-8 col-sm-12 col-12">                 
                  <div class="table-responsive cart-list-wrap code-box-wrap">
                     <table class="table mb-0 tabgle_gap">
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
                           <tr>
                              <td>
                                 <button type="button" class="cart-item-delete"><i class="fa-solid fa-trash-can"></i></button>
                              </td>
                              <td>
                                 <div class="crt-product-img">
                                    <a class="d-block" href="#">
                                       <img class="img-block" src="https://onetabpay.aqualeafitsol.com/public/upload/image/180_180/2213581674492238.jpg?v=1674565732">
                                    </a>
                                 </div>
                              </td>
                              <td class="text-start">
                                 <div class="crt-product-name">
                                    <a href="#">Natural Jute Bags with Luxury Padded Handles</a>
                                 </div>
                              </td>
                              <td class="text-center">
                                 <div class="crt-product-qty2">
                                    <div class="d-flex qty-item-add align-items-center">
                                       <button type="button" class="qty-add sub controls2"><i class="fa-solid fa-minus"></i></button>
                                       <input type="number" class="form-control qty-show count qty qtyInput2" min="1" max="" value="1">
                                       <button type="button" class="qty-add add controls2"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-end text-nowrap">$4.00</td>
                              <td class="text-end text-nowrap">$<span id="product_prict_127" class="cart_product_price">4.00</span></td>
                           </tr>                                            
                        </tbody>
                        <tfoot class="text-nowrap">
                              <tr>
                                 <td class="text-end" colspan="5"><strong>Total :</strong></td>
                                 <td class="text-end"><strong><span class="d-block">$ 127.00</span></strong></td>
                              </tr>
                        </tfoot>
                     </table>
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
                                 <td class="text-end">$<span id="sub_total">127.00</span></td>
                              </tr>
                              <tr>
                                 <td>Shipping Rate :</td>
                                 <td class="text-end">$<span id="shipping_charge">0.00</span></td>
                              </tr>
                              <tr>
                                 <td>Vat :</td>
                                 <td class="text-end">$<span id="total_vat">12.70</span></td>
                              </tr>                                    
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td><strong>Total pay :</strong></td>
                                 <td class="text-end"><strong>$<span id="total_pay">139.70</span></strong></td>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                     <div class="crt-chkout">
                        <a href="#" class="cmn-abtn">Continue</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12">
                    <div class="no-cart-found">
                        <span class="empty-cart-icon"><i class="fa-solid fa-cart-shopping"></i></span>
                        <h3>Your basket is empty</h3>
                        <a href="{{url('/')}}" class="contiue-shop">continue shopping</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
   </div>
</section>
<section class="order-success-sec">
   <div class="container-fluid left-right-gap">
       <div class="row justify-content-center">
           <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12">
               <div class="order-success">
                   <span class="success-icon"><i class="fa-solid fa-check"></i></span>
                   <h3>Order successful</h3>
                   <p>Thank you so much for your order.</p>
                   <a href="{{url('/')}}" class="back-to-home">back to home</a>
               </div>
           </div>
       </div>
   </div>
</section>

<section class="not-found-wrap d-flex align-items-center justify-content-center" style="background: url('https://onetabpay.aqualeafitsol.com/public/front/images/404.jpg')">
   <div class="eror-404-text">
      <h3>404</h3>
      <p>Nothing to see here. try another link</p>
      <a href="#" class="error-bkhome">back to home</a>
   </div>
</section>


    
    
@push('scripts') 
   <script>
      $(document).ready(function(){
         var bodyHeight = $(document).height();
         var fotterHeight = $('.footer').outerHeight();
         $('body').css({"padding-bottom": fotterHeight, "min-height": bodyHeight});
         $('.footer').css({"position": "absolute", "bottom": "0"});
      });
   </script>
 
@endpush
@endsection