<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTable extends Model
{	
	protected $table = 'user_booking_table';
	protected $guarded	= [];
	
	public function table()
    {
		return $this->hasOne(Table::class,'id', 'table_id'); 
    }
	public function merchant()
    {
		return $this->hasOne(Merchant::class,'user_id', 'merchant_id'); 
    }
	
	
	

}
