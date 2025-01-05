<?php

namespace App\Models;

use App\Models\PlaceFeatures;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = 'places';
    protected $primaryKey = 'id';

    public function generate_slug($name){
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        return $slug;
    }

    public function place_details(){
        return $this->hasOne(PlaceDetail::class, 'place_id', 'id');
    }

    public function reservation_details(){
        return $this->hasMany(ReservationDetail::class, 'place_id', 'id');
    }

    public function place_images(){
        return $this->hasMany(PlaceImages::class, 'place_id', 'id');
    }
    
    public function place_features(){
        return $this->hasMany(PlaceFeatures::class, 'place_id', 'id');
    }

    public function places_uniquenesses(){
        return $this->hasMany(PlaceUniqueness::class, 'place_id', 'id');
    }
}
