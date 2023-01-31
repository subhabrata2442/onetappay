@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.login_regis_header') 

@php
$tab=isset($_GET['tab'])?$_GET['tab']:1;


@endphp 

<!-- <section class="home-banner position-relative"> <span class="plate-img"> <img class="img-block" src="{{ asset('public/front/images/plate.png') }}" alt=""> </span> </section> -->
<section class="regBanner" style="background: url(./public/front/images/logBanner.jpg) center center no-repeat"></section>
<section class="profile-sec">
  <div class="container-fluid left-right-gap">
    <div class="row">
      <div class="col-12 mb-5">
        <div class="search-wraps text-center">
          <h3>My Profile</h3>
        </div>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-12 col-12">
        <div class="responsive-tabs mt-0">
          <ul class="nav nav-pills" role="tablist">
            <li class="nav-item"> <a id="tab-A" href="#pane-A" class="nav-link {{ ($tab == 1) ? 'active' : '' }}" data-bs-toggle="tab" role="tab">profile</a> </li>
            <li class="nav-item"> <a id="tab-B" href="#pane-B" class="nav-link {{ ($tab == 2) ? 'active' : '' }}" data-bs-toggle="tab" role="tab">address book</a> </li>
            <li class="nav-item"> <a id="tab-C" href="#pane-C" class="nav-link {{ ($tab == 3) ? 'active' : '' }}" data-bs-toggle="tab" role="tab">order history</a> </li>
            <li class="nav-item"> <a id="tab-D" href="#pane-D" class="nav-link {{ ($tab == 4) ? 'active' : '' }}" data-bs-toggle="tab" role="tab">Booking History</a> </li>
            <li class="nav-item"> <a id="tab-E" href="#pane-E" class="nav-link {{ ($tab == 5) ? 'active' : '' }}" data-bs-toggle="tab" role="tab">credit cards</a> </li>
            <!--<li class="nav-item"> <a id="" href="#" class="nav-link" data-bs-toggle="tab" role="tab">my points</a> </li>-->
          </ul>
          <div id="content" class="tab-content" role="tablist">
            <div id="pane-A" class="card tab-pane fade {{ ($tab == 1) ? 'show active' : '' }}" role="tabpanel" aria-labelledby="tab-A">
              <div class="card-header" role="tab" id="heading-A">
                <h5 class="mb-0"> <a data-bs-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A"> profile </a> </h5>
              </div>
              <div id="collapse-A" class="collapse when-mobile show" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-A">
                <form class="forms has-validation-callback" action="{{route('profile.profile.save')}}" method="POST" id="user_update_form" onsubmit="return false;">
                  @csrf
                  <div class="card-body">
                    <div class="row g-3 mt-0">
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="log-input-wrap">
                          <input type="text" name="first_name" id="first_name" class="form-control log-input-style" placeholder="First name" required="required" value="{{$user_info->first_name}}">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="log-input-wrap">
                          <input type="text" name="last_name" id="last_name" class="form-control log-input-style" placeholder="Last name" required="required" value="{{$user_info->last_name}}">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="log-input-wrap">
                          <input type="text" name="email" id="email" class="form-control log-input-style" placeholder="Email" disabled="disabled" value="{{$user_info->email}}">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="log-input-wrap phone-prefix">
                          <input type="text" name="contact_phone" id="contact_phone" class="form-control log-input-style" placeholder="Phone Number" required="required" value="{{$user_info->phone}}" autocomplete="off">
                          <input type="hidden" class="countryiso" name="countryiso"/>
                          <input type="hidden" class="icocode" name="icocode"/>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="log-input-wrap">
                          <input type="password" name="password" id="password" class="form-control log-input-style" placeholder="Password">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="log-input-wrap">
                          <input type="password" name="confirmed_password" id="confirmed_password" class="form-control log-input-style" placeholder="Confirm password">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="pro-btn-wrap">
                          <button type="submit" class="pro-btn-new">save</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div id="pane-B" class="card tab-pane fade {{ ($tab == 2) ? 'show active' : '' }}" role="tabpanel" aria-labelledby="tab-B">
              <div class="card-header" role="tab" id="heading-B">
                <h5 class="mb-0"> <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B"> address book </a> </h5>
              </div>
              <div id="collapse-B" class="collapse when-mobile" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-B">
                <div class="card-body">
                  <div id="new_address_book_sec" style="display:none;">
                    <form class="forms has-validation-callback" action="{{route('profile.address.save')}}" method="POST" id="user_address_form" onsubmit="return false;">
                      @csrf
                      <input type="hidden" name="address_id" id="address_id" />
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="log-input-wrap">
                            <input type="text" name="street" id="street" class="form-control log-input-style" placeholder="Address" required="required">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="log-input-wrap">
                            <input type="text" name="city" id="city" class="form-control log-input-style" placeholder="City" required="required">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="log-input-wrap">
                            <input type="text" name="state" id="state" class="form-control log-input-style" placeholder="State" required="required">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="log-input-wrap">
                            <input type="text" name="zipcode" id="zipcode" class="form-control log-input-style" placeholder="Zip Code" required="required">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="log-input-wrap">
                            <input type="text" name="location_name" id="location_name" class="form-control log-input-style" placeholder="Location" required="required">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="log-select-wrap">
                            <select class="form-control log-select-style selectOption_1" name="country" id="country" required>
                              <option value="">Select Country</option>
                              
                              
                              
                              
                              @foreach($countrie as $country)
                              
                              
                              
                              
                              <option value="{{ $country->sortname }}">{{$country->name}}</option>
                              
                              
                              
                              
                              @endforeach
                            
                            
                            
                            
                            
                            </select>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="checkbox ps-1">
                            <input type="checkbox" id="defaul-address" name="defaul_address" value="1">
                            <label for="defaul-address">Set as default</label>
                          </div>
                        </div>
                      </div>
                      <div class="row justify-content-between mt-3">
                        <div class="col-auto">
                          <div class="pro-btn-wrap btn-lft-icon"> <a href="javascript:;" class="pro-btn-new close_address_btn"><i class="fa-solid fa-reply"></i>back</a> </div>
                        </div>
                        <div class="col-auto">
                          <div class="pro-btn-wrap">
                            <button type="submit" class="pro-btn-new">save</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  @if(count($address_book)>0)
                  <div class="row address_book_sec">
                    <div class="col-12">
                      <div class="pro-btn-wrap">
                        <div class="pro-btn-wrap"> <a href="javascript:;" class="pro-btn-new add_new_address_btn">add new address</a> </div>
                      </div>
                    </div>
                    <table id="table_list" class="table table-striped dataTable" aria-describedby="table_list_info">
                      <thead>
                        <tr role="row">
                          <th width="40%" class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table_list" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Address: activate to sort column descending" style="width: 260px;">Address</th>
                          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list" rowspan="1" colspan="1" aria-label="Location Name: activate to sort column ascending" style="width: 250px;">Location Name</th>
                          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_list" rowspan="1" colspan="1" aria-label="Default: activate to sort column ascending" style="width: 132px;">Action</th>
                        </tr>
                      </thead>
                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                      
                      @foreach($address_book as $address)
                      <tr class="odd">
                        <td class=" sorting_1">{{$address->street}}
                          @if($address->as_default==1)
                          <div class="isDefaultAddress">Default Address</div>
                          @endif </td>
                        <td class="">{{$address->city}}</td>
                        <td><a href="javascript:;" class="btn btn-danger btn-sm delete_address_btn" data-toggle="tooltip" title="Delete" data-id="{{$address->id}}">Delete</a></td>
                      </tr>
                      @endforeach
                        </tbody>
                      
                    </table>
                  </div>
                  @else
                  <div class="row address_book_sec">
                    <div class="col-12">
                      <div class="pro-btn-wrap"> <a href="javascript:;" class="pro-btn-new add_new_address_btn">add new address</a> </div>
                    </div>
                    <div class="col-12">
                      <div class="not-comments-wrap"> <i class="fa-solid fa-map-location-dot"></i>
                        <p>No address yet</p>
                      </div>
                    </div>
                  </div>
                  @endif </div>
              </div>
            </div>
            <div id="pane-C" class="card tab-pane fade {{ ($tab == 3) ? 'show active' : '' }}" role="tabpanel" aria-labelledby="tab-C">
              <div class="card-header" role="tab" id="heading-C">
                <h5 class="mb-0"> <a data-bs-toggle="collapse" href="#collapse-C" aria-expanded="true" aria-controls="collapse-C"> order history </a> </h5>
              </div>
              <div id="collapse-C" class="collapse when-mobile" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-C">
                <div class="card-body"> @if(count($order_history)>0)
                  <div class="order-history-table">
                    <div class="table-responsive accordion accordion-flush" id="accordionFlushExample">
                      <table class="table">
                        <thead>
                          <th>#</th>
                            <th>Order ID</th>
                            <th>Order date</th>
                            <th>Resturent Name</th>
                            <th>Total</th>
                            <th>Payment Mode</th>
                            <th>Status</th>
                          </thead>
                        <tbody>
                        
                        @php $count=1;@endphp
                        @foreach($order_history as $order_row)
                        <tr>
                          <td>{{$count}}</td>
                          <td>@if($order_row->order_status==1)
                          <button class="toggle-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$order_row->order_id}}" aria-expanded="false" aria-controls="flush-collapse{{$order_row->order_id}}"> <i class="fa-solid fa-chevron-down"></i> #{{$order_row->order_id_token}}</button>
                           @else
                           #{{$order_row->order_id_token}}
                           @endif
                          </td>
                          <td>{{$order_row->created_at}}</td>
                          <td>{{$order_row->merchant_info->restaurant_name}}</td>
                          <td>${{$order_row->gross_total}}</td>
                          <td>{{$order_row->payment_type}}</td>
                          <td>
                          @if($order_row->order_status==1)
                          	@if($order_row->status=='pending')<span class="label order-status bg-yellow">Pending</span> @elseif($order_row->status=='cancel')<span class="label order-status bg-red">Canceled</span>@else<span class="label order-status bg-success">Accepted</span>@endif
                          @else
                          <span class="label order-status bg-red">Payment failed</span>
                          @endif
                          </td>
                        </tr>
                        <tr>
                          <td colspan="7" class="details-wrap">
                            <div id="flush-collapse{{$order_row->order_id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$order_row->order_id}}" data-bs-parent="#accordionFlushExample">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <td>Image</td>
                                    <td>Name</td>
                                    <td>Quantity</td>
                                    <td class="text-end">Unit Price</td>
                                    <td class="text-end">Total</td>
                                  </tr>
                                </thead>
                                <tbody>
                                @if(count($order_row->cartItems)>0)
                                  @foreach($order_row->cartItems as $cartItems)
                                  @php
                                  	$product_info=Helpers::get_product($cartItems->product_id);
                                  @endphp
                                  
                                  <tr>
                                    <td>
                                      <div class="order-history-img"> 
                                        <span class="d-block"> 
                                          <img class="img-block" src="{{$product_info['photo']}}"> 
                                        </span> 
                                        </div>
                                    </td>
                                    <td>{{$product_info['item_name']}}</td>
                                    <td>{{$cartItems->qnty}}</td>
                                    <td class="text-end">${{$cartItems->price}}</td>
                                    <td class="text-end">${{$cartItems->grand_total}}</td>
                                  </tr>
                                   @endforeach
                                @endif
                                </tbody>
                                <tfoot class="text-nowrap">
                                  <tr>
                                    <td class="text-end" colspan="4"><strong>Total :</strong></td>
                                    <td class="text-end"><strong><span class="d-block">$ {{$order_row->gross_total}}</span></strong></td>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                          </td>
                        </tr>
                        @php $count++;@endphp
                        @endforeach
                          </tbody>
                        
                      </table>
                    </div>
                  </div>
                  @else
                  <div class="row">
                    <div class="col-12">
                      <div class="not-comments-wrap"> <i class="fa-solid fa-cart-shopping"></i>
                        <p>No order yet</p>
                      </div>
                    </div>
                  </div>
                  @endif </div>
              </div>
            </div>
            <div id="pane-D" class="card tab-pane fade {{ ($tab == 4) ? 'show active' : '' }}" role="tabpanel" aria-labelledby="tab-D">
              <div class="card-header" role="tab" id="heading-D">
                <h5 class="mb-0"> <a data-bs-toggle="collapse" href="#collapse-D" aria-expanded="true" aria-controls="collapse-D"> Booking History </a> </h5>
              </div>
              <div id="collapse-D" class="collapse when-mobile" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-D">
                <div class="card-body"> @if(count($table_booking_history)>0)
                  <div class="order-history-table">
                    <div class="table-responsive accordion accordion-flush" id="tablebookingaccordionFlushExample">
                      <table class="table">
                        <thead>
                        <th>#</th>
                          <th>Booking ID</th>
                          <th>Booking date</th>
                          <th>Booking Time</th>
                          <th>Resturent Name</th>   
                          <th>Total Guest</th>
                          <th>Status</th>
                          <th>Action</th>
                            </thead>
                        <tbody>
                        
                        @php $count=1;@endphp
                        @foreach($table_booking_history as $table_booking_row)
                        <tr>
                          <td>{{$count}}</td>
                          <td><button class="toggle-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-t{{$table_booking_row->id}}" aria-expanded="false" aria-controls="flush-collapse-t{{$table_booking_row->id}}"> <i class="fa-solid fa-chevron-down"></i> #{{$table_booking_row->booking_id}}</button></td>
                          <td>{{$table_booking_row->date_slot}}</td>
                          <td>{{$table_booking_row->time_slot}}</td>
                          <td>{{$table_booking_row->merchant->restaurant_name}}</td>
                          <td>{{$table_booking_row->total_person}}</td>
                          <td>@if($table_booking_row->status==1)<span class="label order-status bg-yellow">Pending</span> @elseif($table_booking_row->status==0)<span class="label order-status bg-red">Canceled</span>@else<span class="label order-status bg-success">Booked</span>@endif</td>
                          <td> @if($table_booking_row->status==1) <a href="javascript:;" class="btn btn-danger btn-sm request_cancel_booking" data-toggle="tooltip" title="Cancel booking" data-booking_id="{{$table_booking_row->id}}">Cancel booking</a> @endif </td>
                        </tr>
                        <tr>
                          <td colspan="7" class="details-wrap">
                            <div id="flush-collapse-t{{$table_booking_row->id}}" class="accordion-collapse collapse" aria-labelledby="flush-collapse-t{{$table_booking_row->id}}" data-bs-parent="#tablebookingaccordionFlushExample">
                              <div class="row justify-content-center">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="user-book-history">
                                    <h4>booking details</h4>
                                    <div class="booked-history-detls">
                                      <div class="booked-history-detls-lft">
                                        <div class="booked-history-detls-head">Total Guest</div>
                                      </div>
                                          <div class="booked-history-detls-rgt">
                                        <div class="booked-history-detls-dtls">: <span class="total-booked-person">{{$table_booking_row->total_person}} person</span></div>
                                      </div>
                                    </div>
                                    <div class="booked-history-detls">
                                      <div class="booked-history-detls-lft">
                                        <div class="booked-history-detls-head">Date</div>
                                      </div>
                                          <div class="booked-history-detls-rgt">
                                        <div class="booked-history-detls-dtls">: <span class="total-booked-person">{{$table_booking_row->date_slot}}</span></div>
                                      </div>
                                    </div>
                                    <div class="booked-history-detls">
                                      <div class="booked-history-detls-lft">
                                        <div class="booked-history-detls-head">Time</div>
                                      </div>
                                          <div class="booked-history-detls-rgt">
                                        <div class="booked-history-detls-dtls">: <span class="total-booked-person">{{$table_booking_row->time_slot}}</span></div>
                                      </div>
                                    </div>
                                    <div class="booked-history-detls">
                                      <div class="booked-history-detls-lft">
                                        <div class="booked-history-detls-head">Table name</div>
                                      </div>
                                          <div class="booked-history-detls-rgt">
                                        <div class="booked-history-detls-dtls">: <span class="total-booked-person">{{$table_booking_row->table->table_name}} </span></div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="user-book-history">
                                    <h4>User Details</h4>
                                    <div class="history-user-details-wrap">{{$table_booking_row->customer_name}}</div>
                                    <div class="history-user-details-wrap">{{$table_booking_row->email}}</div>
                                    <div class="history-user-details-wrap">{{$table_booking_row->phone}}</div>
                                  </div>
                                  <div class="user-book-history">
                                    <h4>Special Request</h4>
                                    <div class="history-user-details-wrap">{{$table_booking_row->special_note}}</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @php $count++;@endphp
                        @endforeach
                          </tbody>
                        
                      </table>
                    </div>
                  </div>
                  @else
                  <div class="row">
                    <div class="col-12">
                      <div class="not-comments-wrap"> <i class="fa-solid fa-cart-shopping"></i>
                        <p>No order yet</p>
                      </div>
                    </div>
                  </div>
                  @endif </div>
              </div>
            </div>
            <div id="pane-E" class="card tab-pane fade {{ ($tab == 5) ? 'show active' : '' }}" role="tabpanel" aria-labelledby="tab-E">
              <div class="card-header" role="tab" id="heading-E">
                <h5 class="mb-0"> <a data-bs-toggle="collapse" href="#collapse-E" aria-expanded="true" aria-controls="collapse-E"> credit cards </a> </h5>
              </div>
              <div id="collapse-E" class="collapse when-mobile" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-E">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="not-comments-wrap"> <i class="fa-regular fa-credit-card"></i>
                        <p>No credit cards yet</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--<div class="col-lg-3 col-md-4 col-sm-12 col-12">
        <div class="box-grey information-wrap" style="margin-top:0;">
          <div class="avatar-wrap"> <img src="{{$user_logo}}" class="avatar-img"> </div>
          <div class="center top10"> <a href="javascript:;" id="single_uploadfile" class="avatar-upload" data-progress="single_uploadfile_progress" data-preview="avatar-wrap" style="cursor: pointer;"> Browse </a> </div>
          <div class="single_uploadfile_progress"></div>
          <div class="text-center mt-2"> Update your profile picture </div>
          <div class="connected-wrap text-center">
            <div class="mytable web">
              
              
              <div class="mycol  col-12"> <span class="small">Connected as</span><br>
                <span class="bold">david121@gmail.com</span> </div>
              
            </div>
          </div>
          
          
        </div>
      </div>--> 
    </div>
  </div>
</section>
@push('scripts') 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.3.7/packaged/jquery.noty.packaged.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script> 
<script src="{{ asset('public/front/js/user.js/?t='.time()) }}"></script> 
<script>

</script> 
@endpush
@endsection