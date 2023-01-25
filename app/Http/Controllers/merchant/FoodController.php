<?php
namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Common;
use App\Merchant;
use App\Table;
use App\Item;
use App\Category;
use App\Subcategory;
use App\SubcategoryItem;
use App\BookingTable;

use Input;
use Session;
use Carbon;
use Auth;
use Image;
use DB;
use Helpers;
use Hash;

class FoodController extends Controller {
	
	public function table(){
		$title 			= "Table List";
        $breadcumbs 	= "Table List";
        $active 		= "table";
		
		$merchant_id = Auth::id();
		$table_list	= Table::where('merchant_id',$merchant_id)->orderBy('id','DESC')->get();
		
		//echo '<pre>';print_r($category_list);exit;
		
		return view('merchant.food.table-list', compact('title','active','breadcumbs','table_list'));
    }
	public function table_create(){
		$title 			= "Add Table";
        $breadcumbs 	= "Add Table";
        $active 		= "table";
		
		$data	=[];
		return view('merchant.food.table-form', compact('title','active','breadcumbs','data'));
    }
	
	public function table_update($id){
		$title 			= "Edit Category";
        $breadcumbs 	= "Edit Category";
        $active 		= "category";
		
		$merchant_id 	= Auth::id();
		$data 			= Table::where('id',$id)->where('merchant_id',$merchant_id)->first();
		
		//echo '<pre>';print_r($data);exit;
		
		return view('merchant.food.table-form', compact('title','active','breadcumbs','data'));
    }
	public function saveTableRequest(Request $request){
		
		$table_id		= Input::get('table_id');
		$name 			= Input::get('table_name');
		$total_seat 	= Input::get('total_seat');
		$description 	= Input::get('table_description');
		$status 		= Input::get('status');
		
		$validator = Validator::make($request->all(), [
			'table_name' => 'required',
        ]);
		
		if($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			Session::flash('error', $error_html);
			return redirect::back();
        }else{
			$slug=Helpers::create_slug($name);
			$merchant_id = Auth::id();
			if($table_id!=''){
				$data = array(
					'table_name'		=> $name,
					'table_slug'     	=> $slug,
					'table_description'	=> $description,
					'total_seat'  		=> $total_seat,
					'status'  			=> $status
				);	
					
				Table::where('id', $table_id)->update($data);
			}else{
				$table = new Table;
				$table->merchant_id			= $merchant_id;
    			$table->table_name 			= $name;
    			$table->table_slug 			= $slug;
				$table->table_description	= $description;
				$table->total_seat 			= $total_seat;
				$table->status 				= $status;
    			$table->save();
			}
			Session::flash('success', 'Successfully Saved data.');
		}
		return redirect('merchant_admin/food/table');
	}
	public function deleteTable() {
		$table_id = Input::get('id');
		
		/*if ($category_id != null) {
			$check = DB::table('time_slots')->whereRaw('FIND_IN_SET('.$category_id.',category_id)')->first();
			if(!empty($check)){
				Session::flash('error', 'Can not be deleted as time slot are in this date slot !');
			}else{
				Common::deleteData('category','id',$category_id);
				Session::flash('success', 'Category deleted successfully.');
			}
		}else{
			Session::flash('error', 'Something wrong please try again !');
		}*/
		
		Common::deleteData('table','id',$table_id);
		Session::flash('success', 'Table deleted successfully.');
		return redirect::back();
	}
	
	
	public function category(){
		$title 			= "Category List";
        $breadcumbs 	= "Category List";
        $active 		= "category";
		
		$merchant_id = Auth::id();
		$category_list	= Category::where('merchant_id',$merchant_id)->orderBy('cat_id','DESC')->get();
		
		//echo '<pre>';print_r($category_list);exit;
		
		return view('merchant.food.category-list', compact('title','active','breadcumbs','category_list'));
    }
	public function category_create(){
		$title 			= "Add Category";
        $breadcumbs 	= "Add Category";
        $active 		= "category";
		
		$data	=[];
		$category_thumb	= asset('public/backoffice/images/no_image-150x150.png');
		return view('merchant.food.category-form', compact('title','active','breadcumbs','data','category_thumb'));
    }
	public function category_update($id){
		$title 			= "Edit Category";
        $breadcumbs 	= "Edit Category";
        $active 		= "category";
		$merchant_id = Auth::id();
		$data = Category::where('cat_id',$id)->where('merchant_id',$merchant_id)->first();
		$category_thumb	= isset($data->photo)?Helpers::category_image($data->photo): asset('public/backoffice/images/no_image-150x150.png');
		//echo '<pre>';print_r($category_thumb);exit;
		return view('merchant.food.category-form', compact('title','active','breadcumbs','category_thumb','data'));
    }
	public function saveCategoryRequest(Request $request){
		
		$category_id	= Input::get('category_id');
		$name 			= Input::get('category_name');
		$description 	= Input::get('category_description');
		$image 			= Input::get('image');
		$status 		= Input::get('status');
		$validator = Validator::make($request->all(), [
		'category_name' => 'required',
        ]);
		if($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			Session::flash('error', $error_html);
			return redirect::back();
        }else{
			$slug=Helpers::create_slug($name);
			$merchant_id = Auth::id();
			if($category_id!=''){
				$data = array(
					'category_name'			=> $name,
					'category_slug'     	=> $slug,
					'category_description'	=> $description,
					'photo'  				=> $image,
					'status'  				=> $status
				);	
					
				Category::where('cat_id', $category_id)->update($data);
			}else{
				$category = new Category;
				$category->merchant_id			= $merchant_id;
    			$category->category_name 		= $name;
    			$category->category_slug 		= $slug;
				$category->category_description	= $description;
				$category->photo 				= $image;
				$category->status 				= $status;
    			$category->save();
			}
			Session::flash('success', 'Successfully Saved data.');
		}
		return redirect('merchant_admin/food/category');
	}
	public function deleteCategory() {
		$category_id = Input::get('id');
		
		/*if ($category_id != null) {
			$check = DB::table('time_slots')->whereRaw('FIND_IN_SET('.$category_id.',category_id)')->first();
			if(!empty($check)){
				Session::flash('error', 'Can not be deleted as time slot are in this date slot !');
			}else{
				Common::deleteData('category','id',$category_id);
				Session::flash('success', 'Category deleted successfully.');
			}
		}else{
			Session::flash('error', 'Something wrong please try again !');
		}*/
		
		Common::deleteData('category','cat_id',$category_id);
		Session::flash('success', 'Category deleted successfully.');
		return redirect::back();
	}
	
	
	public function sub_category(){
		$title 			= "Addon Category List";
        $breadcumbs 	= "Addon Category List";
        $active 		= "addon_category";
		
		$merchant_id = Auth::id();
		$sub_category_list	= Subcategory::where('merchant_id',$merchant_id)->orderBy('subcat_id','DESC')->get();
		//echo '<pre>';print_r($store_list);exit;
		
		return view('merchant.food.sub-category-list', compact('title','active','breadcumbs','sub_category_list'));
    }
	public function sub_category_create(){
		$title 			= "Add Sub Category";
        $breadcumbs 	= "Add Sub Category";
        $active 		= "addon_category";
		
		$data	=[];
		return view('merchant.food.sub-category-form', compact('title','active','breadcumbs','data'));
    }
	public function sub_category_update($id){
		$title 			= "Edit Category";
        $breadcumbs 	= "Edit Category";
        $active 		= "category";
		$merchant_id 	= Auth::id();
		$data 			= Subcategory::where('subcat_id',$id)->where('merchant_id',$merchant_id)->first();
		//echo '<pre>';print_r($data);exit;
		return view('merchant.food.sub-category-form', compact('title','active','breadcumbs','data'));
    }
	public function saveSubCategoryRequest(Request $request){
		
		$category_id	= Input::get('category_id');
		$name 			= Input::get('category_name');
		$description 	= Input::get('category_description');
		$status 		= Input::get('status');
		$validator = Validator::make($request->all(), [
		'category_name' => 'required',
        ]);
		if($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			Session::flash('error', $error_html);
			return redirect::back();
        }else{
			$slug=Helpers::create_slug($name);
			$merchant_id = Auth::id();
			if($category_id!=''){
				$data = array(
					'subcategory_name'			=> $name,
					'category_slug'     		=> $slug,
					'subcategory_description'	=> $description,
					'status'  					=> $status
				);	
					
				Subcategory::where('subcat_id', $category_id)->update($data);
			}else{
				$category = new Subcategory;
				$category->merchant_id 				= $merchant_id;
    			$category->subcategory_name 		= $name;
    			$category->category_slug 			= $slug;
				$category->subcategory_description	= $description;
				$category->status 					= $status;
    			$category->save();
			}
			Session::flash('success', 'Successfully Saved data.');
		}
		return redirect('merchant_admin/food/addon_category');
	}
	public function deleteSubCategory() {
		$category_id = Input::get('id');
		
		Common::deleteData('subcategory','subcat_id',$category_id);
		Session::flash('success', 'Sub-Category deleted successfully.');
		return redirect::back();
	}
	
