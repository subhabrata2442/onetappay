<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;
use Input;
use Mail;
use URL;
use Session;
use App\Common;
use DB;
use App\User as User;
use Hash;
use Helpers;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
	
	 public function showResetAdminForm(){
        $title = "Reset Password";
        $active = "reset_password";
        return view('auth.passwords.resetAdminPass', compact('title','active'));
    }
	
	public function resetForm(){
		$title = "Reset Password";
        $active = "reset_password";
		$user_info = Common::getSingelData(['id' => $userId], 'users', ['id'], 'id', 'ASC');
        return view('auth.passwords.resetPass', compact('title','active','user_info'));
		
	}
	
	public function AdminResetPasswordRequest(Request $request){
        $this->validate($request, [
			'token' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required_with:password|same:password'
        ]);
		
		$token = Input::get('token');
		$tokenData = DB::table('password_resets')->where('token', $token)->first();
		if (!$tokenData){
            return redirect()->back()->withErrors(['email' => trans('passwords.request')]);
			}
		
		$user = User::where('email', $tokenData->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/administrator')->with('success', 'Your password has successfully reset.');
    }
	
	
}
