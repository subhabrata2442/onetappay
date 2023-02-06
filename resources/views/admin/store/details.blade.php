@extends('layouts.admin.adminLayout')
@section('dashboardContent') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $title or '' }}</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('administrator/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('administrator/store/list')}}">Store</a></li>
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
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="box box-primary">
                <div class="box-body box-profile w-100">
                  <div class="profileUserLeft text-center"> <img class="profile-user-img img-responsive" src="{{ Helpers::store_logo($store_info->logo) }}" alt="User profile picture"> </div>
                  <div class="profileUserRight w-100 mt-3">
                    <h3 class="profile-username text-center">{{$store_info->restaurant_name}}</h3>
                    <p class="text-muted text-center"></p>
                  </div>
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
                    <label for="inputName" class="col-sm-2 control-label">Store Name:</label>
                    <div class="col-sm-10">
                      <div class="box-top-des"><a href="{{$store_info->store_url}}" target="_blank">{{ $store_info->restaurant_name }}</a></div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 control-label">Address:</label>
                    <div class="col-sm-10">
                      <div class="box-top-des">{{$store_info->address}}</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 control-label">Delivery Fee:</label>
                    <div class="col-sm-10">
                      <div class="box-top-des">${{$store_info->free_delivery}}</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 control-label">Estimate Time:</label>
                    <div class="col-sm-10">
                      <div class="box-top-des">{{$store_info->delivery_estimation}}</div>
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
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Store Items List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="{{ route('store.items_upload') }}" class="needs-validation" id="items_upload-form" novalidate enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="upload-btn file-upload">
                      <label for="product_upload" class="custom-file-upload fileInfo file-drop">Upload </label>
                      <input id="product_upload_file" type="file" name="product_upload_file">
                      <input id="merchant_id" type="hidden" name="merchant_id" value="{{ $store_info->user_id }}">
                    </div>
                  </div>
                </div>
              </form>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped tableMd">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th>Date created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @php $i=1;@endphp
                  @foreach($item_list as $row)
                  @php
                  $logo=Helpers::item_logo($row->photo);
                  @endphp
                  <tr>
                    <td>{{ $i }}</td>
                    <td><img src="{{ $logo }}" style="width: 50px;"/></td>
                    <td>{{ $row->item_name }}</td>
                    <td>{{ $row->category->category_name }}</td>
                    <td>${{ $row->price }}</td>
                    <td>@if($row->status==1)<span class="label label-success">Active</span>@else<span class="label label-danger">In-active</span>@endif</td>
                    <td>{{ $row['created_at'] }}</td>
                    <td><a href="{{ route('store.show', $row->merchant_id)}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="View"><i class="fas fa-eye"></i></a> <a href="javascript:;" class="btn btn-danger btn-sm delete-icon" data-id="{{$row->merchant_id}}" data-toggle="tooltip" title="Remove"><i class=" fa fa-trash"></i></a></td>
                  </tr>
                  @php $i++;@endphp
                  @endforeach
                    </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div id="dialog-confirm" title="Confirmation" style="display: none;">
  <p>Are you sure you want to delete this permanently?</p>
</div>
@push('stylesheet')
@endpush
@push('scripts')
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
<script>
$(document).on('change','#items_upload-form',function(){
	$('form#items_upload-form').submit();
	//this.form.submit();
});
$(function () {
    $('#example1').DataTable()
  })
  
$(function() {
	$(document).on('click','.delete-icon',function(){
        var id = $(this).attr("data-id");
        $("#dialog-confirm").dialog({
            resizable: false,
            height: 200,
            width: 'auto',
            modal: true,
            buttons: {
                "Yes": function() {
                    $(this).dialog("close");
					//location.href = "<?=url('/administrator/user_delete?id=')?>" + id;
                    
                },
                No: function() {
                    $(this).dialog("close");
                }
            }
        });
    });
});  
  
</script> 
@endpush
@endsection 