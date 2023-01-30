<?php
namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\User;
use App\Common;
use App\Merchant;
use App\Item;
use App\Category;

use Input;
use Session;
use Carbon;
use Auth;
use Image;
use DB;
use Helpers;
use Hash;

class MerchantController extends Controller {
	
	public function signup(){
		
		 $title 		= "Store Details";
		 $breadcumbs 	= "Store Details";
		 $active 		= 'store';
		 
		 
		//echo '<pre>';print_r($title);exit;
		 
		 return view('front.merchant.signup', compact('title','breadcumbs','active'));	  
    }
	
	public function signup_request(Request $request){
		$validator = Validator::make($request->all(), [
			//'fullName' 	=> 'required|string|max:255',
			//'dob' 		=> 'required|string|max:255',
			//'username' 		=> 'required|string|username|max:255|unique:users',
			'email' => 'required|string|email|max:255|unique:users',
        	'password' 		=> 'required|min:6|confirmed',
        ]);
		
        if ($validator->fails()){
           $errors=$validator->errors()->all();
		   $error_html='';
		   foreach($errors as $er){
			   $error_html .='<span>'.$er.'</span></br>';
			   }
		   $return_data['success'] = 0; 
		   $return_data['error_message'] = $error_html;
		   return response()->json([$return_data]);
		}else{
			
			$user_type 			= 2;
			$fullName 			= Input::post('contact_name');
			$email 				= Input::post('email');
			$phone 				= Input::post('contact_phone');
			$restaurant_phone 	= Input::post('restaurant_phone');
			$password 			= Input::post('password_confirmation');
			$country 			= Input::post('country_code');
			$city 				= Input::post('city');
			$state 				= Input::post('state');
			
			$IP 				= Helpers::get_ip();
			
			$userArr = [
				'user_type'			=> $user_type,
				'name'				=> $fullName,
				'email'				=> $email,
				'password' 			=> Hash::make($password),
				'phone'				=> $phone,
				'alternet_phone'	=> $restaurant_phone,
				'country'			=> $country,
				'city'				=> $city,
				'status' 			=> 1,
				'IP'				=> $IP,
				'remember_token' 	=> $request->_token,
				'created_at'		=> date('Y-m-d')
               ];
			   
			 $user = User::create($userArr);
			 $lastInsertedId = $user->id;
			 
			 //$lastInsertedId=1;
			 
			 
			 $restaurant_slug=Helpers::create_slug(Input::post('restaurant_name'));
			 
			 $merchantArr = [
			 	'user_id'					=> $lastInsertedId,
				'restaurant_slug'			=> $restaurant_slug,
				'restaurant_name'			=> Input::post('restaurant_name'),
				'restaurant_phone'			=> Input::post('restaurant_phone'),
				'contact_name'				=> Input::post('contact_name'),
				'contact_phone'				=> Input::post('contact_phone'),
				'contact_email'				=> Input::post('contact_email'),
				'country_code'				=> Input::post('country_code'),
				'street'					=> Input::post('street'),
				'address'					=> Input::post('street'),
				'city'						=> Input::post('city'),
				'state'						=> Input::post('state'),
				'post_code'					=> Input::post('post_code'),
				'latitude'					=> Input::post('lat'),
				'lontitude'					=> Input::post('lng'),
				'ip_address'				=> $IP,
				'distance_unit'				=> Input::post('distance_unit'),
				'delivery_distance_covered'	=> Input::post('delivery_distance_covered'),
				'merchant_type'				=> Input::post('service'),
				'created_at'				=> date('Y-m-d')
               ];
			   
			   Merchant::create($merchantArr);
			   
			   $return_data['success'] 		= 1;
			   $return_data['success_message'] = '<span>Record is successfully added</span>';
		}
		
		
		return response()->json([$return_data]);
	}
	
	
	public function success(){
		$title 		= "Store Details";
		$breadcumbs = "Store Details";
		$active 	= 'store';
		
		return view('front.merchant.success', compact('title','breadcumbs','active'));	  
    }
	
	public function deleteUser() {
		$user_id = Input::get('id');
		if ($user_id != null) {
			Common::deleteData('users','id',$user_id);
			Common::deleteData('user_wallet','user_id',$user_id);
			Common::deleteData('user_bit_transaction','user_id',$user_id);
			Common::deleteData('user_bank','user_id',$user_id);
			Common::deleteData('transactions','user_id',$user_id);
			Common::deleteData('balance_request','user_id',$user_id);
			Common::deleteData('withdraw_request','user_id',$user_id);
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
