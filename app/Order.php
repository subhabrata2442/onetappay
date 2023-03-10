<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{	
	
	
	protected $table = 'order';
	protected $guarded	= [];
	
	public function cartItems()
    {
		return $this->hasMany(CartItems::class,'order_id', 'order_id'); 
    }
	
	public function merchant_info()
    {
		return $this->hasOne(Merchant::class,'user_id', 'merchant_id'); 
    }
	
	public function product_info()
    {
		return $this->hasOne(Item::class,'item_id', 'product_id'); 
    }
	/*public function articles(){
		return $this->hasMany(Article::class, 'cat_id');
	}*/
	
	

}
