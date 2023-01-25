<?php
namespace App\Http\Controllers\admin;
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
    protected $redirectTo = '/administrator/dashboard';
    /**
     * Display admin dashboard.
     *
     */
    public function dashboard(){
    	$title 		= "Dashboard";
    	$breadcumbs = "Dashboard";
    	$active 	= "dashboard";
		$param = array();
		$total_store	= Merchant::count();
		


        return view('admin.dashboard', compact('title','breadcumbs','active','total_store'));
    }






	public function category(){
		$title 			= "Category";
        $breadcumbs 	= "Category";
        $active 		= "category";
		$meta_data 		= array();
        $search 		= Input::get('s');
        $cur_page 		= Input::get('pg');
        $cur_page 		= $cur_page == '' ? 1 : $cur_page;
        $per_page		= 20;
        $limit_start	= ($cur_page - 1) * $per_page;
        $param = array();
        $param['search'] 		= $search;
        $param['cur_page'] 		= $cur_page;
        $param['per_page'] 		= $per_page;
        $param['limit_start']	= $limit_start;
		$category_list = Category::get_data($param);
		//echo '<pre>';print_r($category_list);exit;
		return view('admin.category/index', compact('title','active','breadcumbs','category_list'));
    }
	public function addCategory(){
		$title 			= "Add Category";
        $breadcumbs 	= "Add Category";
        $active 		= "category";
		$data			= [];
		$category_thumb	= asset('public/images/no_image-150x150.png');
		return view('admin.category/form', compact('title','active','breadcumbs','category_thumb','data'));
    }
	public function editCategory($id){
		$title 			= "Edit Category";
        $breadcumbs 	= "Edit Category";
        $active 		= "category";
		$data = Category::where('id',$id)->first();
		$category_thumb	= isset($data->image)?Helpers::category_image($data->image): asset('public/images/no_image-150x150.png');
		//echo '<pre>';print_r($category_thumb);exit;
		return view('admin.category/form', compact('title','active','breadcumbs','category_thumb','data'));
    }
	public function deleteCategory() {
		$category_id = Input::get('id');
		if ($category_id != null) {
			$check = DB::table('time_slots')->whereRaw('FIND_IN_SET('.$category_id.',category_id)')->first();
			if(!empty($check)){
				Session::flash('error', 'Can not be deleted as time slot are in this date slot !');
			}else{
				Common::deleteData('category','id',$category_id);
				Session::flash('success', 'Category deleted successfully.');
			}
		}else{
			Session::flash('error', 'Something wrong please try again !');
		}
		return redirect::back();
	}
	public function saveCategoryRequest(Request $request){
		$category_id	= Input::get('category_id');
		$label 			= Input::get('label');
		$name 			= Input::get('category');
		$image 			= Input::get('image');
		$status 		= Input::get('status');
		$validator = Validator::make($request->all(), [
			'label'		=> 'required',
			'category' 	=> 'required',
        ]);
		if($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			Session::flash('error', $error_html);
			return redirect::back();
			//return back()->withInput()->withErrors(['error'=>'Phone or password is invalid!']);
        }else{
			$slug=Helpers::create_slug($label.''.$name);
			if($category_id!=''){
				$category = Category::find($category_id);
				$category->label	= $label;
    			$category->name 	= $name;
    			$category->slug 	= $slug;
				$category->image 	= $image;
				$category->status 	= $status;
    			$category->save();
			}else{
				$category = new Category;
				$category->label	= $label;
    			$category->name 	= $name;
    			$category->slug 	= $slug;
				$category->image 	= $image;
				$category->status 	= $status;
    			$category->save();
			}
			Session::flash('success', 'Successfully Saved data.');
		}
		return redirect('administrator/category');
	}
	
	
	
	public function uploadCsvRequest(Request $request){
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['upload_csv']['name']) && in_array($_FILES['upload_csv']['type'], $csvMimes)){
			if(is_uploaded_file($_FILES['upload_csv']['tmp_name'])){
				$csvFile = fopen($_FILES['upload_csv']['tmp_name'], 'r');
				fgetcsv($csvFile);
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$category_name   		= $line[0];
					$category_label   		= $line[1];
					$game_name   			= $line[2];
					$start_time   			= $line[3];
					$end_time   			= $line[4];
					$days   				= $line[5];
					$minum_coin   			= $line[6];
					$type   				= $line[7];
					$calculation_type   	= $line[8];
					$calculation_amount   	= $line[9];
					$status   				= $line[10];
					if($category_name!='' && $start_time!='' && $end_time!=''){
						 $category_slug	= Helpers::create_slug($category_label.''.$category_name);
						 $category_data = Category::where('slug',$category_slug)->first();
						 $category_id	= isset($category_data->id)?$category_data->id: '';
						 if($category_id==''){
							 $category = new Category;
							 $category->label	= $category_label;
							 $category->name 	= $category_name;
							 $category->slug 	= $category_slug;
							 $category->save();
							 $category_id = $category->id;
						}
						$from_time		= date('h:i a',strtotime($start_time));
						$to_time		= date('h:i a',strtotime($end_time));
						$from_time_slug	= date('H:i',strtotime($start_time));
						$to_time_slug	= date('H:i',strtotime($end_time));
						$time 			= strtotime($to_time);


						if($category_id==4){
							$result_time 	= date("h:i a", strtotime('+5 minutes', $time));
						}else{
							$result_time 	= date("h:i a", strtotime('+10 minutes', $time));
						}

						$slot_data	= Time_slots::where('category_id',$category_id)->where('from_time_slug',$from_time_slug)->where('to_time_slug',$to_time_slug)->first();
						$slot_id	= isset($slot_data->id)?$slot_data->id: '';
						if($slot_id==''){
							$slots = new Time_slots;
							$slots->from_time		= $from_time;
							$slots->from_time_slug 	= $from_time_slug;
							$slots->to_time			= $to_time;
							$slots->to_time_slug 	= $to_time_slug;
							$slots->result_time 	= $result_time;
							$slots->category_id		= $category_id;
							$slots->save();
							$slot_id = $slots->id;
						}

						$type_slug		= Helpers::create_slug($type);
						$play_type_data = Play_type::where('slug',$type_slug)->first();
						$play_type_id	= isset($play_type_data->id)?$play_type_data->id: '1';

						$calculation_type = 1;
						if($calculation_type=='Percentage'){
							$calculation_type = 2;
						}
						$win_amount=0;
						if($calculation_amount!=''){
							$win_amount=$calculation_amount;
						}
						Win_price_calculation::where('category_id', $category_id)->where('play_type', $play_type_id)->where('calculation_type', $calculation_type)->delete();
						$calculation = new Win_price_calculation;
						$calculation->category_id		= $category_id;
						$calculation->play_type 		= $play_type_id;
						$calculation->calculation_type	= $calculation_type;
						$calculation->value 			= $win_amount;
						$calculation->save();
						$calculation_id = $calculation->id;

						$game_data	= $this->gameTypeModel->where('category_id',$category_id)->where('time_slot_id',$slot_id)->first();
						$game_id	= isset($game_data->id)?$game_data->id: '';

						$game_status_id='1';
						if($status!='Active'){
							$game_status_id='0';
						}
						$game_image	= '';
						if($game_id!=''){
							$game = Game_type::find($game_id);
							$game->name				= $game_name;
							$game->category_id 		= $category_id;
							$game->time_slot_id		= $slot_id;
							$game->day 				= $days;
							$game->min_bid_amount	= $minum_coin;
							$game->status			= $game_status_id;
							$game->save();
						}else{
							$game = new Game_type;
							$game->name				= $game_name;
							$game->category_id 		= $category_id;
							$game->time_slot_id		= $slot_id;
							$game->day 				= $days;
							$game->min_bid_amount	= $minum_coin;
							$game->image 			= $game_image;
							$game->status			= $game_status_id;
							$game->save();
							$game_id = $game->id;
						}
					}
				}
			}
		}
		Session::flash('success', 'Successfully import data.');
		return redirect('administrator/game');
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
					$imageUrl50_50 		= $directory.'50_50/'.$fileName;
					$imageUrl360_224 	= $directory.'360_224/'.$fileName;
				 	Image::make($image)->save($imageUrlOriginal);
                    Image::make($image)->resize(400, 400)->save($imageUrl400_400);
					Image::make($image)->resize(150, 150)->save($imageUrl150_150);
					Image::make($image)->resize(50, 50)->save($imageUrl50_50);
					Image::make($image)->resize(360, 224)->save($imageUrl360_224);
                    $image_path	=	asset('public/upload/image/400_400/'.$fileName.'?v='.time());
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
        return redirect('administrator');
    }
}