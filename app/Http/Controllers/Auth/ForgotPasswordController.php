<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Input;
use Mail;
use URL;
use Validator;
use Session;
use App\Common;
use Helpers;



class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
	
	public function showLinkRequestForm(){
        $title = "Password Reset";
        $active = "forgot_password";
        return view('auth.passwords.forgot_password', compact('title','active'));
    }
	
	public function sendResetLinkToAdminEmail(Request $request){
        $email = Input::get('email');
        $rules = array('email' => 'required|email|max:255');
        $validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->back()->withErrors($validator);
        }else{
            $randomString  = Helpers::randomString(60);
            $data = array(
                'email' => $email,
                'token' => $randomString,
                'created_at' => date("Y-m-d H:i:s")
                );
			$checkEmailExists = Common::getSingelData(['email' => $email], 'users', ['email'], 'id', 'ASC');
            if(!empty($checkEmailExists)){
				$getData = Common::getSingelData(['email' => $email], 'password_resets', ['*'], 'email', 'ASC');
                if(!empty($getData)){
                    Common::updateData('password_resets','email',$email,$data);
                }else{
                    $inserData = Common::insertData('password_resets', $data);
				}
                
                //Start Send mail
                $subject = 'Reset Password';
                $resetPasswordEmail = [
                    'to' 		=> $email,
                    'subject' 	=> $subject,
                    'userName' 	=> $email,
                    'token' 	=> $randomString,
                    'view' 		=> 'mail_templates/reset_password_tempalte',
                ];
				
				
				$view = view($resetPasswordEmail['view'], $resetPasswordEmail)->render();
				//print_r($view);exit;
				
				
                Helpers::SendEmail($resetPasswordEmail);
                //End Send mail
                Session::flash('success', 'Please check your email.');
                
            }else{
                Session::flash('error', 'You are not admin user.');
            }
            return redirect::back();
        }
    }
	
	
	
	
	
}
