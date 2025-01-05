<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceImages extends Model
{
    protected $table = 'places_images';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    
    public function place(){
        return $this->belongsTo(Place::class, 'id', 'place_id');
    }
}
