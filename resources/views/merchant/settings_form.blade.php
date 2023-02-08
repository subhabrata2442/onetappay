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
      {!! Form::open(['url' => 'merchant_admin/settings/save', 'class' => 'form_settings', 'id' => 'form_settings', 'files' => true, 'autocomplete' => 'off']) !!}
      <div class="card card-default">
        <div class="card-header with-border">
          <h3 class="card-title">Restaurant Information</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Restaurant name</label>
                <input type="text" name="restaurant_name" id="restaurant_name" class="form-control" placeholder="Restaurant name" value="{{$merchant_info->restaurant_name}}" required="required">
              </div>
              <div class="form-group">
                <label>Restaurant phone</label>
                <input type="text" name="restaurant_phone" id="restaurant_phone" class="form-control" placeholder="Restaurant phone" value="{{$merchant_info->restaurant_phone}}" required="required">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact name</label>
                <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Contact name" value="{{$merchant_info->contact_name}}" required="required">
              </div>
              <div class="form-group">
                <label>Contact phone</label>
                <input name="contact_phone" id="contact_phone" type="text" class="form-control" placeholder="Contact phone" value="{{$merchant_info->contact_phone}}" required="required">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact email</label>
                <input type="text" name="contact_email" id="contact_email" class="form-control" placeholder="Contact email" value="{{$merchant_info->contact_email}}" required="required">
              </div>
              <div class="form-group">
                <label>Delivery Distance Covered</label>
                <input type="text" name="delivery_distance_covered" id="delivery_distance_covered" class="form-control" placeholder="Delivery Distance Covered" value="{{$merchant_info->delivery_distance_covered}}" required="required">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Pick Up or Delivery?</label>
                <select class="form-control" data-validation="required" name="service" id="service">
                  <option value="1" {{ ( 1 == $merchant_info->merchant_type) ? 'selected' : '' }}>Delivery &amp; Pickup</option>
                  <option value="2" {{ ( 2 == $merchant_info->merchant_type) ? 'selected' : '' }}>Delivery Only</option>
                  <option value="3" {{ ( 3 == $merchant_info->merchant_type) ? 'selected' : '' }}>Pickup Only</option>
                  <option value="4" {{ ( 4 == $merchant_info->merchant_type) ? 'selected' : '' }}>Delivery / Pickup / Dinein</option>
                  <option value="5" {{ ( 5 == $merchant_info->merchant_type) ? 'selected' : '' }}>Delivery &amp; Dinein</option>
                  <option value="6" {{ ( 6 == $merchant_info->merchant_type) ? 'selected' : '' }}>Pickup &amp; Dinein</option>
                  <option value="7" {{ ( 7 == $merchant_info->merchant_type) ? 'selected' : '' }}>Dinein Only</option>
                </select>
              </div>
              <div class="form-group">
                <label>Distance unit</label>
                <select class="form-control" name="distance_unit" id="distance_unit" required="required">
                  <option value="mi" {{ ( 'mi' == $merchant_info->distance_unit) ? 'selected' : '' }}>Miles</option>
                  <option value="km" {{ ( 'km' == $merchant_info->distance_unit) ? 'selected' : '' }}>Kilometers</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-default">
        <div class="card-header with-border">
          <h3 class="card-title">Logo</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group"> <a href="javascript:;" class="preview fetch_image"id="thumb-image"><img src="{{ $thumb_logo ?? '' }}" alt="{{ $thumb_logo ?? '' }}" width="150px"></a>
                <input type="hidden" name="site_logo" value="{{ $logo ?? '' }}" id="input-image">
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
                <input type="text" name="username" id="username" class="form-control" placeholder="Email" value="{{$user_info->email}}" required="required" readonly="readonly">
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
                <input type="text" name="street" id="street" class="form-control" placeholder="Enter a location" value="{{$merchant_info->street}}" required="required">
                <input type="hidden" name="lat" id="lat" value="{{$merchant_info->latitude}}">
                <input type="hidden" name="lng" id="lng" value="{{$merchant_info->lontitude}}">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>City</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{$merchant_info->city}}" required="required">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Post code/Zip code</label>
                <input type="text" name="post_code" id="post_code" class="form-control" placeholder="Zip code" value="{{$merchant_info->post_code}}" required="required">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Country</label>
                <select class="form-control" name="country" id="country" required="required">
                 @foreach($countrie as $country)
                  <option value="{{$country->sortname}}"  {{ ( $country->sortname == $merchant_info->country_code) ? 'selected' : '' }}>{{$country->name}}</option>
                 @endforeach
                 
                  
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>State/Region</label>
                <input type="text" name="state" id="state" class="form-control" placeholder="Enter a location" value="{{$merchant_info->state}}" required="required">
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
<div style="display:none;"> {{ Form::open(['route' => ['merchant_logo.save'],'class' => 'form-image-upload','id' => 'form-image-upload','files' => true]) }}
  <input name="upload_photo" id="upload_photo" style="display:none" onchange="preview_image(this.files)" type="file">
  </form>
</div>
@push('stylesheet')
@endpush

@push('scripts')

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;libraries=places&amp;key=AIzaSyCBeYhfznD1X2nWYFXFpH6B4eJ9hGrr9_g"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script><script>

function fillInAddress() {
	var place = autocomplete.getPlace();
	
	$('#locality').val('');
	$('#state').val('');
	$('#country_code').val('');
	
	for (var i = 0; i < place.address_components.length; i++) {
		var addressType = place.address_components[i].types[0];
		/*if (componentForm[addressType]) {
		  var val = place.address_components[i][componentForm[addressType]];
		  document.getElementById(addressType).value = val;
		}*/
		if (addressType == "locality") {
			$('#locality').val(place.address_components[i][componentForm[addressType]]);
		}
		if (addressType == "administrative_area_level_1") {
			$('#state').val(place.address_components[i][componentForm[addressType]]);
		}
		if (addressType == "country") {
			$('#country_code').val(place.address_components[i].short_name);
		}
	}
}

var placeSearch, autocomplete;
var componentForm = {
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement}     */
    (document.getElementById('street')), {
     // types: ['(cities)']
    });

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  // Get Latitude and longitude
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var place = autocomplete.getPlace();
	$('#lat').val(place.geometry.location.lat());
	$('#lng').val(place.geometry.location.lng());
    fillInAddress();
  });
}
google.maps.event.addDomListener(window, 'load', initAutocomplete);





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
	/*$('#rules').summernote({
		height: 350
	});
	$('#add_balance_message').summernote({
		height: 350
	});*/
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
			password: {
				minlength: 8
			},
			password_confirm: {
				minlength: 8,
				equalTo: "#password"
			},
		},
		messages: {},
		submitHandler: function(form) {
			form.submit();
		}
	}).settings.ignore = [];
});
</script> 
@endpush
@endsection 