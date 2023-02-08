<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Category;
use App\Merchant;
use App\Common;
use App\User;
use App\Item;
use App\AddressBook;
use App\Countrie;
use App\Order;
use Helpers;
use Session;
use Auth;
use Input;
use Mail;
use DB;

class CartController extends Controller {
	
	public function checkout(){
		$title		='checkout';
		$breadcumbs	='checkout';
		$active		='checkout';
		
		$restaurent		= isset($_GET['restaurent'])?$_GET['restaurent']:'';
		$location		= isset($_GET['location'])?$_GET['location']:'';
		
		$city			= '';
		
		$cartinfo = Common::getCartProducts();
		$total_cart_amount=0;
		$total_cart_item=0;
		$getCartTotal = Common::cartlistingList(['*'], 'id', 'ASC');
		$grand_total		= 0;
		$total_cart_item	= 0;
		$total_cart_amount  = 0;
		if($getCartTotal){
			for($i=0;$i<count($getCartTotal);$i++){
				$grand_total=$grand_total+$getCartTotal[$i]->grand_total;
			}
			$total_cart_amount=number_format($grand_total,2,'.','');
			$total_cart_item = count($getCartTotal);
		}
		
		$user_id				= Session::get('user_id');
		$default_address_book 	= AddressBook::where('user_id',$user_id)->where('as_default',1)->first();
		$countrie				= Countrie::All();
		
		$merchant_id	= Session::get('cart_merchant_id');
		$merchant_info	= Common::get_merchant_data($merchant_id);
		
		
		
		//$img=Helpers::item_logo('');
		
		//echo '<pre>';print_r($merchant_info['merchant_name']);exit;
		
		return view('front.store.checkout', compact('title','breadcumbs','active','restaurent','merchant_info','location','city','cartinfo','total_cart_item','total_cart_amount','default_address_book','countrie'));
	}
	
	
	public function updatetocart_request(Request $request){
		$cart_id 	= Input::get('cart_id');
		$qty 		= Input::get('qty');
		
		$cart_result 	= DB::select(DB::raw('select * FROM cart_items WHERE `id`='.$cart_id));
		
		$addon_grand_total=0;
		$total_price=0;
		
		if(!empty($cart_result)){
			foreach($cart_result as $row){
				if($qty>0){
					$itemPrice	= $row->price;
					$total_price= $qty * $itemPrice;
						
					$data = [
						'qnty'			=> $qty,
						'total_price'	=> $total_price,
						'grand_total'	=> $total_price + $addon_grand_total
					];
					
					$updateData=DB::table('cart_items')->where('id', $cart_id)->update($data);
				}else{
					Common::deleteData('cart_items', 'id', $cart_id);	
				}	
			}
		}
		
		$getCartTotal = Common::cartlistingList(['*'], 'id', 'ASC');
		$grand_total		= 0;
		$total_cart_item	= 0;
		$total_cart_amount  = 0;
		if($getCartTotal){
			for($i=0;$i<count($getCartTotal);$i++){
				$grand_total=$grand_total+$getCartTotal[$i]->grand_total;
			}
			$total_cart_amount=number_format($grand_total,2,'.','');
			$total_cart_item = count($getCartTotal);
		}
		
		$return_data['totalPrice'] 			= number_format($total_cart_amount,2);
		$return_data['totalItem'] 			= $total_cart_item;
		$return_data['item_total_price'] 	= number_format($total_price,2);
		
		echo json_encode($return_data);	
	}
	
