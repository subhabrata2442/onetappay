<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Common;
use DB; 
class IndexController extends Controller {
     
    //For Index Page
    public function index(){
		
        return view('index');
		
    }
	
	public function sendOtp(){
		
		echo 'test';exit;
	}
	
	
	
	public function home(){
		$data['site_title'] 		= Common::get_settings($where=['option_name'=>'site_title']);
		$data['email'] 				= Common::get_settings($where=['option_name'=>'email']);
		$data['whatsapp'] 			= Common::get_settings($where=['option_name'=>'whatsapp']);
		$data['phone'] 				= Common::get_settings($where=['option_name'=>'phone']);
		$data['copyright'] 			= Common::get_settings($where=['option_name'=>'copyright']);
		$data['game_status'] 		= Common::get_settings($where=['option_name'=>'game_status']);
		$data['welcome_message'] 	= Common::get_settings($where=['option_name'=>'welcome_message']);
		$data['welcome_message'] 	= Common::get_settings($where=['option_name'=>'welcome_message']);
		$data['g-play'] 			= Common::get_settings($where=['option_name'=>'g-play']);
		
		$apk = Common::get_settings($where=['option_name'=>'apk']);
		$file_default = isset($apk)?$apk:'';
		$file_default_path='';
		if($file_default!=''){
			$file_default_path=asset('public/upload/apk/'.$file_default);
		}
		$data['apk']=$file_default_path;
		
		//echo '<pre>';print_r($data);exit;
		
		return view('home', compact('data'));
    }
	public function privacy(){
		$data['email']	= Common::get_settings($where=['option_name'=>'email']);
		return view('privacy', compact('data'));
	}
	
	public function get_file(){
		///public_html/public/upload/apk
		$apk = Common::get_settings($where=['option_name'=>'apk']);
		$file_default = isset($apk)?$apk:'';
		if($file_default!=''){
			$file_default_path='public/upload/apk/'.$file_default;
			if(file_exists('public/upload/apk/'.$file_default)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'.basename($file_default_path).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file_default_path));
				flush(); // Flush system output buffer
				readfile($file_default_path);
				exit;
			}
		}
	}
}
?>

      