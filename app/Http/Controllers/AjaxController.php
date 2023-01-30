<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Common;
use App\BookingTable;
use App\Merchant;
use App\Table;
use App\TimeSlots;
use App\Order;
use Input;
use Session;
use Carbon;
use Image;
use DB;
use Helpers;
use Hash;
use Config;


class AjaxController extends Controller {

	public function checkEmailExist(){
		$to      = 'sdev75661@gmail.com';
    	$subject = 'the subject';
    	$message = 'hello';
		$randomString = '123456789';
		$resetPasswordEmail = [
			'to' 		=> $to,
            'subject' 	=> $subject,
			'userName' 	=> $to,
            'token' 	=> $randomString,
            'view' 		=> 'mail_templates/reset_password_tempalte',
       ];
	   $view = view($resetPasswordEmail['view'], $resetPasswordEmail)->render();
	   print_r($resetPasswordEmail);
	  Helpers::SendEmail($resetPasswordEmail);
	  
	  
	  $headers = 'From: test@aqualeafitsol.com'       . "\r\n" .
                 'Reply-To: test@aqualeafitsol.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    //mail($to, $subject, $message, $headers);exit;

	}
	public function checkphoneExist(){
		$type = Input::get('type');
		
		
	}
	
	public function ajaxpost(Request $request) {
		$action = $request->input('action');
		$this->{'ajaxpost_' . $action}($request);
	}
	
	public function ajaxpost_search_restaurants($request) {
		if (request()->isMethod('post')) {
			$keyword  	= $request->keyword;
			$results  	= [];
			$html		= '';
			
			if(!empty($keyword)){
				$restaurant_result = Merchant::where('status', 'active')
				->where(function($query2) use ($keyword) {
					$query2->where('restaurant_name', 'like', '%'.$keyword.'%')->orWhere('city', 'like', '%'.$keyword.'%');
				})
				->select('merchant_id','restaurant_name','logo','restaurant_slug','city')
				->orderby('restaurant_name', 'asc')
				->get();
				
				//print_r($restaurant_result);exit;
				
				if(count($restaurant_result)>0){
					$html.= '<ul id="search-result-restaurants">';
					foreach($restaurant_result as $row){
						$img_sec='';
						if($row->logo!=''){
							$img_src	= Helpers::store_logo($row->logo);
							$img_sec	= '<img alt="'.$row->logo.'" src="'.$img_src.'" width="50px">';
						}
						$url=route('store.details', $row->restaurant_slug);
						
						$html.= '<li class="select-li-restaurant"><a href="javascript:;"><div class="restaurant-search-item-img">'.$img_sec.'</div><div class="restaurant-search-item-title">'.$row->restaurant_name.'</div></a></li>';
					}
					$html.= '</ul>';
				}else{
					$html= '<ul id="search-result-restaurants"><li class="no-restaurant-found">No restaurant found!</li></ul>';
				}
			}
			
			//print_r($html);exit;
			
			echo json_encode(array('success' => 1, 'html' => $html));
		}
	}
	
	public function ajaxpost_table_booking_availability($request) {
		if (request()->isMethod('post')) {
			$merchant_id  		= $request->merchant_id;
			$total_person  		= $request->total_person;
			$booking_date  		= $request->booking_date;
			$booking_time_id  	= $request->booking_time_id;
			
			//$total_person		= 30;
			
			$results  	= [];
			$html		= '';
			
			$table_result = Table::where('merchant_id', $merchant_id)->where('status', 1)->get();
			$result=[];
			
			
			//print_r();exit;
			
			
			
			$booking_table_ids=[];
			$booking_result = BookingTable::where('merchant_id', $merchant_id)->where('time_slot_id', $booking_time_id)->where('date_slot', $booking_date)->where('status', 1)->get();
			foreach($booking_result as $row){
				$booking_table_ids[]=$row->table_id;
			}
			
			//echo '<pre>';print_r($booking_result);exit;
			//echo '<pre>';print_r($total_person);exit;
			
			foreach($table_result as $row){
				$total_seat=isset($row->total_seat)?$row->total_seat:0;
				if($total_seat>0){
					if($total_seat>=$total_person){
						$status='deactivate';
						if (!in_array($row->id, $booking_table_ids)){
							$status='open';
							
						}
						$result[]=array(
							'id'				=> $row->id,
							'table_name'		=> $row->table_name,
							'table_description'	=> $row->table_description,
							'total_seat'		=> $row->total_seat,
							'status'			=> $status
						);
					}
				}
			}
			
			
			echo json_encode(array('success' => 1, 'result' => $result));
		}
	}
	public function ajaxpost_timeslot_availability($request) {
		if (request()->isMethod('post')) {
			$merchant_id  		= $request->merchant_id;
			$total_person  		= $request->total_person;
			$booking_date  		= $request->booking_date;
			
			$total_table = Table::where('merchant_id', $merchant_id)->where('status', 1)->count();
			
			//$total_table =1;
			
			
			$booking_timeslot_ids=[];
			$booking_result = BookingTable::selectRaw('time_slot_id')->distinct()->where('merchant_id', $merchant_id)->where('date_slot', $booking_date)->where('status', 1)->get();
			foreach($booking_result as $row){
				$booked_total_table=BookingTable::where('merchant_id',$merchant_id)->selectRaw('table_id')->distinct()->where('date_slot', $booking_date)->where('time_slot_id', $row->time_slot_id)->where('status',1)->count();
				if($booked_total_table>=$total_table){
					$booking_timeslot_ids[]=$row->time_slot_id;
				}	
			}
			
			//echo '<pre>';print_r($booking_timeslot_ids);exit;
			
			$time_slots 		= TimeSlots::where('status',1)->get();
			$result=[];
			foreach($time_slots as $row){
				$status='Y';
				if (in_array($row->id, $booking_timeslot_ids)){
					$status='N';
				}
				$result[]=array(
					'id'		=> $row->id,
					'from_time'	=> $row->from_time,
					'status'	=> $status
				);
			}
			
			//echo '<pre>';print_r($result);exit;
			
			echo json_encode(array('success' => 1, 'result' => $result));
		}
	}
	
