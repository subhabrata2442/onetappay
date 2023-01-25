@php
    $auth       = Auth::user();
    $authUserId = $auth->id ?? '';
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
              <li class="show-mobile"><a href="javascript:;" class="scr_mob"><i class="fa-solid fa-magnifying-glass"></i>Search</a></li>
              @if(Auth::user())
              
              @else
              <li><a href="#"><i class="fa-solid fa-circle-user"></i>login</a></li>
              <li><a href="javascript:;" class="reg-nav">sign up</a></li>
              @endif
              <li><a href="{{url('/merchant/signup')}}" class="reg-nav">Restaurant Signup</a></li>
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
