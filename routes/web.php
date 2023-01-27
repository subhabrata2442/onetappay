<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'front\HomeController@index');
Route::get('index', 'front\HomeController@index');
Route::get('privacy', 'IndexController@privacy');
Route::get('get-file', 'IndexController@get_file');
Route::get('cron-balance-request', 'CronController@cron_balance_request');

Route::get('surl', 'PayUController@surl_request');
Route::get('furl', 'PayUController@furl_request');
Route::get('hash', 'PayUController@hash_request');
Route::get('success_page', 'PayUController@success_page');






Auth::routes();
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Route::get('searcharea', 'front\HomeController@searcharea');

Route::get('about-us', 'front\HomeController@about_us');

#Store
Route::prefix('store')->name('store.')->group(function () {
	Route::get('/{store}', 'front\StoreController@store_details')->name('details');
	Route::post('booking_table', 'front\StoreController@booking_table_request')->name('booking_table.save');
	//Route::post('booking_timeslot', 'front\StoreController@booking_timeslot_request')->name('booking_timeslot.save');
});


#Merchant
Route::prefix('merchant')->name('merchant.')->group(function () {
	Route::get('/signup', 'front\MerchantController@signup')->name('signup');
	Route::post('signup', 'front\MerchantController@signup_request')->name('signup.save');
	Route::get('/signup-success', 'front\MerchantController@success')->name('signup.success');
});

#User
Route::get('/signup', 'Auth\RegisterController@index')->name('signup');
Route::post('signup', 'Auth\RegisterController@createUser')->name('signup.save');
Route::get('/signup-success', 'front\UserController@success')->name('signup.success');

Route::post('login', 'Auth\LoginController@customerAuthentication')->name('login');
Route::post('login', 'Auth\LoginController@customerAuthentication')->name('login');
Route::get('logout', 'Auth\LoginController@logout');


Route::get('profile', 'front\UserController@profile');

#Customer
Route::prefix('profile')->name('profile.')->middleware('checkmemberauth')->group(function () {
//Route::prefix('profile')->name('profile.')->group(function () {
	Route::get('/', 'front\UserController@profile')->name('profile');
	Route::post('updateClientProfile', 'front\UserController@updateClientProfile')->name('profile.save');
	Route::post('updateClientAddress', 'front\UserController@updateClientAddress')->name('address.save');
	
	
	//Route::get('/signup-success', 'front\MerchantController@success')->name('signup.success');
	
	Route::post('delete_address', 'front\UserController@delete_address');
});


//Route::post('additem', 'front\CartController@addons_item_request');
Route::post('get_cart_items', 'front\CartController@cart_items_request');
Route::post('addtocart', 'front\CartController@addtocart_request');
Route::post('updatetocart', 'front\CartController@updatetocart_request');
Route::post('deletecartitem', 'front\CartController@delete_cart_item');
Route::get('checkout', 'front\CartController@checkout');
Route::post('order_place', 'front\CartController@orderPlaceRequest')->name('order_place.save');

Route::get('order-success', 'front\CartController@order_success');
Route::get('order-cancel', 'front\CartController@order_cancel');












