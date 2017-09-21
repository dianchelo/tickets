<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $table = 'events'; 
    protected $fillable = ['name', 'slug', 'category_id', 'hash', 'description', 'event_date', 'location_id', 'event_colour', 'creator', 'dark_event_colour', 'amount_tickets'];

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
