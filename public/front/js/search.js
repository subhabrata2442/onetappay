$(function() {
    if ($('#location-input').length > 0) {
        const input = document.getElementById("location-input");
        const options = {
            componentRestrictions: {
                country: "ca"
            },
        };
        const autocomplete = new google.maps.places.Autocomplete($("#location-input")[0], options);
    }


    $("#location-form").validate({
        errorElement: "span",
        rules: {
            "location": "required",
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
	




$(".search-restaurent").keyup(function() {
	var keyword=$(this).val();
    $.ajax({
        url: prop.ajaxurl,
        type: "POST",
        dataType: 'json',
        data: {
            action: 'search_restaurants',
			keyword: keyword,
            _token: prop.csrf_token
        },
        beforeSend: function() {
            $(".search-restaurent").css("background", "#FFF url('" + imageUrl + "') right no-repeat");
        },
        success: function(data) {

            $("#suggesstion-restaurent-box").show();

            $("#suggesstion-restaurent-box").html(data.html);
            $(".search-restaurent").css("background", "#FFF");
            if (data.status == 0) {
                $(".search-restaurent").val('');
                setTimeout(() => {
                    $("#suggesstion-restaurent-box").hide();
                }, 2000);
            }
        }
    });
});

$(document).on('click', '.select-li-restaurant', function(){
	var store=$(this).find('.restaurant-search-item-title').text();
    $(".search-restaurent").val(store);
    $("#suggesstion-restaurent-box").hide();
});