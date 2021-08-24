<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class CardType extends Model

{

    use HasFactory;



    protected $table = "card_types";



    protected $fillable = [
        'name',
    ];



    public function card_type()
    {

        return $this->belongsTo(Card::class,'card_type', 'id');

    }

    public function card_type_bill()
    {

        return $this->belongsTo(CardBill::class,'card_type', 'id');

    }

    public function FunctionName()
    {
        return $this->belongsTo(CardBill::class,'card_type', 'id');
    }


}

