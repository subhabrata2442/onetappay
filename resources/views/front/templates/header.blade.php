@php
    $auth       = Auth::user();
    $authUserId = $auth->id ?? '';
    $user_type 	= $auth->user_type ?? '';
    $userName 	= Session::get('userName') ?? '';
    $total_cart_item=isset($total_cart_item)?$total_cart_item:0;
    $total_cart_amount=isset($total_cart_amount)?$total_cart_amount:0;  
@endphp 

<a class="scrollup" href="javascript:void(0);" aria-label="Scroll to top"><i class="fas fa-chevron-up"></i></a>
<header class="main-header start-style start-header white-header">
  <div class="container-fluid left-right-gap">
    <div class="row align-items-center justify-content-between align-items-center">
      <div class="logo"> <a href="{{url('/')}}"> <img class="img-block" src="{{ asset('public/front/images/logo-color.png')}}" alt=""> </a> </div>
      <div class="header-search-bar scr_mob_slide col">
        <div class="header-search-bar-box"> {!! Form::open(['url'=>'/searcharea', 'class'=>'validate-form', 'id' => 'location-form', 'autocomplete' => 'off', 'method'=>'GET']) !!}
          <div class="row g-0">
            <div class="search-bar-lft">
              <div class="header-src">
                <div class="position-relative">
                  <input type="text" class="form-control input-style-hdr search-restaurent" placeholder="Search Restaurent" name="restaurent" value="{{$restaurent}}">
                  <button type="submit" class="hdr-src-icon"><i class="fa-solid fa-magnifying-glass"></i></button>
                  <div id="suggesstion-restaurent-box"></div>
                </div>
              </div>
            </div>
            <div class="search-bar-rgt">
              <div class="header-location-src"> 
                <!-- <select class="form-control selectOption_1">
                  <option value="" disabled="disabled">Select City</option>
                  <option value="Winnipeg" {{ $city == 'Winnipeg'  ? 'selected' : ''}} >Winnipeg</option>
                  <option value="Vancouver" {{ $city == 'Vancouver'  ? 'selected' : ''}}>Vancouver</option>
                </select>-->
                <input type="text" class="form-control input-style-bnr" placeholder="Enter delivery address" id="location-input" name="location" value="{{$location}}">
              </div>
              <span class="location-icon"> <i class="fa-solid fa-location-dot"></i> </span> </div>
          </div>
          {!! Form::close() !!} </div>
      </div>
      <div class="col-auto d-flex">
        <div class="login-area d-flex justify-content-between align-items-center">
          <div class="login-area-lft">
            <ul class="d-flex login-menu-wrap align-items-center">
              <li class="show-mobile"><a href="javascript:;" class="scr_mob"><i class="fa-solid fa-magnifying-glass"></i><span class="mob-none">Search</span></a></li>
              <li class="header-login-mobile"> 
                <button type="button" class="header-menu-mobile d-none"><i class="fa-solid fa-user"></i></button>
                @if(Auth::user() && $user_type==3)
                <ul class="user-after-login d-flex align-items-center">
                  <li><a href="{{url('/profile')}}" class="reg-nav user-profile"><i class="fa-solid fa-circle-user"></i>{{$userName}}</a></li>
                  <li><a href="{{url('/logout')}}" class="reg-nav user-signout"><i class="fa-solid fa-right-from-bracket"></i>sign out</a></li>
                </ul>
                @else
                <ul class="user-before-login d-flex align-items-center">
                  <li><a href="{{url('/signup')}}"><i class="fa-solid fa-circle-user"></i>Login & Signup</a></li>
                  <li><a href="{{url('/merchant/signup')}}" class="reg-nav">Restaurant Signup</a></li>
                </ul>
                @endif </li>
              <li class="hover-dropdown"> <a href="javascript:;" class="reg-nav position-reletive"><i class="fa-solid fa-basket-shopping"></i><span class="mob-none">cart</span> <span class="order-count total_cart_item_blink" @php if($total_cart_item == 0){ echo 'style="display:none"'; } @endphp>{{$total_cart_item}}</span> </a>
                <div class="product-droplist hover-dropdown-list">
                  <div class="row justify-content-between align-items-center mb-2">
                    <div class="col-auto">
                      <div class="basket-item-total basket_total_item">{{$total_cart_item}} iteam in basket</div>
                    </div>
                    <div class="col-auto">
                      <div class="basket-item-price basket_total_amount">${{$total_cart_amount}}</div>
                    </div>
                  </div>
                  <div class="basket-product-list-wrap basket-items-sec"> 
                    <!--<div class="no-cart">
                      <i class="fa-solid fa-cart-shopping"></i>
                      <p>Your basket is empty</p>
                    </div>-->
                    <!--<div class="basket-product-list d-flex">
                      <div class="basket-product-list-lft">
                        <div class="basket-product-list-img"> <a href="#"> <img class="img-block" src="https://onetabpay.aqualeafitsol.com/public/front/images/first-order/first-order1.jpg" alt=""> </a> </div>
                      </div>
                      <div class="basket-product-list-rgt">
                        <div class="basket-product-list-text">
                          <h4><a href="#">White Premium Italian Paper Carrier Bags with Twisted Handles</a> </h4>
                          <p>Pack Size: 500. Dimensions: 15cm x 20cm + 8cm</p>
                          <div class="row justify-content-between align-items-center mt-2">
                            <div class="col-auto">
                              <div class="basket-qty-price d-flex">
                                <div class="basket-qty-price-lft">Qty : 2</div>
                              </div>
                            </div>
                            <div class="col-auto">
                              <div class="basket-qty-price d-flex">
                                <div class="basket-qty-price-lft">Price :</div>
                                <div class="basket-qty-price-rgt">$67.65</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>--> 
                    <!--<div class="basket-product-list d-flex">
                      <div class="basket-product-list-lft">
                        <div class="basket-product-list-img"> <a href="#"> <img class="img-block" src="https://onetabpay.aqualeafitsol.com/public/front/images/first-order/first-order1.jpg" alt=""> </a> </div>
                      </div>
                      <div class="basket-product-list-rgt">
                        <div class="basket-product-list-text">
                          <h4><a href="#">White Premium Italian Paper Carrier Bags with Twisted Handles</a> </h4>
                          <p>Pack Size: 500. Dimensions: 15cm x 20cm + 8cm</p>
                          <div class="row justify-content-between align-items-center mt-2">
                            <div class="col-auto">
                              <div class="basket-qty-price d-flex">
                                <div class="basket-qty-price-lft">Qty : 2</div>
                              </div>
                            </div>
                            <div class="col-auto">
                              <div class="basket-qty-price d-flex">
                                <div class="basket-qty-price-lft">Price :</div>
                                <div class="basket-qty-price-rgt">$67.65</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>--> 
                  </div>
                  @if($total_cart_item>0)
                  <div class="basket-view basket-check-view"> <a href="{{url('/checkout')}}" class="basket-view-btn">Check Out</a> </div>
                  @endif
                </div>
              </li>
            </ul>
            <!-- Only After login --> 
            <!-- <div class="after-login-wrap position-relative">
                                <div class="after-login d-flex align-items-center">
                                    <span class="user-img">
                                        <img class="img-block" src="images/avatar.jpg" alt="">
                                    </span>
                                    <h5>Michel Smith</h5>
                                    <span class="after-login-icon"><i class="fas fa-angle-down"></i></span>
                                </div>
                                <div class="after-login-menu-wrap">
                                    <ul>
                                        <li><a href="#">dashboard</a></li>
                                        <li><a href="#">logout</a></li>
                                    </ul>
                                </div>
                            </div> --> 
          </div>
        </div>
        <div class="small-menu-area">
          <div class="side-menu-close d-flex flex-column align-items-center justify-content-center"> <span></span> <span></span> <span></span> </div>
        </div>
      </div>
    </div>
  </div>
</header>
