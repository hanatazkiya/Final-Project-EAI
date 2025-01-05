<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $table = 'balances';
    protected $primaryKey = 'username';

    public function user(){
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
