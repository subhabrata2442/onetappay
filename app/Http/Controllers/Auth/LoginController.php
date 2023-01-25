<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;
use App\User;
use App\Merchant;
use Auth;
use DB;
use Response;
use Hash;
use App\Common;
use Helpers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/my-account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('checkadminauth')->except('logout');
    }
	
	public function index(){
        $title = "Login";
        $active = "Login";
		return view('auth.admin', compact('title','active'));
	}
	
	// Member login
	public function customerAuthentication(Request $request){
		$data= $request->only('email','password','user_type');
		$user = User::where([['email', '=', $data['email']],['user_type', '=', '3']])->first();
		
		$return_data= array();
		
		if(isset($user)){
			$remember = $request->get('remember');
			if(Auth::attempt($data,$remember)){
				$user = User::where([['email', '=', $data['email']],['user_type', '=', '3']])->first();
				$userId = $user->id;
        		$userType = $user->user_type;
        		$userEmail = $user->email;
        		$userName = $user->name;
				
				/*$cart_id = Session::get('cart_id');
				if(isset($cart_id)){
					Common::updateData($table="cart_items",$uId = "ses_id", $cart_id, $data = ['user_id' =>$userId]);
				}*/
				
				
				if($userType == 3){
					Session::put('user_id', $userId);
					Session::put('user_type', $userType);
					Session::put('email', $userEmail);
					Session::put('userName', $userName);
				
					$return_data['success']			= 1;
					$return_data['success_message'] = 'Record is successfully added';
				}else{
					$return_data['success']			= 0;
					$return_data['error_message'] 	= 'Email or password is invalid!';
				}
			}else{
				$return_data['success']			= 0;
				$return_data['error_message'] 	= 'Email or password is invalid!';
				}
			}else{
				$return_data['success']			= 0;
				$return_data['error_message'] 	= 'Email or password is invalid!';
			}
			
			
		return response()->json([$return_data]);	
	}
	
	public function logout(Request $request) {
		Session::forget('redirect_url');
		
		Auth::logout();
		Session::flush();
		return redirect('/');
		
	}
	
	// Merchant admin Login			
	public function merchant_admin(){
		$title	= 'Admin Login';
		$active = "adminlogin";
		
		$adminId 	= Session::get('adminId');
		$admin_type = Session::get('admin_type');
		
		
		
		if(isset($adminId)){
			return redirect('merchant_admin/dashboard');
		}
        return view('auth.merchant_login', compact('title','active'));
    }
	public function merchantAuthentication(Request $request){
		$data= $request->only('email','password','user_type');
		$remember = $request->get('remember');
		if(!empty($remember)){
			setcookie ("email",$request->email,time()+ (60 * 2));
			setcookie ("password",$request->password,time()+ (60 * 2));
		}else {
			if(isset($_COOKIE["email"])) {
				setcookie ("email","");
			}
			if(isset($_COOKIE["password"])) {
				setcookie ("password","");
			}
		}
		
        if(Auth::attempt($data,$remember)){
			$user = User::where([['email', '=', $data['email']],['user_type', '=', '2']])->first();
        	$userId = $user->id;
        	$userType = $user->user_type;
        	$userEmail = $user->email;
        	$userName = $user->name;
			
			if($userType == 2){
				
				$merchantInfo=Merchant::where('user_id',$userId)->first();
				$merchant_id=isset($merchantInfo->merchant_id)?$merchantInfo->merchant_id:0;
				
				Session::put('merchant_id', $merchant_id);
				Session::put('adminId', $userId);
				Session::put('admin_type', $userType);
				Session::put('admin_email', $userEmail);
				Session::put('admin_userName', $userName);
				return redirect('merchant_admin/dashboard');
			}else{
				return back()->withInput()->withErrors(['error'=>'Email or password is invalid!']);
			}
		}else{
			return back()->withInput()->withErrors(['error'=>'Email or password is invalid!']);
			}
		}
	
	// Admin Login			
	public function admin(){
		$title	= 'Admin Login';
		$active = "adminlogin";
		
		$adminId 	= Session::get('adminId');
		$admin_type = Session::get('admin_type');
		
		if(isset($adminId)){
			return redirect('administrator/dashboard');
		}
		
		//echo 'dd';exit;
		
		
        return view('auth.login', compact('title','active'));
    }
	public function adminAuthentication(Request $request){
		$data= $request->only('email','password','user_type');
		$remember = $request->get('remember');
		if(!empty($remember)){
			setcookie ("email",$request->email,time()+ (60 * 2));
			setcookie ("password",$request->password,time()+ (60 * 2));
		}else {
			if(isset($_COOKIE["email"])) {
				setcookie ("email","");
			}
			if(isset($_COOKIE["password"])) {
				setcookie ("password","");
			}
		}
		
		
		
        if(Auth::attempt($data,$remember)){
			$user = User::where([['email', '=', $data['email']],['user_type', '=', '1']])->first();
        	$userId = $user->id;
        	$userType = $user->user_type;
        	$userEmail = $user->email;
        	$userName = $user->name;
			
			if($userType == 1){
				Session::put('adminId', $userId);
				Session::put('admin_type', $userType);
				Session::put('admin_email', $userEmail);
				Session::put('admin_userName', $userName);
				return redirect('administrator/dashboard');
			}else{
				return back()->withInput()->withErrors(['error'=>'Email or password is invalid!']);
			}
		}else{
			return back()->withInput()->withErrors(['error'=>'Email or password is invalid!']);
			}
		}
		
	
		
}
