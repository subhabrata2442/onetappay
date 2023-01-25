<?php
namespace App\Services;
use App\SocialTwitterAccount;
use App\User;
use App\Common;
use Laravel\Socialite\Contracts\User as ProviderUser;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Image;

class SocialTwitterAccountService {
	
    public function createOrGetUser(ProviderUser $providerUser) {
		
		$account_info = Common::getSingelData($where=['provider_user_id'=>$providerUser->getId()],$table='social_twitter_accounts',$data=['*'],'id','ASC');
		if(!empty($account_info)){
			$user_id=$account_info->user_id;
			}else{
				$name=$providerUser->getName();
				$name_arr=explode(' ',$name);
				
				$user_id=Common::insert_get_id($table="users",array('name'=>$providerUser->getName(),'email'=>$providerUser->getEmail(),'roll'=>2,'status'=>1,'user_type'=>2));
				$data=array();
				$data['user_id'] 		= $user_id;
				$data['fname'] 			= @$name_arr[0];
				$data['lname'] 			= @$name_arr[1];
				$data['email'] 			= $providerUser->getEmail();
				$data['date_updated'] 	= date('Y-m-d');
				$data['date_added'] 	= date('Y-m-d');
				$data['password'] 		= md5(rand(1,10000));
				$data['password_real'] 	= rand(1,10000);
				$data['is_verified'] 	= 1;
				
				Common::insert_get_id($table="members",$data);
				Common::insert_get_id($table="social_twitter_accounts",array('provider_user_id'=>$providerUser->getId(),'user_id'=>$user_id,'provider'=>'twitter'));	
			}
			return $user_id;
			
		//$path = 'http://pbs.twimg.com/profile_images/756914080896516096/ukzhmgvY.jpg';
		//$filename = basename($path);
		//Image::make($path)->save(public_path('images/twitter/' . $filename));exit;
		
    }
}