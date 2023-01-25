/*$(document).on('click',	'.add',function(){
	var cart_id=$(this).data('id')
	var th = $(this).closest('.qty-item-add').find('.count');
	var qty=+th.val() + 1;
	th.val(+th.val() + 1);
	
	updateCartItem(cart_id,qty);
	
});

$(document).on('click',	'.sub',function(){
	
	alert('test');
	return false;	

	var cart_id=$(this).data('id')
	var th = $(this).closest('.qty-item-add').find('.count');
	if (th.val() > 1){
		th.val(+th.val() - 1);
		var qty=+th.val() - 1;
		
		updateCartItem(cart_id,qty);
	}else{
		$('#cart-item-'+cart_id).remove();
		var qty=0;
		updateCartItem(cart_id,qty);
	}
});*/

var qty = 0,
    maxlim;
$(document).on('click', '.priceControl .controls2', function() {
    qty = $(this).siblings('.qtyInput2').val();
    //console.log('qty', qty);
    maxlim = $(this).siblings('.qtyInput2').attr('data-max-lim');
    //console.log('maxlim', maxlim);
    var cart_id = $(this).data('id')
    //console.log('cart_id', cart_id);

    if (($(this).val() == '+') && (parseInt(maxlim) > qty)) {
        qty++;
		
		$(this).siblings('.qtyInput2').val(qty);
		updateCartItem(cart_id,qty);
    } else if ($(this).val() == '-') {
        if (qty > 1) {
            qty--;
			
			$(this).siblings('.qtyInput2').val(qty);
			updateCartItem(cart_id,qty);
        } else {
            swal({
                title: 'Are you sure?',
                text: "Are you sure you want to remove this item?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
					$(this).siblings('.qtyInput2').val(qty);
					updateCartItem(cart_id,0); 
                }
            });
        }
    }
    
});

function updateCartItem(cart_id, qty) {
    console.log('cart_id', cart_id);
    console.log('qty', qty);

    $.ajax({
        url: base_url + '/updatetocart',
        data: {
            cart_id: cart_id,
            qty: qty,
            _token: csrf_token
        },

        type: 'post',
        dataType: 'json',
        beforeSend: function() {
            //$(".preloader").fadeIn();
        },
        complete: function(data) {
            //$(".preloader").fadeOut();
        },
        success: function(json) {
            $('.total_cart_item_count').html(json.totalItem + ' Items');
            $('#grand_total-' + cart_id).html('$' + json.item_total_price);
			
			if(qty==0){
				$('#cart-item-'+cart_id).remove();
			}

            if (json.totalItem > 0) {
                $('#cart_checkout_section').show();
                $('.cart_subtotal').html('$' + json.totalPrice);
				$('.total_cart_item_blink').html(json.totalItem).show();
				$('.basket_total_item').html(json.totalItem+' iteam in basket');
				$('.basket_total_amount').html('$'+json.totalPrice);
            } else {
				$('.basket_total_item').html('0 iteam in basket');
				$('.basket_total_amount').html('$0');
				$('.total_cart_item_blink').hide();
                $('#cart_checkout_section').hide();
                $('.cart_subtotal').html('0');
            }
        }
    });
}



function addtocart(id, mid, cid) {
    console.log('item_id', id);
    console.log('mid', mid);
    console.log('cid', cid);
	
    $.ajax({
        url: base_url + '/addtocart',
        data: {
            pid: id,
            mid: mid,
            cid: cid,
            _token: csrf_token
        },

        type: 'post',
        dataType: 'json',
        beforeSend: function() {
            //$(".preloader").fadeIn();
        },
        complete: function(data) {
            //$(".preloader").fadeOut();
        },
        success: function(json) {
			$('.cart_items_section').html(json.html);
			$('.total_cart_item_count').html(json.totalItem+' Items');
			
			$('.total_cart_item_blink').html(json.totalItem).show();
			
			if(json.totalItem>0){
				$('#cart_checkout_section').show();
				$('.cart_subtotal').html('$'+json.totalPrice);
				$('.basket_total_item').html(json.totalItem+' iteam in basket');
				$('.basket_total_amount').html('$'+json.totalPrice);
			}else{
				$('.total_cart_item_blink').hide();
				$('#cart_checkout_section').hide();
				$('.cart_subtotal').html('0');
				$('.basket_total_item').html('0 iteam in basket');
				$('.basket_total_amount').html('$0');
			}
			
			
			
            /*$('.cart_items_section').append(json.html);
			var sum=0;
			$('.cart-item-price').each(function(){
				sum += Number($(this).data('price'));
			});
			
			$('.basket-item-price').text('$'+sum);
			
			var total_cart_item=$('.basket-cart-items').length;
			$('.basket-item-total').text(total_cart_item+' iteam in basket');
            //$('#addons').modal('show');*/
        }
    });
}