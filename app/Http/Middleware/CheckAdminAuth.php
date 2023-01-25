<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;

class CheckAdminAuth
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
		
		$userType = Session::get('admin_type');
		$adminId = Session::get('adminId');
		
        if(auth()->check() && auth()->user()->isAdmin($adminId)) {
            return $next($request);
        }elseif($request->session()->has('admin_type')){
            if($userType == 1){
				//echo 'test2';exit;
                return $next($request);
            }elseif($userType == 2){
				return redirect('/merchant_admin/dashboard');
			}else{
				if($userType==2){
					return redirect('/merchant_admin/dashboard');
				}
				if($userType==3){
					return redirect('/');
				}
				return redirect()->back();  
            }
        }else{
			
			$segment_1=request()->segment(1);
			$segment_2=request()->segment(2);
			
			if(isset($segment_2)){
				//echo 'test4';exit;
				return redirect('/administrator');
				}else{
					//echo 'test4f';exit;
					return $next($request);
					}
        }
        return $next($request);
    }
}