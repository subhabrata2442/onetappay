<?php
namespace App\Http;
use App\Common;
use App\Telescope_entries;
use Mail;
use Session;
use DB;

class Helpers{
	
	
	public static function getPeriod($date_slot,$cat_id,$time_slot_id,$game_type_id,$game_play_type_id='1'){
		$string		= $date_slot.$cat_id.$time_slot_id.$game_type_id.$game_play_type_id;
		$replace	= '';
	   	$string = strtolower($string);
	   //replace / and . with white space
	   	$string = preg_replace("/[\/\.]/", " ", $string);
	   	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);

	   //remove multiple dashes or whitespaces
	   	$string = preg_replace("/[\s-]+/", " ", $string);
	   
	   //convert whitespaces and underscore to $replace
	  	 $string = preg_replace("/[\s_]/", $replace, $string);

	   //limit the slug size
	  	 $string = substr($string, 0, 100);
		 
	   //slug is generated
	  	 return $string;
	}
	
	public static function getToken($length){
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$max = strlen($codeAlphabet); // edited
		for ($i=0; $i < $length; $i++) {
			$token .= $codeAlphabet[Helpers::crypto_rand_secure(0, $max-1)];
		}
		
		return $token;
	}
	
	public static function crypto_rand_secure($min, $max){
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}
	
	public static function limit_text($text, $limit = '200') {
        $text = strip_tags($text);
        if (strlen($text) > $limit) {
            $text = substr($text, 0, $limit) . '...';
        }
        return $text;
    }
	
	public static function getYoutubeCodeFromUrl($url) {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        // $matches[ 1 ] should contain the youtube id
        return isset($matches[1]) ? $matches[1] : '';
    }
	
	public static function format_file_size($size) {
        if ($size < 1024)
            $filesize = $size . ' bytes';
        elseif ($size >= 1024 && $size < 1048576)
            $filesize = round($size / 1024, 1) . ' KB';

        elseif ($size >= 1048576)
            $filesize = round($size / 1048576, 1) . ' MB';

        return $filesize;
    }
	
	public static function admin_logo($path){
		return $path && file_exists('public/upload/logo/'.$path) ? asset('public/upload/logo/'.$path.'?v='.time()) : asset('public/images/avatar-default.png');
	}
	
	public static function merchant_logo($path){
		return $path && file_exists('public/upload/logo/thumb/'.$path) ? asset('public/upload/logo/thumb/'.$path.'?v='.time()) : asset('public/images/no_logo.jpg');
	}
		
	public static function website_main_image($path){
		return $path && file_exists('public/upload/logo/original/'.$path) ? asset('public/upload/logo/original/'.$path.'?v='.time()) : '';
	}
	public static function website_logo($path){
		return $path && file_exists('public/upload/website_logo/cover/'.$path) ? asset('public/upload/website_logo/cover/'.$path.'?v='.time()) : asset('public/images/no_logo.jpg');
	}
	public static function website_app_logo($path){
		return $path && file_exists('public/upload/logo/thumb/'.$path) ? asset('public/upload/logo/thumb/'.$path.'?v='.time()) : asset('public/images/no_logo.png');
	}
	public static function category_image($path){
		return $path && file_exists('public/upload/image/180_180/'.$path) ? asset('public/upload/image/180_180/'.$path.'?v='.time()) : asset('public/backoffice/images/no_image-150x150.png');
	}
	
	public static function thumb($path){
		return $path && file_exists('public/upload/image/150_150/'.$path) ? asset('public/upload/image/150_150/'.$path) : asset('public/images/no_image-150x150.png');
	}
	public static function slider_thumb($path){
		return $path && file_exists('public/upload/image/360_224/'.$path) ? asset('public/upload/image/360_224/'.$path) : asset('public/images/no_image-150x150.png');
	}
	
	public static function store_logo($path){
		return $path && file_exists('public/upload/store/'.$path) ? asset('public/upload/store/'.$path) : asset('public/image/store-demo.jpg');
	}
	
	public static function user_logo($path){
		return $path && file_exists('public/upload/user/'.$path) ? asset('public/upload/user/'.$path) : asset('public/front/images/demo_user.png');
	}
	
	public static function item_logo($path){
		return $path && file_exists('public/upload/store/item/'.$path) ? asset('public/upload/store/item/'.$path) : asset('public/images/food.jpg');
	}
	
	
	
	public static function item_thumb($path){
		return $path && file_exists('public/upload/image/180_180/'.$path) ? asset('public/upload/image/180_180/'.$path.'?v='.time()) : asset('public/images/food.jpg');
	}
	
	public static function get_product($product_id){
		$result=array();
		$item_data	= Common::getSingelData($where=['item_id'=>$product_id],$table='item', $data=['item_name','photo'],'item_name','ASC');
		$result['item_name'] 	= $item_data->item_name;
		$result['photo'] 		= $item_data->photo && file_exists('public/upload/image/180_180/'.$item_data->photo) ? asset('public/upload/image/180_180/'.$item_data->photo.'?v='.time()) : asset('public/backoffice/images/no_image-150x150.png');
		
		return $result;
	}
	public static function get_restaurant_open_class($merchant_id){
		$is_open='InActive';
		$merchant_data	= Common::getSingelData($where=['merchant_id'=>$merchant_id],$table='merchant', $data=['service_hours'],'merchant_id','ASC');
		
		$service_hours = isset($merchant_data->service_hours)?json_decode($merchant_data->service_hours):array();
		$service_days=array();
		if(isset($service_hours->day)){
			$service_days = json_decode(json_encode($service_hours->day), true);
		}
		
		$service_day_hours=array();
		if(isset($service_hours->time)){
			$service_day_hours= $service_hours->time;
		}
		
		$current_day = date('N');
		$current_day = $current_day-1;
		
		$is_restaurant_open = 'N';
		$restaurant_open 	= '';
		$open_from			= '';
		$open_to			= '';
		if(in_array($current_day, $service_days)){
			if(isset($service_day_hours[$current_day]->from)){
				$open_from = $service_day_hours[$current_day]->from;
			}
			
			if(isset($service_day_hours[$current_day]->to)){
				$open_to = $service_day_hours[$current_day]->to;
			}
			
			$restaurant_open = 'Open now '.$open_from.' - '.$open_to;
			$is_restaurant_open = 'Y';
		}
		
		if (time() < strtotime($open_from) || time() < strtotime($open_to)) {
			$restaurant_open	= $restaurant_open;
			$is_restaurant_open = 'Y';
		}else{
			$is_restaurant_open = 'N';
		}

		if($is_restaurant_open=='Y'){
			$is_open='active';
		}else{
			$is_open='InActive';
		}
		
		return $is_open;
	}
	
	public static function get_setting_meta($merchant_id,$option_name){
		$result = Common::getDataByRawQuery("SELECT * FROM site_settings WHERE option_name= '".$option_name."' AND merchant_id='".$merchant_id."' LIMIT 0,1");
		$option_value='';
		if(isset($result)){
			if(!empty($result)){
				$option_value=$result[0]->option_value;
				}
			}
		return $option_value;	
	}
	
	public static function get_province_full($province_id){
		$result = Common::getSingelData($where=['province_id'=>$province_id],$table='province',$data=['*'],'province_id','DESC');
		$code='';
		if(isset($result)){
			if(!empty($result)){
				$code=$result->name;
				}
			}
		return $code;	
		}
		
	public static function countByProvince($province_id) {
		$count = Common::getTotalListing($where=['province'=>$province_id,'status'=>1],$table='clubs',$data=['club_id'],'club_id','DESC');
		return $count;	
		}
		
		
	public static function club_main_image($path){
		return $path && file_exists('public/upload/clubs/original/'.$path) ? asset('public/upload/clubs/original/'.$path.'?v='.time()) : '';
		}
	public static function club_logo($path){
		return $path && file_exists('public/upload/clubs/profile/'.$path) ? asset('public/upload/clubs/profile/'.$path.'?v='.time()) : asset('public/images/no_logo.jpg');
		}
	public static function club_cover($path){
		return $path && file_exists('public/upload/clubs/cover/'.$path) ? asset('public/upload/clubs/cover/'.$path.'?v='.time()) : asset('public/images/no_img.jpg');
		}	
		
			
	public static function resultCountbyUser($user_id){
		$total_result = DB::table('event_result')->where('user_id',$user_id)->count();
		return $total_result;
		}
	public static function reviewCountbyUser($user_id){
		$total_result = DB::table('review')->where('user_id',$user_id)->count();
		return $total_result;
		}
	public static function member_main_image($path){
		return $path && file_exists('public/upload/member/original/'.$path) ? asset('public/upload/member/original/'.$path.'?v='.time()) : '';
		}
		
	public static function member_profile_image($path){
		return $path && file_exists('public/upload/member/profile/'.$path) ? asset('public/upload/member/profile/'.$path.'?v='.time()) : asset('public/images/no-image.jpg');
		}
		
	public static function member_cover_image($path){
		return $path && file_exists('public/upload/member/cover/'.$path) ? asset('public/upload/member/cover/'.$path.'?v='.time()) : asset('public/images/no-cover_image.jpg');
		}		
		
	public static function no_image(){
		return asset('public/images/article_fallback_1024x768.png');
		}
	
	public static function last_member_login($member_id){
		$result = Common::getSingelData($where=['member_id'=>$member_id],$table='members_login',$data=['*'],'id','DESC');
		$login_date='NUll';
		if(isset($result)){
			if(!empty($result)){
				$login_date=$result->login_date;
				}
			}
		return $login_date;	
		}		
		
		
		
	public static function news_main_image($path){
		return $path && file_exists('public/upload/news/original/'.$path) ? asset('public/upload/news/original/'.$path.'?v='.time()) : '';
		}
	public static function articleImage($path){
		return $path && file_exists('public/upload/news/'.$path) ? asset('public/upload/news/'.$path.'?v='.time()) : asset('public/images/article_fallback_80x80.png');
		}	
	public static function newsImage($path){
		return $path && file_exists('public/upload/news/'.$path) ? asset('public/upload/news/'.$path.'?v='.time()) : asset('public/images/article_fallback_80x80.png');
		}
	public static function newsThumbImage($path){
		return $path && file_exists('public/upload/news/small/'.$path) ? asset('public/upload/news/small/'.$path.'?v='.time()) : asset('public/images/article_fallback_80x80.png');
		}
	
	
	
	public static function productImage($path){
		return $path && file_exists('public/'.$path) ? asset('public/'.$path) : asset('public/images/not-found.jpg');
		}
		
	public static function productThumbImage($path){
		return $path && file_exists('public/'.$path) ? asset('public/'.$path) : asset('public/images/not-found.jpg');
		}
		
	public static function bannerImage($path){
		return $path && file_exists('public/'.$path) ? asset('public/'.$path) : asset('public/images/not-found.jpg');
		}
			
	public static function generateOTP($digits = 5){
		$i = 1; //counter
		$pin = ""; //our default pin is blank.
		while($i < $digits){
			//generate a random number between 1 and 9.
			$pin .= mt_rand(1, 9);
			$i++;
		}
		return $pin;
	}
	
	public static function randomString($length = 12) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
	
	public static function sendSinglemail($request = []) {
		$smtp = true;
		$custom = array();
		if (!empty($custom)) {
			$data = array_merge($request, $custom);
		} else {
			$data = $request;
		}		
    	if ($smtp == true) {	
			Mail::send($data['view'], $data, function ($message) use ($data) {
				$message->to($data['to'])->subject($data['subject']);
				});
        	return true;
		} else {
			$headers = 'MIME-Version: 1.0' . "\r\n";
        	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        	$headers .= 'To: <' . $data['to'] . '>' . "\r\n";
        	$headers .= 'From: Aqualeafitsol <' . $data['from'] . '>' . "\r\n";
			
			
			echo '<pre>';print_r($headers);exit;
			
			if (mail($data['to'], $data['subject'], $data['message'], $headers)) {
				return true;
				} else {
					return false;
					}
				}
			}
	
	
	public static function SendEmail($request = []) {
		$smtp = true;
		$custom = array();
		if (!empty($custom)) {
			$data = array_merge($request, $custom);
		} else {
			$data = $request;
		}
		if ($smtp == true) {
			Mail::send($data['view'], $data, function ($message) use ($data) {
				$message->to($data['to'])->subject($data['subject']);
			});
			return true;
		} else {
	
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'To: <' . $data['to'] . '>' . "\r\n";
			$headers .= 'From: aqualeafitsol <' . $data['from'] . '>' . "\r\n";
	
			if (mail($data['to'], $data['subject'], $data['message'], $headers)) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	public static function create_slug($string){
		$replace = '-';
	   	$string = strtolower($string);
	   //replace / and . with white space
	   	$string = preg_replace("/[\/\.]/", " ", $string);
	   	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);

	   //remove multiple dashes or whitespaces
	   	$string = preg_replace("/[\s-]+/", " ", $string);
	   
	   //convert whitespaces and underscore to $replace
	  	 $string = preg_replace("/[\s_]/", $replace, $string);

	   //limit the slug size
	  	 $string = substr($string, 0, 100);
	   
	   //slug is generated
	  	 return $string;
	  }
	  
	  
	 public static function set_elescope_entries(){
		 $ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
	  		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	  	else if(getenv('HTTP_FORWARDED'))
	 	 	$ipaddress = getenv('HTTP_FORWARDED');
	  	else if(getenv('REMOTE_ADDR'))
	  		$ipaddress = getenv('REMOTE_ADDR');
	  	else
	   		$ipaddress = 'UNKNOWN';
		 
		 
		 
		/*$ip = $ipaddress;
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$data=array(
			'ip'			=> $ip,
			'url'			=> $actual_link,
			'created_at'	=> date('Y-m-d H:i:s')
		);
		
		Common::insertData('telescope_entries',$data);*/
	 } 
	
	//Our custom function.
	public static function get_ip(){
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
	  		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	  	else if(getenv('HTTP_FORWARDED'))
	 	 	$ipaddress = getenv('HTTP_FORWARDED');
	  	else if(getenv('REMOTE_ADDR'))
	  		$ipaddress = getenv('REMOTE_ADDR');
	  	else
	   		$ipaddress = 'UNKNOWN';
			
	    return $ipaddress;
		
	}	
		
	public static function paginate($item_per_page, $current_page, $total_records, $page_url, $additional_params="", $additional_class="") {
	  $v = ($total_records/$item_per_page);
	  if($v > (int)$v)
	   $total_pages = (int)$v + 1;
	  else
	   $total_pages = (int)$v;
		 $pagination = '';
		 if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
			 $pagination .= '<ul class="pagination '.$additional_class.'">';
			 
			 $right_links    = $current_page + 3; 
			 $previous       = $current_page - 3; //previous link 
			 $next           = $current_page + 1; //next link
			 $first_link     = true; //boolean var to decide our first link
			 
			 if($current_page > 1){
				 $previous_link = ($previous<=0)?1:$previous;
				 $pagination .= '<li class="first"><a href="'.$page_url.'?pg=1'.$additional_params.'" title="First">&laquo;</a></li>'; //first link
				 $pagination .= '<li><a href="'.$page_url.'?pg='.$previous_link.''.$additional_params.'" title="Previous">&lt;</a></li>'; //previous link
					 for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
						 if($i > 0){
							 $pagination .= '<li><a href="'.$page_url.'?pg='.$i.''.$additional_params.'">'.$i.'</a></li>';
						 }
					 }   
				 $first_link = false; //set first link to false
			 }
			 
			 if($first_link){ //if current active page is first link
				 $pagination .= '<li class="first active"><a href="'.$page_url.'?pg='.$current_page.''.$additional_params.'">'.$current_page.'</a></li>';
			 }elseif($current_page == $total_pages){ //if it's the last active link
				 $pagination .= '<a href="'.$page_url.'?pg='.$current_page.''.$additional_params.'"><li class="last active">'.$current_page.'</a></li>';
			 }else{ //regular current link
				 $pagination .= '<li class="active"><a href="'.$page_url.'?pg='.$current_page.''.$additional_params.'">'.$current_page.'</a></li>';
			 }
					 
			 for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
				 if($i<=$total_pages){
					 $pagination .= '<li><a href="'.$page_url.'?pg='.$i.''.$additional_params.'">'.$i.'</a></li>';
				 }
			 }
			 if($current_page < $total_pages){ 
					 $next_link = ($i > $total_pages)? $total_pages : $i;
					 $pagination .= '<li><a href="'.$page_url.'?pg='.$next_link.''.$additional_params.'" >&gt;</a></li>'; //next link
					 $pagination .= '<li class="last"><a href="'.$page_url.'?pg='.$total_pages.''.$additional_params.'" title="Last">&raquo;</a></li>'; //last link
			 }
			 
			 $pagination .= '</ul>'; 
		 }
		 return $pagination; //return pagination links
 }
 
 public static function formatCurrency($amount){
	 $price		= 0;
	 if($amount!=''){
		 $price = number_format($amount,2);
		}
	return $price;
	 }
 
 	public static function date_time_format($date_time){
		$empty_date_time_format="0000-00-00 00:00:00";
		$empty_date_format="0000-00-00";
		$unx_stamp = strtotime($date_time);
		$date_str  = "-";
		$DATE_FORMAT=1;
		if(!empty($date_time)){
			if($date_time!=$empty_date_time_format){
	  		if($date_time!=$empty_date_format){
			switch ($DATE_FORMAT) {
				case 1:
					$date_str = (date("Y/m/d", $unx_stamp));
					break; //2016/06/13
				case 2:
					$date_str = (date("m/d/Y", $unx_stamp));
					break; //06/13/2016
				case 3:
					$date_str = (date("d/m/Y", $unx_stamp));
					break; //13/06/2016
				case 4:
					$date_str = (date("d M Y", $unx_stamp));
					break; //13 Jun 2016
				case 5:
					$date_str = (date("dS M, Y", $unx_stamp));
					break; //13 June 2016
				case 6:
					$date_str = (date("M d, Y", $unx_stamp));
					break; //13th Jun ,2016
				case 7:
					$date_str = (date("D M dS, Y", $unx_stamp));
					break; //Tue Jun 13th,2016
				case 8:
					$date_str = (date("dS F, Y", $unx_stamp));
					break; //Tuesday Jun 13th,2016
				case 9:
					$date_str = (date("l M dS, Y", $unx_stamp));
					break; //Tuesday June 29th,2016
				case 10:
					$date_str = (date("d M Y l", $unx_stamp));
					break; //13 June 2016 Tuesday
				case 11:
					$date_str = (date("Y/m/d H:i:s", $unx_stamp));
					break; //13 June 2016 Tuesday
				default :
					$date_str = (date("dS M, Y", $unx_stamp));
					break; //13 June 2016 Tuesday
				 }
			}
		}
	}
	return $date_str;}
	
 	public static function getStartAndEndDateWeek($week, $year) {
	  $dto = new \DateTime();
	  $dto->setISODate($year, $week);
	  $ret['week_start'] = $dto->format('d-m-Y');
	  $dto->modify('+6 days');
	  $ret['week_end'] = $dto->format('d-m-Y');
	  return $ret;
	}		
		
		
		
		
}