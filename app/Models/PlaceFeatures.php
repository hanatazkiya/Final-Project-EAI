<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceFeatures extends Model
{
    protected $table = 'places_features';
    protected $primaryKey = 'id';
    
    public function place(){
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
    
}
