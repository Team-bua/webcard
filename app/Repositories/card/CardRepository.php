<?php

namespace App\Repositories\card;

use App\Models\Card;
use App\Models\CardBill;
use App\Models\CardStore;
use App\Models\CardType;
use App\Models\Discount;
use App\Models\SubCardType;
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

    public function getSubCardType()
    {
        return SubCardType::all();
    }

    public function GetCardStoreToIndex($name, $price)
    {
        return CardStore::where('name', strtolower($name))
            ->where('price', $price)
            ->orderBy('price', 'asc')
            ->get();
    }

    public function EditCardStore($id)
    {
        return CardStore::find($id);
    }

    public function GetCardImageToIndex($name)
    {
        return Card::where('name', $name)
            ->first();
    }

    public function getAllCard()
    {
        return Card::orderBy('created_at', 'desc')->get();
    }

    public function getCardToEdit($id)
    {
        return Card::find($id);
    }

    public function UpdateCardStore($request, $id)
    {
        $card_store = CardStore::find($id);
        $card_store->name = strtolower($request->name_card);
        $card_store->price = $request->price_card;
        $card_store->seri_number = $request->id_card;
        $card_store->code = $request->code_card;

        $card_store->save();
    }


    public function BuyCard($request)
    {
        $card = Card::find($request->card_id_info);
        $card_info = [];
        $discount_code_in_bill = '';
        $discount_info_in_bill = '0';
        if (isset(Auth::user()->id)) {
            if (in_array($request->subject, json_decode($card->price)) == true && in_array($request->discount_num, json_decode($card->discount)) == true) {
                if ($request->discount_code != null) {
                    $discount_info = Discount::where('code', $request->discount_code)->where('status', '0')->first();
                    if ($discount_info != null) {
                        $discount_code_in_bill = $request->discount_code;
                        $user = User::find(Auth::user()->id);
                        if ($discount_info->discount_type == 'Cố định') {
                            $user->check_discount_code = 5;
                            $user->save();

                            $discount_info_in_bill = number_format($discount_info->price) . ' VNĐ';
                            $dc = $request->subject * $request->discount_num / 100;
                            $dc_code = $discount_info->price;
                            if ($dc < $dc_code) {
                                $discount = $request->subject - $dc_code;
                            } else {
                                $discount = $request->subject - $dc;
                            }
                            $discount_info->status = 1;
                            $discount_info->save();
                        } else if ($discount_info->discount_type == 'Phần trăm') {
                            $user->check_discount_code = 5;
                            $user->save();

                            $discount_info_in_bill = $discount_info->price . ' %';
                            $dc = $request->subject * $request->discount_num / 100;
                            $dc_code = $request->subject * $discount_info->price / 100;
                            if ($dc < $dc_code) {
                                $discount = $request->subject - $dc_code;
                            } else {
                                $discount = $request->subject - $dc;
                            }
                            $discount_info->status = 1;
                            $discount_info->save();
                        }
                    } else {
                        $user = User::find(Auth::user()->id);
                        if ($user->check_discount_code != 1) {
                            $user->check_discount_code -= 1;
                            $user->save();
                            return redirect()->back()->with('warning', 'Sai mã khuyến mãi. Bạn chỉ còn lại ' . $user->check_discount_code . ' lần nhập sai');
                        } else {
                            $user->check_discount_code -= 1;
                            $user->banned_status = 1;
                            $user->save();
                            Auth::logout();
                            return redirect()->route('index')->with('message', '4');
                        }
                    }
                } else {
                    $discount_info_in_bill = $request->discount_num . ' %';
                    $discount = $request->subject - ($request->subject * $request->discount_num / 100);
                }
                if (Auth::user()->point - ($discount * $request->quantity1) < 0) {
                    return redirect()->back()->with('message', '5');
                } else {
                    $card_codes = CardStore::where('name', strtolower($card->name))
                        ->where('price', $request->subject)
                        ->where('status', 0)
                        ->limit($request->quantity1)
                        ->get();
                    if ($request->quantity1 > count($card_codes->all())) {

                        $user = User::find(Auth::user()->id);
                        $user->point = $user->point - $discount * $request->quantity1;
                        $user->save();

                        $card_info = ["Đang xử lý"];
                        $card_codes_for_user = new CardBill();
                        $card_codes_for_user->user_id = Auth::user()->id;
                        $card_codes_for_user->card_id = $request->card_id_info;
                        $card_codes_for_user->order_id = '00' . rand(100000, 999999);
                        $card_codes_for_user->card_type = $card->name;
                        $card_codes_for_user->discount_code = $discount_code_in_bill;
                        $card_codes_for_user->discount_info = $discount_info_in_bill;
                        $card_codes_for_user->card_price = $request->subject;
                        $card_codes_for_user->card_total = $request->quantity1;
                        $card_codes_for_user->card_info = json_encode($card_info);
                        $card_codes_for_user->price_total = $discount * $request->quantity1;
                        $card_codes_for_user->save();
                        return redirect()->route('orderhistory')->with('message', '6');
                    } else {
                        foreach ($card_codes as $card_code) {
                            $card_info[] = $card_code->name . '|' . $card_code->price . '|' . $card_code->seri_number . '|' . $card_code->code;
                            $card_delete = CardStore::find($card_code->id);
                            $card_delete->status = 1;
                            $card_delete->save();
                        }
                        $user = User::find(Auth::user()->id);
                        $user->point = $user->point - $discount * $request->quantity1;
                        $user->save();

                        $card_codes_for_user = new CardBill();
                        $card_codes_for_user->user_id = Auth::user()->id;
                        $card_codes_for_user->card_id = $request->card_id_info;
                        $card_codes_for_user->order_id = '00' . rand(100000, 999999);
                        $card_codes_for_user->card_type = $card->name;
                        $card_codes_for_user->discount_code = $discount_code_in_bill;
                        $card_codes_for_user->discount_info = $discount_info_in_bill;
                        $card_codes_for_user->card_price = $request->subject;
                        $card_codes_for_user->card_total = $request->quantity1;
                        $card_codes_for_user->card_info = json_encode($card_info);
                        $card_codes_for_user->price_total = $discount * $request->quantity1;
                        $card_codes_for_user->status = 1;
                        $card_codes_for_user->save();

                        return redirect()->route('orderhistory')->with('message', '1');
                    }
                }
            } else {
                return redirect()->back()->with('message', '7');
            }
        } else {
            return redirect()->route('signin');
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
        $card->sub_card_type_id = $request->sub_card_type;
        $card->discount = json_encode($request->discount);
        $card->price = json_encode($request->price);

        $card->save();
    }

    public function storeCardCode($request)
    {
        $card_info = new CardStore();
        $test = explode('  ', preg_replace("/\r|\n/", " ", $request->code));

        for ($i = 0; $i < count($test); $i++) {
            $code = explode('|', $test[$i]);
            $card_info = new CardStore();
            if ($request->card_type_form == 'Card') {
                $card_info->card_type = $request->card_type_form;
                $card_info->name = strtolower($request->card_name_form);
                $card_info->price = str_replace(',', '', $request->card_price_form);
                $card_info->seri_number = $code[0];
                $card_info->code = $code[1];
                $card_info->save();
            } else if ($request->card_type_form == 'Voucher') {
                $card_info->card_type = $request->card_type_form;
                $card_info->name = strtolower($request->card_name_form);
                $card_info->price = str_replace(',', '', $request->card_price_form);
                $card_info->code = $code[0];
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
        $card->sub_card_type_id = $request->sub_card_type;
        $card->price = json_encode($request->price);
        $card->discount = json_encode($request->discount);

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
        foreach ($cards as $card) {
            $card_code = CardStore::where('name', strtolower($card->name))
                ->count();
            $arr[$card->name] = $card_code;
        }
        $card = Card::find($request->id);
        if ($arr[$card->name] == 0) {
            if (file_exists($card->image)) {
                unlink(public_path($card->image));
            }
            $card->delete();
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function deleteCardCode($request)
    {
        $card_store_delete = CardStore::find($request->id);
        $card_store_delete->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
