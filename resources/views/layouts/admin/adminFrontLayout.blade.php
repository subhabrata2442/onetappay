<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="html5, html 5, video, audio, html5video, html 5 video, html 5 audio, flash, h.264, h264, mp4, mp3, wav, aac, web, internet"/>
<title>{{ $title ?? 'No title'}}</title>

<!--<link rel="shortcut icon" href="images/fav-icon.ico">-->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
<!-- <link href="{{ asset('public/fonts/stylesheet2.css') }}" rel="stylesheet" type="text/css"> -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin2/css/font-awesome.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin2/themify/themify-icons.css') }}"/>
<link href="{{ asset('public/admin2/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/admin2/css/build.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('public/admin2/css/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin2/css/tabs.css') }}">
@stack('stylesheet')
<link href="{{ asset('public/admin2/css/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/admin2/css/media.css') }}" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head><body>
<header>
  <div class="topHeader full"> @php /*$settings = App\Common::listingData(['status'=>'1'],'site_settings',['meta_key','meta_value'],'id','ASC');*/@endphp
    <div class="container">
      <div class="row">
        <div class="autowidthR mLeft">
          <div class="logPerson autowidthL"> @php 
            $userId = Session::get('id');
            $userName = Session::get('userName');
            $userFirstName = Session::get('userFirstName');
            @endphp
            <ul>
              @if(!empty($userId))
              <li><a href="{{ url('dashboard') }}">Hi, {{ $userFirstName->parent_first_name ?? '' }}</a></li>
              <li><a href="{{url('logout')}}">Logout <i class="fa fa-power-off"></i></a></li>
              @endif
            </ul>
          </div>
          @php 
          $userId = Session::get('id');
          $userName = Session::get('userName');
          @endphp </div>
      </div>
    </div>
  </div>
</header>
@yield('mainContent')
<!--<footer class="full">
  <div class="container-fluid p-h-40">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="footerBox full">
          <p>Copyright © 2017-2018. All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
</footer>-->

<!-- Modal -->
<div id="myModal2" class="modal fade cusModal" role="dialog">
  <div class="modal-dialog modal-sm"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Enter your vreification code</h5>
      </div>
      <div class="modal-body text-center bDrTop m_t_15 p-t-15">
        <p>A verification code was sent via email to <strong class="uEmail">info@gmail.com</strong>. When you receive the code enter it below</p>
        <div class="lightbg2 p15 full text-left m-b-15">
          <div class="form-group full relative noMargin">
            <label for=""><strong>OTP</strong></label>
            <input type="text" name="otpValidate" class="form-control textBox otpValidate" id="otpValidate">
            <button type="submit" class="commonBtn ok validateOtp">OK</button>
          </div>
          <span class="tryAgain"></span> </div>
        <button type="submit" class="commonBtn radius5 pre btn-sm resend">resend</button>
        <div class="clearfix"></div>
        <span class="sendAgain"></span>
        <div class="full m-t-15">
          <h6>Didn't receive the email?</h6>
          <p>sometimes automatad messages get categorised as spam. Check your spam folder.</p>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="myModal1" class="modal fade cusModal" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body text-center p-b-30">
        <h2>Thank you for join with us</h2>
        <!-- <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> -->
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<!-- Error Modal -->
<div id="errorModal" class="modal fade cusModal errorModal" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body text-center p-b-30">
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<div id="valErrorModal" class="modal fade cusModal valErrorModal" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body text-center p-b-30">
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/jscript" src="{{ asset('public/js/jquery-2.1.4.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js') }}"></script> 
<script type="text/javascript">
      var width = window.innerHeight;
      var header= $("header").height();
      var maxHeight= header + width + 150;
      var bodyHeight = $(document).height();
      var h=document.documentElement.scrollHeight;

      if(bodyHeight>=maxHeight){
         $(window).scroll(function() {
            if ($(this).scrollTop() >50){  
              $('header').addClass("sticky");
            }
            else{
              $('header').removeClass("sticky");
            }
          });
      } 
    </script> 
<script type="text/javascript">
$(document).ready(function(){
	$(".rightnav").click(function(){
    	$(".lpart").toggleClass("slideout");
		$("body").addClass("noscroll");
	});
	
	$(".closenav").click(function(){
    	$(".lpart").removeClass("slideout");
		$("body").removeClass("noscroll");
		
	});

//  $("#menu_res").click(function(){
//   $("#res_nav").toggleClass('left0');
//  });
});
</script> 
<script type="text/javascript">
$(document).ready(function(e) {
  var ico = $('<span></span>');
   $('li.sub_menu_open').append(ico);
  
 $("#menu_res").click(function(){
   $("#res_nav").toggleClass('left0');
  });
  
 $('li span').on("click",function(e){
    if ($(this).hasClass('open')){
     
    $(this).prev('ul').slideUp(300, function(){});
    
     } else {
    $(this).prev('ul').slideDown(300, function(){});
     }
     $(this).toggleClass("open");
  });
  $('#menu_res').click(function (){
   $(this).toggleClass('menu_responsiveTo')
  });
});
</script> 
<script type="text/javascript">
$(document).ready(function(){
	
	$('.itemBtn').click(function(){
		var tgid = $(this).attr('tgid');
		$('.mainSection').fadeOut();
		$('.showHideArea').fadeOut();
		$('.showHideArea.' + tgid).fadeIn();
	});
	
	$('.bck2main').click(function(){
		$('.mainSection').fadeIn();
		$('.showHideArea').fadeOut();
	});
	
	$('.ShowFilterBtn').click(function(){
		$('.filterArea').slideToggle();
	});
	
});
</script> 
<script>
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
function validateEmail(userEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(userEmail)) {
        return true;
    }
    else {
        return false;
    }
}
function displayModal(errorMsgTerms = ''){
  $('.valErrorModal').on('show.bs.modal', function(event) {  
    var modal = $(this);
    var errorTxt = errorMsgTerms;
    modal.find('.modal-body').html(errorTxt);
  });
  $('.valErrorModal').modal('show'); 
}
 $(document).ready(function(){
      //Remove flash message
        setTimeout(function() {
            $('#valErrorModal').modal('hide');
        }, 5000); // <-- time in milliseconds
      });
</script> 
@stack('scripts')
<div class="clearfix"></div>
</body>
</html>