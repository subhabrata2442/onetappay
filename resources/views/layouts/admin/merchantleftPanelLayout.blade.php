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
        <li class="nav-item"> <a href="{{ url('merchant_admin/dashboard') }}" class="nav-link @if($active == 'dashboard') active @endif"> <i class="nav-icon fas fa-tachometer-alt"></i>
          <p> Dashboard </p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('merchant_admin/merchant') }}" class="nav-link @if($active == 'merchant') active @endif"> <i class="nav-icon fas fa-utensils"></i>
          <p> Merchant Info </p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('merchant_admin/food/table') }}" class="nav-link @if($active == 'table') active @endif"> <i class="nav-icon fa fa-list-alt"></i>
          <p> Manage Table</p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('merchant_admin/food/table_booking') }}" class="nav-link @if($active == 'table_booking') active @endif"> <i class="nav-icon fa fa-list-alt"></i>
          <p> Manage Table Booking</p>
          </a> </li>
          
          <li class="nav-item"> <a href="{{ url('merchant_admin/incomingorders') }}" class="nav-link @if($active == 'incomingorders') active @endif"> <i class="nav-icon fa fa-list-alt"></i>
          <p> All Orders </p>
          </a> </li>
          
          
        
          
          
        <li class="nav-item"> <a href="{{ url('merchant_admin/food/category') }}" class="nav-link @if($active == 'category') active @endif"> <i class="nav-icon fa fa-list-alt"></i>
          <p> Manage Category</p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('merchant_admin/food/addon_category') }}" class="nav-link @if($active == 'addon_category') active @endif"> <i class="nav-icon fa fa-list-alt"></i>
          <p> Manage Addon Category</p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('merchant_admin/food/addon_items') }}" class="nav-link @if($active == 'addon_items') active @endif"> <i class="nav-icon fas fa-pizza-slice"></i>
          <p> Manage Addon Items</p>
          </a> </li>
        <li class="nav-item"> <a href="{{ url('merchant_admin/food/items') }}" class="nav-link @if($active == 'items') active @endif"> <i class="nav-icon fas fa-hamburger"></i>
          <p> Manage Items</p>
          </a> </li>
        
        <!--<li class="nav-item"> <a href="{{ url('administrator/settings') }}" class="nav-link @if($active == 'settings') active @endif"> <i class="nav-icon fas fa fa-cog"></i>
          <p> Settings</p>
          </a> </li>-->
      </ul>
    </nav>
  </div>
</aside>
