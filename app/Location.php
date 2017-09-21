<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $fillable = ['name', 'capacity', 'street', 'number', 'additional', 'city', 'zipcode', 'country'];
	
    public function event()
    {
    	return $this->hasMany('App\Event');
    }
}
 