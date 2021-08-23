<?php

namespace App\Repositories\Card;

use App\Models\CardType;
use App\Models\SubCardType;

class SubCardTypeRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

     public function getCardType($request)
     {
         return CardType::all();
     }

     public function getSubCardType($request)
     {
         return SubCardType::all();
     }

     public function getEditSubCardType($id)
    {
        return SubCardType::find($id);       
    }

     public function store($request)
     {
         $sub_card = new SubCardType();
         $sub_card->card_type_id = $request->type_card;
         $sub_card->name = $request->name;
         $sub_card->save();
     }

     public function update($request, $id)
     {
         $sub_card = SubCardType::find($id);
         $sub_card->card_type_id = $request->type_card;
         $sub_card->name = $request->name;
         $sub_card->save();
     }

}