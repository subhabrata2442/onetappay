//Property form validation
jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 && 
    phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please specify a valid phone number");

$('#tourForm').validate({
    ignore: [],
    errorPlacement: function errorPlacement(error, element) {
        element.after(error);
    },
    rules: {
        "first_name": {
            required: true,
        },
        "last_name": {
            required: true,
        },
        "dob": {
            required: true,
        },
        "email": {
            required: true,
            email: true,
        },
        "phone": {
            required: true,
            phoneUS: true,
        },
        "address": {
            required: true,
        },
        "city": {
            required: true,
        },
        "zip": {
            required: true,
            number: true,
            min: 1
        },
        "tour_date": {
            required: true,
        },
        "slotId": {
            required: true,
        }
    },
    messages: {

        "first_name": {
            required: 'Please enter first name',
        },
         "last_name": {
            required: 'Please enter last name',
        },
        "dob": {
            required: 'Please select dob',
        },
        "email": {
            email: "Please enter valid email address",
            required: 'Please enter email address',
        },
        "phone": {
            required: 'Please enter phone number.',
            phoneUS: "United states numbers only",
        },
        "address": {
            required: 'Please enter address.',
        },
        "city": {
            required: 'Please select city.',
        },
        "zip": {
            required: 'Please enter zip code.',
        },
        "tour_date":{
            required: 'Please select datepicker.',
        }, 
        "slotId":{
            required: 'Please select slot.',
        }
    },
});