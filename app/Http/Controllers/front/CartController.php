<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Category;
use App\Merchant;
use App\Common;
use App\User;
use App\Item;

use Helpers;
use Session;
use Auth;
use Input;
use Mail;
use DB;

class CartController extends Controller {
	
	public function checkout(){
		$title='checkout';
		$breadcumbs='checkout';
		$active='checkout';
		
		$restaurent	= isset($_GET['restaurent'])?$_GET['restaurent']:'';
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
		
		//echo '<pre>';print_r($cartinfo);
		
		return view('front.store.checkout', compact('title','breadcumbs','active','restaurent','location','city'));
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
	
	
	
	
}
