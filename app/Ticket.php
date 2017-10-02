<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	protected $table = 'tickets';
  protected $fillable = ['event_id', 'user_id', 'price', 'hash'];
	
    public function event()
    {
    	return $this->belongsTo('App\Event', 'event_id');
    }

    public function user()
   	{
   		return $this->hasOne('App\User', 'id', 'user_id');
   	}

    public function reservation()
    {
      return $this->BelongsTo('App\Reservation', 'id', 'ticket_id');
    }
}
