<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Helpers;
use App\Common;

class Common extends Model{
	
	/**
     * Insert data into database.
     *
     */
	 
	public static function insertData($table='',$dataSet=[]){
		$insertData = DB::table($table)->insert($dataSet);	
		if(!empty($insertData)){
			return $insertData;	
		}else{
			return false;
		}
	}
	
	/**
     * Insert data into database get last insert id.
     *
     */
	public static function insert_get_id($table='',$dataSet=[]){
		$insertData = DB::table($table)->insertGetId($dataSet);	
		if(!empty($insertData)){
			return $insertData;	
		}else{
			return false;
		}
	}
	
	/**
     * Fetch data from single table in database.
     *
     */
	 
    public static function listingData($where=[],$table='',$data=[], $orderBy='',$ordering){
		if(!empty($where)){
			$allData = DB::table($table)->select($data)->where($where)->orderby($orderBy, $ordering)->get();
        }else{
           $allData = DB::table($table)->select($data)->orderby($orderBy, $ordering)->get();
        }
        if(!empty($allData)){
            return $allData;
        }else{
            return "No data found!";
        }
    }
	
	/**
     * Get single data.
     *
     */
	 
    public static function getSingelData($where=[],$table='',$data=[], $orderBy='',$ordering){
		if(!empty($where)){
           $allData = DB::table($table)->select($data)->where($where)->orderby($orderBy, $ordering)->first();
        }else{
           $allData = DB::table($table)->select($data)->orderby($orderBy, $ordering)->first();
        }
        if(!empty($allData)){
            return $allData;
        }else{
           return array();
        }
    }
	
	 /**
     * Update single data.
     *
     */
	 
    public static function updateData($table="",$uId = "", $getId="", $data = []) {
        //Update slngle data
        $updateData = DB::table($table)->where($uId, $getId)->update($data);
        if(!empty($updateData)){
        	return $updateData;
        }else{
        	return false;
        }
    }
	
	 public static function updateMultiData($table="",$where = "", $data = []) {
        //Update slngle data
        $updateData = DB::table($table)->where($where)->update($data);
        if(!empty($updateData)){
        	return $updateData;
        }else{
        	return false;
        }
    }
	
	/**
     * Delete single data by unique id.
     *
     */
    public static function deleteData($table="",$uId="", $getId="") {
        //Delete  data
        $deleteData = DB::table($table)->where($uId, $getId)->delete();
        if($deleteData){
        	return true;
        }else{
        	return false;	
        } 
    }
	
	
	/**
     * Delete Multi data by unique id.
     *
     */
    public static function deleteMultiData($table="",$where) {
        //Delete  data
        $deleteData = DB::table($table)->where($where)->delete();
        if($deleteData){
        	return true;
        }else{
        	return false;	
        } 
    }
	
	
	/**
     * Fetch total data from single table in database.
     *
     */
	 
    public static function getTotalListing($where=[],$table='',$data=[], $orderBy='',$ordering){
		if(!empty($where)){
           $allData = DB::table($table)->select($data)->where($where)->orderby($orderBy, $ordering)->get()->count();
        }else{
           $allData = DB::table($table)->select($data)->orderby($orderBy, $ordering)->get()->count();
        }
        if(!empty($allData)){
            return $allData;
        }else{
            return 0;
        }
    }
	
	
	
	 /**
     * Update order data.
     *
     */
    public static function updateOrderTable($table="",$where=[],$data = []) {
        //Update slngle data
        $updateData = DB::table($table)->where($where)->update($data);
		
        if(!empty($updateData)){
        	return $updateData;
        }else{
        	return false;
        }
    }
	
	
	public static function get_settings($where) {
		$result=DB::table('site_settings')->select('option_value')->where($where)->first();
		$value=isset($result->option_value)?$result->option_value:'';
	 	return $value;
	}	
	
	/**
     * Add To Cart.
     *
     */
	 
