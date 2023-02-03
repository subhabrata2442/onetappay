<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Common;
use App\Item;
use App\User;
use App\Merchant;
use App\Category;
use Input;
use Session;
use Carbon;
use Auth;
use Image;
use DB;
use Helpers;
use Hash;

class StoreController extends Controller {
	
	public function store(){
		$title 			= "Store List";
        $breadcumbs 	= "Store List";
        $active 		= "store";
		
		$meta_data 		= array();
        $search 		= Input::get('s');
        $cur_page 		= Input::get('pg');
        $cur_page 		= $cur_page == '' ? 1 : $cur_page;
        $per_page		= 20;
        $limit_start	= ($cur_page - 1) * $per_page;
        $param = array();
        $param['search'] 		= $search;
		$param['name']		 	= Input::get('name');
		$param['email']		 	= Input::get('email');
        $param['cur_page'] 		= $cur_page;
        $param['per_page'] 		= $per_page;
        $param['limit_start']	= $limit_start;
		
		$store_list = Merchant::orderBy('merchant_id','desc')->get();
		
		//echo '<pre>';print_r($store_list);exit;
		
		return view('admin.store.list', compact('title','active','breadcumbs','store_list'));
    }
	
	public function store_details($store_id){
		 $title 		= "Store Details";
		 $breadcumbs 	= "Store Details";
		 $active 		= 'store';
		 
		 $param['store_id']	= $store_id;
		 $store_info 		= Merchant::where('merchant_id',$store_id)->first();
		 $item_list 		= Item::where('merchant_id',$store_info->user_id)->get();
		 
		 //echo '<pre>';print_r($item_list[0]->category->category_name);exit;
		 
		 return view('admin.store.details', compact('title','breadcumbs','active','store_id','store_info','item_list'));	  
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
					$rating   			= $line[3];
					$img_url   			= $line[4];
					
					echo '<pre>';print_r($line);exit;
					
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
						
						//$total_merchant_count	= Merchant::where('city','Winnipeg')->count();
						//if($total_merchant_count<6){
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
								
								//echo '<pre>';print_r($merchantData);exit;
								//Merchant::where('merchant_id', $merchant_id)->update($merchantData);
							}else{
								$user_type 			= 2;
								$store_email		= $restaurant_slug.'@gmail.com';
								$store_password		= '123456';
								$IP 				= Helpers::get_ip();
								$userArr = [
									'user_type'			=> $user_type,
									'name'				=> $store_name,
									'email'				=> $store_email,
									'password' 			=> Hash::make($store_password),
									'raw_password'		=> $store_password,
									'phone'				=> '',
									'alternet_phone'	=> '',
									'country'			=> 'CA',
									'city'				=> 'Ottawa',
									'status' 			=> 1,
									'IP'				=> $IP,
									'remember_token' 	=> '',
									'created_at'		=> date('Y-m-d')
								];
								
								//echo '<pre>';print_r($userArr);exit;
								$user = User::create($userArr);
								$lastInsertedId = $user->id;
								
								
								
								
								$merchantData=array(
									'user_id'				=> $lastInsertedId,
									'restaurant_slug'  		=> $restaurant_slug,
									'restaurant_name'  		=> $store_name,
									'contact_name'  		=> $store_name,
									'store_url'				=> $store_url,
									'free_delivery'  		=> $free_delivery,
									'delivery_estimation'  	=> $delivery_estimation,
									'logo'  				=> $img_url,
									'meta_data'				=> $desc,
									'country_id'			=> '38',
									'country_code'			=> 'CA',
									'city'					=> 'Ottawa',
									'state'					=> 'ON',
									'address'				=> '93 Murray St, Ottawa, On K1N 5M5',
									'street'				=> '93 Murray St, Ottawa, On K1N 5M5',
									'post_code'				=> '5M5',
									'latitude'				=> '45.4299231',
									'lontitude'				=> '-75.6934121',
									'rating'				=> $rating
									
								);
								
								//echo '<pre>';print_r($merchantData);exit;
								//echo '<pre>';print_r($merchantData);exit;
								Merchant::create($merchantData);	
								echo '<pre>';print_r($merchantData);exit;					
							}
						//}
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
					$tag   		= '';//$line[3];
					$img   		= isset($line[3])?$line[3]:'';
					$cat_name   = isset($line[4])?$line[4]:'';
					
					$title		= preg_replace("/\p{Han}+/u", '', $title);
					$desc		= preg_replace("/\p{Han}+/u", '', $desc);
					
					//echo '<pre>';print_r($desc);exit;
					
					
					
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
							
							//echo '<pre>';print_r($categoryData);exit;
							
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
							//Item::where('item_id', $product_id)->update($productData);
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
							
							//echo '<pre>';print_r($productData);exit;
							
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
