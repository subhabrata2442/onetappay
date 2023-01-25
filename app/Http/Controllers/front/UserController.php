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

class UserController extends Controller {
	
	public function profile(){
		
		 $title 		= "Profile";
		 $breadcumbs 	= "Profile";
		 $active 		= 'profile';
		 
		 $user_id		= Session::get('user_id');
		 $user_info 	= Common::getSingelData($where=['id'=>$user_id],$table='users',$data=['id','first_name','last_name','email','phone','logo'],'id','ASC');
		 
		 $user_logo		= isset($logo)?Helpers::user_logo($user_info->logo): asset('public/front/images/demo_user.png');
		 
		 //echo '<pre>';print_r($user_logo);exit;
		 
		 return view('front.user.profile', compact('title','breadcumbs','active','user_info','user_logo'));	  
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
	
}
