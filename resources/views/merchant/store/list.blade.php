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
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Store List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <!--<form method="post" action="{{ route('store.store_upload') }}" class="needs-validation" id="product_upload-form" novalidate enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="upload-btn file-upload">
                      <label for="product_upload" class="custom-file-upload fileInfo file-drop">Upload </label>
                      <input id="product_upload_file" type="file" name="product_upload_file">
                    </div>
                  </div>
                </div>
              </form>-->
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped tableMd">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Logo</th>
                      <th>Name</th>
                      <th>Country</th>
                      <th>City</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Date created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @php $i=1;@endphp
                  @foreach($store_list as $row)
                  @php
                  $logo=Helpers::store_logo($row->logo);
                  @endphp
                  <tr>
                    <td>{{ $i }}</td>
                    <td><img src="{{ $logo }}" style="width: 50px;"/></td>
                    <!--<td><a href="{{$row->store_url}}" target="_blank">{{ $row->restaurant_name }}</a></td>-->
                    <td>{{ $row->restaurant_name }}</td>
                    <td>{{ $row->country->name }}</td>
                    <td>{{ $row->city }}</td>
                    <td>{{ $row->address }}</td>
                    <td>@if($row->status=='active')<span class="label label-success">Active</span>@else<span class="label label-danger">In-active</span>@endif</td>
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
$(document).on('change','#product_upload-form',function(){
	$('form#product_upload-form').submit();
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
					location.href = "<?=url('/administrator/user_delete?id=')?>" + id;
                    
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