<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [ 'users_id', 'events_id', 'delivery_address', 'ticket_quantity',
    ];
}
