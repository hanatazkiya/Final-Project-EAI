<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refunds';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    
    public function users(){
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function reservations(){
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }
}
