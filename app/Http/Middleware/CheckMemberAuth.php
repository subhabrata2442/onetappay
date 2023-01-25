<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;

class CheckMemberAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	 
    public function handle($request, Closure $next){
		$userId = Auth::id();
		$userType = Session::get('user_type');
        if(auth()->check() && auth()->user()->isMember($userId)) {
            return $next($request);
        }elseif($request->session()->has('user_type')){
            if($userType == 2){
                return $next($request);
            }else{
                return redirect()->back();
            }
        }else{
			return redirect('/signup');
			}
        return $next($request);
    }
}