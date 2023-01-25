@extends('layouts.admin.merchantLayout')
@section('dashboardContent') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $title or '' }}</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('merchant_admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('merchant_admin/food/category')}}">Category</a></li>
            <li class="breadcrumb-item active">{{ $breadcumbs or 'No title'}}</li>
          </ol>
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container-fluid --> 
  </div>
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid"> @include('messages.flash_messages')
      <div class="card card-default"> {{Form::open(['route'=>['food.table.save'],'name'=>'table','id' =>'table-form','files'=>true])}}
        <input type="hidden" name="table_id" value="{{$data->id ?? ''}}" />
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="label">Table Name</label>
                <input type="text" class="form-control" id="table_name" name="table_name" placeholder="Enter Table Name" value="{{$data->table_name ?? ''}}">
              </div>
              <div class="form-group">
                <label for="label">Enter Seat</label>
                <input type="text" class="form-control" id="total_seat" name="total_seat" placeholder="Enter Seat" value="{{$data->total_seat ?? ''}}">
              </div>
              <div class="form-group">
                <label for="category">Table Description</label>
                <textarea class="form-control" id="table_description" name="table_description">{{$data->table_description ?? ''}}</textarea>
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                  <option value="">--Select Status--</option>
                  <option value="1" @php if(isset($data->status)){if($data->status==1){ echo 'selected="selected"';}} @endphp> Active </option>
                  <option value="0" @php if(isset($data->status)){if($data->status==0){ echo 'selected="selected"';}} @endphp echo> InActive </option>
                </select>
              </div>
            </div>
            
            <!-- /.col -->
            
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {{Form::close()}} </div>
    </div>
  </section>
</div>
@push('stylesheet')

@endpush
@push('scripts') 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
$(function() {
    $("#table-form").validate({
        errorElement: "span",
        rules: {
            table_name: "required",
			total_seat: "required",
            status: "required"
        },
        messages: {},
        errorElement: "em",
        errorPlacement: function(error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

</script> 
@endpush
@endsection 