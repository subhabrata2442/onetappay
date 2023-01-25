<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Common;
use Input;
use Session;
use Carbon;
use Auth;
use Image;
use DB;
use Helpers;
use Hash;
class UserController extends Controller {
	
	protected $userModel;
	
	 public function __construct(){
		$this->userModel	= new User;
		Helpers::set_elescope_entries();
    }
	
   
	public function user(){
		$title 			= "Users";
        $breadcumbs 	= "Users";
        $active 		= "user";
		
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
		
		$user_list = $this->userModel->get_users($param);
		
		//echo '<pre>';print_r($user_list);exit;
		
		return view('admin.users', compact('title','active','breadcumbs','user_list'));
    }
	
	public function user_show($slug){
		 $title 		= "User Details";
		 $breadcumbs 	= "User Details";
		 $active 		= 'user';
		 
		 $param['user_id']	= $slug;
		 $user_info 		= $this->userModel->get_user($param);
		 
		 //echo '<pre>';print_r($user_info['records']['name']);exit;
		 
		 return view('admin.user_details', compact('title','breadcumbs','active','user_info'));	  
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
 
	
}
