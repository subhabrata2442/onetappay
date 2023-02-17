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

use Helpers;
use Session;
use Auth;
use Input;
use Mail;
use DB;

class HomeController extends Controller {
	
	public function index(){
		$title = "Home";
		
		//$auth       = Auth::user();
		//$authUserId = $auth->id ?? '';
		
		
		$popular_city[]=array(
			'city'				=> 'Vancouver',
			'total_restaurant'	=> Merchant::where('city', 'like', '%Vancouver%')->count(),
			'link'				=> url('searcharea/?location=Vancouver&type=city')
		);
		$popular_city[]=array(
			'city'				=> 'Winnipeg',
			'total_restaurant'	=> Merchant::where('city', 'like', '%Winnipeg%')->count(),
			'link'				=> url('searcharea/?location=Winnipeg&type=city')
		);
		$popular_city[]=array(
			'city'				=> 'Toronto',
			'total_restaurant'	=> Merchant::where('city', 'like', '%Toronto%')->count(),
			'link'				=> url('searcharea/?location=Toronto&type=city')
		);
		$popular_city[]=array(
			'city'				=> 'Calgary',
			'total_restaurant'	=> Merchant::where('city', 'like', '%Calgary%')->count(),
			'link'				=> url('searcharea/?location=Calgary&type=city')
		);
		$popular_city[]=array(
			'city'				=> 'Montreal',
			'total_restaurant'	=> Merchant::where('city', 'like', '%Montreal%')->count(),
			'link'				=> url('searcharea/?location=Montreal&type=city')
		);
		$popular_city[]=array(
			'city'				=> 'Ottawa',
			'total_restaurant'	=> Merchant::where('city', 'like', '%Ottawa%')->count(),
			'link'				=> url('searcharea/?location=Ottawa&type=city')
		);
		
		
		//echo '<pre>';print_r($popular_city);exit;
		
		
		
		
		
		$user_id 	= Session::get('user_id');
		return view('front.home', compact('title','popular_city'));
    }
	
	public function searcharea(){
		$title 		= "Search";
		$location	= isset($_GET['location'])?$_GET['location']:'';
		$restaurent	= isset($_GET['restaurent'])?$_GET['restaurent']:'';
		$type		= isset($_GET['type'])?$_GET['type']:'';
		
		$location_reasult = $this->get_city($location);
		
		$city			= isset($location_reasult['city'])?$location_reasult['city']:'';
		$country		= isset($location_reasult['country'])?$location_reasult['country']:'';
		$country_code	= isset($location_reasult['country_code'])?$location_reasult['country_code']:'CA';
		$state			= isset($location_reasult['state'])?$location_reasult['state']:'';
		$state_code		= isset($location_reasult['state_code'])?$location_reasult['state_code']:'';
		$postal_code	= isset($location_reasult['postal_code'])?$location_reasult['postal_code']:'';
		$street			= isset($location_reasult['street'])?$location_reasult['street']:'';
		$full_street	= isset($location_reasult['full_street'])?$location_reasult['full_street']:'';
		$street_number	= isset($location_reasult['street_number'])?$location_reasult['street_number']:'';
		
			
		$category_list 	= Category::select('cat_id','category_name','photo','category_slug')->distinct('category_slug')->where('status',1)->limit(15)->offset(0)->orderBy('cat_id', 'DESC')->get();
		
		$query_store_list 	= Merchant::where('status', 'active');
		
		if($type=='city'){
			if($city!=''){
				$query_store_list->where('city', 'like', '%'.$city.'%');
			}
		}else{
			if($country_code!=''){
				$query_store_list->where('country_code', 'like', '%'.$country_code.'%');
			}
			if($city!=''){
				$query_store_list->where('city', 'like', '%'.$city.'%');
			}
			
			if($state!=''){
				$query_store_list->where('state', 'like', '%'.$state_code.'%');
			}
			
			if($street_number!=''){
				$query_store_list->where('street', 'like', '%'.$street_number.'%');
			}
			if($street!=''){
				//$query_store_list->where('street', 'like', '%'.$street.'%')->orWhere('street', 'like', '%'.$full_street.'%');
				$street_arr=explode(' ',$full_street);
				//for($i=0;count($street_arr)>$i;$i++){
					$query_store_list->where('street', 'like', '%'.trim($street_arr[0]).'%');
				//}
			}
			
			if($postal_code!=''){
				//$query_store_list->where('post_code', 'like', '%'.$postal_code.'%')->orWhere('post_code', 'like', '%'.$postal_code.'%');
			}
		}
		
		if($restaurent!=''){
			$query_store_list->where('restaurant_name', 'like', '%'.$restaurent.'%');
		}
		
		$store_list=$query_store_list->orderBy('merchant_id', 'desc')->get();
		
		
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
		
		
		
		 
		//echo '<pre>';print_r($store_list);exit;
		
		return view('front.search', compact('title','category_list','store_list','city','location','restaurent','cartinfo','total_cart_amount','total_cart_item'));
    }
	
	
	public function get_city($address){
		$address = str_replace(" ", "+", $address);
		
		$city			= '';
		$country		= '';
		$country_code	= '';
		$street			= '';
		$full_street	= '';
		$street_number	= '';
		$state			= '';
		$state_code		= '';
		$postal_code	='';
		//try {
			$json 	= file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=AIzaSyCBeYhfznD1X2nWYFXFpH6B4eJ9hGrr9_g");
			$data 	= json_decode($json);
			//echo '<pre>';print_r($data);exit;
			
			$status = $data->status;
			if($status=="OK") {
				for ($j=0;$j<count($data->results[0]->address_components);$j++) {
					$cn=array($data->results[0]->address_components[$j]->types[0]);
					
					if(in_array("street_number", $cn)) {
						$street_number	= $data->results[0]->address_components[$j]->long_name;
					}
					if(in_array("route", $cn)) {
						$street			= $data->results[0]->address_components[$j]->short_name;
						$full_street	= $data->results[0]->address_components[$j]->long_name;
					}
					
					if(in_array("postal_code", $cn)) {
						$postal_code	= $data->results[0]->address_components[$j]->long_name;
					}
					if(in_array("locality", $cn)) {
						$city	= $data->results[0]->address_components[$j]->long_name;
					}
					if(in_array("administrative_area_level_1", $cn)) {
						$state	= $data->results[0]->address_components[$j]->long_name;
						$state_code	= $data->results[0]->address_components[$j]->short_name;
					}
					if(in_array("country", $cn)) {
						$country		= $data->results[0]->address_components[$j]->long_name;
						$country_code	= $data->results[0]->address_components[$j]->short_name;
					}
					
				}
			}
		/*} catch (\Exception $e) {
			$city			= '';
			$country		= '';
			$country_code	= 'CA';
			
			$state			= '';
			$state_code		= '';
			
			$postal_code	='';
		}*/
		
		
		$result['postal_code']	= $postal_code;
		$result['city']			= $city;
		$result['country']		= $country;
		$result['country_code']	= $country_code;
		$result['state']		= $state;
		$result['state_code']	= $state_code;
		$result['street']		= $street;
		$result['full_street']	= $full_street;
		$result['street_number']= $street_number;
		
		//echo '<pre>';print_r($result);exit;
		
		return $result;
	}
	
	public function about_us(){
		$title = "About us";
		$user_id 	= Session::get('user_id');
		return view('front.about_us', compact('title'));
    }
	
	
	
	
}