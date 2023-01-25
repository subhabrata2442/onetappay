<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{	
	protected $table = 'merchant';
	protected $guarded	= [];
	
	public function country()
    {
		return $this->hasOne(Countrie::class,'id', 'country_id'); 
    }

}
