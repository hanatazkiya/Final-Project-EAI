<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceUniqueness extends Model
{
    protected $table = 'place_uniquenesses';
    protected $primaryKey = 'id';
    
    public function place(){
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}
