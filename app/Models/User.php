<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','phone','provider',
        'email','provider_id','avatar',
        'avatar_original','banned_status','password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin_transaction()
    {
        return $this->belongsTo(AdminTransaction::class,'user_id', 'id');
    }

    public function user_bill()
    {
        return $this->belongsTo(UserBill::class,'user_id', 'id');
    }

    public function user_card_bill()
    {
        return $this->belongsTo(CardBill::class,'user_id', 'id');
    }
}
