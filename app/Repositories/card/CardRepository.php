<?php

namespace App\Repositories\card;

use App\Models\Card;
use App\Models\CardBill;
use App\Models\CardStore;
use App\Models\CardType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CardRepository
{
    public function getCardTypeForCard()
    {
        return CardType::all();
    }

    public function getAllCard(){
        return Card::orderBy('created_at', 'desc')->get();
    }

    public function getCardToEdit($id)
    {
        return Card::find($id);
    }

    public function BuyCard($request)
    {
        $card = Card::find($request->card_id_info);
        $card_info = [];
        if(isset(Auth::user()->id)){
            if(in_array($request->subject, json_decode($card->price)) == true){
                $discount = $request->subject - ($request->subject * $card->discount / 100);
                $card_codes = CardStore::where('name', strtolower($card->name))
                                        ->where('price', $request->subject)
                                        ->limit($request->quantity1)
                                        ->get();
                if($request->quantity1 > count($card_codes->all())){
                    return redirect()->back()->with('message', '6');
                }else{
                    foreach($card_codes as $card_code){
                        $card_info[] = $card_code->name.'|'.$card_code->price.'|'.$card_code->seri_number.'|'.$card_code->code;
                        $card_delete = CardStore::find($card_code->id);
                        $card_delete->delete();
                    }
                    $user = User::find(Auth::user()->id);
                    $user->point = $user->point - $request->subject * $request->quantity1;
                    $user->save();
        
                    $card_codes_for_user = new CardBill();
                    $card_codes_for_user->user_id = Auth::user()->id;
                    $card_codes_for_user->card_id = $request->card_id_info;
                    $card_codes_for_user->order_id = Str::random(8);
                    $card_codes_for_user->card_type = $card->name;
                    $card_codes_for_user->card_price = $request->subject;
                    $card_codes_for_user->card_total = $request->quantity1;
                    $card_codes_for_user->card_info = json_encode($card_info);
                    $card_codes_for_user->price_total = $discount * $request->quantity1;
                    $card_codes_for_user->status = 1;
                    $card_codes_for_user->save();
    
                    return redirect()->route('orderhistory')->with('message', '1');
                }           
            }
        }else{
            return redirect(url('sign-in'));
        }           
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
        $card->discount = $request->discount;

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

    public function destroy($request, $cards)
    {
        foreach($cards as $card) {
            $card_code = CardStore::where('name', strtolower($card->name))
                                ->count();
            $arr[$card->name] = $card_code;
        }
          $card = Card::find($request->id);
          if($arr[$card->name] == 0){
            if(file_exists($card->image)){
                unlink(public_path($card->image));
            } 
            $card->delete();  
            return response()->json([
                'success' => true
            ]);
          }else{
            return response()->json([
                'success' => false
            ]);
          }       
    }
}
