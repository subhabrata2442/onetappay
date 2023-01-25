<?php
namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon;
use Auth;
use Image;
use DB;
use Helpers;
use Hash;
use App\Common;
use App\User_wallet;
use App\Payments;
use App\Withdraw_request;
use App\Balance_request;
use App\Time_slots;
use App\Category;
use App\Play_type;
use App\Game_type;
use App\Transactions;
use App\User_bit_transaction;
use App\Avality_time_date_slots;
use App\Win_price_calculation;
use Config;
class ResultController extends Controller {
	protected $paymentsModel;
	protected $withdrawRequestModel;
	protected $balanceRequestModel;
	protected $timeSlotsModel;
	protected $userBitTransactionModel;
	protected $avalityTimeDateSlotsModel;
	public function __construct(){
		$this->paymentsModel 				= new Payments;
		$this->withdrawRequestModel 		= new Withdraw_request;
		$this->balanceRequestModel 			= new Balance_request;
		$this->timeSlotsModel 				= new Time_slots;
		$this->userBitTransactionModel 		= new User_bit_transaction;
		$this->avalityTimeDateSlotsModel 	= new Avality_time_date_slots;
    }
	
	public function showbid(){
		$title 			= 'Total Bet';
        $breadcumbs 	= 'Total Bet';
        $active 		= 'showbid';
		$meta_data 		= array();
        $search 		= Input::get('s');
		$cat_id 		= Input::get('cat_id');
		$slot_id 		= Input::get('slot_id');
		$play_type_id 	= Input::get('type_id');
		$date 			= Input::get('date');
        $cur_page 		= Input::get('pg');
		$current_date 	= '';
		if(isset($_GET['date'])){
			if($date!=''){
				$current_date = $date;
			}
		}
        $cur_page 		= $cur_page == '' ? 1 : $cur_page;
        $per_page		= 20;
        $limit_start	= ($cur_page - 1) * $per_page;
        $param 					= array();
		$param['search'] 		= $search;
		$param['cat_id'] 		= $cat_id;
		$param['slot_id'] 		= $slot_id;
		$param['play_type_id'] 	= $play_type_id;
		$param['current_date'] 	= $current_date;
        $param['cur_page'] 		= $cur_page;
        $param['per_page'] 		= $per_page;
        $param['limit_start']	= $limit_start;
		$result 				= $this->userBitTransactionModel->getTotalBidResultTest($param);
		$category_list 			= Category::get();
		$type_list     			= Play_type::get();
		$time_slots				= [];
		if($cat_id!=''){
			$time_slots	= Time_slots::where('category_id',$cat_id)->get();
		}
		//echo '<pre>';print_r($result);exit;
		return view('showbid', compact('title','active','breadcumbs','category_list','type_list','time_slots','result','current_date'));
    }
}