	public static function addItemtoCart($cart_id,$product_id,$merchant_id,$itemPrice,$itemQty,$size_id,$option,$notes,$method_id,$cat_id){
		$cart_result = DB::select(DB::raw('select * FROM cart_items WHERE `product_id`='.$product_id.' AND `method_type`='.$method_id.' AND `ses_id`='.$cart_id.' AND `size_id`='.$size_id.' AND `category_id`='.$cat_id));
		 
		 /*echo '<pre>';print_r($option);exit;
		 if(!empty($option)){
			foreach($option as $modifier_group){
				$modifier_group_name = $modifier_group['modifier_group_name'];
				$modifier_group_id = $modifier_group['modifier_group_id'];
				
				if(count($modifier_group['modifier_items'])>0){
					foreach($modifier_group['modifier_items'] as $modifier_item){
						$modifier_item_id		= $modifier_item['modifier_item_id'];
						$modifier_item_name		= $modifier_item['modifier_item_name'];
						$modifier_item_price	= $modifier_item['modifier_item_price'];
						
						$cart_addon_result = DB::select(DB::raw('select * FROM cart_addon_items WHERE `product_id`='.$product_id.' AND `ses_id`='.$cart_id.' AND `category_id`='.$modifier_group_id.' AND `addon_id`='.$modifier_item_id.' AND `size_id`='.$size_id));
						if(!empty($cart_addon_result)){
							$addon_qty 		= $cart_addon_result[0]->qnty + $itemQty;
							$addon_price	= $addon_qty * $modifier_item['modifier_item_price'];
							$addon_data= [
								'modifier_group_title' 	=> $modifier_group_name,
								'modifier_item_title'	=> $modifier_item_name,
								'price'					=> $modifier_item['modifier_item_price'],
								'qnty'   				=> $addon_qty,
								'total_price'			=> $addon_price
							];	
													
							DB::table('cart_addon_items')->where('ses_id', $cart_id)->where('product_id', $product_id)->where('size_id', $size_id)->where('addon_id', $modifier_item_id)->update($addon_data);
						}else{
							$addon_data= [
								'ses_id'  		=> $cart_id,
								'merchant_id'	=> $merchant_id,
								'product_id'	=> $product_id,
								'size_id'		=> $size_id,
								'addon_id'		=> $modifier_item_id,
								'category_id'	=> $modifier_group_id,
								'modifier_group_title' 	=> $modifier_group_name,
								'modifier_item_title'	=> $modifier_item_name,
								'price'			=> $modifier_item['modifier_item_price'],
								'qnty'   		=> $itemQty,
								'total_price'	=> $itemQty * $modifier_item['modifier_item_price']
							];
							
							DB::table('cart_addon_items')->insert($addon_data);
						}
					}
				}
			}
		}
		 $addon_data_list = DB::table('cart_addon_items')->where('ses_id',$cart_id)->select('total_price','qnty')->where('product_id',$product_id)->where('size_id',$size_id)->get();
		 $addon_grand_total = 0;
		 if($addon_data_list){
			for($i=0;$i<count($addon_data_list);$i++){
				$addon_grand_total=$addon_grand_total+$addon_data_list[$i]->total_price;
			}
			$addon_grand_total=number_format($addon_grand_total,2,'.','');
			
		}*/
		
		//echo '<pre>';print_r($cart_result);exit;
		
		$addon_grand_total=0;
		
		if(!empty($cart_result)){
			
			//==============update cartitem table===============//
			
			foreach($cart_result as $row){
				$qty		= $row->qnty + $itemQty;
				$price		= $qty * $itemPrice;
				$cart_id	= $row->ses_id;
				$data = [
					'merchant_id'	=> $merchant_id,
					'category_id'	=> $cat_id,
					'qnty'			=> $qty,
			 		'total_price'	=> $price,
					'grand_total'	=> $price + $addon_grand_total,
					'option'		=> json_encode($option),
					'notes'			=> $notes
					];
				}
				
				if($itemQty>0){
					$updateData = DB::table('cart_items')->where('ses_id', $cart_id)->where('product_id', $product_id)->where('category_id', $cat_id)->where('method_type', $method_id)->where('size_id', $size_id)->update($data);
				}
		}else{
			
			//=============insert cartitem table==============//
			
			$grand_total = $itemQty * $itemPrice;
			
			$dataSet = [
				'ses_id'  		=> $cart_id,
				'method_type'	=> $method_id,
				'merchant_id'	=> $merchant_id,
				'category_id'	=> $cat_id,
				'qnty'   		=> $itemQty,
				'price'			=> $itemPrice,
				'total_price'	=> $itemQty * $itemPrice,
				'grand_total'	=> $grand_total + $addon_grand_total,
				'product_id'	=> $product_id,
				'size_id'		=> $size_id,
				'option'		=> json_encode($option),
				'notes'			=> $notes
				];
				
				//print_r($dataSet);exit;
				
			$insertData = DB::table('cart_items')->insert($dataSet);
		}
	}
	
	
	public static function updateItemtoCart($cart_id,$product_id,$merchant_id,$itemPrice,$itemQty,$size_id,$option,$notes){
		$cart_result 	= DB::select(DB::raw('select * FROM cart_items WHERE `id`='.$cart_id.' AND `product_id`='.$product_id));
		$ses_id 		= $cart_result[0]->ses_id;
		
		Common::deleteMultiData('cart_addon_items',array('ses_id'=>$ses_id,'product_id'=>$product_id,'size_id'=>$size_id));
		
		//echo '<pre>';print_r($cart_result);exit;
		
		if(!empty($option)){
			foreach($option as $modifier_group){
				$modifier_group_name	= $modifier_group['modifier_group_name'];
				$modifier_group_id 		= $modifier_group['modifier_group_id'];
				
				if(count($modifier_group['modifier_items'])>0){
					foreach($modifier_group['modifier_items'] as $modifier_item){
						$modifier_item_id		= $modifier_item['modifier_item_id'];
						$modifier_item_name		= $modifier_item['modifier_item_name'];
						$modifier_item_price	= $modifier_item['modifier_item_price'];
						$addon_data= [
							'ses_id'  		=> $ses_id,
							'merchant_id'	=> $merchant_id,
							'product_id'	=> $product_id,
							'size_id'		=> $size_id,
							'addon_id'		=> $modifier_item_id,
							'category_id'	=> $modifier_group_id,
							'modifier_group_title' 	=> $modifier_group_name,
							'modifier_item_title'	=> $modifier_item_name,
							'price'			=> $modifier_item['modifier_item_price'],
							'qnty'   		=> $itemQty,
							'total_price'	=> $itemQty * $modifier_item['modifier_item_price']
						];
						
						DB::table('cart_addon_items')->insert($addon_data);
					}
				}
			}
		}
		
		$addon_data_list = DB::table('cart_addon_items')->where('ses_id',$ses_id)->select('total_price','qnty')->where('product_id',$product_id)->where('size_id',$size_id)->get();
		$addon_grand_total = 0;
		if($addon_data_list){
			for($i=0;$i<count($addon_data_list);$i++){
				$addon_grand_total=$addon_grand_total+$addon_data_list[$i]->total_price;
			}
			$addon_grand_total=number_format($addon_grand_total,2,'.','');
			
		}
		
		//echo '<pre>';print_r($addon_grand_total);exit;
		
		//==============update cartitem table===============//
		
		if(!empty($cart_result)){
			foreach($cart_result as $row){
				$qty		= $itemQty;
				$price		= $qty * $itemPrice;
				//$cart_id	= $row->ses_id;
				$data = [
					'merchant_id'	=> $merchant_id,
					'size_id'		=> $size_id,
					'qnty'			=> $qty,
			 		'total_price'	=> $price,
					'grand_total'	=> $price + $addon_grand_total,
					'option'		=> json_encode($option),
					'notes'			=> $notes
					];
				}
				
				//print_r($cart_id);exit;
				if($itemQty>0){
					$updateData=DB::table('cart_items')->where('id', $cart_id)->where('product_id', $product_id)->update($data);
				}
			}
		}
	