	public function addon_items(){
		$title 			= "Addon Item List";
        $breadcumbs 	= "Addon Item List";
        $active 		= "addon_items";
		$merchant_id 	= Auth::id();
		$addon_items_list	= SubcategoryItem::where('merchant_id',$merchant_id)->orderBy('sub_item_id','DESC')->get();
		
		//echo '<pre>';print_r($addon_items_list);exit;
		
		return view('merchant.food.addon-items-list', compact('title','active','breadcumbs','addon_items_list'));
    }
	public function addon_item_create(){
		$title 			= "Add Addon Item";
        $breadcumbs 	= "Add Addon Item";
        $active 		= "addon_items";
		
		$data	=[];
		$item_thumb	= asset('public/backoffice/images/no_image-150x150.png');
		$merchant_id = Auth::id();
		$sub_category_list	= Subcategory::where('merchant_id',$merchant_id)->get();
		return view('merchant.food.addon-item-form', compact('title','active','breadcumbs','data','item_thumb','sub_category_list'));
    }
	public function addon_item_create_update($id){
		$title 			= "Edit Addon Item ";
        $breadcumbs 	= "Edit Addon Item";
        $active 		= "addon_items";
		$merchant_id = Auth::id();
		$data = SubcategoryItem::where('sub_item_id',$id)->where('merchant_id',$merchant_id)->first();
		$item_thumb	= isset($data->photo)?Helpers::category_image($data->photo): asset('public/backoffice/images/no_image-150x150.png');
		$sub_category_list	= Subcategory::where('merchant_id',$merchant_id)->get();
		//echo '<pre>';print_r($category_thumb);exit;
		return view('merchant.food.addon-item-form', compact('title','active','breadcumbs','data','item_thumb','sub_category_list'));
    }
	public function saveAddonItemRequest(Request $request){
		//echo '<pre>';print_r($_POST);exit;
		
		$addon_items_id	= Input::get('addon_items_id');
		$name 			= Input::get('item_name');
		$description 	= Input::get('description');
		$price 			= Input::get('price');
		$addOn_category = Input::get('addOn_category');
		$image 			= Input::get('image');
		$status 		= Input::get('status');
		$validator = Validator::make($request->all(), [
		'item_name' => 'required',
        ]);
		if($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			Session::flash('error', $error_html);
			return redirect::back();
        }else{
			$slug=Helpers::create_slug($name);
			$merchant_id = Auth::id();
			if($addon_items_id!=''){
				$data = array(
					'sub_item_name'		=> $name,
					'item_description'	=> $description,
					'category'			=> $addOn_category,
					'price'  			=> $price,
					'photo'  			=> $image,
					'status'  			=> $status
				);	
				SubcategoryItem::where('sub_item_id', $addon_items_id)->update($data);
			}else{
				$subcategoryItem = new SubcategoryItem;
				$subcategoryItem->merchant_id		= $merchant_id;
    			$subcategoryItem->sub_item_name 	= $name;
    			$subcategoryItem->item_description	= $description;
				$subcategoryItem->category			= $addOn_category;
				$subcategoryItem->price 			= $price;
				$subcategoryItem->photo 			= $image;
				$subcategoryItem->status 			= $status;
    			$subcategoryItem->save();
			}
			Session::flash('success', 'Successfully Saved data.');
		}
		return redirect('merchant_admin/food/addon_items');
	}
	public function deleteAddonItem() {
		$category_id = Input::get('id');
		Common::deleteData('subcategory_item','sub_item_id',$category_id);
		Session::flash('success', 'Addon Item deleted successfully.');
		return redirect::back();
	}
	
