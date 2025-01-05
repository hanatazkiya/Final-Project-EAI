<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceAccumulations extends Model
{
    protected $table = 'balance_accumulations';
    protected $primaryKey = 'username';

    public function user(){
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
