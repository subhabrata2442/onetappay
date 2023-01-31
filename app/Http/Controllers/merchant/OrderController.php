<?php
namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Common;
use App\Merchant;
use App\Table;
use App\Item;
use App\Category;
use App\Subcategory;
use App\SubcategoryItem;
use App\BookingTable;
use App\Order;

use Input;
use Session;
use Carbon;
use Auth;
use Image;
use DB;
use Helpers;
use Hash;

class OrderController extends Controller {
	
	public function incomingorders(){
		$title 			= "All Orders";
        $breadcumbs 	= "All Orders";
        $active 		= "incomingorders";
		
		$merchant_id = Auth::id();
		$order_list	= Order::where('merchant_id',$merchant_id)->where('order_status',1)->orderBy('order_id','DESC')->get();
		
		//echo '<pre>';print_r($order_list);exit;
		
		return view('merchant.incomingorders', compact('title','active','breadcumbs','order_list'));
    }
	
	public function saveOrderStatusRequest(Request $request){
		$validator = Validator::make($request->all(), [
			'status'	=> 'required|string|max:255',
			'order_id' 	=> 'required|string|max:255',
        ]);
		
		$order_id=Input::post('order_id');
		
		if ($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			Session::flash('success', $error_html);
			return redirect('merchant_admin/incomingorders');
        }else{
			$data_general['status']=Input::post('status');
			Common::updateData($table="order", "order_id", $order_id, $data_general);
			
			Session::flash('success', 'Successfully Saved data.');
			return redirect('merchant_admin/incomingorders');
		}
	}
	
	public function saveBookingStatusRequest(Request $request){
		$validator = Validator::make($request->all(), [
			'status'	=> 'required|string|max:255',
			'order_id' 	=> 'required|string|max:255',
        ]);
		
		$order_id=Input::post('order_id');
		
		if ($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			Session::flash('success', $error_html);
			return redirect('merchant_admin/food/table_booking');
        }else{
			$data_general['status']=Input::post('status');
			Common::updateData($table="user_booking_table", "id", $order_id, $data_general);
			
			Session::flash('success', 'Successfully Saved data.');
			return redirect('merchant_admin/food/table_booking');
		}
	}
	
}