/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
|
*/
Route::get('administrator', 'Auth\LoginController@admin');
Route::post('administrator', 'Auth\LoginController@adminAuthentication');
Route::get('admin-logout', 'admin\AdminController@adminlogout');
Route::get('play_game', 'IndexController@play_game');
Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::post('registration', 'Auth\RegisterController@createUser')->name('registration');
#Password reset link request routes...
Route::get('password/forgot', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.forgot');
Route::post('password-forgot', 'Auth\ForgotPasswordController@sendResetLinkToAdminEmail');
Route::get('password-reset',  'Auth\ResetPasswordController@showResetAdminForm');
Route::post('reset-password',  'Auth\ResetPasswordController@AdminResetPasswordRequest');
#Email Check
Route::get('check-email', array('as' => 'check.email', 'uses' => 'AjaxController@checkEmailExist'));
Route::get('ipn', 'IpnController@index');
Route::post('ipn', 'IpnController@index');
Route::get('phone', 'AjaxController@checkphoneExist');


Route::get('merchant_admin', 'Auth\LoginController@merchant_admin');
Route::post('merchant_admin', 'Auth\LoginController@merchantAuthentication');
Route::get('merchant-logout', 'merchant\AdminController@adminlogout');



Route::group(['middleware' => ['checkmerchantauth']], function () {

    # Dashboard
    Route::get('merchant_admin/dashboard', 'merchant\AdminController@dashboard');
	
	# Dashboard
    Route::get('merchant_admin/merchant', 'merchant\AdminController@merchant_settings');
	
	
	
	# Food
	Route::prefix('merchant_admin/food')->name('food.')->group(function () {
		
		Route::post('upload_image', 'merchant\AdminController@uploadImageRequest')->name('image.save');
		
		Route::get('/category', 'merchant\FoodController@category');
		Route::get('/category_create', 'merchant\FoodController@category_create');
		Route::get('/category_update/{cat}', 'merchant\FoodController@category_update')->name('category.edit');
		Route::post('/category/save', 'merchant\FoodController@saveCategoryRequest')->name('category.save');
		Route::get('/category/delete', 'merchant\FoodController@deleteCategory');
		
		
		
		
		//Route::post('/category_save', 'merchant\FoodController@saveCategory')->name('category.save');
		
		//Route::post('/category/save', 'merchant\FoodController@saveCategoryRequest')->name('category_save');
		
		Route::get('/addon_category', 'merchant\FoodController@sub_category');
		Route::get('/addon_category_create', 'merchant\FoodController@sub_category_create');
		Route::get('/addon_category_update/{cat}', 'merchant\FoodController@sub_category_update')->name('subcategory.edit');
		Route::post('/addon_category/save', 'merchant\FoodController@saveSubCategoryRequest')->name('subcategory.save');
		Route::get('/addon_category/delete', 'merchant\FoodController@deleteSubCategory');
		
		
		
		Route::get('/addon_items', 'merchant\FoodController@addon_items');
		Route::get('/addon_items_create', 'merchant\FoodController@addon_item_create');
		Route::get('/addon_items_update/{cat}', 'merchant\FoodController@addon_item_create_update')->name('addonItems.edit');
		Route::post('/addon_items/save', 'merchant\FoodController@saveAddonItemRequest')->name('addonItems.save');
		Route::get('/addon_items/delete', 'merchant\FoodController@deleteAddonItem');
		
		Route::get('/items', 'merchant\FoodController@items');
		Route::get('/items_create', 'merchant\FoodController@items_create');
		Route::get('/items_update/{id}', 'merchant\FoodController@items_update')->name('items.edit');
		Route::post('/items/save', 'merchant\FoodController@saveItemRequest')->name('items.save');
		Route::get('/items/delete', 'merchant\FoodController@deleteItem');
		
		
		
		Route::get('/table', 'merchant\FoodController@table');
		Route::get('/table_create', 'merchant\FoodController@table_create');
		Route::get('/tableupdate/{cat}', 'merchant\FoodController@table_update')->name('table.edit');
		Route::post('/table/save', 'merchant\FoodController@saveTableRequest')->name('table.save');
		Route::get('/table/delete', 'merchant\FoodController@deleteTable');
		
		Route::get('/table_booking', 'merchant\FoodController@tableBooking');
		
		
		
		//Route::post('/store_upload', 'merchant\StoreController@store_upload')->name('store_upload');
		//Route::post('/items_upload', 'merchant\StoreController@items_upload')->name('items_upload');
		
		//Route::match(['GET', 'POST'], '/product_upload', [ProductController::class, 'product_upload'])->name('product_upload');
	});

    

    # Store
	Route::prefix('merchant_admin/store')->name('store.')->group(function () {
		Route::get('/list', 'merchant\StoreController@store');
		Route::get('/details/{store}', 'merchant\StoreController@store_details')->name('show');
		Route::get('/store_delete', 'merchant\StoreController@deleteStore');
		Route::post('/store_upload', 'merchant\StoreController@store_upload')->name('store_upload');
		Route::post('/items_upload', 'merchant\StoreController@items_upload')->name('items_upload');
		
		//Route::match(['GET', 'POST'], '/product_upload', [ProductController::class, 'product_upload'])->name('product_upload');
	});
	
    /*Route::get('administrator/store', 'admin\StoreController@store');
    Route::get('administrator/store/{store}', 'admin\StoreController@store_details')->name('store.show');
    Route::get('administrator/store_delete', 'admin\StoreController@deleteStore');*/
	
    # Settings
    Route::get('merchant_admin/settings', 'merchant\AdminController@settings');
    Route::post('merchant_admin/settings/save', 'merchant\AdminController@saveAdminSettings');
    Route::post('merchant_admin/upload_logo', 'merchant\AdminController@upload_logo_request');

    # Password
    Route::get('merchant_admin/profile/password', 'merchant\MyaccountController@change_password');
    Route::post('merchant_admin/user_password_reset', 'merchant\MyaccountController@passwordReset');
});

Route::group(['middleware' => ['checkadminauth']], function () {

    # Dashboard
    Route::get('administrator/dashboard', 'admin\AdminController@dashboard');

    

    # Store
	Route::prefix('administrator/store')->name('store.')->group(function () {
		Route::get('/list', 'admin\StoreController@store');
		Route::get('/details/{store}', 'admin\StoreController@store_details')->name('show');
		Route::get('/store_delete', 'admin\StoreController@deleteStore');
		Route::post('/store_upload', 'admin\StoreController@store_upload')->name('store_upload');
		Route::post('/items_upload', 'admin\StoreController@items_upload')->name('items_upload');
		
		//Route::match(['GET', 'POST'], '/product_upload', [ProductController::class, 'product_upload'])->name('product_upload');
	});
	
    /*Route::get('administrator/store', 'admin\StoreController@store');
    Route::get('administrator/store/{store}', 'admin\StoreController@store_details')->name('store.show');
    Route::get('administrator/store_delete', 'admin\StoreController@deleteStore');*/
	
    # Settings
    Route::get('administrator/settings', 'admin\AdminController@settings');
    Route::post('administrator/settings/save', 'admin\AdminController@saveAdminSettings');
    Route::post('administrator/upload_logo', 'admin\AdminController@upload_logo_request');

    # Password
    Route::get('profile/password', 'front\MyaccountController@change_password');
    Route::post('user_password_reset', 'front\MyaccountController@passwordReset');


    # upload csv
    Route::post('administrator/upload_csv', 'admin\AdminController@uploadCsvRequest')->name('csv.save');

    # upload image
    Route::post('administrator/upload_image', 'admin\AdminController@uploadImageRequest')->name('image.save');

    # upload Logo
    Route::post('administrator/upload_logo', 'admin\AdminController@uploadLogoRequest')->name('logo.save');

    Route::get('administrator/telescope_entries', 'admin\OrderController@telescope');
});
Route::post('/ajaxpost', 'AjaxController@ajaxpost');
Route::get('show-user-bid-info', 'front\ResultController@showbid');