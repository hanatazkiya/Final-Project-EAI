<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    protected $table = 'reservation_details';
    protected $primaryKey = 'reservation_id';

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }

    public function refund()
    {
        return $this->hasOne(Refund::class, 'reservation_id', 'reservation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'visitor_username', 'username');
    }

    public function place(){
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}