	public function items(){
		$title 			= "Item List";
        $breadcumbs 	= "Item List";
        $active 		= "items";
		
		$merchant_id 	= Auth::id();
		$items_list		= Item::where('merchant_id',$merchant_id)->orderBy('item_id','DESC')->get();
		
		//echo '<pre>';print_r($items_list);exit;
		
		return view('merchant.food.items', compact('title','active','breadcumbs','items_list'));
    }
	public function items_create(){
		$title 			= "Add Item";
        $breadcumbs 	= "Add Item";
        $active 		= "items";
		
		$data	=[];
		$item_thumb	= asset('public/backoffice/images/no_image-150x150.png');
		$merchant_id = Auth::id();
		$category_list	= Category::where('merchant_id',$merchant_id)->get();
		return view('merchant.food.item-form', compact('title','active','breadcumbs','data','item_thumb','category_list'));
    }
	public function items_update($id){
		$title 			= "Edit Item ";
        $breadcumbs 	= "Edit Item";
        $active 		= "items";
		$merchant_id = Auth::id();
		$data = Item::where('item_id',$id)->where('merchant_id',$merchant_id)->first();
		$item_thumb	= isset($data->photo)?Helpers::category_image($data->photo): asset('public/backoffice/images/no_image-150x150.png');
		$category_list	= Category::where('merchant_id',$merchant_id)->get();
		
		//echo '<pre>';print_r($data);exit;
		return view('merchant.food.item-form', compact('title','active','breadcumbs','data','item_thumb','category_list'));
    }
	public function saveItemRequest(Request $request){
		//echo '<pre>';print_r($_POST);exit;
		
		$item_id		= Input::get('item_id');
		$name 			= Input::get('item_name');
		$description 	= Input::get('description');
		$price 			= Input::get('price');
		$category_id 	= Input::get('category_id');
		$addOn_category = Input::get('addOn_category');
		$image 			= Input::get('image');
		$status 		= Input::get('status');
		
		$validator = Validator::make($request->all(), [
			'item_name' => 'required',
        ]);
		
		if($validator->fails()){
			$errors=$validator->errors()->all();
			$error_html='';
			foreach($errors as $er){
				$error_html .='<span>'.$er.'</span></br>';
			}
			Session::flash('error', $error_html);
			return redirect::back();
        }else{
			$slug=Helpers::create_slug($name);
			$merchant_id = Auth::id();
			if($item_id!=''){
				$data = array(
					'item_name'			=> $name,
					'item_slug'			=> $slug,
					'item_description'	=> $description,
					'category_id'		=> $category_id,
					'price'				=> $price,
					'photo'  			=> $image,
					'status'  			=> $status
				);	
				Item::where('item_id', $item_id)->update($data);
			}else{
				$item = new Item;
				$item->merchant_id		= $merchant_id;
    			$item->item_name 		= $name;
    			$item->item_slug		= $slug;
				$item->item_description	= $description;
				$item->category_id 		= $category_id;
				$item->price 			= $price;
				$item->photo 			= $image;
				$item->status 			= $status;
    			$item->save();
			}
			Session::flash('success', 'Successfully Saved data.');
		}
		return redirect('merchant_admin/food/items');
	}
	public function deleteItem() {
		$item_id = Input::get('id');
		//echo $category_id;exit;
		Common::deleteData('item','item_id',$item_id);
		Session::flash('success', 'Addon Item deleted successfully.');
		return redirect::back();
	}
	
	
	public function tableBooking(){
		$title 			= "Table Booking List";
        $breadcumbs 	= "Table Booking List";
        $active 		= "table_booking";
		
		$merchant_id 	= Auth::id();
		$booking_list		= BookingTable::where('merchant_id',$merchant_id)->orderBy('id','DESC')->get();
		
		//echo '<pre>';print_r($items_list);exit;
		
		return view('merchant.food.table_booking', compact('title','active','breadcumbs','booking_list'));
    }
	
	
	
	
	
