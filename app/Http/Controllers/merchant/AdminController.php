<?php
namespace App\Http\Controllers\merchant;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Common;
use App\Merchant;
use App\Item;
use App\Category;
use App\Countrie;

use Input;
use Session;
use Carbon;
use Auth;
use Image;
use DB;
use Helpers;
use Hash;
use Config;


//require_once('public/mpdf/vendor/autoload.php');
class AdminController extends Controller {
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/merchant_admin/dashboard';
    /**
     * Display admin dashboard.
     *
     */
    public function dashboard(){
    	$title 		= "Dashboard";
    	$breadcumbs = "Dashboard";
    	$active 	= "dashboard";
		$param = array();
		
		
		
		$totalOrders	= 0;//Merchant::count();
        return view('merchant.dashboard', compact('title','breadcumbs','active','totalOrders'));
    }
	
	public function merchant_settings(){
        $title 						= "Merchant Settings";
        $breadcumbs 				= "Merchant Settings";
        $active 					= "merchant";
		$user_id					= Session::get('adminId');
		$data						= [];
		
		$user_info 					= Common::getSingelData($where=['id'=>$user_id],$table='users',$data=['*'],'id','ASC');
		$merchant_info 				= Common::getSingelData($where=['user_id'=>$user_id],$table='merchant',$data=['*'],'merchant_id','ASC');
		$countrie					= Countrie::All();
		
		
		//echo '<pre>';print_r($countrie);exit;
        return view('merchant.settings_form', compact('title','active','breadcumbs','merchant_info','user_info','countrie'));
    }
	
	
	
	
	
	public function settings(){
        $title 						= "Settings";
        $breadcumbs 				= "Settings";
        $active 					= "settings";
		$user_id					= Session::get('adminId');
		$data						= [];
		$user_id 					= Session::get('adminId');
		$user_info 					= Common::getSingelData($where=['id'=>1],$table='users',$data=['name','email'],'id','ASC');
		$data['site_title'] 		= Common::get_settings($where=['option_name'=>'site_title']);
		$data['meta_title'] 		= Common::get_settings($where=['option_name'=>'meta_title']);
		$data['meta_keywords'] 		= Common::get_settings($where=['option_name'=>'meta_keywords']);
		$data['meta_description'] 	= Common::get_settings($where=['option_name'=>'meta_description']);
		$data['email'] 				= Common::get_settings($where=['option_name'=>'email']);
		$data['admin_name'] 		= $user_info->name;
		$data['admin_email'] 		= $user_info->email;
		
		//echo '<pre>';print_r($data);exit;
        return view('admin.settings_form', compact('title','active','breadcumbs','data'));
    }
	public function saveAdminSettings(Request $request){
		$site_title 			= Input::get('site_title');
		$meta_title 			= Input::get('meta_title');
		$meta_keywords 			= Input::get('meta_keywords');
		$meta_description 		= Input::get('meta_description');
		$email 					= Input::get('email');
		$admin_name 			= Input::get('admin_name');
		$admin_email 			= Input::get('admin_email');
		$password 				= Input::get('password');
		
		
		print_r($_POST);exit;
		
		
		
		$IP = Helpers::get_ip();
		$validator = Validator::make($request->all(), [
			'site_title'	=> 'required|string|max:255',
			'email' 		=> 'required|string|email|max:255',
        ]);
		if ($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
		   $return_data['success'] = 0;
		   $return_data['error_message'] = $error_html;
		   return response()->json([$return_data]);
        }else{
			$user_id = Session::get('adminId');
			$email_check = Common::getSingelData($where=['email'=>$admin_email],$table='users',$data=['id'],'id','ASC');
			if(!empty($email_check)){
				if($email_check->id!=$user_id){
					$return_data['error_message'] 	= 'Warning: Email already exists!';
					$return_data['success']			= 0;
					echo json_encode($return_data);exit;
				}
			}
			$data_general=array(
				'name'				=> $admin_name,
				'email'				=> $admin_email,
				'IP'				=> $IP,
				'updated_at'		=> date('Y-m-d H:i:s')
			);
		}
		if($password!=''){
			$data_general['password']=Hash::make($password);
		}
		
		//print_r($data_general);exit;
		Common::updateData($table="users", "id", $user_id, $data_general);
		
		
		Common::updateData($table="site_settings", "option_name", "site_title", array('option_value'=>$site_title));
		Common::updateData($table="site_settings", "option_name", "meta_title", array('option_value'=>$meta_title));
		Common::updateData($table="site_settings", "option_name", "meta_keywords", array('option_value'=>$meta_keywords));
		Common::updateData($table="site_settings", "option_name", "meta_description", array('option_value'=>$meta_description));
		Common::updateData($table="site_settings", "option_name", "email", array('option_value'=>$email));
		Session::flash('success', 'Successfully Saved data.');
		return redirect('administrator/settings/');
	}
	
