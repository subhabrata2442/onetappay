<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubcategoryItem extends Model
{	
	protected $table = 'subcategory_item';
	protected $guarded	= [];
	
	public function subcategory(){
		return $this->hasOne(Subcategory::class,'subcat_id', 'category');
	}

}
