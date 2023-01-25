<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\AdvertisementMail;
use App\Mail\NewCustomerRegistrationEmail;
use App\Mail\VerifyMail;
use Notification;
use App\Notifications\AdvertisementMessageNotification;
use App\Notifications\AdvertisementNewMessageCustomerNotification;
use App\Notifications\AdvertisementNewMessageAdvertiserNotification;
use App\Models\Advertisement;
use App\Models\Messenger;
use App\Models\MessangerDetail;
use App\Models\UserSubscription;
use App\Models\RecreationalVehicle;
use App\Models\AdvertisementCategory;
use App\Models\AdvertisementWiseCategory;
use App\Models\Property;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\VerifyUser;
use DB;
use Auth;
use Image;
use Carbon;
use Session;

class AdvertiesmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title          = "List Advertiesment";
        $breadcumbs     = "List Advertiesment";
        $active         = 'advertiesment';
        $subActive      = 'advertiesmentList';
        if(Auth::user()->user_type == 1){
            $advertisements = Advertisement::where('user_id_fk','!=',0)->orderBy('id','DESC')->get();
        }else{
            $advertisements = Advertisement::Where('user_id_fk', Auth::user()->id)->orderBy('id','DESC')->get();
        }
		echo 'dd';exit;

        $subscription   = UserSubscription::Where('user_id', Auth::user()->id)->Where('subscription_type','3')->first();
        return view('advertisement.list', compact('title','breadcumbs','active','subActive','advertisements','subscription'));
    }

    public function advertisement()
    {
        $title          = "List Advertiesment";
        $breadcumbs     = "List Advertiesment";
        $active         = 'advertiesment';
		$search			= isset($_GET['advertisement'])?$_GET['advertisement']:'';
		
		//print_r($search);exit;
		
		if($search!=''){
			 $advertisements = Advertisement::With('getCountry','getState','getCity','category')->WhereDate('end_date', '>=', date('Y-m-d'))->where('title', 'like', '%'.$search.'%')->orderBy('created_at', 'ASC')->paginate(12);
		}else{
			 $advertisements = Advertisement::With('getCountry','getState','getCity','category')->WhereDate('end_date', '>=', date('Y-m-d'))->orderBy('created_at', 'ASC')->paginate(12);
		}
       
        $category       = AdvertisementCategory::Where('status', '1')->get();
        $min            = Advertisement::Where(['status' =>'1'])->min('price');
        $max            = Advertisement::Where(['status' =>'1'])->max('price');
		if($max!=''){
			$max			= $max + 1000;
		}
		
		
		//print_r($max);exit;
		
		//echo 'dd';exit;
		
		
        return view('advertisement.advertisement', compact('title','breadcumbs','active','advertisements','category','min','max'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title 		= "Add Advertiesment";
        $breadcumbs = "Add Advertiesment";
        $active     = 'advertiesment';
        $subActive  = 'advertiesmentAdd';
        $category   = AdvertisementCategory::Where('status','1')->orderBy('id','DESC')->get();
        $country    = Country::Where('status', '1')->get();
		
		if(isset(Auth::user()->id)){
			return view('advertisement.create', compact('title','breadcumbs','active','subActive','category','country'));
		}
		
		return view('advertisement.withoutlogincreate', compact('title','breadcumbs','active','subActive','category','country'));
		
    }
	
	
	public function store_save_data(Request $request)
    {
		
		//print_r($_POST);exit;
        //
        $imageData = $request->file('image');
        $videoData = $request->file('video');
        $category  = $request->category;

        $rules = array(
            'title'       => 'required|max:100',
            /*'description' => 'required',
            'image'       => 'required|image|mimes:jpeg,jpg,bmp,png,gif|dimensions:min_width=600,min_height=800',
            'start_date'  => 'required',
            'end_date'    => 'required',
            'price'       => 'required',
            'dicount'     => 'required',
            'category'    => 'required',
            'address'     => 'required',
            'country'     => 'required',
            'state'       => 'required',
            'city'        => 'required',
            'zip_code'    => 'required'*/
        );

        $messages = [
            'title.required'       => 'Please Enter Title.',
            /*'description.required' => 'Please Enter About Advertisement.',
            'image.required'       => 'Please Upload Banner Image.',
            'image.mimes'          => 'Only allowed jpeg,jpg,png,bmp or gif.',
            'image.dimensions'     => 'Image size minimum width 600px and minimum height 800px',
            'start_date.required'  => 'Please Select Start Date',
            'end_date.required'    => 'Please Select End Date',
            'price.required'       => 'Please enter price',
            'dicount.required'     => 'Please enter discount',
            'category.required'    => 'Please select category',
            'address.required'     => 'Please enter address',
            'country.required'     => 'Please select country',
            'state.required'       => 'Please select state',
            'city.required'        => 'Please select city',
            'zip_code.required'    => 'Please enter zip code',*/
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }else{
            DB::beginTransaction();
            try{
                $advertisement = new Advertisement;

                $advertisement->user_id_fk        = 0;
                $advertisement->title             = $request->title;
                $advertisement->description       = $request->description;
                $advertisement->inclusions        = $request->inclusions;
                $advertisement->duration          = $request->duration;
                $advertisement->departure_details = $request->departure_details;
                $advertisement->exclusions        = $request->exclusions;
                $advertisement->start_date        = date('Y-m-d', strtotime($request->start_date));
                $advertisement->end_date          = date('Y-m-d', strtotime($request->end_date));
                $advertisement->price             = $request->price;
                $advertisement->dicount           = $request->dicount;
                $advertisement->address           = $request->address;
                $advertisement->country           = $request->country;
                $advertisement->state             = $request->state;
                $advertisement->city              = $request->city;
                $advertisement->zip_code          = $request->zip_code;
				$advertisement->status            = 1;
				

                if(!empty($imageData)){
                    $filename = $imageData->getClientOriginalName();
                    $newFileName = time(). '_' .str_replace(' ', '_', $filename);
                    $path = public_path('/image/advertiesment/');
                    $croppedBanner = Image::make($imageData->getRealPath())->fit(600, 800);
                    $uploadSuccess = $croppedBanner->save($path.'/'.$newFileName,99);
                    //Thumb
                    $pathT = public_path('/image/advertiesment/thumb/');
                    $croppedBannerT = Image::make($imageData->getRealPath())->fit(800, 600);
                    $uploadSuccess = $croppedBannerT->save($pathT.'/'.$newFileName,99);
                    $advertisement->image = $newFileName;
                }

                if($request->hasFile('video')){
                    $file = $request->file('video');
                    $filename = $file->getClientOriginalName();
                    $path = public_path('/video/advertiesment/');
                    $file->move($path, $filename);
                    $advertisement->video = $filename;
                }

                $advertisement->save();

                if(!empty($category)){
                    foreach($category as $cat){
                        $categories = new AdvertisementWiseCategory;
                        $categories->add_id_fk = $advertisement->id;
                        $categories->cat_id_fk = $cat;
                        $categories->save();
                    }
                }

                DB::commit();
				Session::put('last_advertisement_id', $advertisement->id);
                return redirect('/login');

            }catch( \Exception $e){
                DB::rollback();
                Session::flash('error', $e->Getmessage());
                return redirect()->back();
            }
        }
		
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $imageData = $request->file('image');
        $videoData = $request->file('video');
        $category  = $request->category;

        $rules = array(
            'title'       => 'required|max:100',
            'description' => 'required',
            'image'       => 'required|image|mimes:jpeg,jpg,bmp,png,gif|dimensions:min_width=600,min_height=800',
            'start_date'  => 'required',
            'end_date'    => 'required',
            'price'       => 'required',
            'dicount'     => 'required',
            'category'    => 'required',
            'address'     => 'required',
            'country'     => 'required',
            'state'       => 'required',
            'city'        => 'required',
            'zip_code'    => 'required'
        );

        $messages = [
            'title.required'       => 'Please Enter Title.',
            'description.required' => 'Please Enter About Advertisement.',
            'image.required'       => 'Please Upload Banner Image.',
            'image.mimes'          => 'Only allowed jpeg,jpg,png,bmp or gif.',
            'image.dimensions'     => 'Image size minimum width 600px and minimum height 800px',
            'start_date.required'  => 'Please Select Start Date',
            'end_date.required'    => 'Please Select End Date',
            'price.required'       => 'Please enter price',
            'dicount.required'     => 'Please enter discount',
            'category.required'    => 'Please select category',
            'address.required'     => 'Please enter address',
            'country.required'     => 'Please select country',
            'state.required'       => 'Please select state',
            'city.required'        => 'Please select city',
            'zip_code.required'    => 'Please enter zip code',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }else{
            DB::beginTransaction();
            try{
                $advertisement = new Advertisement;

                $advertisement->user_id_fk        = Auth::user()->id;
                $advertisement->title             = $request->title;
                $advertisement->description       = $request->description;
                $advertisement->inclusions        = $request->inclusions;
                $advertisement->duration          = $request->duration;
                $advertisement->departure_details = $request->departure_details;
                $advertisement->exclusions        = $request->exclusions;
                $advertisement->start_date        = date('Y-m-d', strtotime($request->start_date));
                $advertisement->end_date          = date('Y-m-d', strtotime($request->end_date));
                $advertisement->price             = $request->price;
                $advertisement->dicount           = $request->dicount;
                $advertisement->address           = $request->address;
                $advertisement->country           = $request->country;
                $advertisement->state             = $request->state;
                $advertisement->city              = $request->city;
                $advertisement->zip_code          = $request->zip_code;

                if(!empty($imageData)){
                    $filename = $imageData->getClientOriginalName();
                    $newFileName = time(). '_' .str_replace(' ', '_', $filename);
                    $path = public_path('/image/advertiesment/');
                    $croppedBanner = Image::make($imageData->getRealPath())->fit(600, 800);
                    $uploadSuccess = $croppedBanner->save($path.'/'.$newFileName,99);
                    //Thumb
                    $pathT = public_path('/image/advertiesment/thumb/');
                    $croppedBannerT = Image::make($imageData->getRealPath())->fit(800, 600);
                    $uploadSuccess = $croppedBannerT->save($pathT.'/'.$newFileName,99);
                    $advertisement->image = $newFileName;
                }

                if($request->hasFile('video')){
                    $file = $request->file('video');
                    $filename = $file->getClientOriginalName();
                    $path = public_path('/video/advertiesment/');
                    $file->move($path, $filename);
                    $advertisement->video = $filename;
                }

                $advertisement->save();

                if(!empty($category)){
                    foreach($category as $cat){
                        $categories = new AdvertisementWiseCategory;
                        $categories->add_id_fk = $advertisement->id;
                        $categories->cat_id_fk = $cat;
                        $categories->save();
                    }
                }

                DB::commit();
                Session::flash('success', 'Advertisement added Successfully!');
                if(auth()->user()->user_type == 2){
                    return redirect('owner/advertiesment');
                }else{
                    return redirect('advertiser/advertiesment');
                }

            }catch( \Exception $e){
                DB::rollback();
                Session::flash('error', $e->Getmessage());
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        if(empty($id)){
            return redirect('/');
        }

        $title = "Advertisement";
        $active = "advertisement";
        $otherAdvertisement = [];
        $advertiesmentData = Advertisement::With('advertiser')->find(decrypt($id));
        $category   = AdvertisementCategory::Where('status','1')->orderBy('id','DESC')->get();
        if(count((array)$advertiesmentData)>0){
            $title = $advertiesmentData->title;
            $otherAdvertisement = Advertisement::Where('user_id_fk', $advertiesmentData->user_id_fk)->Where('id', '!=', $advertiesmentData->id)->get();
            return view('advertisement.show', compact('title','active','advertiesmentData','otherAdvertisement','category'));
        }else{
            return redirect('/');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title       = "Edit Advertiesment";
        $breadcumbs  = "Edit Advertiesment";
        $active      = 'advertiesment';
        $subActive   = 'advertiesmentEdit';

        if ($id != null) {
            $id = decrypt($id);
            $advertiesmentData = Advertisement::find($id);
            $category   = AdvertisementCategory::Where('status','1')->orderBy('id','DESC')->get();
            $adCategory = AdvertisementWiseCategory::where('add_id_fk', '=', $advertiesmentData->id)->pluck('cat_id_fk')->toArray();
            $country    = Country::Where('status', '1')->get();
            $state      = State::Where('country_id', $advertiesmentData->country)->get();
            $city       = City::Where('state_id', $advertiesmentData->state)->get();
            return view('advertisement.update', compact('title','breadcumbs','active','subActive','advertiesmentData','category','adCategory','country','state','city'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($id != null) {
            $imageData = $request->file('image');
            $category  = $request->category;

            if(!empty($imageData)){
                $rules = array(
                    'title'       => 'required|max:100',
                    'description' => 'required',
                    'image'       => 'required|image|mimes:jpeg,jpg,bmp,png,gif|dimensions:min_width=600,min_height=800',
                    'start_date'  => 'required',
                    'end_date'    => 'required',
                    'price'       => 'required',
                    'dicount'     => 'required',
                    //'category'    => 'required',
                    'address'     => 'required',
                    'country'     => 'required',
                    'state'       => 'required',
                    'city'        => 'required',
                    'zip_code'    => 'required'
                );

                $messages = [
                    'title.required'       => 'Please Enter Title.',
                    'description.required' => 'Please Enter Description.',
                    'image.required'       => 'Please Upload Banner Image.',
                    'image.mimes'          => 'Only allowed jpeg,jpg,png,bmp or gif.',
                    'image.dimensions'     => 'Image size minimum width 600px and minimum height 800px',
                    'start_date.required'  => 'Please Select Start Date',
                    'end_date.required'    => 'Please Select End Date',
                    'price.required'       => 'Please enter price',
                    'dicount.required'     => 'Please enter discount',
                    //'category.required'    => 'Please select category',
                    'address.required'     => 'Please enter address',
                    'country.required'     => 'Please select country',
                    'state.required'       => 'Please select state',
                    'city.required'        => 'Please select city',
                    'zip_code.required'    => 'Please enter zip code',
                ];
            }else{
                $rules = array(
                    'title'       => 'required|max:100',
                    'description' => 'required',
                    'start_date'  => 'required',
                    'end_date'    => 'required',
                    'price'       => 'required',
                    'dicount'     => 'required',
                    //'category'    => 'required',
                    'address'     => 'required',
                    'country'     => 'required',
                    'state'       => 'required',
                    'city'        => 'required',
                    'zip_code'    => 'required'
                );

                $messages = [
                    'title.required'       => 'Please Enter Title.',
                    'description.required' => 'Please Enter Description.',
                    'start_date.required'  => 'Please Select Start Date',
                    'end_date.required'    => 'Please Select End Date',
                    'price.required'       => 'Please enter price',
                    'dicount.required'     => 'Please enter discount',
                    'category.required'    => 'Please select category',
                    'address.required'     => 'Please enter address',
                    'country.required'     => 'Please select country',
                    'state.required'       => 'Please select state',
                    'city.required'        => 'Please select city',
                    'zip_code.required'    => 'Please enter zip code',
                ];
            }


            //Validation

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }else{
                DB::beginTransaction();

                try{

                    $advertisement  = Advertisement::find($id);

                    $advertisement->title             = $request->title;
                    $advertisement->description       = $request->description;
                    $advertisement->inclusions        = $request->inclusions;
                    $advertisement->duration          = $request->duration;
                    $advertisement->departure_details = $request->departure_details;
                    $advertisement->exclusions        = $request->exclusions;
                    $advertisement->start_date        = date('Y-m-d', strtotime($request->start_date));
                    $advertisement->end_date          = date('Y-m-d', strtotime($request->end_date));
                    $advertisement->price             = $request->price;
                    $advertisement->dicount           = $request->dicount;
                    $advertisement->address           = $request->address;
                    $advertisement->country           = $request->country;
                    $advertisement->state             = $request->state;
                    $advertisement->city              = $request->city;
                    $advertisement->zip_code          = $request->zip_code;

                    if(!empty($imageData)){
                        $filename = $imageData->getClientOriginalName();
                        $newFileName = time(). '_' .str_replace(' ', '_', $filename);
                        $path = public_path('/image/advertiesment/');
                        $croppedBanner = Image::make($imageData->getRealPath())->fit(600, 800);
                        $uploadSuccess = $croppedBanner->save($path.'/'.$newFileName,99);
                        //Thumb
                        $pathT = public_path('/image/advertiesment/thumb/');
                        $croppedBannerT = Image::make($imageData->getRealPath())->fit(800, 600);
                        $uploadSuccess = $croppedBannerT->save($pathT.'/'.$newFileName,99);
                        $advertisement->image = $newFileName;
                    }

                    if($request->hasFile('video')){
                        $file = $request->file('video');
                        $filename = $file->getClientOriginalName();
                        $path = public_path('/video/advertiesment/');
                        $file->move($path, $filename);
                        $advertisement->video  = $filename;
                    }

                    $advertisement->status = $request->status;
                    $advertisement->save();

                    if(!empty($category)){
                        AdvertisementWiseCategory::Where('add_id_fk', $advertisement->id)->delete();
                        foreach($category as $cat){
                            $categories = new AdvertisementWiseCategory;
                            $categories->add_id_fk = $advertisement->id;
                            $categories->cat_id_fk = $cat;
                            $categories->save();
                        }
                    }

                    DB::commit();

                    Session::flash('success', 'Advertisement updated Successfully!');
                    if(auth()->user()->user_type == 2){
                        return redirect('owner/advertiesment');
                    }else{
                        return redirect('advertiser/advertiesment');
                    }
                }catch(\Exception $e){
                    DB::rollback();
                    Session::flash('error', $e->Getmessage());
                    return redirect()->back();
                }

            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if ($id) {
            $decrypted = decrypt($id);
            $add = Advertisement::find($decrypted);
            if(\File::exists(public_path('image/advertiesment/'.$add->image))){
                \File::delete(public_path('image/advertiesment/'.$add->image));
            }
            if(\File::exists(public_path('video/advertiesment/'.$add->video))){
                \File::delete(public_path('video/advertiesment/'.$add->video));
            }
            $add->delete();
        }
        Session::flash('success', 'Advertisement deleted successfully!');
        return redirect()->back();
    }

    public function contactAdvertiser(Request $request){
        $rules = array(
            'first_name'  => 'required',
            'last_name'   => 'required',
            'phone'       => 'required|digits:10',
            'message'     => 'required',
            'email'       => 'required|email',
        );

        $messages = [
            'first_name.required'  => 'Please enter first name.',
            'last_name.required'   => 'Please enter last name.',
            'phone.required'       => 'Please enter phone number.',
            'phone.digits'         => 'Please enter phone numbers only.',
            'email.required'       => 'Please enter email address.',
            'email.email'          => 'Please enter valid email address.',
            'message.required'     => 'Please enter message.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();

            $error_html='';
            foreach($errors as $er){
               $error_html .='<span>'.$er.'</span></br>';
            }
            $return_data['success'] = 0;
            $return_data['error_message'] = $error_html;

        }else{
            try{
                //DB::beginTransaction();

                //Send email both advertiser and customer
                $findUser             = User::Where('email', $request->email)->first();
                $advertisementDetails = Advertisement::With('advertiser')->find(decrypt($request->advertisement));

                if(!empty($advertisementDetails) && count((array)$advertisementDetails)){

                    if(empty($findUser)){
                        $customerID   = NULL;

                        $newUser 		                = new User;
                        $generatePassword               = Str::random(12);

                        $newUser->name		 			= $request->first_name.' '.$request->last_name;
                        $newUser->first_name            = $request->first_name;
                        $newUser->last_name             = $request->last_name;
                        //$newUser->phone_country         = $request->phoneCountry;
                        //$newUser->phone_prefix          = $request->phonePrefix;
                        $newUser->phone                 = $request->phone;
                        $newUser->email 				= $request->email;
                        $newUser->password 				= Hash::make($generatePassword);
                        $newUser->email_verified_at 	= date('Y-m-d H:i:s');
                        $newUser->remember_token 		= Str::random(32);
                        $newUser->user_type 			= '3';
                        $newUser->is_verified  			= '1';
						$newUser->is_active 		    = '1';
                        $newUser->save();

                        $customerID	=	$newUser->id;

                        $data = [
                            'name'     => $newUser->name,
                            'password' => $generatePassword,
                            'email'    => $newUser->email,
                        ];
                        $userEmail = $newUser->email;
                        //User Registration Mail Send
                        Mail::to($request->email)->send(new NewCustomerRegistrationEmail($data));

                        /* $verifyUser = VerifyUser::create([
                            'user_id' => $user->id,
                            'token' => sha1(time())
                          ]);


                        Mail::to($newUser->email)->send(new VerifyMail($newUser)); */
                        $customerType = $request->first_name.' '.$request->last_name;

                    }else{
                        $customerID   = $findUser->id;
                        $customerType = $findUser->name;
                    }

                    if($advertisementDetails->user_id_fk == $customerID){
                        $message= 'You can\'t send message your self.';
                        $return_data['success'] = 0;
                        $return_data['error_message'] = $message;
                    }else{
                        $messanger = new Messenger;
                        $messanger->messengerId     = createID('message');
                        $messanger->seller_id_fk    = $advertisementDetails->user_id_fk;
                        $messanger->customer_id_fk  = $customerID;
                        $messanger->item_id_fk      = decrypt($request->advertisement);
                        $messanger->item_type       = '3';
                        $messanger->message_person  = '2';
                        $messanger->message         = $request->message;
                        $messanger->message_type    = $customerType.' Send message to Advertiser.';
                        $messanger->types           = '4';
                        $messanger->save();

                        $messageDetails = new MessangerDetail;
                        $messageDetails->messenger_id_fk   = $messanger->messengerId;
                        $messageDetails->seller_id_fk      = $advertisementDetails->user_id_fk;
                        $messageDetails->customer_id_fk    = $customerID;
                        $messageDetails->message           = $request->message;
                        $messageDetails->message_person    = '2';
                        $messageDetails->save();

                        $advertisementData = [
                            'first_name' => $request->first_name,
                            'last_name'  => $request->last_name,
                            'email'      => $request->email,
                            'phone'      => $request->phone,
                            'message'    => $request->message,
                            'ad'         => $advertisementDetails->title,
                            'price'      => '$'.number_format($advertisementDetails->price,2),
                            'thumb'      => $advertisementDetails->image,
                        ];

                        Mail::to($request->email)->send(new AdvertisementMail($advertisementData));

                        if($advertisementDetails->advertiser->user_type == '4'){
                            $messagePerson = '4';
                            $userUrl = 'advertiser';
                        }elseif($advertisementDetails->advertiser->user_type == '3'){
                            $messagePerson = '2';
                            $userUrl = 'customer';
                        }elseif($advertisementDetails->advertiser->user_type == '2'){
                            $messagePerson = '1';
                            $userUrl = 'owner';
                        }else{
                            $messagePerson = '3';
                            $userUrl = 'admin';
                        }

                        //Send notification to advertiser
                        $userNotificationDetails = [
                            'greeting'                => 'Hi',
                            'body'                    => 'New advertisement enquiry',
                            'actionIcon'              => 'fas fa-comment-dots',
                            'actionURL'               => url($userUrl.'/message/enquiry/advertisement'),
                            'advertiser_id'           => $advertisementDetails->user_id_fk,
                            'newAdvertisementEnquery' => $advertisementDetails->user_id_fk,
                        ];
                        User::find($advertisementDetails->user_id_fk)->notify(new AdvertisementMessageNotification($userNotificationDetails));
                        DB::commit();
                        //Send Notification
                        $message= 'Message Send Successfully. Thank You.';
                        $return_data['success'] = 1;
                        $return_data['success_message'] = $message;
                    }
                }else{
                     //Send Notification
                     $message= 'Something went wrong. Please try aftersometime.';
                     $return_data['success'] = 0;
                     $return_data['success_message'] = $message;
                }
            }catch ( \Exception $e){
               // DB::rollback();
                $return_data['success'] = 0;
                $return_data['error_message'] = $e->Getmessage();
            }
        }
        return response()->json($return_data);
    }

    public function newAdvertisementMessages(Request $request){
        $title = 'Message Advertisement Enquiry List';
        $breadcumbs = 'Message Advertisement Enquiry List';
        $active = 'messages';
        $subActive = 'messageEnquiryList';
        $auth = Auth::user();
        $userType = '';
        $view = '';
        if($auth->user_type == '3'){
            $userType = 'customer_id_fk';
            $view = 'customer';
            Auth::user()->unreadNotifications()->Where('type',AdvertisementMessageNotification::class)->update(['read_at' => Carbon\Carbon::now()]);
        }elseif($auth->user_type == '2'){
            Auth::user()->unreadNotifications()->Where('type',AdvertisementMessageNotification::class)->update(['read_at' => Carbon\Carbon::now()]);
            $userType = 'seller_id_fk';
            $view = 'owner';
        }else{
            Auth::user()->unreadNotifications()->Where('type',AdvertisementMessageNotification::class)->update(['read_at' => Carbon\Carbon::now()]);
            $userType = 'seller_id_fk';
            $view = 'advertiser';
        }

        $messenger = Messenger::With('advertisement','customer')->Where('types','4')->Where($userType, Auth::user()->id)->orderBy('created_at', 'DESC')->groupBy('messengerId')->get();

        return view('message.'.$view.'.enquiry.index', compact('title','breadcumbs','active','subActive','messenger'));

    }

    public function viewEnquery($id=null){
        if(!$id){
            return redirect()->back()->with('error','Something Went Wrong. Try Later.');
        }
        $id=decrypt($id);
        $title = 'Message Enquiry Details';
        $breadcumbs = 'Message Enquiry Details';
        $active = 'messages';
        $subActive = 'messageEnquiryList';

        $auth= Auth::user();

        $mainMessage = Messenger::With('advertisement','customer','seller')->Where('messengerId', $id)->first();
        $messages = MessangerDetail::Where('messenger_id_fk', $id)->get();

        if($auth->user_type == '3'){
            $userType = 'customer_id_fk';
            $view = 'customer';
            Auth::user()->unreadNotifications()->Where('type',AdvertisementMessageNotification::class)->update(['read_at' => Carbon\Carbon::now()]);
        }elseif($auth->user_type == '2'){
            Auth::user()->unreadNotifications()->Where('type',AdvertisementMessageNotification::class)->update(['read_at' => Carbon\Carbon::now()]);
            $userType = 'seller_id_fk';
            $view = 'owner';
        }else{
            Auth::user()->unreadNotifications()->Where('type',AdvertisementMessageNotification::class)->update(['read_at' => Carbon\Carbon::now()]);
            $userType = 'seller_id_fk';
            $view = 'advertiser';
        }

        return view('message.'.$view.'.enquiry.message', compact('title','breadcumbs','active','subActive','messages','mainMessage'));

    }

    public function newMessage(Request $request){

        if(!empty($request->all())){

            $auth = Auth::user();
            $messageID = decrypt($request->messageID);
            $messageType = $request->messageType;
            $messagePerson = '1';
            $messsages = array(
                'message.required'=>'Please enter your message',
            );
            $rules = array('message' => 'required');
            $validator = Validator::make($request->all(), $rules,$messsages);
            if ($validator->fails()){
                echo json_encode(array('success'=> 0, 'message' => $validator->errors(), 'validation' => $validator->errors()));
            }else{
                DB::beginTransaction();
                try{

                    $newMessage = Messenger::Where('messengerId', $messageID)->first();

                    if($auth->user_type == '4'){
                        $messagePerson = '4';
                    }elseif($auth->user_type == '3'){
                        $messagePerson = '2';
                    }elseif($auth->user_type == '2'){
                        $messagePerson = '1';
                    }else{
                        $messagePerson = '3';
                    }

                    $message = new MessangerDetail;
                    $message->messenger_id_fk   = $messageID;
                    $message->seller_id_fk      = $newMessage->seller_id_fk;
                    $message->customer_id_fk    = $newMessage->customer_id_fk;
                    $message->message           = $request->message;
                    $message->message_person    = $messagePerson;
                    $message->save();

                    if($messageType == 'advertisement'){
                        if($auth->user_type == '4'){
                            $messageDetails = [
                                'greeting'                    => 'Hi',
                                'body'                        => 'New enquery message reply',
                                'thanks'                      => 'Thank you',
                                'actionText'                  => 'View My Site',
                                'actionIcon'                  =>'fa fa-envelope-o',
                                'actionURL'                   => url('customer/message/enquiry/details/'.encrypt($messageID)),
                                'newAdvertisementCustMessage' => $messageID
                            ];

                            User::find($message->customer_id_fk)->notify(new AdvertisementNewMessageCustomerNotification($messageDetails));
                        }else{
                            $messageDetails = [
                                'greeting'   => 'Hi',
                                'body'       => 'New enquery message',
                                'thanks'     => 'Thank you',
                                'actionText' => 'View My Site',
                                'actionIcon' =>'fa fa-envelope-o',
                                'actionURL'  => url('advertiser/message/enquiry/details/'.encrypt($messageID)),
                                'newAdvertisementAdvMessage'  => $messageID
                            ];

                            User::find($message->seller_id_fk)->notify(new AdvertisementNewMessageAdvertiserNotification($messageDetails));
                        }
                    }

                    DB::commit();
                    echo json_encode(array('success'=> 1, 'message' => 'Message send.'));
                }catch ( \Exception $e){
                    DB::rollback();
                    echo json_encode(array('success'=> 0, 'validation' => $e->Getmessage()));
                }

            }
        }
    }

    public function category()
    {
        //
        $title          = "List Advertiesment Category";
        $breadcumbs     = "List Advertiesment Category";
        $active         = 'advertiesment';
        $subActive      = 'advertiesmentList';
        $category = AdvertisementCategory::orderBy('id','DESC')->get();

        return view('advertisement.category.list', compact('title','breadcumbs','active','subActive','category'));
    }

    public function categoryAdd()
    {
        //
        $title = "Add Advertiesment Category";
        $breadcumbs = "Add Advertiesment Category";
        $active = 'advertiesment';
        $subActive = 'advertiesmentAdd';
        return view('advertisement.category.create', compact('title','breadcumbs','active','subActive'));
    }

    public function categoryStore(Request $request)
    {
        //

        $rules = ['category' => 'required'];

        $messages = ['category.required' => 'Please Enter category.'];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }else{
            DB::beginTransaction();
            try{
                $advertisementCat            = new AdvertisementCategory;
                $advertisementCat->category  = $request->category;
                $advertisementCat->save();

                DB::commit();
                Session::flash('success', 'Advertisement Category Added Successfully!');
                return redirect()->back();
            }catch( \Exception $e){
                DB::rollback();
                Session::flash('error', $e->Getmessage());
                return redirect()->back();
            }
        }
    }

    public function categoryEdit($id)
    {
        //
        $title       = "Edit Advertiesment Category";
        $breadcumbs  = "Edit Advertiesment Category";
        $active      = 'advertiesment';
        $subActive   = 'advertiesmentEdit';

        if ($id != null) {
            $id = decrypt($id);
            $advertiesmentData = AdvertisementCategory::find($id);

            return view('advertisement.category.update', compact('title','breadcumbs','active','subActive','advertiesmentData'));
        }else{
            return redirect()->back();
        }
    }

    public function categoryDestroy($id)
    {
        //
        if ($id) {
            $decrypted = decrypt($id);
            $add = AdvertisementCategory::find($decrypted);

            $add->delete();
        }
        Session::flash('success', 'Advertisement category deleted successfully!');
        return redirect()->back();
    }

    public function categoryUpdate(Request $request, $id)
    {
        //
        if ($id != null) {

            $rules = ['category' => 'required'];

            $messages = ['category.required' => 'Please Enter category.'];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }else{

                try{
                    DB::beginTransaction();
                    $advertisementCat            = AdvertisementCategory::find(decrypt($id));
                    $advertisementCat->category  = $request->category;
                    $advertisementCat->status    = $request->status;
                    $advertisementCat->save();
                    DB::commit();

                    Session::flash('success', 'Advertisement Category updated Successfully!');
                    return redirect()->back();
                }catch(\Exception $e){
                    DB::rollback();
                    Session::flash('error', $e->Getmessage());
                    return redirect()->back();
                }

            }

        }
    }
}