	public function uploadImageRequest(Request $request){
		//print_r($_FILES);exit;
		$validator = Validator::make($request->all(), ['upload_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
		if ($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			 $return_data['success'] = 0;
		   	 $return_data['error_message'] = $error_html;
			 return response()->json([$return_data]);
			}else{
				$image_path = '';
                $fileName   = '';
				if ($request->hasFile('upload_photo')) {
					$image = $request->file('upload_photo');
					$imageName = $image->getClientOriginalName();
					$fileName =  date('His').time().'.'.$image->getClientOriginalExtension();
				 	$directory 			= public_path('/upload/image/');
					$imageUrlOriginal 	= $directory.'/'.$fileName;
				 	$imageUrl 			= $directory.$fileName;
                    $imageUrl400_400 	= $directory.'400_400/'.$fileName;
					$imageUrl150_150 	= $directory.'150_150/'.$fileName;
					$imageUrl50_50 		= $directory.'180_180/'.$fileName;
					$imageUrl360_224 	= $directory.'360_224/'.$fileName;
				 	Image::make($image)->save($imageUrlOriginal);
                    Image::make($image)->resize(400, 400)->save($imageUrl400_400);
					Image::make($image)->resize(150, 150)->save($imageUrl150_150);
					Image::make($image)->resize(180, 180)->save($imageUrl50_50);
					Image::make($image)->resize(360, 224)->save($imageUrl360_224);
                    $image_path	=	asset('public/upload/image/180_180/'.$fileName.'?v='.time());
                    $return_data['success']	= 1;
				}
				$return_data['success'] 		= 1;
				$return_data['file_name']		= $fileName;
				$return_data['image_path']		= $image_path;
				return response()->json([$return_data]);
			}
		}
	public function uploadLogoRequest(Request $request){
		$validator = Validator::make($request->all(), ['upload_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
		if ($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			$return_data['success'] = 0;
		   	$return_data['error_message'] = $error_html;
			return response()->json([$return_data]);
		}else{
			$image_path = '';
			$fileName   = '';
			if ($request->hasFile('upload_photo')) {
				$image = $request->file('upload_photo');
				$imageName = $image->getClientOriginalName();
				$fileName =  date('His').time().'.'.$image->getClientOriginalExtension();
				$directory 			= public_path('/upload/logo/');
				$imageUrlOriginal 	= $directory.'/'.$fileName;
				$imageUrl 			= $directory.$fileName;
                $imageAppLogo 	= $directory.'thumb/'.$fileName;
				Image::make($image)->save($imageUrlOriginal);
                Image::make($image)->resize(192, 25)->save($imageAppLogo);
				//Image::make($image)->resize(150, 150)->save($imageUrl150_150);
                $image_path	=	asset('public/upload/logo/thumb/'.$fileName.'?v='.time());
                $return_data['success']	= 1;
			}
			$return_data['success'] 		= 1;
			$return_data['file_name']		= $fileName;
			$return_data['image_path']		= $image_path;
			return response()->json([$return_data]);
		}
	}
	
    /**
     * Logout admin.
     *
     */
    public function adminlogout() {
        \Auth::logout();
        Session::flush();
        return redirect('merchant_admin');
    }
}