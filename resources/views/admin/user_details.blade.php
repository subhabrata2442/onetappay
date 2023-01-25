@extends('layouts.admin.adminLayout')

@section('dashboardContent') 

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $title or '' }}</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('administrator/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('administrator/user')}}">User</a></li>
            <li class="breadcrumb-item active">{{ $breadcumbs or 'No title'}}</li>
          </ol>
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container-fluid --> 
  </div>
  
  <!-- Content Header (Page header) -->
  
  <section class="content-header blance-page">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-between">
        <div class="col-12">
          <div class="d-flex align-items-center">
            <h1> {{ $title or '' }} : <small></small> </h1>
            <div class="balance-box-wrap d-flex align-items-center">
              <h3 class="mb-0">Balance</h3>
              <a><i class="fa fa-money"></i><i class="fa fa-inr"></i> {{$user_info['records']['balance']}}</a> </div>
          </div>
        </div>
        <!-- <div class="col-lg-auto col-md-auto col-12 d-flex justify-content-center">
          <ol class="breadcrumb">
            <li><a href="{{url('administrator/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:;">{{ $breadcumbs or 'No title'}}</a></li>
          </ol>
        </div> -->
      </div>
    </div>
    
    
  </section>
  
  <!-- Main content -->
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="box box-primary">
                <div class="box-body box-profile w-100">
                <div class="profileUserLeft text-center">
                  <img class="profile-user-img img-responsive img-circle" src="{{ asset('public/admin/dist/img/avatar04.png') }}" alt="User profile picture">
                </div>
                
                <div class="profileUserRight w-100 mt-3">
                  <h3 class="profile-username text-center">{{$user_info['records']['name']}}</h3>
                  <p class="text-muted text-center">{{$user_info['records']['email']}}</p>
                </div>
                  <!-- <ul class="list-group list-group-unbordered">
      
                      <li class="list-group-item">
      
                        <b>Balance</b> <a class="pull-right"><i class="fa fa-money"></i>${{$user_info['records']['balance']}}</a>
      
                      </li>
                    </ul> -->
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="col-md-9">
          <div class="nav-tabs-custom bdr-top">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <form class="">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 control-label">Name:</label>
                    <div class="col-sm-10">
                      <div class="box-top-des">{{$user_info['records']['name']}} </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 control-label">Email:</label>
                    <div class="col-sm-10">
                      <div class="box-top-des">{{$user_info['records']['email']}} </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 control-label">Phone:</label>
                    <div class="col-sm-10">
                      <div class="box-top-des">{{$user_info['records']['phone']}}</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 control-label">Password:</label>
                    <div class="col-sm-10">
                      <div class="box-top-des">{{$user_info['records']['raw_password']}}</div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@push('stylesheet')

@endpush

@push('scripts')  

@endpush

@endsection 