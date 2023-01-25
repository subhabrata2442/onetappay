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
            <li class="breadcrumb-item"><a href="{{url('merchant_admin/food/items')}}">Items</a></li>
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
      <div class="card card-default"> {{Form::open(['route'=>['food.items.save'],'name'=>'items','id' =>'items-form','files'=>true])}}
        <input type="hidden" name="item_id" value="{{$data->item_id ?? ''}}" />
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="label">Food Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter Item Name" value="{{$data->item_name ?? ''}}">
              </div>
              <div class="form-group">
                <label for="category">Description</label>
                <textarea class="form-control" id="description" name="description">{{$data->item_description ?? ''}}</textarea>
              </div>
              <div class="form-group">
                <label>Food Category:</label>
                <select class="form-control" name="category_id" id="category_id">
                  <option value="">--Select Category--</option>
                  
                  
                  @foreach($category_list as $row)
                  
                  
                  <option value="{{$row->cat_id}}" @php if(isset($data->status)){if($data->category_id==$row->cat_id){ echo 'selected="selected"';}} @endphp> {{$row->category_name}} </option>
                  
                  
                  @endforeach
                  
                
                
                </select>
                
                <!-- /.input group --> 
              </div>
              
              <div class="form-group">
                <label>Price:</label>
                <div class="input-group">
                  <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span> </div>
                  <input type="text" name="price" id="price" class="form-control" value="{{$data->price ?? ''}}">
                </div>
                <!-- /.input group --> 
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
            <div class="col-md-4">
              <div class="form-group">
                <label for="category">Category Image</label>
                <div class="col-auto"> <a href="javascript:;" class="preview fetch_image" id="thumb-image"><img src="{{ $item_thumb ??  ''}}" alt="{{ $item_thumb ?? ''}}" width="150px"></a>
                  <input type="hidden" name="image" value="{{$data->photo ?? ''}}" id="input-image">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {{Form::close()}} </div>
    </div>
  </section>
</div>
<div style="display:none;"> {{Form::open(['route'=>['food.image.save'],'class'=>'form-image-upload', 'id' => 'form-image-upload','files'=>true])}}
  <input name="upload_photo" id="upload_photo" style="display:none" onchange="preview_image(this.files)" type="file">
  </form>
</div>
@push('stylesheet')

@endpush
@push('scripts') 
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
        var formData 	= new FormData(this);
        if ($('input[name=\'upload_photo\']').val() != '') {
			var upload_photo_id =$('#upload_photo_id').val();
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
                success: function(json) {;
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

$(function() {
    $("#items-form").validate({
        errorElement: "span",
        rules: {
            item_name: "required",
            price: "required",
			addOn_category: "required",
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