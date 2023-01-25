<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeSlots extends Model
{	
	protected $table = 'time_slots';
	protected $guarded	= [];
	
}
