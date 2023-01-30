<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItems extends Model
{	
	protected $table = 'cart_items';
	protected $guarded	= [];

}
