<?php

namespace App\Repositories\card;

use App\Models\Card;
use App\Models\CardType;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CardRepository
{
    public function getCardTypeForCard(){
        return CardType::all();
    }

    public function getAllCard(){
        return Card::all();
    }

    public function getCardToEdit($id){
        return Card::find($id);
    }

    public function store($request)
    {
        $card = new Card();
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->avatar;
        if (isset($img)) {
            $img_name = 'upload/card/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/card/img/' . $date);
            $img->move($destinationPath, $img_name);

            $card->image = $img_name;
        }

        $card->name = $request->name_card;
        $card->card_type = $request->type_card;
        $card->price = json_encode($request->price);

        $card->save();
    }

    public function update($request, $id)
    {
        $card = Card::find($id);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->avatar;
        if (isset($img)) {
            $img_name = 'upload/card/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/card/img/' . $date);
            $img->move($destinationPath, $img_name);

            $card->image = $img_name;
        }

        $card->name = $request->name_card;
        $card->card_type = $request->type_card;
        $card->price = json_encode($request->price);

        $card->save();
    }

    public function AjaxDeletePrice($request, $id)
    {
          $card = Card::find($id);
          $card->price = json_encode($request->price);
          $card->save();

          return response()->json([
               'error' => false,
               'package'  => $card,
           ], 200);
    }
}
