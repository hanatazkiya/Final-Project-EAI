<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceDetail extends Model
{
    protected $table = 'place_details';
    // protected $primaryKey = 'place_id';
    
    public function place(){
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'username', 'admin_username');
    }
}
