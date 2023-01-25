<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Session;
use Carbon;
use Auth;
use Image;
use DB;
use Helpers;
use Hash;
use Config;
use App\User;
use App\Common;
use App\Payments;
use App\Withdraw_request;
use App\Balance_request;
use App\Transactions;


class CronController extends Controller {
	protected $paymentsModel;
	protected $withdrawRequestModel;
	protected $balanceRequestModel;
	protected $userTransactionsModel;
	
	public function __construct(){
		$this->paymentsModel 			= new Payments;
		$this->withdrawRequestModel 	= new Withdraw_request;
		$this->balanceRequestModel 		= new Balance_request;
		$this->userTransactionsModel	= new Transactions;
		
    }
     
    
	
	public function cron_balance_request(){
		$balance_request_data	= Balance_request::where('status','pending')->get();
		//$balance_request_data	= Balance_request::where('id',1)->get();
		
		$demo = fopen("demo_file.txt", "w+");
		fprintf($demo, "%s %s %s", "Welcome",
            "to", "bet16");
		fclose($demo);
		
		//print_r($balance_request_data);exit;
		
		foreach($balance_request_data as $row){
			
			$current_time	= date('H:i');
			$passed_time	= date('H:i',strtotime($row->created_at));
			
			$diff = abs(strtotime($current_time) - strtotime($passed_time));
			$tmins = $diff/60;
			$hours = floor($tmins/60);
			
			if($hours >= 1){
				Common::updateData($table="balance_request", "id", $row->id, array('status'=>'rejected','updated_at'=>date('Y-m-d H:i:s')));
				$payment_data 	= Common::getSingelData($where=['id'=>$row->id],$table='balance_request',$data=['amount','user_id'],'id','ASC');
				$payment_gross 	= isset($payment_data->amount)? $payment_data->amount:'0';
				
				$user_id		= isset($payment_data->user_id)? $payment_data->user_id:'0';
				$wallet_data 	= Common::getSingelData($where=['user_id'=>$user_id],$table='user_wallet',$data=['balance'],'id','ASC');
				$balance_gross 	= isset($wallet_data->balance)? $wallet_data->balance:'0';
				$wallet_amount = 0;
				$wallet_amount+= $balance_gross;
				
				$transactionsData=array(
					'user_id'   	=> $row->user_id,
					'description'   => 'Balance rejected',
					'amount'		=> $payment_gross,
					'available_bal'	=> $wallet_amount,
					'type'			=> 3,
					'status'		=> 'rejected',
					'date_slot'		=> date('Y-m-d')
				);
				$this->userTransactionsModel::create($transactionsData);
			}
		}
	}
	
	
}
?>

      