<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title or 'No title'}}</title>

{{-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet"> --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('public/backoffice/plugins/fontawesome-free/css/all.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('public/backoffice/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/backoffice/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/backoffice/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/backoffice/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/backoffice/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/backoffice/dist/css/custom.css') }}">
<link href="{{ asset('public/backoffice/plugins/tokeninput/token-input.css') }}" rel="stylesheet" type="text/css">

</head>
<script>
 var base_url = "{{url('/')}}";
 var csrf_token = "{{csrf_token()}}";
 var prop = <?php echo json_encode(array('url'=>url('/'), 'ajaxurl' => url('/ajaxpost'),  'csrf_token'=>csrf_token()));?>;
</script>



<!--<body class="hold-transition sidebar-mini layout-fixed">-->
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper"> 
  
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center"> <img class="animation__wobble" src="{{ asset('public/backoffice/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60"> </div>
  
  <!-- Navbar --> 
  <!--<nav class="main-header navbar navbar-expand navbar-white navbar-light">-->
  <nav class="main-header navbar navbar-expand navbar-dark"> 
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> </li>
      <li class="nav-item d-none d-sm-inline-block"> <a href="{{url('/')}}" class="nav-link">Home</a> </li>
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item"> <a class="nav-link" href="{{url('merchant-logout')}}"> <i class="fas fa-power-off"></i> </a> </li>
    </ul>
  </nav>
  <!-- /.navbar --> 
  
  <!-- Main Sidebar Container --> 
  
  @include('layouts.admin.merchantleftPanelLayout')
  
  @yield('dashboardContent')
  <aside class="control-sidebar control-sidebar-dark"> 
    <!-- Control sidebar content goes here --> 
  </aside>
  <!-- /.control-sidebar --> 
  
  <!-- Main Footer -->
  <footer class="main-footer"> <strong>Copyright &copy; 2014-2021 <a href="javascript:;">tour.in</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block"> <b>Version</b> 3.1.0 </div>
  </footer>
</div>
<!-- ./wrapper -->

<div class="loader-bg">
  <div class="loader"></div>
</div>






<!-- REQUIRED SCRIPTS --> 
<!-- jQuery --> 
<script src="{{ asset('public/backoffice/plugins/jquery/jquery.min.js') }}"></script> 
<!-- Bootstrap --> 
<script src="{{ asset('public/backoffice/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 

<!-- DataTables  & Plugins --> 
<script src="{{ asset('public/backoffice/plugins/datatables/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/jszip/jszip.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/pdfmake/pdfmake.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/pdfmake/vfs_fonts.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> 

<!-- overlayScrollbars --> 
<script src="{{ asset('public/backoffice/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> 
<!-- AdminLTE App --> 
<script src="{{ asset('public/backoffice/dist/js/adminlte.js') }}"></script> 

<!-- bs-custom-file-input --> 
<script src="{{ asset('public/backoffice/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script> 
<!-- AdminLTE App --> 

<!-- PAGE PLUGINS --> 
<!-- jQuery Mapael --> 
<script src="{{ asset('public/backoffice/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/raphael/raphael.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script> 
<script src="{{ asset('public/backoffice/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script> 
<!-- ChartJS --> 
<script src="{{ asset('public/backoffice/plugins/chart.js/Chart.min.js') }}"></script> 
<script type="text/jscript" src="{{ asset('public/backoffice/plugins/tokeninput/jquery.tokeninput.js') }}"></script>

<!-- AdminLTE for demo purposes --> 
<script src="{{ asset('public/backoffice/dist/js/demo.js') }}"></script> 
<!-- AdminLTE dashboard demo (This is only for demo purposes) --> 
<!--<script src="{{ asset('public/backoffice/dist/js/pages/dashboard2.js') }}"></script>--> 

<script>

$(window).on('load', function() {
 $('.os-content').attr('style','padding: 0px 8px 0px 0px; height: 100%; width: 100%;');
});
</script>
@stack('scripts')
</body>
</html>