	public static function cartlistingList($data=[], $orderBy='',$ordering){
		$userId 	= Session::get('user_id');
		$cart_id  	= Session::get('cart_id');
		
		$allData=array();
		/*if($userId){
			$allData = DB::table('cart_items')->select($data)->where('user_id',$userId)->where('is_order','N')->orderby($orderBy, $ordering)->get();
			}else if($cart_id){
				$allData = DB::table('cart_items')->select($data)->where('ses_id',$cart_id)->where('is_order','N')->orderby($orderBy, $ordering)->get();
			}*/
		$allData = DB::table('cart_items')->select($data)->where('ses_id',$cart_id)->where('is_order','N')->orderby($orderBy, $ordering)->get();	
		
		if(!empty($allData)){
			return $allData;
		}else{
			return array();
		}
	}
	
	public static function getCartItemDetails($cart_id,$size_id,$method_id) {
		$product_data 	= array();
		$cart_result	= array();
		
		$cart_id		= $cart_id;
		$size_id		= $size_id;
		$cart_result = DB::select(DB::raw("SELECT * FROM cart_items WHERE id = '" . (int)$cart_id . "' AND size_id = '" .(int)$size_id . "' AND method_type = '" .(int)$method_id . "' AND is_order='N'"));
		if($cart_result){
			foreach ($cart_result as $cart) {
				$stock = true;
				$product_result = DB::select(DB::raw("SELECT p.item_id,p.merchant_id,p.item_name,p.size,p.price,p.addon_item FROM menu_items p WHERE p.item_id = '" . (int)$cart->product_id . "'"));
				if($product_result && ($cart->qnty > 0)){
					$option_price 	= 0;
					$option_data = DB::select(DB::raw("SELECT CAI.*,AI.item_name FROM cart_addon_items CAI LEFT JOIN addon_item as AI on CAI.addon_id = AI.addon_item_id WHERE CAI.ses_id = '" .(int)$cart->ses_id. "' AND CAI.product_id = '" .(int)$cart->product_id. "' AND CAI.size_id = '" .(int)$cart->size_id. "' ORDER BY CAI.id ASC"));
					
					$price = $product_result[0]->price;
					$discount_quantity = 0;
					$stock = false;
					$product_data= array(
						'cart_id'       => $cart->id,
						'ses_id'       	=> $cart->ses_id,
						'merchant_id'	=> $product_result[0]->merchant_id,
						'product_id'	=> $product_result[0]->item_id,
						'name'          => $product_result[0]->item_name,
						'size_id'       => $cart->size_id,
						'size'          => Helpers::get_item_size_by_id($cart->size_id),
						'addon_item'	=> $product_result[0]->addon_item,
						'option'        => $option_data,
						'notes'       	=> $cart->notes,
						'quantity'      => $cart->qnty,
						'price'         => $cart->price,
						'total'         => $cart->total_price,
						'grand_total'   => $cart->grand_total
					);
				}
			}
		}
		
		return $product_data;
	}
	
