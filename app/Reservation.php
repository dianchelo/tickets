<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected  $table = 'ticket_reservations';
    protected  $fillable = ['status'];

    public function ticket()
   	{
   		return $this->hasOne('App\Ticket', 'ticket_id', 'id');

   	}
}
