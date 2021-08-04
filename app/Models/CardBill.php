<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardBill extends Model
{
    use HasFactory;

    protected $table = "card_bills";

    public function user_card_bill()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function card_type_bill()
    {
        return $this->belongsTo(CardType::class,'card_type', 'id');
    }

    public function card_bill()
    {
        return $this->belongsTo(Card::class,'card_id', 'id');
    }
}
