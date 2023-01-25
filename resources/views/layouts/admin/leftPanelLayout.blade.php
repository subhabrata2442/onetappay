@php
$segment_1 = request()->segment(1);
$segment_2 = request()->segment(2);
$admin_type = Session::get('admin_type');
$merchant_type = Session::get('merchant_type');
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4"> <a href="index3.html" class="brand-link"> <img src="{{ asset('public/backoffice/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> <span class="brand-text font-weight-light">One Tab Pay</span> </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item"> <a href="{{ url('administrator/dashboard') }}" class="nav-link @if($active == 'dashboard') active @endif"> <i class="nav-icon fas fa-tachometer-alt"></i>
          <p> Dashboard </p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('administrator/store/list') }}" class="nav-link @if($active == 'store') active @endif"> <i class="nav-icon fas fa-solid fa-store"></i>
          <p> Manage Store</p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('administrator/settings') }}" class="nav-link @if($active == 'settings') active @endif"> <i class="nav-icon fas fa fa-cog"></i>
          <p> Settings</p>
          </a> </li>
      </ul>
    </nav>
  </div>
</aside>
