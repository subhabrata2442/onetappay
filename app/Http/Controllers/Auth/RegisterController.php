<?php

namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Redirect;
use Input;
use Helpers;
use Session;
use App\User;
use App\Common;
use Response;
use DB;
use Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('checkadminauth')->except('logout');
    }
	
	 public function index(){
		 $title 	= 'Registration';
		 $active 	= "registration";
		 
		 $userId 	= Session::get('user_id');
		 
		 if(isset($userId)){
			return redirect('/');
		}
		
		return view('front.user.signup', compact('title','active'));
	}
	
	

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
		
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
	
	 /**
     * send otp to user email.
     *
     */
    public function sendOtp(Request $request){
		$validator = Validator::make($request->all(), [
		'email' => 'required|string|email|max:255|unique:users'
        ]);
		if($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
				}
			   
		   $return_data['success'] = 0; 
		   $return_data['error_message'] = $error_html;
		   return response()->json([$return_data]);
		  }else{
			   $userEmail = Input::post('email');
			   $otp = Helpers::generateOTP();
			   $otpArr = array(
			   'email' => $userEmail,
			   'verification_code' => $otp
			   );
			   Session::put('reg_otp', $otpArr);
			   
			   $subject = 'Email verification Otp';
			   $mailData = [
                    'to' 		=> $userEmail,
                    'subject' 	=> $subject,
                    'from' 		=> 'subha@aqualeafitsol.com',
                    'email' 	=> $userEmail,
                    'otp'		=> $otp,
                    'view' 		=> 'mail_templates/registration_otp_tempalte',
                ];
				
				Helpers::sendSinglemail($mailData);
				//print_r($email_html);
				//print_r($mailData);exit;
			   $return_data['success'] = 1;
			   $return_data['otp'] = $otp;
			   
			return response()->json([$return_data]);
			}
		
		}
		
		
	 /**
     * validate otp and resend otp.
     *
     */
    public function otpValidation(){
        $otp = Input::post('otp');
		$getotpArr=Session::get('reg_otp');
		$verification_code=$getotpArr['verification_code'];
		if(!empty($otp)){
			if($verification_code==$otp){
				$return_data['action']=1;
				}else{
					$return_data['action']=0;
					}
				}else{
					$return_data['action']=0;
					}	
						
       return response()->json([$return_data]);
    }
	
	
	/**
     * Registration process.
     *
     */
	 
    public function createUser(Request $request){
        $validator = Validator::make($request->all(), [
			'first_name' 	=> 'required|string|max:255',
			'last_name' 	=> 'required|string|max:255',
			'contact_phone' => 'required|string|max:255',
			'email' 		=> 'required|string|email|max:255|unique:users',
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
			$user_type 			= 3;
			$fullName 			= Input::post('first_name').' '.Input::post('last_name');
			$first_name 		= Input::post('first_name');
			$last_name 			= Input::post('last_name');;
			
			$email 				= Input::post('email');
			$phone 				= Input::post('contact_phone');
			$password 			= Input::post('password_confirmation');
			$country 			= Input::post('countryiso');
			$icocode 			= Input::post('icocode');			
			$IP 				= Helpers::get_ip();
			
				 
			$userArr = [
				'user_type'			=> $user_type,
				'name'				=> $fullName,
				'first_name'		=> $first_name,
				'last_name'			=> $last_name,
				'email'				=> $email,
				'password' 			=> Hash::make($password),
				'phone'				=> '+'.$icocode.$phone,
				'country'			=> $country,
				'status' 			=> 1,
				'IP'				=> $IP,
				'remember_token' 	=> $request->_token,
				'created_at'		=> date('Y-m-d')
               ];
			   
			 //print_r($userArr);exit;  
			   
			 $user = User::create($userArr);
			 $user_id= $user->id;
			 
			 $post = array('password' => $password, 'email' => $email);
			 Auth::loginUsingId($user_id);
			 
			 Session::put('user_id', $user_id);
             Session::put('user_type', $user_type);
             Session::put('email', $email);
             Session::put('userName', $fullName);
			
 			/*$subject = 'Confirmation of registration email';
			$mailData = [
				'to' 		=> $email,
                'subject' 	=> $subject,
                'uName' 	=> $name,
				'user_verification_link'=>url('/'),
                'view' 		=> 'mail_templates/registration_welcome_template',
              ];
				
			Helpers::sendSinglemail($mailData);*/
			
			$return_data['success'] 		= 1;
			$return_data['success_message'] = '<span>Record is successfully added</span>';
			return response()->json([$return_data]);
		}
			
    }
		
	public function create_test(){
		return response()->json(['name' => 'Abigail','state' => 'CA']);die();
		
		}	
		
	
	
	
}