	public function store_details($store_id){
		 $title 		= "Store Details";
		 $breadcumbs 	= "Store Details";
		 $active 		= 'store';
		 
		 $param['store_id']	= $store_id;
		 $store_info 		= Merchant::where('merchant_id',$store_id)->first();
		 $item_list 		= Item::where('merchant_id',$store_id)->get();
		 
		 //echo '<pre>';print_r($item_list[0]->category->category_name);exit;
		 
		 return view('admin.store.details', compact('title','breadcumbs','active','store_id','store_info','item_list'));	  
    }
	
	public function deleteUser() {
		$user_id = Input::get('id');
		if ($user_id != null) {
			Common::deleteData('users','id',$user_id);
			Common::deleteData('user_wallet','user_id',$user_id);
			Common::deleteData('user_bit_transaction','user_id',$user_id);
			Common::deleteData('user_bank','user_id',$user_id);
			Common::deleteData('transactions','user_id',$user_id);
			Common::deleteData('balance_request','user_id',$user_id);
			Common::deleteData('withdraw_request','user_id',$user_id);
			Session::flash('success', 'User deleted successfully.');
			}else{
				Session::flash('error', 'Something wrong please try again !');
			}
			
		return redirect::back();
    }
	
	public function store_upload(Request $request){
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['product_upload_file']['name']) && in_array($_FILES['product_upload_file']['type'], $csvMimes)){
			if(is_uploaded_file($_FILES['product_upload_file']['tmp_name'])){
				$csvFile = fopen($_FILES['product_upload_file']['tmp_name'], 'r');
				fgetcsv($csvFile);
				$merchantData=[];
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$store_name   		= $line[0];
					$store_url   		= $line[1];
					$desc   			= $line[2];
					$img_url   			= $line[3];
					
					if($store_name!=''){
						$restaurant_slug	= Helpers::create_slug(trim($store_name));
						
						$desc_data = explode(' ',$desc);
						$price_id='';
						for($i=0; count($desc_data)>$i; $i++){
							$th_head = str_replace(' ','',$desc_data[$i]);
							if (preg_match('/\$\b/', $th_head)) {
								$price_id	= $i;
								break;
							}
						}
						
						$free_delivery='';
						if($price_id!=''){
							$free_delivery_info=$desc_data[$price_id];
							preg_match_all('!\d+!', $free_delivery_info, $matches);
							$free_delivery .= isset($matches[0][0])?$matches[0][0]:'0';
							$free_delivery .= isset($matches[0][1])? '.'.$matches[0][1]:'.0';
						}
						
						//echo '<pre>';print_r($free_delivery);exit;
						$start_delivery_fee_row_id='';
						for($i=0; count($desc_data)>$i; $i++){
							$th_head = str_replace(' ','',$desc_data[$i]);
							if (preg_match('/Delivery$\b/', $th_head)) {
								$start_delivery_fee_row_id	= $i;
								break;
							}
						}
						
						
						$delivery_estimation='';
						if($start_delivery_fee_row_id!=''){
							$start_delivery_fee_row_id	= (count($desc_data)-2);
							for($i=$start_delivery_fee_row_id; count($desc_data)>$i; $i++){
								$delivery_estimation .=$desc_data[$i].' ';
							}
							if($delivery_estimation!=''){
								$delivery_estimation=trim($delivery_estimation);
							}
						}
						
						$merchant_data 		= Merchant::where('restaurant_slug',$restaurant_slug)->first();
						$merchant_id		= isset($merchant_data->merchant_id)?$merchant_data->merchant_id: '';
						
						$total_merchant_count	= Merchant::where('city','Winnipeg')->count();
						if($total_merchant_count<6){
							if($merchant_id!=''){
								$merchantData=array(
									'restaurant_slug'  		=> $restaurant_slug,
									'restaurant_name'  		=> $store_name,
									'store_url'				=> $store_url,
									'free_delivery'  		=> $free_delivery,
									'delivery_estimation'  	=> $delivery_estimation,
									'logo'  				=> $img_url,
									'meta_data'				=> $desc
								);
								Merchant::where('merchant_id', $merchant_id)->update($merchantData);
							}else{
								$merchantData=array(
									'restaurant_slug'  		=> $restaurant_slug,
									'restaurant_name'  		=> $store_name,
									'store_url'				=> $store_url,
									'free_delivery'  		=> $free_delivery,
									'delivery_estimation'  	=> $delivery_estimation,
									'logo'  				=> $img_url,
									'meta_data'				=> $desc,
									'country_id'			=> '38',
									'country_code'			=> 'CA',
									'city'					=> 'Winnipeg',
									'address'				=> '236 Edmonton St, Winnipeg, R3c 1r7',
									
								);
								//echo '<pre>';print_r($merchantData);exit;
								$merchantData	= Merchant::create($merchantData);	
								//echo '<pre>';print_r($merchantData);exit;					
							}
						}
					}
				}
			}
		}
		
		Session::flash('success', 'Successfully import data.');
		return redirect('administrator/store/list');
	}
	
	public function items_upload(Request $request){
		$merchant_id = Input::get('merchant_id');
		$productData2=[];
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['product_upload_file']['name']) && in_array($_FILES['product_upload_file']['type'], $csvMimes)){
			if(is_uploaded_file($_FILES['product_upload_file']['tmp_name'])){
				$csvFile = fopen($_FILES['product_upload_file']['tmp_name'], 'r');
				fgetcsv($csvFile);
				$merchantData=[];
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$title		= $line[0];
					$price   	= $line[1];
					$desc   	= $line[2];
					$tag   		= $line[3];
					$img   		= isset($line[4])?$line[4]:'';
					$cat_name   = $line[5];
					
					
					
					if($title!=''){
						$product_slug	= Helpers::create_slug($title);
						$product_mrp 	= str_replace('CA$', '', $price);
						$product_tag 	= $tag;
						
						
						//print_r($cat_name);exit;
						
						
						$category_slug	= Helpers::create_slug($cat_name);
						$category_data 	= Category::where('category_slug',$category_slug)->where('merchant_id',$merchant_id)->first();
						$cat_id			= isset($category_data->cat_id)?$category_data->cat_id: '';
						
						if($cat_id!=''){
							$category_id=$cat_id;
						}else{
							$categoryData=array(
								'merchant_id'  			=> $merchant_id,
								'category_name'  		=> $cat_name,
								'category_slug'			=> $category_slug,
								'category_description'  => $cat_name,
								'status'  				=> 1
							);
							
							$categorySaveData	= Category::create($categoryData);
							$category_id		= $categorySaveData->id;
						}
						
						$product_data 		= Item::where('item_slug',$product_slug)->where('merchant_id',$merchant_id)->first();
						$product_id			= isset($product_data->item_id)?$product_data->item_id: '';
						
						if($product_id!=''){
							$productData=array(
								'item_name'  		=> $title,
								'item_slug'  		=> $product_slug,
								'item_description'	=> $desc,
								'category_id'  		=> $category_id,
								'price'  			=> $product_mrp,
								'tag'  				=> $product_tag,
								'photo'				=> $img
							);
							Item::where('item_id', $product_id)->update($productData);
						}else{
							$productData=array(
								'merchant_id'  		=> $merchant_id,
								'item_name'  		=> $title,
								'item_slug'  		=> $product_slug,
								'item_description'	=> $desc,
								'category_id'  		=> $category_id,
								'price'  			=> $product_mrp,
								'tag'  				=> $product_tag,
								'photo'				=> $img
							);
							
							Item::create($productData);	
							
							$productData2[]=array(
								'merchant_id'  		=> $merchant_id,
								'item_name'  		=> $title,
								'item_slug'  		=> $product_slug,
								'item_description'	=> $desc,
								'cat_name'			=> $cat_name,
								'category_id'  		=> $category_id,
								'price'  			=> $product_mrp,
								'tag'  				=> $product_tag,
								'photo'				=> $img
							);
							
							//echo '<pre>';print_r($productData);exit;
							
										
						}
					}
				}
			}
		}
		
		echo '<pre>';print_r($productData2);exit;
		Session::flash('success', 'Successfully import data.');
		return redirect('administrator/store/list');
	}
 
	
}
