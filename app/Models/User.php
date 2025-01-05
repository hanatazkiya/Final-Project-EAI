<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    // protected $primaryKey = 'username';
    // reminder : perhatikan ini ketika terdapat error

    public function balance(){
        return $this->hasOne(Balance::class, 'username', 'username');
    }

    public function balance_accumulations(){
        return $this->hasMany(BalanceAccumulations::class, 'username', 'username');
    }

    public function reservation_details(){
        return $this->hasMany(Reservation::class, 'username', 'visitor_username');
    }

    public function refund(){
        return $this->hasMany(Refund::class, 'username', 'username');
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
