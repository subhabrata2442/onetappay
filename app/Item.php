<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{	
	protected $table = 'item';
	protected $guarded	= [];
	
	
	public function category()
    {
		return $this->hasOne(Category::class,'cat_id', 'category_id'); 
    }

}
