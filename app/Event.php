<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $table = 'events'; 

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function location()
    {
    	return $this->belongsTo('App\Location');
    }

    public function ticket()
    {
    	return $this->hasMany('App\Ticket', 'event_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
