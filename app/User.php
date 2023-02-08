<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB AS DB;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\User_wallet;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type', 'name', 'email', 'first_name', 'last_name', 'password', 'raw_password', 'phone', 'country', 'city', 'street', 'zipcode', 'logo', 'status', 'IP', 'device_token', 'created_at'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
	
	public function isAdmin($userId){
		$getData = User::find($userId);
		if(isset($getData->user_type)){
			return ($getData->user_type == 1);
        }else{
            return false;
        }
    }
	
	public function isMerchant($userId){
		$getData = User::find($userId);
		if(isset($getData->user_type)){
			return ($getData->user_type == 2);
        }else{
            return false;
        }
    }
	
	public function isMember($userId){
		$getData = User::find($userId);
		if(isset($getData->user_type)){
			return ($getData->user_type == 3);
        }else{
            return false;
        }
    }
		
	public static function get_users($param) {
        $return  = array();
		
		$type=isset($_GET['type'])?$_GET['type']:'';
		
        $name = $param['name'];
        $email = $param['email'];
        $cur_page = $param['cur_page'];
        $per_page = $param['per_page'];
        $limit_start = $param['limit_start'];
        $users = User::where('user_type', 2);
        if($name != '')
            $users = $users->where('name', 'LIKE', '%' . $name . '%');
        if($email != '')
            $users = $users->where('email', 'LIKE', '%' . $email . '%');
        $total_users = $users->count();
        $users = $users->orderby('id', 'DESC')->get();
		//$users = $users->orderby('id', 'DESC')->offset($limit_start)->limit($per_page)->get();
        $user_data = array();
        $user_ids = array();
        foreach ($users as $key => $value) {
            $user_ids[] = $value->id;
        }
		
        foreach ($users as $key => $value) {
            $temp = array();
			$user_wallet_info = User_wallet::where('user_id',$value->id)->first();
			$balance=isset($user_wallet_info->balance)?$user_wallet_info->balance:'0';
			if($type=='wallet'){
				if($balance>0){
					$temp['id'] 			= $value->id;
					$temp['name'] 			= $value->name;
					$temp['email'] 			= $value->email; 
					$temp['phone'] 			= $value->phone;
					$temp['status'] 		= $value->status;
					$temp['IP'] 			= $value->IP;
					$temp['balance'] 		= $balance;
					$temp['created_at'] 	= $value->created_at;
					$user_data[] 			= $temp;
				}
			}else{
				$temp['id'] 			= $value->id;
				$temp['name'] 			= $value->name;
				$temp['email'] 			= $value->email; 
				$temp['phone'] 			= $value->phone;
				$temp['status'] 		= $value->status;
				$temp['IP'] 			= $value->IP;
				$temp['balance'] 		= $balance;
				$temp['created_at'] 	= $value->created_at;
				$user_data[] 			= $temp;
			}
			
			
			
           
        }
		
        $return['records'] = $user_data;
        $return['total_records'] = $total_users;
        return $return;
    }
    public static function get_user($param) {
        $return  = array();
        $user_id = $param['user_id'];
        $user = User::find($user_id);
		
        $user_data = array();
		
        if(isset($user->id)) {
			$user_wallet_info = User_wallet::where('user_id',$user->id)->first();
			$balance=isset($user_wallet_info->balance)?$user_wallet_info->balance:'0';
			
			$temp = array();
            $temp['id'] 			= $user->id;
			$temp['name'] 			= $user->name;
            $temp['email'] 			= $user->email;
            $temp['dob'] 			= $user->dob;
            $temp['gender'] 		= $user->gender;
            $temp['phone'] 			= $user->phone;
            $temp['alternet_phone'] = $user->alternet_phone;
            $temp['raw_password']   = $user->raw_password;
			$temp['balance'] 		= $balance;
			$temp['country'] 		= $user->country;
            $temp['city'] 			= $user->city;
			$temp['logo'] 			= $user->logo;
			$temp['zipcode'] 		= $user->zipcode;
			$temp['street'] 		= $user->street;
            $temp['status'] 		= $user->status;
            $temp['IP'] 			= $user->IP;
			$temp['created_at'] 	= $user->created_at->toDateTimeString();
            $user_data = $temp;
		}
		
		$return['records'] = $user_data;
		return $return;
    }
	
	
	
}