	public function ajaxpost_get_account($request) {
		if (request()->isMethod('post')) {
			$mobile = Input::get('mobile');
			$result = User::where('phone',$mobile)->first();
			$return_data=[];
			if(isset($result)){
				$wallet_data 	= Common::getSingelData($where=['user_id'=>$result->id],$table='user_wallet',$data=['balance'],'id','ASC');
				$balance_gross 	= isset($wallet_data->balance)? $wallet_data->balance:'0';
				$wallet_amount = 0;
				$wallet_amount+= $balance_gross;
				
				$return_data['status'] 			= 1;
				$return_data['customer_name']	= $result->name;
				$return_data['customer_id']		= $result->id;
				$return_data['current_amount']	= $wallet_amount;
			}else{
				$return_data['status']	= 0;
			}
			echo json_encode($return_data);
		}
	}
	
	
	
	
	
	public function ajaxpost_view_receipt($request) {
		if (request()->isMethod('post')) {
			$order_id = Input::get('order_id');
			
			$orderDetails = Common::getOrderDetails($order_id);
			
			
			$html='<table class="table table-borderless marcheny-allorder-details-table"><tbody><tr><td scope="col">Name :</td><td class="text-right">'.$orderDetails['order_info'][0]->customer_name.'</td></tr><tr><td scope="col">Telephone :</td><td class="text-right">'.$orderDetails['order_info'][0]->customer_phone.'</td></tr><tr><td scope="col">TRN Type :</td><td class="text-right">Delivery</td></tr><tr><td scope="col">Payment Type :</td><td class="text-right">'.$orderDetails['order_info'][0]->payment_type.'</td></tr><tr><td scope="col">Reference # :</td><td class="text-right">'.$orderDetails['order_info'][0]->order_id_token.'</td></tr><tr><td scope="col">TRN Date :</td><td class="text-right">'.$orderDetails['order_info'][0]->created_at.'</td></tr><tr><td scope="col">Location Name :</td><td class="text-right">'.$orderDetails['delivery_address'][0]->street.'</td></tr><tr><td scope="col">Contact Number :</td><td class="text-right">'.$orderDetails['delivery_address'][0]->contact_phone.'</td></tr><tr><td scope="col">zipcode :</td><td class="text-right">'.$orderDetails['delivery_address'][0]->zipcode.'</td></tr><tr><td colspan="2">Address :<p>'.$orderDetails['delivery_address'][0]->city.' '.$orderDetails['delivery_address'][0]->state.'</p></td></tr>';
			
			$cart_items_html='';
			
			foreach($orderDetails['product_data'] as $cart){
				$cart_items_html .='<tr class="order-details-ftr">
                  <td scope="col">
                    <div class="d-flex">
                      <div class="qty-number"><h6>'.$cart['quantity'].'</h6></div>
                      <div class="prod-name">
                        <h6>'.$cart['name'].'(Piece)</h6>
                        <p>$'.$cart['grand_total'].'</p>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">$'.$cart['grand_total'].'</td>
                </tr>';
			}
			
			$html .=$cart_items_html;
			
			$html .='</tbody>
              <tfoot style="border-top: 1px solid;">
                <tr>
                  <td>Sub Total</td>
                  <td class="text-right">$'.$orderDetails['grand_total'].'</td>
                </tr>
                <tr>
                  <td>Delivery Fee</td>
                  <td class="text-right">$0.00</td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td class="text-right">$'.$orderDetails['grand_total'].'</td>
                </tr>
              </tfoot>
            </table>';
			$return_data['html']	= $html;
			echo json_encode($return_data);
		}
	}
	
	public function ajaxpost_table_booking_view_receipt($request) {
		if (request()->isMethod('post')) {
			$order_id = Input::get('order_id');
			$orderDetails = BookingTable::where('id',$order_id)->first();
			
			
			
			$html='<table class="table table-borderless marcheny-allorder-details-table"><tbody><tr><td scope="col">Customer Name :</td><td class="text-right">'.$orderDetails->customer_name.'</td></tr><tr><td scope="col">Telephone :</td><td class="text-right">'.$orderDetails->phone.'</td></tr><tr><td scope="col">Email:</td><td class="text-right">'.$orderDetails->email.'</td></tr><tr><td scope="col">Total Guest :</td><td class="text-right">'.$orderDetails->total_person.'</td></tr><tr><td scope="col">Reference # :</td><td class="text-right">'.$orderDetails->booking_id.'</td></tr><tr><td scope="col">Date Booking :</td><td class="text-right">'.$orderDetails->date_slot.'</td></tr><tr><td scope="col">Time Slot :</td><td class="text-right">'.$orderDetails->time_slot.'</td></tr><tr><td scope="col">Table Name :</td><td class="text-right">'.$orderDetails->table->table_name.'</td></tr><tr><td colspan="2">Special note :<p>'.$orderDetails->special_note.'</p></td></tr>';
			$html .='</tbody> </table>';
			$return_data['html']	= $html;
			echo json_encode($return_data);
		}
	}
	
}