	public static function getCartProducts() {
		$product_data 	= array();
		$cart_result	= array();
		$userId			= Session::get('user_id');
		$cart_id		= Session::get('cart_id');
		//$cart_id		= 8;
		
		$cart_result = DB::select(DB::raw("SELECT * FROM cart_items WHERE ses_id = '" . (int)$cart_id . "' AND is_order='N'"));
		//echo '<pre>';print_r($cart_result);exit;
		
		if($cart_result){
			foreach ($cart_result as $cart) {
				$stock = true;
				$product_result = DB::select(DB::raw("SELECT p.* FROM item p WHERE p.item_id = '" . (int)$cart->product_id . "'"));
				//echo '<pre>';print_r($product_result);exit;
				
				if ($product_result && ($cart->qnty > 0)) {
					$option_price 	= 0;
					
					/*$option_data = DB::select(DB::raw("SELECT CAI.*,AI.item_name FROM cart_addon_items CAI LEFT JOIN addon_item as AI on CAI.addon_id = AI.addon_item_id WHERE CAI.ses_id = '" .(int)$cart_id. "' AND CAI.product_id = '" .(int)$cart->product_id. "' AND CAI.size_id = '" .(int)$cart->size_id. "' ORDER BY CAI.id ASC"));*/
					$price = $product_result[0]->price;
					
					// Product Discounts
					$discount_quantity = 0;
					
					// Stock
					$stock = false;
					
					
					$merchant_info = DB::select(DB::raw("SELECT * FROM merchant WHERE user_id = '" . (int)$product_result[0]->merchant_id . "'"));
					
					$product_data[] = array(
						'cart_id'       => $cart->id,
						'merchant_id'	=> $product_result[0]->merchant_id,
						'merchant_name'	=> $merchant_info[0]->restaurant_name,
						'product_id'	=> $product_result[0]->item_id,
						'name'          => $product_result[0]->item_name,
						'image'         => $product_result[0]->photo,
						'method_id'     => $cart->method_type,
						'size_id'       => $cart->size_id,
						//'size'          => Helpers::get_item_size_by_id($cart->size_id),
						//'addon_item'	=> $product_result[0]->addon_item,
						//'option'        => $option_data,
						'notes'			=> $cart->notes,
						'quantity'      => $cart->qnty,
						'stock'         => $stock,
						'price'         => $cart->price,
						'total'         => $cart->total_price,
						'grand_total'   => $cart->grand_total
					);

				//echo '<pre>';print_r($product_data);exit;
			}	
		}
	}
	return $product_data;
}

public static function getOrderInfo($token) {
	$result		= array();
	$cart_items = array();
	$order_result = DB::table('order as O')
		->leftjoin('merchant as M', 'O.merchant_id', '=','M.merchant_id')
		->select('O.*','M.restaurant_name')
		->where('O.order_id_token',(int)$token)
		->where('O.order_status','1')
		->get();
	
	$cart_result = DB::select(DB::raw("SELECT CI.*,MI.item_name FROM cart_items CI LEFT JOIN menu_items as MI on CI.product_id = MI.item_id WHERE CI.ses_id = '" .(int)$order_result[0]->cart_id. "' ORDER BY CI.id ASC"));	
	
	if(count($cart_result)>0){
		foreach($cart_result as $row){
			$cart_items[]=array(
				'id'=>$row->id,
				'merchant_id'	=> $row->merchant_id,
				'product_id'	=> $row->product_id,
				'product_name'	=> $row->item_name,
			);
			
		}
	}
	
	
	
	
		
   echo '<pre>';
   print_r($cart_items);
   print_r($cart_result);
   
   exit;		
}
	
	
	public static function getOrderDetails($token) {
		$result	= array();
		$product_data 	= array();
		$order_result = DB::table('order as O')
		 			->leftjoin('merchant as M', 'O.merchant_id', '=','M.user_id')
					->select('O.*','M.restaurant_name')
		 			->where('O.order_id_token',(int)$token)
					->where('O.order_status','1')
		 			->get();
		
		//echo '<pre>';print_r($order_result[0]->order_id);exit;
		
		$payment_order		= DB::select(DB::raw("SELECT * FROM payment_order WHERE order_id = '" .(int)$order_result[0]->order_id. "'"));
		$delivery_address	= DB::select(DB::raw("SELECT * FROM order_delivery_address WHERE order_id = '" .(int)$order_result[0]->order_id. "'"));
		
		
		$cart_result = DB::select(DB::raw("SELECT * FROM cart_items WHERE order_id = '" . (int)$order_result[0]->order_id . "'"));
		
		$grand_total		= 0;
		$total_cart_item	= 0;
		$total_cart_amount  = 0;
		
		
		
		if($cart_result){
			foreach ($cart_result as $cart) {
				$stock = true;
				$product_result = DB::select(DB::raw("SELECT p.* FROM item p WHERE p.item_id = '" . (int)$cart->product_id . "'"));
				if ($product_result && ($cart->qnty > 0)) {
					$option_price 	= 0;
					$price = $product_result[0]->price;
					// Product Discounts
					$discount_quantity = 0;
					// Stock
					$stock = false;
					
					$grand_total=$grand_total+$cart->grand_total;
					$total_cart_amount=$total_cart_amount+$cart->price;
					$total_cart_item=$total_cart_item+$cart->qnty;
					
					
					$merchant_info = DB::select(DB::raw("SELECT * FROM merchant WHERE user_id = '" . (int)$product_result[0]->merchant_id . "'"));
					$product_data[] = array(
						'cart_id'       => $cart->id,
						'merchant_id'	=> $product_result[0]->merchant_id,
						'merchant_name'	=> $merchant_info[0]->restaurant_name,
						'product_id'	=> $product_result[0]->item_id,
						'name'          => $product_result[0]->item_name,
						'image'         => $product_result[0]->photo,
						'method_id'     => $cart->method_type,
						'size_id'       => $cart->size_id,
						'notes'			=> $cart->notes,
						'quantity'      => $cart->qnty,
						'stock'         => $stock,
						'price'         => $cart->price,
						'total'         => $cart->total_price,
						'grand_total'   => $cart->grand_total
					);
				}
			}
		}
		
		$result= array(
			'order_info'			=> $order_result,
			'payment_order'			=> $payment_order,
			'delivery_address'		=> $delivery_address,
			'product_data'			=> $product_data,
			'grand_total'			=> $grand_total,
			'total_cart_item'		=> $total_cart_item,
			'total_cart_amount'		=> $total_cart_amount,
		);
		
		return $result;
	}
	
	
	public static function get_merchant_data($merchant_id) {
		$result	= array();
		$merchant_result = DB::select(DB::raw("SELECT M.restaurant_name,M.restaurant_slug,U.name,U.email FROM merchant M LEFT JOIN users as U on M.user_id = U.id WHERE M.user_id = '" .(int)$merchant_id. "' ORDER BY M.merchant_id ASC"));
		
		if(!empty($merchant_result)){
			$result = array(
				'merchant_id'		=> $merchant_id,
				'merchant_name'		=> $merchant_result[0]->restaurant_name,
				'restaurant_slug'	=> $merchant_result[0]->restaurant_slug,
				'merchant_email'	=> $merchant_result[0]->email,
			);
		}
		return $result;
	}
	
	
	
	
	
	# temp table data
	public static function get_temo_table_data($where=[]) {
		$result = DB::table('temp_table')->select('*')->where($where)->orderby('id', 'DESC')->first();
		if(!empty($result)){
			$data=json_decode($result->value);
			return $data;
        }else{
        	return false;
        }
	}
	
 	public static function incrementalHash($len = 5){
	  $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	  $base = strlen($charset);
	  $result = '';
	
	  $now = explode(' ', microtime())[1];
	  while ($now >= $base){
		$i = $now % $base;
		$result = $charset[$i] . $result;
		$now /= $base;
	  }
	  return substr($result, -5);
  }
  
   public static function getDataByRawQuery($query){
	   $data = array();
	   $result = DB::select(DB::raw($query));
	   if(!empty($result)){
		  $data = $result;
		 }
		 
		return $data; 
	}
					
  							
  public static function create_slug($string){
	$replace = '-';
	$string = strtolower($string);     
	$string = preg_replace("/[\/\.]/", " ", $string);     
	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);     
	$string = preg_replace("/[\s-]+/", " ", $string);     
	$string = preg_replace("/[\s_]/", $replace, $string);     
	$string = substr($string, 0, 100);     
	return $string;
	}
  
  
  
}
