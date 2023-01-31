<?php
namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Common;
use App\Merchant;
use App\Item;
use App\Category;
use App\TimeSlots;
use App\BookingTable;
use App\Table;
use Input;
use Session;
use Carbon;
use Auth;
use Image;
use DB;
use Helpers;
use Hash;

use App\Classes\Calendar;

class StoreController extends Controller {
	
	public function store_details($store_slug){
		
		 $title 		= "Store Details";
		 $breadcumbs 	= "Store Details";
		 $active 		= 'store';
		 
		 $restaurent	= isset($_GET['restaurent'])?$_GET['restaurent']:'';
		 $location		= isset($_GET['location'])?$_GET['location']:'';
		 //$city			= $this->get_city($location);
		 
		 $store_info 			= Merchant::where('restaurant_slug',$store_slug)->first();
		 $merchant_item_list 	= Item::where('merchant_id',$store_info->user_id)->orderBy('category_id','asc')->get();
		 $category_list 		= Category::where('merchant_id',$store_info->user_id)->orderBy('cat_id','asc')->get();
		 $store_id				= $store_info->user_id;	
		 $city					= $store_info->city;
		 
		 $time_slots 	= TimeSlots::where('status',1)->get();
		 $total_time_slot=count($time_slots);
		 
		 
		 
		 $item_list		= [];
		 
		 foreach($category_list as $c_row){
			 
			 $items=[];
			 $item_result 	= Item::where('merchant_id',$store_info->user_id)->where('category_id',$c_row->cat_id)->orderBy('item_id','asc')->get();
			 foreach($item_result as $row){
				 $photo=Helpers::item_thumb($row->photo);
				 $items[]=array(
				 	'item_id'			=> $row->item_id,
				 	'item_name'			=> $row->item_name,
					'item_slug'			=> $row->item_slug,
					'item_description'	=> $row->item_description,
					'price'				=> $row->price,
					'tag'				=> $row->tag,
					'photo'				=> $photo,
				 );
			 }
			 
			 $item_list[]=array(
			 	'cat_id'		=> $c_row->cat_id,
				'category_name'	=> $c_row->category_name,
				'items'			=> $items
			 );
		 }
		 
		 //echo '<pre>';print_r($item_list);exit;
		 
		 
		 /*$calendar = new Calendar;
         $calendar->create();*/
		 
		 $current_month = date('m');
		 $current_date	= date('Y-m-d');
		 $next_month 	= date('m',strtotime('first day of +1 month'));
		 
		 
		 if($current_month==12){
			 $next_year 	= date('Y', strtotime('+1 year'));
		 }else{
			 $next_year 	= date('Y');
		 }
		 
		 $next_date		= date('Y-m-d',strtotime('01-'.$next_month.'-'.$next_year));
		 $timestamp    = strtotime($current_date);
		 $current_month_start_date = date('Y-m-04', $timestamp);
		 $current_month_last_date  = date('Y-m-t', $timestamp);
		
		 $timestamp    = strtotime($next_date);
		 $prev_month_start_date = date('Y-m-01', $timestamp);
		 $prev_month_last_date  = date('Y-m-t', $timestamp);
		 
		 $current_month_booking_result=BookingTable::where('merchant_id',$store_info->user_id)->selectRaw('date_slot')->distinct()->whereBetween('date_slot', [$current_month_start_date, $current_month_last_date])->where('status',1)->get();
		 
		 //$total_time_slot=1;
		 $current_month_booked_result=[];
		 foreach($current_month_booking_result as $row){
			 $current_month_booked_total_timeslot=BookingTable::where('merchant_id',$store_info->user_id)->selectRaw('time_slot_id')->distinct()->where('date_slot', $row->date_slot)->where('status',1)->count();
			 
			 if($current_month_booked_total_timeslot>=$total_time_slot){
				 $current_month_booked_result[]=array(
				 	'date_slot'=>$row->date_slot,
					'booked_total_timeslot'=>$current_month_booked_total_timeslot
				);
			 }
		}
		
		$next_month_booking_result=BookingTable::where('merchant_id',$store_info->user_id)->selectRaw('date_slot')->distinct()->whereBetween('date_slot', [$prev_month_start_date, $prev_month_last_date])->where('status',1)->get();
		
		$next_month_booked_result=[];
		foreach($next_month_booking_result as $row){
			 $next_month_booked_total_timeslot=BookingTable::where('merchant_id',$store_info->user_id)->selectRaw('time_slot_id')->distinct()->where('date_slot', $row->date_slot)->where('status',1)->count();
			 
			 if($next_month_booked_total_timeslot>=$total_time_slot){
				 $next_month_booked_result[]=array(
				 	'date_slot'=>$row->date_slot,
					'booked_total_timeslot'=>$next_month_booked_total_timeslot
				);
			 }
		}
		 
		 
		 
		 
		 
		 
		 //$next_month_booking_result=BookingTable::where('merchant_id',$store_info->user_id)->selectRaw('date_slot')->whereBetween('created_at', [$prev_month_start_date." 00:00:00", $prev_month_last_date." 23:59:59"])->where('status',1)->get();
		 
		 
		//echo '<pre>';print_r($next_month_booked_result);exit;
		
		 $calendar = new Calendar();
		 foreach($current_month_booked_result as $row){
			  $calendar->add_event('Booked', $row['date_slot'], 1, 'red');
		 }
		 /*$calendar->add_event('Birthday', '2022-12-10', 1, 'green');
		 $calendar->add_event('Doctors', '2022-12-12', 1, 'red');
         $calendar->add_event('Holiday', '2022-12-21', 7);*/
		 
		 $next_calendar = new Calendar($next_date);
		 foreach($next_month_booked_result as $row){
			  $next_calendar->add_event('Booked', $row['date_slot'], 1, 'red');
		 }
		 //$next_calendar->add_event('Booked', '2023-01-10', 7, 'green');
		 //$next_calendar->add_event('Doctors', '2022-12-12', 1, 'red');
         //$next_calendar->add_event('Holiday', '2022-12-21', 7);
		 //echo $calendar;
		 
		 
		 
		 //echo $next_calendar;exit;
		 
		$cartinfo = Common::getCartProducts();
		
		//echo '<pre>';print_r($cartinfo);exit;
		
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
		
		
		
		$store_url		= url('store/'.$store_slug);
		$checkout_url	= url('checkout/');
		$store_table	= Table::where('merchant_id',$store_info->user_id)->get();
		
		//echo '<pre>';print_r($item_list);exit;
		
		
		
		return view('front.store.details', compact('title','breadcumbs','active','store_id','category_list','store_info','item_list','city','location','restaurent','calendar','next_calendar','time_slots','cartinfo','total_cart_amount','total_cart_item','store_url','store_table','merchant_item_list','checkout_url'));	  
    }
	
