@extends('layouts.admin.merchantLayout')
@section('dashboardContent') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $title or '' }}</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('administrator/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $breadcumbs or 'No title' }}</li>
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
      <div class="alert alert-success alert-dismissible" id="alert-success" style="display:none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Success</h4>
        Successfuly update settings. </div>
      <div class="alert alert-danger alert-dismissible" id="alert-error" style="display:none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <p class="error_msg"></p>
      </div>
      {!! Form::open(['url' => 'administrator/settings/save', 'class' => 'form_settings', 'id' => 'form_settings', 'files' => true, 'autocomplete' => 'off']) !!}
      <div class="card card-default">
        <div class="card-header with-border">
          <h3 class="card-title">Restaurant Information</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Restaurant name</label>
                <input type="text" name="restaurant_name" id="restaurant_name" class="form-control" placeholder="Restaurant name" value="{{$merchant_info->restaurant_name}}">
              </div>
              <div class="form-group">
                <label>Restaurant phone</label>
                <input type="text" name="restaurant_phone" id="restaurant_phone" class="form-control" placeholder="Restaurant phone" value="{{$merchant_info->restaurant_phone}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact name</label>
                <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Contact name" value="{{$merchant_info->contact_name}}">
              </div>
              <div class="form-group">
                <label>Contact phone</label>
                <input name="contact_phone" id="contact_phone" type="text" class="form-control" placeholder="Contact phone" value="{{$merchant_info->contact_phone}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact email</label>
                <input type="text" name="contact_email" id="contact_email" class="form-control" placeholder="Contact email" value="{{$merchant_info->contact_email}}">
              </div>
              <div class="form-group">
                <label>Delivery Distance Covered</label>
                <input type="text" name="delivery_distance_covered" id="delivery_distance_covered" class="form-control" placeholder="Delivery Distance Covered" value="{{$merchant_info->delivery_distance_covered}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Pick Up or Delivery?</label>
                <select class="form-control" data-validation="required" name="service" id="service">
                  <option value="1">Delivery &amp; Pickup</option>
                  <option value="2">Delivery Only</option>
                  <option value="3">Pickup Only</option>
                  <option value="4">Delivery / Pickup / Dinein</option>
                  <option value="5">Delivery &amp; Dinein</option>
                  <option value="6">Pickup &amp; Dinein</option>
                  <option value="7">Dinein Only</option>
                </select>
              </div>
              <div class="form-group">
                <label>Distance unit</label>
                <select class="form-control" name="distance_unit" id="distance_unit">
                  <option value="mi" {{ ( 'mi' == $merchant_info->distance_unit) ? 'selected' : '' }}>Miles</option>
                  <option value="km"> {{ ( 'km' == $merchant_info->distance_unit) ? 'selected' : '' }}Kilometers</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-default">
        <div class="card-header with-border">
          <h3 class="card-title">Login Information</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Email" value="{{$user_info->email}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="cc-number">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-default">
        <div class="card-header with-border">
          <h3 class="card-title">Google Map</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Street address</label>
                <input type="text" name="street" id="street" class="form-control" placeholder="Enter a location" value="{{$merchant_info->street}}">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>City</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{$merchant_info->city}}">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Post code/Zip code</label>
                <input type="text" name="post_code" id="post_code" class="form-control" placeholder="Zip code" value="{{$merchant_info->post_code}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Country</label>
                <select class="form-control" name="country" id="country">
                 @foreach($countrie as $country)
                  <option value="{{$country->sortname}}"  {{ ( $country->sortname == $merchant_info->country_code) ? 'selected' : '' }}>{{$country->name}}</option>
                 @endforeach
                 
                  
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>State/Region</label>
                <input type="text" name="state" id="state" class="form-control" placeholder="Enter a location" value="{{$merchant_info->state}}">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
      </div>
      {!! Form::close() !!} </div>
  </section>
</div>
<div style="display:none;"> {{ Form::open(['route' => ['logo.save'],'class' => 'form-image-upload','id' => 'form-image-upload','files' => true]) }}
  <input name="upload_photo" id="upload_photo" style="display:none" onchange="preview_image(this.files)" type="file">
  </form>
</div>
@push('stylesheet')
@endpush

@push('scripts') 

<!-- summernote -->
<link rel="stylesheet" href="{{ asset('public/front/plugins/summernote/summernote-bs4.min.css') }}">
<!-- Summernote --> 
<script src="{{ asset('public/front/plugins/summernote/summernote-bs4.min.js') }}"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
$(document).on('click', '.fetch_image', function(e) {
$('#upload_photo').click();
});

function preview_image(files) {
input = document.getElementById('upload_photo');
var files = !!input.files ? input.files : [];
if (!files.length || !window.FileReader) return;
if (/^image/.test(files[0].type)) {
	var reader = new FileReader(); // instance of the FileReader
	reader.readAsDataURL(files[0]); // read the local file
	reader.onloadend = function() { // set image data as background of div
		$("#form-image-upload").submit()
		//$("#view_image_"+index).attr("src",this.result);
		//$("#thumb-image").find('img').attr('src', this.result).css("height", "150px").css("height", "150px");;
	}
}
}
$(document).ready(function() {
	$('#form-image-upload').submit(function(evt) {
		evt.preventDefault();
		var formData = new FormData(this);
		if ($('input[name=\'upload_photo\']').val() != '') {
			var upload_photo_id = $('#upload_photo_id').val();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				beforeSend: function() {
					$('.loader-bg').fadeIn();
				},
				complete: function() {
					$('.loader-bg').fadeOut();
					$('#form-image-upload')[0].reset();
				},
				success: function(json) {
					;
					if (json[0].success == 1) {
						$("#thumb-image").find('img').attr('src', json[0].image_path);
						$("#input-image").val(json[0].file_name);
						//$('#button-clear').show();
					} else {
						alert(json[0].error_message);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	});
});
</script> 
<script>
$(function() {
	$('#rules').summernote({
		height: 350
	});
	$('#add_balance_message').summernote({
		height: 350
	});
});

$(function() {
	$("#form_settings").validate({
		errorElement: "span",
		highlight: function(element, errorClass, validClass) {
			if ($(element).is('select')) {
				$(element).closest("label.selectBox").addClass("error").removeClass("success");
			} else {
				$(element).addClass("error").removeClass("success");
			}
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).closest(".error").removeClass("error").addClass("success");
		},
		invalidHandler: function(form, validator) {
			$("#err_report").show();
			$("#err_report").html("Few required fields are missing");
		},
		rules: {
			site_title: "required",
			email: "required",
			whatsapp: "required",
			phone: "required",
			copyright: "required",
			admin_name: {
				required: true,
			},
			admin_email: {
				required: true,
			},
			password: {
				minlength: 8
			},
			password_confirm: {
				minlength: 8,
				equalTo: "#password"
			},
		},
		messages: {
			site_title: "Please enter a site title",
			phone: "Please enter a site phone no.",
			copyright: "Please enter a copyright.",
			email: "Please enter admin email",
		},
		submitHandler: function(form) {
			form.submit();
		}
	}).settings.ignore = [];
});
</script> 
@endpush
@endsection 