	public function addtocart_request(Request $request){
		$pid 	= Input::get('pid');
		$mid 	= Input::get('mid');
		$cat_id	= Input::get('cid');
		$cart_id= Session::get('cart_id');
		$merchant_id= Session::get('cart_merchant_id');
		
		if($merchant_id!=''){
			if($merchant_id!=$mid){
				Common::deleteData('cart_items', 'ses_id', $cart_id);	
			}
		}
		
		//Common::deleteData('cart_items', 'ses_id', $cart_id);exit;
		
		//$cart_id= 8;
		
		//echo $cart_id;
		
		$fooditem_data	= Item::where('merchant_id',$mid)->where('category_id',$cat_id)->where('item_id',$pid)->first();
		if(!empty($fooditem_data)){
			$itemPrice		=isset($fooditem_data->price)?$fooditem_data->price:0;
			$itemQty=1;
			$size_id=0;
			$option=[];
			$notes='';
			$method_id=0;
			if($cart_id){
				//echo 'dd';exit;
				Session::put('cart_merchant_id', $mid);
				$return_value = Common::addItemtoCart($cart_id,$pid,$mid,$itemPrice,$itemQty,$size_id,$option,$notes,$method_id,$cat_id);
			}else{
				$session_id=Session::getId();
				$cart_id=Common::insert_get_id('ses',['ses_id'=>$session_id]);
				Session::put('cart_id', $cart_id);
				Session::put('cart_merchant_id', $mid);
				$return_value = Common::addItemtoCart($cart_id,$pid,$mid,$itemPrice,$itemQty,$size_id,$option,$notes,$method_id,$cat_id);
			}
		}
		
		
		$getCartTotal = Common::cartlistingList(['*'], 'id', 'ASC');
		$grand_total		= 0;
		$total_cart_item	= 0;
		$total_cart_amount  = 0;
		if($getCartTotal){
			for($i=0;$i<count($getCartTotal);$i++){
				$grand_total=$grand_total+$getCartTotal[$i]->grand_total;
			}
			$total_cart_amount=number_format($grand_total,2,'.','');
			$total_cart_item = count($getCartTotal);
		}
		
		$cartinfo = Common::getCartProducts();
		$json 	= array();
		
		$html = '';
		
		if(!empty($cartinfo)){
			foreach($cartinfo as $cart){
				//$product_price 	= '0.00';
				//$p_price 		= '0';
				$item_photo='';
				$item_photo = asset("public/front/images/first-order/first-order1.jpg");
				
				$qty=1;
				
				$html .='<div class="crt-product-list d-flex justify-content-between align-items-center" id="cart-item-'.$cart['cart_id'].'"><div class="crt-product-name"><div class="prod-name-dtls item-veg"><h3><a href="javascript:;">'.$cart['name'].'</a></h3></div></div><div class="crt-product-qty"><div class="d-flex qty-item-add align-items-center priceControl"><button type="button" class="qty-add sub controls2" value="-" data-id="'.$cart['cart_id'].'"><i class="fa-solid fa-minus"></i></button><input type="number" class="form-control qty-show count qty qtyInput2" min="1" max="20" data-max-lim="20" value="'.$cart['quantity'].'"><button type="button" class="qty-add add controls2" value="+" data-id="'.$cart['cart_id'].'"><i class="fa-solid fa-plus"></i></button></div></div><div class="crt-product-price"><h3 id="grand_total-'.$cart['cart_id'].'">$'.$cart['grand_total'].'</h3></div></div>';	
			}		
		}
		
		$return_data['html'] 		= $html;
		$return_data['totalPrice'] 	= number_format($total_cart_amount,2);
		$return_data['totalItem'] 	= $total_cart_item;
		
		echo json_encode($return_data);

	}
	
	
	public function orderPlaceRequest(Request $request){
		//print_r($_POST);exit;
		$street 			= Input::post('street');
		$city 				= Input::post('city');
		$state 				= Input::post('state');
		$zipcode 			= Input::post('zipcode');
		$location_name 		= Input::post('location_name');
		$country_code 		= Input::post('country');
		
		$card_holder_name	= Input::post('card_holder_name');
		$card_number 		= Input::post('card_number');
		$card_exp_month 	= Input::post('card_exp_month');
		$card_exp_year 		= Input::post('card_exp_year');
		$card_cvc 			= Input::post('card_cvc');
		
		$country_info		= Countrie::where('sortname',$country_code)->first();
		$country_name		= isset($country_info->name)?$country_info->name:'';
		$IP 				= Helpers::get_ip();
		
		$item_number		= 1;
		$currency 			= 'usd';
		
		$total_cart_amount=0;
		$total_cart_item=0;
		$getCartTotal = Common::cartlistingList(['*'], 'id', 'ASC');
		$grand_total		= 0;
		$total_cart_item	= 0;
		$total_cart_amount  = 0;
		if($getCartTotal){
			for($i=0;$i<count($getCartTotal);$i++){
				$grand_total=$grand_total+$getCartTotal[$i]->grand_total;
			}
			$total_cart_amount=number_format($grand_total,2,'.','');
			$total_cart_item = count($getCartTotal);
		}
		
		$order_total		= $total_cart_amount;
		$sub_total			= $total_cart_amount;
		$grand_total		= $total_cart_amount;
		$tax				= 0;
		$service_fee		= 0;
		$discount			= 0;
		
		$user_id			= Session::get('user_id');
		$cart_id			= Session::get('cart_id');
		$merchant_id		= Session::get('cart_merchant_id');
		
		$order_info		= Common::getSingelData([], 'order', ['order_id'], 'order_id', 'DESC');
		$order_id 		= isset($order_info->order_id)?$order_info->order_id:'0';
		$order_id		= $order_id+1;
		$token			= date('Yd').$order_id;
		
		$user_info 		= Common::getSingelData($where=['id'=>$user_id],$table='users',$data=['id','first_name','last_name','email','phone'],'id','ASC');
		
		$created_at		= date('Y-m-d H:i s');
		
		$data_order=array(
			'merchant_id'			=> $merchant_id,
			'cart_id'				=> $cart_id,		
			'payment_type'			=> 'Stripe',
			'sub_total'				=> $sub_total,
			'gross_total'			=> $grand_total,
			'status'				=> 'pending',
			'tax' 					=> $tax,
			'service_fee' 			=> $service_fee,
			'discount' 				=> $discount,
			'ip_address'			=> $IP,
			'order_id_token'		=> $token,
			'payment_status' 		=> 0,	
			'order_status' 			=> 0,	
			'user_id' 				=> $user_id,
			'customer_email' 		=> $user_info->email,
			'customer_name' 		=> $user_info->first_name.' '.$user_info->last_name,
			'customer_phone' 		=> $user_info->phone,
			'created_at'			=> date('Y-m-d h:i:s a'),
		);
		
		//print_r($data_order);exit;
		
		$order_id=Common::insert_get_id($table="order",$data_order);
		
		if($order_id!=''){
			$data_order_delivery_address=array(
				'order_id'			=> $order_id,
				'user_id'			=> $user_id,		
				'street'			=> $street,
				'city'				=> $city,
				'state'				=> $state,
				'zipcode'			=> $zipcode,
				'location_name' 	=> $location_name,
				'country' 			=> $country_name,
				'contact_phone' 	=> $user_info->phone,
				'formatted_address'	=> $street,
				'area_name'			=> $street,
				'first_name'		=> $user_info->first_name,
				'last_name' 		=> $user_info->last_name,
				'contact_email' 	=> $user_info->email,
				'created_at'		=> $created_at
			);
			
			Common::insert_get_id($table="order_delivery_address",$data_order_delivery_address);
			
			$addressBookCheck=AddressBook::where('user_id',$user_id)->get();
			if(count($addressBookCheck)==0){
				$data_general=array(
					'user_id'		=> $user_id,
					'street'		=> $street,
					'city'			=> $city,
					'state'			=> $state,
					'zipcode'		=> $zipcode,
					'location_name'	=> $location_name,
					'country_code'	=> $country_code,
					'as_default'	=> 1,
					'created_at'	=> $created_at
				);
				Common::insert_get_id($table="address_book", $data_general);
			}	
		}
		
		$secret_key 		= 'sk_test_51J0fT9SAQKpdsVUhAbrNrCE8MNBaHkM8Ue8HfCUonaqVnNuHnzmI2rJAkKoBhW8c8yIfamrybqdVOBZ29L6Ij1GA00yBnmozw1';
		
		$description	= 'Food Order';
		$customer_data  = ['name' => $card_holder_name, 'description' => $description, 'email' => $user_info->email, "address" => ["city" => $city, "country" => $country_name, "line1" => $street, "line2" => $location_name, "postal_code" => $zipcode]];
		
		Stripe::setApiKey($secret_key);
		$stripe = new \Stripe\StripeClient($secret_key);
		$return 		= ['success' => 0, 'message' => ''];
		try {
			$card_token=\Stripe\Token::create(array(
				"card" => array(
					"number" 	=> $card_number,
					"exp_month" => $card_exp_month,
					"exp_year" 	=> $card_exp_year,
					"cvc"		=> $card_cvc
					)
				)
			);
			try {
				$customer = \Stripe\Customer::create(array_merge(['source' => $card_token->id], $customer_data));
				try {
					$charge=\Stripe\Charge::create(array(
						'customer' => $customer->id,
						"amount" => ($order_total * 100),
						"currency" => $currency,
						"description" => $description
					));
				} catch (\Exception $e) {
					$return['message'] = $e->getMessage();
				}
				if($charge){
					$chargeJson = $charge->jsonSerialize();
					//print_r($chargeJson);exit;
					if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){
						$transactionID  = $chargeJson['balance_transaction'];
						$paidAmount     = $chargeJson['amount'];
						$paidAmount     = $paidAmount;
						$paidCurrency   = $chargeJson['currency'];
						$payment_status = $chargeJson['status'];
						// Retrieve subscription data
						$subsData = $chargeJson;
						//All code for order table
						
						$data_payment_order=array(
							'user_id'			=> $user_id,
							'payment_type'		=> 'Stripe',
							'payment_reference'	=> $transactionID,
							'order_id'			=> $order_id,
							'raw_response'		=> json_encode($subsData),
							'card_holder_name'	=> $card_holder_name,
							'card_number'		=> $card_number,
							'card_exp_month'	=> $card_exp_month,
							'card_exp_year'		=> $card_exp_year,
							'card_cvc'			=> $card_cvc,
							'created_at'		=> $created_at
						);
						
						
						
						Common::insert_get_id($table="payment_order", $data_payment_order);
						
						Session::put('last_order_token', $token);
						Common::updateData($table="cart_items",$uId = "ses_id", $cart_id, $data = ['is_order' =>'Y','order_id' =>$order_id]);
						Common::updateData($table="order",$uId = "order_id", $order_id, $data = ['payment_status' =>1,'order_status' =>1]);
						
						$return['success'] 	= 1;
						$return['token'] 	= $token;
						$return['message'] 	= 'Your order has been place.';
						
						//print_r($return);exit;
					}else{
						$return['message'] = 'Charge creation failed!';
					}	
				}
				
			} catch (\Exception $e) {
				$return['message'] = $e->getMessage();
			}
		} catch (\Exception $e) {
			$return['message'] = $e->getMessage();
		}
		
