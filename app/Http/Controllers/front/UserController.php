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
use App\AddressBook;
use App\Countrie;
use App\Order;
use App\BookingTable;

use Input;
use Session;
use Carbon;
use Auth;
use Image;
use DB;
use Helpers;
use Hash;

class UserController extends Controller {
	
	public function profile(){
		
		 $title 		= "Profile";
		 $breadcumbs 	= "Profile";
		 $active 		= 'profile';
		 
		 $user_id		= Session::get('user_id');
		 $user_info 	= Common::getSingelData($where=['id'=>$user_id],$table='users',$data=['id','first_name','last_name','email','phone','logo'],'id','ASC');
		 
		 $user_logo		= isset($logo)?Helpers::user_logo($user_info->logo): asset('public/front/images/demo_user.png');
		 
		 $address_book 	= AddressBook::where('user_id',$user_id)->get();
		 $countrie		= Countrie::All();
		 
		 $order_history	= Order::where('user_id',$user_id)->orderBy('order_id','DESC')->get();
		 $table_booking_history	= BookingTable::where('user_id',$user_id)->orderBy('id','DESC')->get();
		 
		 
		 //echo '<pre>';print_r($table_booking_history);exit;
		 
		 
		 
		 
		 
		 return view('front.user.profile', compact('title','breadcumbs','active','user_info','user_logo','address_book','countrie','order_history','table_booking_history'));	  
    }
	
	public function updateClientProfile(Request $request){
		$validator = Validator::make($request->all(), [
			'first_name' 	=> 'required|string|max:255',
			'last_name' 	=> 'required|string|max:255',
			'contact_phone' => 'required|string|max:255',
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
			$first_name 		= Input::post('first_name');
			$last_name 			= Input::post('last_name');
			$contact_phone 		= Input::post('contact_phone');
			$icocode 			= Input::post('icocode');
			$password 			= Input::post('password');
			$cpassword 			= Input::post('confirmed_password');
			
			$fullName 			= $first_name.' '.$last_name;
			
			$phone='';
			if($icocode!=''){
				$phone='+'.$icocode.$contact_phone;
			}
			
			$data_general=array(
				'name'			=> $fullName,
				'first_name'	=> $first_name,
				'last_name'		=> $last_name,
			);
			if($phone!=''){
				$data_general['phone']=$phone;
			}
			
			if($password!=''){
				$data_general['password']=Hash::make($password);
			}
			/*if($password!=''){
				$data_general['logo']='';
			}*/
			
			$user_id		= Session::get('user_id');
			Common::updateData($table="users", "id", $user_id, $data_general);
			
			$return_data['success'] 		= 1;
			$return_data['success_message'] = '<span>Record is successfully added</span>';
			return response()->json([$return_data]);
		}
	}
	
	public function updateClientAddress(Request $request){
		$validator = Validator::make($request->all(), [
			'street' 			=> 'required|string|max:255',
			'city' 				=> 'required|string|max:255',
			'state' 			=> 'required|string|max:255',
			'zipcode' 			=> 'required|string|max:255',
			'location_name' 	=> 'required|string|max:255',
			'country' 			=> 'required|string|max:255',
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
			$address_id 	= Input::post('address_id');
			$street 		= Input::post('street');
			$city 			= Input::post('city');
			$state 			= Input::post('state');
			$zipcode 		= Input::post('zipcode');
			$location_name 	= Input::post('location_name');
			$country_code 	= Input::post('country');
			$defaul_address = Input::post('defaul_address');
			
			$country_info	= Countrie::where('sortname',$country_code)->first();
			$country_name	= isset($country_info->name)?$country_info->name:'';
			
			$user_id		= Session::get('user_id');
			
			/*$is_defaul_address=0;
			if($defaul_address==1){
				$is_defaul_address=1;
				
				$default_address_data=array('as_default'=> 0);
				Common::updateData($table="address_book", "user_id", $user_id, $default_address_data);
			}*/
			
			$default_address_data=array('as_default'=> 0);
			Common::updateData($table="address_book", "user_id", $user_id, $default_address_data);
			
			if($address_id!=''){
				$data_general=array(
					'street'		=> $street,
					'city'			=> $city,
					'state'			=> $state,
					'zipcode'		=> $zipcode,
					'location_name'	=> $location_name,
					'country_code'	=> $country_code,
					'as_default'	=> 1
				);
				Common::updateData($table="address_book", "user_id", $user_id, $data_general);
				$return_data['success_message'] = '<span>Update Address successfully</span>';
			}else{
				$data_general=array(
					'user_id'		=> $user_id,
					'street'		=> $street,
					'city'			=> $city,
					'state'			=> $state,
					'zipcode'		=> $zipcode,
					'location_name'	=> $location_name,
					'country_code'	=> $country_code,
					'as_default'	=> 1,
				);
				Common::insert_get_id($table="address_book", $data_general);
				$return_data['success_message'] = '<span>Address successfully added</span>';
			}
			$return_data['success'] 	= 1;
			$return_data['tab'] 		= 2;
			
			
			
			
			
			
			
			
			return response()->json([$return_data]);
		}
	}
	
	public function delete_address(Request $request){
		$address_id = Input::post('address_id');
		$user_id	= Session::get('user_id');
		Common::deleteData($table="address_book","id", $address_id);
		$return_data['success'] 		= 1;
		$return_data['success_message'] = '<span>Address is deleted successfully.</span>';
		return response()->json([$return_data]);
		
	}
	
	public function cancel_booking_table(Request $request){
		$booking_id = Input::post('booking_id');
		$user_id	= Session::get('user_id');
		$data_general['status']=0;
		
		BookingTable::where(['user_id'=>$user_id,'id'=>$booking_id])->update(['status'=>0]);
		
		$return_data['success'] 		= 1;
		$return_data['success_message'] = '<span>Table booking is successfully cancel.</span>';
		return response()->json([$return_data]);
		
	}
	
}
