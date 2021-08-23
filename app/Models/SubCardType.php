<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCardType extends Model
{
    use HasFactory;
    
    protected $table = 'sub_card_type';

    public function sub_card_type()
    {
        return $this->hasMany(Card::class,'sub_card_type_id', 'id');
    }
}
