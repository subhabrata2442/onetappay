@extends('layouts.admin.adminLayout')
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
          <h3 class="card-title">Site setting</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Site title</label>
                <input type="text" name="site_title" id="site_title" class="form-control"
                                        placeholder="Site Title" value="<?= $data['site_title'] ?>">
              </div>
              <div class="form-group">
                <label>Global meta title</label>
                <input type="text" name="meta_title" id="meta_title" class="form-control"
                                        placeholder="Global meta title" value="<?= $data['meta_title'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Global meta keywords</label>
                <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                                        placeholder="Global meta keywords" value="<?= $data['meta_keywords'] ?>">
              </div>
              <div class="form-group">
                <label>From Email</label>
                <input name="email" id="email" type="text" class="form-control" placeholder="Email"
                                        value="<?= $data['email'] ?>">
              </div>
            </div>
            
            
          </div>
        </div>
      </div>
      <div class="card card-default">
        <div class="card-header with-border">
          <h3 class="card-title">Profile setting</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Admin Name</label>
                <input type="text" name="admin_name" id="admin_name" class="form-control"
                                        placeholder="Admin Name" value="<?= $data['admin_name'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Admin Email</label>
                <input type="text" name="admin_email" id="admin_email" class="form-control"
                                        placeholder="Admin Email" value="<?= $data['admin_email'] ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-default">
        <div class="card-header with-border">
          <h3 class="card-title">Change Password</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password" autocomplete="cc-number">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Re-enter Password</label>
                <input type="text" name="password_confirm" id="password_confirm" class="form-control"
                                        placeholder="Confirm password">
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
<!-- Bootstrap Color Picker -->
<link rel="stylesheet"
            href="{{ asset('public/front/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<!-- bootstrap color picker --> 
<script src="{{ asset('public/front/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}">
        </script> 

<!-- summernote -->
<link rel="stylesheet" href="{{ asset('public/front/plugins/summernote/summernote-bs4.min.css') }}">
<!-- Summernote --> 
<script src="{{ asset('public/front/plugins/summernote/summernote-bs4.min.js') }}"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<script>
            $(document).on('click', '.fetch_image', function(e) {
                $('#upload_photo').click();
            });

            //color picker with addon
            $('.my-colorpicker2').colorpicker()

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