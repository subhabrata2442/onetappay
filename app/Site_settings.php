<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_settings extends Model
{
    protected $table = 'site_settings';
	protected $fillable = ['option_name','option_value','created_at'];
}
