@php
    $auth       = Auth::user();
    $authUserId = $auth->id ?? '';
    $user_type 	= $auth->user_type ?? '';
    $userName = Session::get('userName') ?? '';
    $total_cart_item=isset($total_cart_item)?$total_cart_item:0;
    $total_cart_amount=isset($total_cart_amount)?$total_cart_amount:0;  
@endphp

<a class="scrollup" href="javascript:void(0);" aria-label="Scroll to top"><i class="fas fa-chevron-up"></i></a>
<header class="main-header start-style start-header">
  <div class="container-fluid left-right-gap">
    <div class="row align-items-center justify-content-between align-items-center">
      <div class="logo"> <a href="{{url('/')}}"> <img class="img-block" src="{{ asset('public/front/images/logo-white.png') }}" alt=""> </a> </div>
      <div class="col-auto d-flex">
        <div class="login-area d-flex justify-content-between align-items-center">
          <div class="login-area-lft"> @if(Auth::user() && $user_type==3)
            <ul class="d-flex login-menu-wrap align-items-center">
              <li><a href="{{url('/profile')}}" class="reg-nav user-profile"><i class="fa-solid fa-circle-user"></i>{{$userName}}</a></li>
              <li><a href="{{url('/logout')}}" class="reg-nav user-signout"><i class="fa-solid fa-right-from-bracket"></i>sign out</a></li>
              <li><a href="{{url('/merchant/signup')}}" class="reg-nav">Restaurant Signup</a></li>
            </ul>
            @else
            <ul class="d-flex login-menu-wrap align-items-center">
              <li><a href="{{url('/signup')}}"><i class="fa-solid fa-circle-user"></i>Login & Signup</a></li>
              <li><a href="{{url('/merchant/signup')}}" class="reg-nav">Restaurant Signup</a></li>
            </ul>
            @endif 
            
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
