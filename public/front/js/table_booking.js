document.getElementById('customer_phone').addEventListener('keyup', function(evt) {
    var phoneNumber = document.getElementById('customer_phone');
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    phoneNumber.value = phoneFormat(phoneNumber.value);
});
function phoneFormat(input) {
    // Strip all characters from the input except digits
    input = input.replace(/\D/g, '');
    // Trim the remaining input to ten characters, to preserve phone number format
    input = input.substring(0, 12);
    // Based upon the length of the string, we add formatting as necessary
    /*var size = input.length;
    if (size == 0) {
        input = input;
    } else if (size < 4) {
        input = '(' + input;
    } else if (size < 7) {
        input = '(' + input.substring(0, 2) + ') ' + input.substring(2, 6);
    } else {
        input = '(' + input.substring(0, 2) + ') ' + input.substring(2, 6) + ' - ' + input.substring(6, 12);
    }*/
    return input;
}




$(document).on('click', '.booke_btn', function(){
            $(this).toggleClass('active_table');
            if($(this).hasClass('active_table')){
                $('.booked_table').slideDown();
                $('.booked_food').slideUp();
                $('.booke_btn').html('<i class="fa-solid fa-utensils"></i>Order Food</a>');
            }else{
                $('.booked_food').slideDown(); 
                $('.booked_table').slideUp();
                $('.booke_btn').html('<i class="fa-solid fa-utensils"></i>Book Table</a>');
            }
        });

function recaptchaCallback() {
    var response = grecaptcha.getResponse();
    $("#hidden-grecaptcha").val(response);
    //console.log(response);
}
function recaptchaExpired() {
    $("#hidden-grecaptcha").val("");
}


