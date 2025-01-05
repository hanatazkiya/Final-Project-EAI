<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'username';
    protected $table = 'admins';

    public function place_detail(){
        return $this->hasMany(PlaceDetail::class, 'admin_username', 'username');
    }
    
}
