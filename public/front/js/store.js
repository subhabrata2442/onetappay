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


/*if ($('#street').length > 0) {
        const input = document.getElementById("street");
        const options = {
            componentRestrictions: {
                country: "ca"
            },
        };
        const autocomplete = new google.maps.places.Autocomplete($("#street")[0], options);
    }*/


$(function() {
    $("#merchant_form").validate({
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
                minlength: 8,
            },
            password_confirmation: {
                required: true,
                minlength: 8,
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
                        $.toast({
                            heading: 'Error!',
                            position: 'bottom-right',
                            text: response[0].error_message,
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 7000,
                            stack: 6
                        });
                    } else {
						 $.toast({
                            heading: 'Success',
                            text: 'And these were just the basic demos! Scroll down to check further details on how to customize the output.',
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
						
						window.location.href = base_url +'/merchant/signup-success';   
                    }
                    console.log(response);
                }
            });
        }
    }).settings.ignore = [];
});