$(document).on('click', '.tab-pane .next-step', function() {
    var step_id = $(this).data('step');
    var nextstep = $(this).data('nextstep');
	
    formValidation(step_id);

    var has_error = '';
    if ($('#table_booking-form .red_border').length > 0) {
        if (step_id == 1) {
            if ($('#step1 .red_border').length > 0) {
                has_error = 'step1';
                $('#step1 .red_border:first').focus();
                return false;
            }
        }
        if (step_id == 2) {
            if ($('#step2 .red_border').length > 0) {
                has_error = 'step2';
                $('#step2 .red_border:first').focus();
				swal("Error", "Select booking date.", "error");

                return false;
            }
        }
        if (step_id == 3) {
            if ($('#step3 .red_border').length > 0) {
                has_error = 'step3';
                $('#step3 .red_border:first').focus();
				swal("Error", "Select booking Time.", "error");
                return false;
            }
        }
		if (step_id == 4) {
            if ($('#step4 .red_border').length > 0) {
                has_error = 'step4';
                $('#step4 .red_border:first').focus();
				swal("Error", "Select booking Table.", "error");
                return false;
            }
        }
		if (step_id == 5) {
            if ($('#step5 .red_border').length > 0) {
                has_error = 'step5';
                $('#step5 .red_border:first').focus();
                return false;
            }
        }
    }


    if (has_error == '') {
		if (step_id == 2) {
			var total_person 	= $('#total_person').val();
			var booking_date 	= $('#booking_date').val();
			$.ajax({
				url: prop.ajaxurl,
				type: "POST",
				dataType: 'json',
				data: {
					action: 'timeslot_availability',
					merchant_id: merchant_id,
					total_person: total_person,
					booking_date: booking_date,
					_token: prop.csrf_token
				},
				beforeSend: function() {
				},
				success: function(data) {
					if(data.result.length>0){
						var html='';
						
						for (var i = 0; i < data.result.length; i++) {
							var status_class='';
							var click_class='timeslot_btn';
							if(data.result[i].status=='N'){
								status_class='deactivate';
								click_class='';
							}
							
							html +='<li class="'+status_class+'"><a href="javascript:;" class="'+click_class+'" data-id="'+data.result[i].id+'" data-time="'+data.result[i].from_time+'">'+data.result[i].from_time+'</a></li>';
						}
						$('#timeslot_section').html(html);
						
						console.log('nextstep',nextstep);
						console.log('step_id',step_id);
						console.log('nextstep',nextstep);
						
						$('#step' + nextstep + '_progress_bar').addClass('active');
						$('#step' + step_id).hide();
						$('#step' + nextstep).show();
					}else{
						$('#book_table_section').html('Time are not available.Try to select another date.');
					}
				}
			});
		}else if (step_id == 3) {
			var total_person 	= $('#total_person').val();
			var booking_date 	= $('#booking_date').val();
			var booking_time_id = $('#booking_time_id').val();
			
			$.ajax({
				url: prop.ajaxurl,
				type: "POST",
				dataType: 'json',
				data: {
					action: 'table_booking_availability',
					merchant_id: merchant_id,
					total_person: total_person,
					booking_date: booking_date,
					booking_time_id: booking_time_id,
					_token: prop.csrf_token
				},
				beforeSend: function() {
				},
				success: function(data) {
					if(data.result.length>0){
						var html='<ul class="row g-2 table_seat_booking">';
						
						for (var i = 0; i < data.result.length; i++) {
							html +='<li class="'+data.result[i].status+'"><a href="javascript:;" class="table_booking_btn" data-id="'+data.result[i].id+'" data-seat="'+data.result[i].total_seat+'">'+data.result[i].table_name+' <span>'+data.result[i].total_seat+' Seat</span></a></li>';
						}
						html +='</ul>'
						$('#book_table_section').html(html);
						
						console.log('nextstep',nextstep);
						console.log('step_id',step_id);
						console.log('nextstep',nextstep);
						
						$('#step' + nextstep + '_progress_bar').addClass('active');
						$('#step' + step_id).hide();
						$('#step' + nextstep).show();
					}else{
						$('#step' + nextstep + '_progress_bar').addClass('active');
						$('#step' + step_id).hide();
						$('#step' + nextstep).show();
						$('#book_table_section').html('Table are not available.Try to select another date and time.');
					}
				}
			});
		}else if (step_id == 5) {
			
			$('#table_booking-form').submit();
			
			
        } else {
            $('#step' + nextstep + '_progress_bar').addClass('active');
            $('#step' + step_id).hide();
            $('#step' + nextstep).show();
        }
    }
});
function formValidation(step_id) {
    if (step_id == 1) {
        var total_person = $('#total_person').val();
        if (total_person == '') {
            $('#total_person').removeClass('black_border').addClass('red_border');
        } else {
			$('#total-booked-person-view').text(total_person+' person');
            $('#total_person').removeClass('red_border').addClass('black_border');
        }
    }
	
	if (step_id == 2) {
        var booking_date = $('#booking_date').val();
        if (booking_date == '') {
            $('#booking_date').removeClass('black_border').addClass('red_border');
        } else {
			$('#booked-date-view').text(booking_date);
            $('#booking_date').removeClass('red_border').addClass('black_border');
        }
    }
    if (step_id == 3) {
        var booking_time_id = $('#booking_time_id').val();
        if (booking_time_id == '') {
            $('#booking_time_id').removeClass('black_border').addClass('red_border');
        } else {
            $('#booking_time_id').removeClass('red_border').addClass('black_border');
        }
    }
	if (step_id == 4) {
        var booking_table_id = $('#booking_table_id').val();
        if (booking_table_id == '') {
            $('#booking_table_id').removeClass('black_border').addClass('red_border');
        } else {
            $('#booking_table_id').removeClass('red_border').addClass('black_border');
        }
    }
	if (step_id == 5) {
        var customer_name = $('#customer_name').val();
        if (customer_name == '') {
            $('#customer_name').removeClass('black_border').addClass('red_border');
        } else {
            $('#customer_name').removeClass('red_border').addClass('black_border');
        }
		
		var customer_phone = $('#customer_phone').val();
        if (customer_phone == '') {
            $('#customer_phone').removeClass('black_border').addClass('red_border');
        } else {
            $('#customer_phone').removeClass('red_border').addClass('black_border');
        }
		
		var customer_email = $('#customer_email').val();
        if (customer_email == '') {
            $('#customer_email').removeClass('black_border').addClass('red_border');
        } else {
            $('#customer_email').removeClass('red_border').addClass('black_border');
        }
		
		var grecaptcha = $('#hidden-grecaptcha').val();
        if (grecaptcha == '') {
            $('.capchaArea').removeClass('black_border').addClass('red_border');
        } else {
            $('.capchaArea').removeClass('red_border').addClass('black_border');
        }
    }
}

