<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



use Helpers;
use App\User;
use App\User_wallet;
use App\Site_settings;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller{

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
	 
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'otp'         => 'required|string|max:255',
            'password'     => 'required|string|min:6|confirmed',
            'user_type' => 'required|numeric|digits:1|regex:/^[1-2]+/',
            'phone'     => 'required|numeric|digits:10|regex:/^[0-9]+/|unique:users',
        ]);
		
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
		
        $otp = $request->input('otp1');
        $otp .= $request->input('otp2');
        $otp .= $request->input('otp3');
        $otp .= $request->input('otp4');
		
        $verification_code	= $request->input('otp');
        $otpPhone           = $request->input('otpPhone');
        $phone              = $request->input('phone');
		
        $user = User::create([

            'name'             => $request->get('name'),
            'email'         => $request->get('email'),
            'raw_password'     => $request->get('password'),
            'password'         => Hash::make($request->get('password')),
            'user_type'     => $request['user_type'],
            'phone'         => $request['phone']
        ]);



        //dd($user);

        User_wallet::create([
            'user_id' => $user->id,
            'balance' => 0

        ]);

        User::where('id', $user->id)->update([
            'raw_password'     => $request->get('password')
        ]);

        User::where('id', $user->id)->update(['device_token' => $request['device_token']]);



        $token = JWTAuth::fromUser($user);

        return response()->json(['success' => true, 'token' => $token,], 200);

        //return response()->json(compact('user','token'),201);

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
	 
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
		
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Wrong Details'], 400);
            } else {
                if (\Auth::user()->user_type != 2) {
                    return response()->json(['error' => 'Invalid User Type'], 400);
                }
            }
        } catch (JWTException $e) {

            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $id = \Auth::user()->id;
		
		$user_result=array(
			'id'		=>\Auth::user()->id,
			'name'		=>\Auth::user()->name,
			'email'		=>\Auth::user()->email,
			'phone'		=>\Auth::user()->phone,
			'country'	=>\Auth::user()->country,
			'city'		=>\Auth::user()->city,
		);

        //User::where('id', $id)->update(['device_token' => $request['device_token']]);

        return response()->json(['success' => true, 'token' => $token,'user_result' => $user_result], 200);
    }

   


    /**

     * Logout

     * Invalidate the token. User have to relogin to get a new token.

     * @param Request $request 'header'

     */

    public function logout(Request $request){

        // Get JWT Token from the request header key "Authorization"

        $token = $request->header('Authorization');

        // Invalidate the token

        try {

            JWTAuth::invalidate($token);

            return response()->json([

                'status' => 'success',

                'message' => "User successfully logged out."

            ]);
        } catch (JWTException $e) {

            // something went wrong whilst attempting to encode the token

            return response()->json([

                'status' => 'error',

                'message' => 'Failed to logout, please try again.'

            ], 500);
        }
    }
}
