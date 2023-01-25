@extends('layouts.admin.adminLayout')
@section('dashboardContent')
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('administrator')}}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container-fluid --> 
  </div>
  <!-- /.content-header --> 
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6"> 
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$total_store}}</h3>
              <p>Store</p>
            </div>
            <div class="icon"> <i class="ion ion-bag"></i> </div>
            <a href="{{url('administrator/store/list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> </div>
        </div>
        <!-- ./col -->
        <!--<div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>0</h3>
              <p>Withdraw Request</p>
            </div>
            <div class="icon"> <i class="ion ion-stats-bars"></i> </div>
            <a href="{{url('administrator/withdraw_request')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> </div>
        </div>-->
        <!-- ./col -->
        <!--<div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>0</h3>
              <p>Balance Request</p>
            </div>
            <div class="icon"> <i class="ion ion-person-add"></i> </div>
            <a href="{{url('administrator/balance_request')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> </div>
        </div>-->
        <!-- ./col -->
        <!--<div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>0</h3>
              <p>Total Wallet Balance</p>
            </div>
            <div class="icon"> <i class="ion ion-pie-graph"></i> </div>
            <a href="{{url('administrator/user?type=wallet')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> </div>
        </div>-->
        <!-- ./col --> 
        
      </div>
    </div>
    <!-- /.container-fluid --> 
  </section>
  <!-- /.content --> 
</div>
@push('stylesheet') 
@endpush
@push('scripts')
@endpush
@endsection 