$(document).ready(function() {
    $("#table_booking-form").submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = $(this).serialize() + '&merchant_id=' + merchant_id;
        $.ajax({
            type: "POST",
            //cache: false,
            //contentType: false,
            //processData: false,
            url: url,
            dataType: 'json',
            data: data,
            success: function(data) {
				if(data.success==1){
					$('.tab-pane').hide();
					$('#step1').show();
		
					$('.step_bar').removeClass('active');
					$('#step1_progress_bar').addClass('active');
		
					$('#total_person').val('');
					$('.day_num').removeClass('booked-date');
					$('.timeslot_btn').removeClass('booked-time');
					$('.table_booking_btn').removeClass('booked-time');
					$('.table_booking_btn').removeClass('booked-time');
					
					$('.table_booking_btn').removeClass('booked-time');
					
					$('#table_booking-form')[0].reset();
					
					//swal("Success", "Table successfully Booked.", "success")
					swal({
					  title: 'Success',
					  text: "Table successfully Booked.",
					  type: 'success',
					  showConfirmButton:false,
					  //confirmButtonText: 'Yes, delete it!'
					});
					 setTimeout(function() {
						 location.reload();
						}, 2000);
				}else{
					swal("Error", "Something went wrong.Booking table is not available.", "error");
				}
			},
            beforeSend: function() {
			},
            complete: function() {
			}
        });
    });
});


$(document).on('click', '.tab-pane .prev-step', function() {
	var step_id		= $(this).data('step');
	var prevstep_id		= $(this).data('prevstep');
	$('#step'+step_id+'_progress_bar').removeClass('active');
	$('#step'+step_id).hide();
	$('#step'+prevstep_id).show();
});

$(document).on('click', '.booking_btn', function() {
	var booking_date	= $(this).data('date');
	$('.day_num').removeClass('booked-date');
	$(this).addClass('booked-date');
	$('#booked-date-view').text(booking_date);
	$('#booking_date').val(booking_date);
});

$(document).on('click', '.timeslot_btn', function() {
	var booking_date_id	= $(this).data('id');
	var booking_time	= $(this).data('time');
	$('.timeslot_btn').removeClass('booked-time');
	$(this).addClass('booked-time');
	$('#booking_time_id').val(booking_date_id);
	$('#booking_time_slot').val(booking_time);
	
	$('#booked-time-view').text(booking_time);
});

$(document).on('click', '.table_booking_btn', function() {
	var table_id	= $(this).data('id');
	var table_seat	= $(this).data('seat');
	var table_name	= $(this).text();
	$('.table_booking_btn').removeClass('booked-time');
	$(this).addClass('booked-time');
	$('#booking_table_id').val(table_id);
	$('#booking_table_name').val(table_name);
	
	$('#booked-table-view').text(table_name);
	
	//alert(table_name);
	
	//$('#booked-time-view').text(booking_time);
});

//customer_special_request_view_sec

$(document).on('keyup', '#customer_name', function() {
	var val=$(this).val();
	$('#booked-customer_name-view').text(val);
});
$(document).on('keyup', '#customer_phone', function() {
	var val=$(this).val();
	$('#booked-customer_phone-view').text(val);
});
$(document).on('keyup', '#customer_email', function() {
	var val=$(this).val();
	$('#booked-customer_email-view').text(val);
});
$(document).on('keyup', '#customer_special_request', function() {
	var val=$(this).val();
	if(val!=''){
		$('#customer_special_request_view_sec').show();
	}else{
		$('#customer_special_request_view_sec').hide();
	}
	$('#booked-customer_special_request-view').text(val);
});








