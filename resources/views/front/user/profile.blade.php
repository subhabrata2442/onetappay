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
            <li class="nav-item"> <a id="tab-D" href="#pane-D" class="nav-link {{ ($tab == 4) ? 'active' : '' }}" data-bs-toggle="tab" role="tab">favorites</a> </li>
            <li class="nav-item"> <a id="tab-E" href="#pane-E" class="nav-link {{ ($tab == 5) ? 'active' : '' }}" data-bs-toggle="tab" role="tab">credit cards</a> </li>
            <!--<li class="nav-item"> <a id="" href="#" class="nav-link" data-bs-toggle="tab" role="tab">my points</a> </li>-->
          </ul>
          <div id="content" class="tab-content" role="tablist">
            <div id="pane-A" class="card tab-pane fade {{ ($tab == 1) ? 'show active' : '' }}" role="tabpanel" aria-labelledby="tab-A">
              <div class="card-header" role="tab" id="heading-A">
                <h5 class="mb-0"> <a data-bs-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A"> profile </a> </h5>
              </div>
              <div id="collapse-A" class="collapse show" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-A">
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
              <div id="collapse-B" class="collapse" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-B">
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
                        <td class=""><a href="javascript:;" class="delete_address_btn" data-id="{{$address->id}}"><i class="fa fa-times"></i></a></td>
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
              <div id="collapse-C" class="collapse" data-bs-parent="#content" role="tabpanel"
                                aria-labelledby="heading-C">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="not-comments-wrap"> <i class="fa-solid fa-cart-shopping"></i>
                        <p>No order yet</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="pane-D" class="card tab-pane fade {{ ($tab == 4) ? 'show active' : '' }}" role="tabpanel" aria-labelledby="tab-D">
              <div class="card-header" role="tab" id="heading-D">
                <h5 class="mb-0"> <a data-bs-toggle="collapse" href="#collapse-D" aria-expanded="true" aria-controls="collapse-D"> favorites </a> </h5>
              </div>
              <div id="collapse-D" class="collapse" data-bs-parent="#content" role="tabpanel"
                                aria-labelledby="heading-D">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="not-comments-wrap"> <i class="fa-regular fa-heart"></i>
                        <p>No favorites yet</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="pane-E" class="card tab-pane fade {{ ($tab == 5) ? 'show active' : '' }}" role="tabpanel" aria-labelledby="tab-E">
              <div class="card-header" role="tab" id="heading-E">
                <h5 class="mb-0"> <a data-bs-toggle="collapse" href="#collapse-E" aria-expanded="true" aria-controls="collapse-E"> credit cards </a> </h5>
              </div>
              <div id="collapse-E" class="collapse" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-E">
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