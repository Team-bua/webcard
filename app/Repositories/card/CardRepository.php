<?php

namespace App\Repositories\card;

use App\Models\Card;
use App\Models\CardStore;
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

    public function storeCardCode($request)
    {    
        $card_info = new CardStore();
        $test = explode('  ',preg_replace("/\r|\n/", " ", $request->code));
        for($i = 0; $i < count($test); $i++){
            $code = explode('|', $test[$i]);
            $card_info = new CardStore();
            if($request->type_card == 'Card'){
                $card_info->card_type = $request->type_card;
                $card_info->name = strtolower($code[0]);
                $card_info->price = $code[1];
                $card_info->seri_number = $code[2];
                $card_info->code = $code[3];
                $card_info->save();
            }else if ($request->type_card == 'Voucher'){
                $card_info->card_type = $request->type_card;
                $card_info->name = strtolower($code[0]);
                $card_info->price = $code[1];
                $card_info->code = $code[2];
                $card_info->save();
            }
            
        }
    }

    public function update($request, $id)
    {
        $card = Card::find($id);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->avatar;
        if (isset($img)) {
            unlink(public_path($card->image));
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