		return response()->json([$return]);
	}
	
	public function order_success(){
		$title		= 'Order Pay';
		$breadcumbs	= 'checkout';
		$active		= 'checkout';
		
		$token 		= Input::get('id');
		
		Session::forget('order_token');
		Session::forget('cart_id');
		
		$orderDetails = array();
		if(isset($token)){
			if(!empty($token)){
				$orderDetails = Common::getOrderDetails($token);
			}
		}
		
		$restaurent	= isset($_GET['restaurent'])?$_GET['restaurent']:'';
		$location		= isset($_GET['location'])?$_GET['location']:'';
		
		$city			= '';
		
		$card_number	= isset($orderDetails['payment_order'][0]->card_number)?substr($orderDetails['payment_order'][0]->card_number, -4):'';
		$card_type		= '';
		
		if($orderDetails['payment_order'][0]->raw_response!=''){
			$raw_response	= json_decode($orderDetails['payment_order'][0]->raw_response,true);
			$card_type		= isset($raw_response['payment_method_details']['card']['brand'])?$raw_response['payment_method_details']['card']['brand']:'';
		}
		
		
		
		
		
		
		
		//echo $newstring = substr($orderDetails['payment_order'][0]->card_number, -4);exit;
		
		//card_number
		//echo '<pre>';print_r($orderDetails);exit;
			
		return view('front.success_page', compact('title','breadcumbs','active','orderDetails','restaurent','location','city','card_number','card_type'));
	}
	
	
	
	
}
