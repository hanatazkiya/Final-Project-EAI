<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class RefundMessage extends Model
{
    protected $table = 'refund_messages';
    // protected $primaryKey = 'id';
    
    public function reservation(){
        return $this->belongsTo(Reservation::class, 'reservation_invoice', 'reservation_invoice');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_username', 'username');
    }
}