	public function booking_table_request(Request $request){
		$merchant_id  		= $request->merchant_id;
		$total_person  		= $request->total_person;
		$booking_date  		= $request->booking_date;
		$booking_time_id  	= $request->booking_time_id;
		$booking_table_id  	= $request->booking_table_id;
		
		$booking_table_name  		= $request->booking_table_name;
		$customer_name  			= $request->customer_name;
		$customer_phone  			= $request->customer_phone;
		$customer_email  			= $request->customer_email;
		$customer_special_request  	= $request->customer_special_request;
		$time_slot					= $request->booking_time_slot;
		
		$user_id 	= Session::get('user_id') ?? 0;
		//print_r($_POST);exit;
			
		$validator = Validator::make($request->all(), [
			'booking_date' 		=> 'required|string|max:255',
			'booking_time_id' 	=> 'required|string|max:255',
			'booking_table_id' 	=> 'required|string|max:255',
			'total_person' 		=> 'required|string|max:255',
        	'customer_name' 	=> 'required|string|max:255',
			'customer_phone' 	=> 'required|string|max:255',
        ]);
		
		$booking_result = BookingTable::where('merchant_id', $merchant_id)->where('time_slot_id', $booking_time_id)->where('date_slot', $booking_date)->where('table_id', $booking_table_id)->where('status', 1)->count();
		
		if($booking_result>0){
			echo json_encode(array('success' => 0));
		}else{
			$order_info		= Common::getSingelData([], 'user_booking_table', ['booking_id'], 'booking_id', 'DESC');
			$order_id 		= isset($order_info->order_id)?$order_info->order_id:'0';
			$order_id		= $order_id+1;
			$token			= date('Yd').$order_id;
			
			
			
			$booking_data = [
				'booking_id'	=> $token,
				'merchant_id'	=> $merchant_id,
				'user_id'		=> $user_id,
				'table_id'		=> $booking_table_id,
				'time_slot_id'	=> $booking_time_id,
				'time_slot' 	=> $time_slot,
				'date_slot'		=> $booking_date,
				'total_person'	=> $total_person,
				'customer_name'	=> $customer_name,
				'email'			=> $customer_email,
				'phone'			=> $customer_phone,
				'special_note' 	=> $customer_special_request,
				'status'		=> 1,
               ];
			   
			   
			   //print_r($booking_data);exit;
			   
			   
			   
			   BookingTable::create($booking_data);
			   echo json_encode(array('success' => 1));
		}
		
	}
	
	
	
