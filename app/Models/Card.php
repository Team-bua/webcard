<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Card extends Model
{
    use HasFactory, Notifiable;

    protected $table = "cards";

    protected $fillable = [
        'name',
        'card_type',
        'price',
        'image',
    ];

    public function card_type()
    {
        return $this->belongsTo(CardType::class,'card_type', 'id');
    }

    public function card_bill()
    {
        return $this->belongsTo(CardBill::class,'card_id', 'id');
    }
}
