<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;

class CheckMerchantAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	 
    public function handle($request, Closure $next){
		$userId		= Auth::id();
		$userType = Session::get('admin_type');
		
		if(auth()->check() && auth()->user()->isMerchant($userId)) {
			return $next($request);
		}elseif($request->session()->has('admin_type')){
			if($userType == 2){
				return $next($request);
			}elseif($userType == 1){
				return redirect('/administrator/dashboard');
			}else{
				return redirect()->back();
			}
		}else{
			$segment_1=request()->segment(1);
			$segment_2=request()->segment(2);
			if(isset($userId)){
				if(isset($segment_2)){
					return redirect('/merchant_admin/dashboard');
				}else{
					return $next($request);
				}
			}else{
				return redirect('/merchant_admin');
			}
		}
        return $next($request);
    }
}