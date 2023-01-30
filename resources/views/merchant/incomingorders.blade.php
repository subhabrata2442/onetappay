@extends('layouts.admin.merchantLayout')
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
            <li class="breadcrumb-item"><a href="{{url('merchant_admin/dashboard')}}">Home</a></li>
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
    <div class="container-fluid">@include('messages.flash_messages')
      <div class="alert alert-success alert-dismissible" id="alert-success" style="display:none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Success</h4>
        Successfuly update settings. </div>
      <div class="alert alert-danger alert-dismissible" id="alert-error" style="display:none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <p class="error_msg"></p>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card"> 
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped tableMd">
                  <thead>
                    <tr>
                      <th>Ref#</th>
                      <th>Customer Name</th>
                      <th>Total Item</th>
                      <th>Trans Type</th>
                      <th>Payment Type</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Action</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @php $i=1;@endphp
                  @foreach($order_list as $row)
                  <tr>
                    <td>{{ $row->order_id }}</td>
                    <td>{{ $row->customer_name }} </br>
                      {{ $row->customer_email }}</br>
                      {{ $row->customer_phone }}</td>
                    <td>{{$order_list[0]->cartItems->count()}}</td>
                    <td>Delivery</td>
                    <td>Stripe</td>
                    <td>{{ $row->gross_total }}</td>
                    <td>@if($row->status=='pending')<span class="label bg-yellow">Pending</span> @elseif($row->status=='cancel')<span class="label bg-red">Canceled</span>@else<span class="label bg-success">Accepted</span>@endif</td>
                    <td><a href="javascript:;" class="btn btn-success btn-sm edit_btn" data-toggle="tooltip" title="Edit" data-order_id="{{$row->order_id}}" data-status="{{$row->status}}"><i class="fa fa-edit"></i></a> <a href="javascript:;" class="btn btn-success btn-sm view_receipt_btn"  data-order_id="{{$row->order_id_token}}" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a></td>
                    <td>{{ $row->created_at }}</td>
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
<div class="example-modal">
  <div class="modal" id="set_order_status_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal-title">Change Order Status</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
        </div>
        {!! Form::open(['url'=>'merchant_admin/order/save', 'class'=>'result-form', 'id' =>'result-form', 'autocomplete' => 'off']) !!}
        <input type="hidden" id="order_id" name="order_id" value="">
        <div class="modal-body">
          <div class="form-group">
            <label for="" class="control-label">Status:</label>
            <select class="form-control" name="status" id="status" required="required">
              <option value="pending">Pending</option>
              <option value="cancel">Cancel</option>
              <option value="completed">Completed</option>
            </select>
          </div>
          <div class="form-group">
            <label for="" class="control-label">Remarks:</label>
            <textarea class="form-control" name="remarks" id="remarks"></textarea>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-save" >Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="example-modal">
  <div class="modal" id="order_details_modal">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal-title">Order Details</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive" id="order_details_section">
            
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
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
  
  
$(document).on('click','.edit_btn',function(){
	var order_id=$(this).data('order_id');
	var status=$(this).data('status');
	
	$('#order_id').val(order_id);
	$('#status').val(status);
	
	$('#set_order_status_modal').modal('show');
}); 

$(document).on('click', '.view_receipt_btn', function() {
    var order_id = $(this).data('order_id');
    $.ajax({
        url: prop.ajaxurl,
        type: "post",
		dataType: "json",
        data: {
            order_id: order_id,
            action: 'view_receipt',
            _token: prop.csrf_token
        },
        beforeSend: function() {},
        success: function(response) {
			$('#order_details_section').html(response.html);
			$('#order_details_modal').modal('show');
		},
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});


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
					location.href = "<?=url('/merchant_admin/food/table/delete?id=')?>" + id;
                    
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