	public function deleteUser() {
		$user_id = Input::get('id');
		if ($user_id != null) {
			/*Common::deleteData('users','id',$user_id);
			Common::deleteData('user_wallet','user_id',$user_id);
			Common::deleteData('user_bit_transaction','user_id',$user_id);
			Common::deleteData('user_bank','user_id',$user_id);
			Common::deleteData('transactions','user_id',$user_id);
			Common::deleteData('balance_request','user_id',$user_id);
			Common::deleteData('withdraw_request','user_id',$user_id);*/
			Session::flash('success', 'User deleted successfully.');
			}else{
				Session::flash('error', 'Something wrong please try again !');
			}
			
		return redirect::back();
    }
	
	public function store_upload(Request $request){
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['product_upload_file']['name']) && in_array($_FILES['product_upload_file']['type'], $csvMimes)){
			if(is_uploaded_file($_FILES['product_upload_file']['tmp_name'])){
				$csvFile = fopen($_FILES['product_upload_file']['tmp_name'], 'r');
				fgetcsv($csvFile);
				$merchantData=[];
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$store_name   		= $line[0];
					$store_url   		= $line[1];
					$desc   			= $line[2];
					$img_url   			= $line[3];
					
					if($store_name!=''){
						$restaurant_slug	= Helpers::create_slug(trim($store_name));
						
						$desc_data = explode(' ',$desc);
						$price_id='';
						for($i=0; count($desc_data)>$i; $i++){
							$th_head = str_replace(' ','',$desc_data[$i]);
							if (preg_match('/\$\b/', $th_head)) {
								$price_id	= $i;
								break;
							}
						}
						
						$free_delivery='';
						if($price_id!=''){
							$free_delivery_info=$desc_data[$price_id];
							preg_match_all('!\d+!', $free_delivery_info, $matches);
							$free_delivery .= isset($matches[0][0])?$matches[0][0]:'0';
							$free_delivery .= isset($matches[0][1])? '.'.$matches[0][1]:'.0';
						}
						
						//echo '<pre>';print_r($free_delivery);exit;
						$start_delivery_fee_row_id='';
						for($i=0; count($desc_data)>$i; $i++){
							$th_head = str_replace(' ','',$desc_data[$i]);
							if (preg_match('/Delivery$\b/', $th_head)) {
								$start_delivery_fee_row_id	= $i;
								break;
							}
						}
						
						
						$delivery_estimation='';
						if($start_delivery_fee_row_id!=''){
							$start_delivery_fee_row_id	= (count($desc_data)-2);
							for($i=$start_delivery_fee_row_id; count($desc_data)>$i; $i++){
								$delivery_estimation .=$desc_data[$i].' ';
							}
							if($delivery_estimation!=''){
								$delivery_estimation=trim($delivery_estimation);
							}
						}
						
						$merchant_data 		= Merchant::where('restaurant_slug',$restaurant_slug)->first();
						$merchant_id		= isset($merchant_data->merchant_id)?$merchant_data->merchant_id: '';
						
						$total_merchant_count	= Merchant::where('city','Winnipeg')->count();
						if($total_merchant_count<6){
							if($merchant_id!=''){
								$merchantData=array(
									'restaurant_slug'  		=> $restaurant_slug,
									'restaurant_name'  		=> $store_name,
									'store_url'				=> $store_url,
									'free_delivery'  		=> $free_delivery,
									'delivery_estimation'  	=> $delivery_estimation,
									'logo'  				=> $img_url,
									'meta_data'				=> $desc
								);
								Merchant::where('merchant_id', $merchant_id)->update($merchantData);
							}else{
								$merchantData=array(
									'restaurant_slug'  		=> $restaurant_slug,
									'restaurant_name'  		=> $store_name,
									'store_url'				=> $store_url,
									'free_delivery'  		=> $free_delivery,
									'delivery_estimation'  	=> $delivery_estimation,
									'logo'  				=> $img_url,
									'meta_data'				=> $desc,
									'country_id'			=> '38',
									'country_code'			=> 'CA',
									'city'					=> 'Winnipeg',
									'address'				=> '236 Edmonton St, Winnipeg, R3c 1r7',
									
								);
								//echo '<pre>';print_r($merchantData);exit;
								$merchantData	= Merchant::create($merchantData);	
								//echo '<pre>';print_r($merchantData);exit;					
							}
						}
					}
				}
			}
		}
		
		Session::flash('success', 'Successfully import data.');
		return redirect('administrator/store/list');
	}
	
	public function items_upload(Request $request){
		$merchant_id = Input::get('merchant_id');
		$productData2=[];
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['product_upload_file']['name']) && in_array($_FILES['product_upload_file']['type'], $csvMimes)){
			if(is_uploaded_file($_FILES['product_upload_file']['tmp_name'])){
				$csvFile = fopen($_FILES['product_upload_file']['tmp_name'], 'r');
				fgetcsv($csvFile);
				$merchantData=[];
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$title		= $line[0];
					$price   	= $line[1];
					$desc   	= $line[2];
					$tag   		= $line[3];
					$img   		= isset($line[4])?$line[4]:'';
					$cat_name   = $line[5];
					
					
					
					if($title!=''){
						$product_slug	= Helpers::create_slug($title);
						$product_mrp 	= str_replace('CA$', '', $price);
						$product_tag 	= $tag;
						
						
						//print_r($cat_name);exit;
						
						
						$category_slug	= Helpers::create_slug($cat_name);
						$category_data 	= Category::where('category_slug',$category_slug)->where('merchant_id',$merchant_id)->first();
						$cat_id			= isset($category_data->cat_id)?$category_data->cat_id: '';
						
						if($cat_id!=''){
							$category_id=$cat_id;
						}else{
							$categoryData=array(
								'merchant_id'  			=> $merchant_id,
								'category_name'  		=> $cat_name,
								'category_slug'			=> $category_slug,
								'category_description'  => $cat_name,
								'status'  				=> 1
							);
							
							$categorySaveData	= Category::create($categoryData);
							$category_id		= $categorySaveData->id;
						}
						
						$product_data 		= Item::where('item_slug',$product_slug)->where('merchant_id',$merchant_id)->first();
						$product_id			= isset($product_data->item_id)?$product_data->item_id: '';
						
						if($product_id!=''){
							$productData=array(
								'item_name'  		=> $title,
								'item_slug'  		=> $product_slug,
								'item_description'	=> $desc,
								'category_id'  		=> $category_id,
								'price'  			=> $product_mrp,
								'tag'  				=> $product_tag,
								'photo'				=> $img
							);
							Item::where('item_id', $product_id)->update($productData);
						}else{
							$productData=array(
								'merchant_id'  		=> $merchant_id,
								'item_name'  		=> $title,
								'item_slug'  		=> $product_slug,
								'item_description'	=> $desc,
								'category_id'  		=> $category_id,
								'price'  			=> $product_mrp,
								'tag'  				=> $product_tag,
								'photo'				=> $img
							);
							
							Item::create($productData);	
							
							$productData2[]=array(
								'merchant_id'  		=> $merchant_id,
								'item_name'  		=> $title,
								'item_slug'  		=> $product_slug,
								'item_description'	=> $desc,
								'cat_name'			=> $cat_name,
								'category_id'  		=> $category_id,
								'price'  			=> $product_mrp,
								'tag'  				=> $product_tag,
								'photo'				=> $img
							);
							
							//echo '<pre>';print_r($productData);exit;
							
										
						}
					}
				}
			}
		}
		
		echo '<pre>';print_r($productData2);exit;
		Session::flash('success', 'Successfully import data.');
		return redirect('administrator/store/list');
	}
 
	
}
