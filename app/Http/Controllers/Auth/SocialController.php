<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Redirect;
use Helpers;
use Session;
use App\User;
use App\Common;
use Response;
use DB;


class SocialController extends Controller
{

 

    public function getSocialRedirect( $provider )
    {

        $providerKey = Config::get('services.' . $provider);


        if (empty($providerKey)) {

            return view('pages.status')
                ->with('error','No such provider');

        }

        return Socialite::driver( $provider )->redirect();

    }

    public function getSocialHandle( $provider ){
        if (Input::get('denied') != '') {
            return redirect()->to('login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your profile data with our social app.');
        }
        $user = Socialite::driver( $provider )->user(); 
        $redirect='';

        //dd($user);
        //$redirect = $request->get('redirect');     

        $socialUser = null;
        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();
        $email = $user->email;
        if (!$user->email) {
            $email = 'missing' . str_random(10);
        }
        if (!empty($userCheck)) {
			$socialUser = $userCheck;
            Session::put('user_id', $socialUser['id']);
            Session::put('user_type', $socialUser['user_type']);
            Session::put('email', $socialUser['email']);
            Session::put('userName', $socialUser['name']);
			return redirect('/');
        }else {
			$name = explode(' ', $user->name);
			$fname='';
			$lname='';
			if (count($name) >= 1) {
				$fname = $name[0];
			}
			if (count($name) >= 2) {
				$lname = $name[1];
			}
			
			
			$user_type 			= 2;
			$email 				= $email;
			$name 				= $name;
			$password 			= '';
			$d_ob 				= '';
			$m_ob 				= '';
			$y_ob 				= '';
			$gender 			= '';
			$redirect 			= url('/profile');	 
			$IP = Helpers::get_ip();
			
			$userArr = [
				'name'				=> $name,
				'email'				=> $email,
				'roll'				=> $user_type,
				'user_type' 		=> $user_type,
				'status' 			=> 1,
				'IP'				=> $IP,
                'password' 			=> '',
				'remember_token' 	=> '',
				'created_at'		=> date('Y-m-d')
               ];
			   
			
			$newSocialUser = new User;
			$newSocialUser->name			= $user->name;
			$newSocialUser->email     		= $email;
            $newSocialUser->roll 			= $user_type;
			$newSocialUser->user_type 		= $user_type;
			$newSocialUser->status 			= '1';	 
			$newSocialUser->IP 				= $IP;	 
			$newSocialUser->password 		= '';	 
			$newSocialUser->remember_token	= '';	 
			$newSocialUser->created_at 		= date('Y-m-d');
			
			//print_r($newSocialUser);exit;
			
			$newSocialUser->save();
            $lastInsertedId =  $newSocialUser->id;
			   
			   
			  // print_r($userArr);exit;
			   
			
			//$user=User::save($userArr);
			//$lastInsertedId= $user->id;
			
			//print_r($userArr);exit;
			   
			$userDetails = [
				'user_id'		=> $lastInsertedId,
				'fname'			=> $fname,
				'lname'			=> $lname,
				'email' 		=> $email,
				'password' 		=> '',
				'password_real'	=> '',
                'dob' 			=> '',
				'gender' 		=> ''
               ];
			   
			 Common::insertData('members', $userDetails);
			 
			// print_r($userDetails);exit;
			 
			 Session::put('user_id', $lastInsertedId);
             Session::put('user_type', $user_type);
             Session::put('email', $email);
             Session::put('userName', $user->name);
			 
			$subject = 'Confirmation of registration email';
			$mailData = [
				'to' 		=> $email,
                'subject' 	=> $subject,
                'uName' 	=> $user->name,
				'user_verification_link'=>url('/'),
                'view' 		=> 'mail_templates/registration_welcome_template',
              ];
				
			Helpers::sendSinglemail($mailData);
			
			$return_data['success'] 		= 1;
			$return_data['redirect'] 		= $redirect;
			$return_data['success_message'] = '<span>Record is successfully added</span>';
			//return response()->json([$return_data]);
			return redirect('/profile');
			
        }

           auth()->login($socialUser, true);
               
            if(!empty($redirect)){
                return redirect('/'.$redirect);
             }else{

                return redirect('/my-account');
            }
      

        return abort(500, 'User has no Role assigned, role is obligatory! You did not seed the database with the roles.');

    }
}