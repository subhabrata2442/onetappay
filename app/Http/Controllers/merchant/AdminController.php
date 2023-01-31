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
use App\Table;
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
		
		
		$merchant_id 		= Auth::id();
		$totalOrders		= Order::where('merchant_id',$merchant_id)->where('order_status',1)->count();
		$totalTableOrders	= BookingTable::where('merchant_id',$merchant_id)->count();
		$totalItem			= Item::where('merchant_id',$merchant_id)->count();
		$totalCategory		= Category::where('merchant_id',$merchant_id)->count();
		
        return view('merchant.dashboard', compact('title','breadcumbs','active','totalOrders','totalTableOrders','totalItem','totalCategory'));
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
		
		$logo 						= isset($merchant_info->logo)?$merchant_info->logo:'';
		$thumb_logo					= Helpers::merchant_logo($logo);
		
		
		
		//echo '<pre>';print_r($thumb_logo);exit;
        return view('merchant.settings_form', compact('title','active','breadcumbs','merchant_info','user_info','countrie','logo','thumb_logo'));
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
		
		$validator = Validator::make($request->all(), [
			'restaurant_name'	=> 'required|string|max:255',
			'street' 			=> 'required|string|max:255',
        ]);
		
		$IP 				= Helpers::get_ip();
		
		if ($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			
		   Session::flash('success', $error_html);
		   return redirect('merchant_admin/merchant/');
        }else{
			$user_id = Session::get('adminId');
			
			$merchantArr = [
				'restaurant_name'			=> Input::post('restaurant_name'),
				'restaurant_phone'			=> Input::post('restaurant_phone'),
				'contact_name'				=> Input::post('contact_name'),
				'contact_phone'				=> Input::post('contact_phone'),
				'contact_email'				=> Input::post('contact_email'),
				'country_code'				=> Input::post('country'),
				'street'					=> Input::post('street'),
				'address'					=> Input::post('street'),
				'city'						=> Input::post('city'),
				'state'						=> Input::post('state'),
				'post_code'					=> Input::post('post_code'),
				'latitude'					=> Input::post('lat'),
				'lontitude'					=> Input::post('lng'),
				'ip_address'				=> $IP,
				'logo'						=> Input::post('site_logo'),
				'distance_unit'				=> Input::post('distance_unit'),
				'delivery_distance_covered'	=> Input::post('delivery_distance_covered'),
				'merchant_type'				=> Input::post('service'),
				'created_at'				=> date('Y-m-d')
		   ];
		   
		   Common::updateData($table="merchant", "user_id", $user_id, $merchantArr);
		   
		   
		   $data_general=[];
		   if(Input::post('password')!=''){
			   $data_general['password']=Hash::make(Input::post('password'));
			   Common::updateData($table="users", "id", $user_id, $data_general);
			}
			
			Session::flash('success', 'Successfully Saved data.');
			return redirect('merchant_admin/merchant/');
		}
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
                Image::make($image)->resize(288, 275)->save($imageAppLogo);
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