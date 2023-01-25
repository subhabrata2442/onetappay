if($("#contact_phone").length !=0) {

	var input 	= document.querySelector("#contact_phone");
	var iti1	= window.intlTelInput(input, {
		   preferredCountries: ['ca'],
		   separateDialCode: true,
	});
	
	input.addEventListener('blur', function() {
		var countryData = iti1.getSelectedCountryData();
	   
		if (input.value.trim()) {
			$(".countryiso").val(countryData.iso2);
			$(".icocode").val(countryData.dialCode);
		 
		}
	  });
}
  
$(function() {
    $("#user_login_form").validate({
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
            "email": "required",
            "password": "required",
        },
        messages: {},
        submitHandler: function(form) {
			var redirect_to=base_url + '/';
			if($('#login_redirect_to').val()!=''){
				redirect_to=$('#login_redirect_to').val();
			}
			
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response[0].success == 0) {
                        uk_msg(response[0].error_message)
                    } else {
                        uk_msg_sucess('Login Successful');
                        setTimeout(function() {
                            window.location.href = redirect_to;
                        }, 2000);
                    }   
                }
            });
        }
    })
});  
  
$(function() {
    $("#user_signup_form").validate({
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
            "restaurant_name": "required",
            "restaurant_phone": "required",
            "contact_name": "required",
            "contact_email": "required",
            "street": "required",
            "locality": "required",
            "post_code": "required",
            "country_code": "required",
            "state": "required",
            "email": "required",
            password: {
                required: true,
                minlength: 6,
            },
            password_confirmation: {
                required: true,
                minlength: 6,
                equalTo: "#password_confirmation"
            },
        },
        messages: {},
        submitHandler: function(form) {
			var redirect_to=base_url + '/';
			if($('#signup_redirect_to').val()!=''){
				redirect_to=$('#signup_redirect_to').val();
			}
			
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response[0].success == 0) {
                        uk_msg(response[0].error_message);
                    } else {
                        uk_msg_sucess('Registration Success')
                        setTimeout(function() {
                            window.location.href = redirect_to;
                        }, 2000);
                    }   
                }
            });
        }
    })
});

$(function() {
    $("#user_update_form").validate({
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
            "first_name": "required",
            "last_name": "required",
            "email": "required",
            "contact_phone": "required",
            password: {
                minlength: 6,
            },
            confirmed_password: {
                minlength: 6,
                equalTo: "#password"
            },
        },
        messages: {},
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response[0].success == 0) {
                        uk_msg(response[0].error_message);
                    } else {
                        uk_msg_sucess('Profile Updated')
                        /*setTimeout(function() {
                            window.location.href = base_url + '/';
                        }, 2000);*/
                    }   
                }
            });
        }
    })
});

jQuery(document).ready(function() {
	
	if($("#single_uploadfile").length !=0) {	
        single_uploadfile_progress 	= $("#single_uploadfile").data("progress");
        single_uploadfile_progress 	= $("." + single_uploadfile_progress);
        single_uploadfile_preview 	= $("#single_uploadfile").data("preview");
		
		//alert(single_uploadfile_preview);

        var uploader = new ss.SimpleUpload({
            button: 'single_uploadfile',
            url: front_ajax + "/UploadProfile/?" + addValidationRequest() + "&post_type=get&preview=" + single_uploadfile_preview,
            name: 'uploadfile',
            responseType: 'json',
            allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            maxSize: image_limit_size,
            onExtError: function(filename, extension) {
                uk_msg(js_lang.invalid_file_ext, "warning");
            },
            onSizeError: function(filename, fileSize) {
                uk_msg(js_lang.invalid_file_size, "warning");
            },
            onSubmit: function(filename, extension) {
                busy(true);
                this.setProgressBar(single_uploadfile_progress);
            },
            onComplete: function(filename, response) {
                busy(false);
                if (!response) {
                    uk_msg(filename + 'upload failed');
                    return false;
                } else {
                    dump(response);
                    if (response.code == 1) {
                        $("." + single_uploadfile_preview).html(response.details.preview_html);
                        callAjax("saveAvatar", 'filename=' + response.details.new_filename);
                    } else {
                        uk_msg(response.msg);
                    }
                }
            }
        });
    }
});







function uk_msg(msg)
{
	var n = noty({
		 text: msg,
		 type        : "warning" ,		 
		 theme       : 'relax',
		 layout      : 'topCenter',		 
		 timeout:2500,
		 animation: {
	        open: 'animated fadeInDown', // Animate.css class names
	        close: 'animated fadeOut', // Animate.css class names	        
	    }
	});
}

function uk_msg_sucess(msg)
{
	var n = noty({
		 text: msg,
		 type        : "success" ,		 
		 theme       : 'relax',
		 layout      : 'topCenter',		 
		 timeout:2500,
		 animation: {
	        open: 'animated fadeInDown', // Animate.css class names
	        close: 'animated fadeOut', // Animate.css class names	        
	    }
	});	  
}