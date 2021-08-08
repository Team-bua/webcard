<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\CardStore;
use App\Repositories\card\CardRepository;
use Illuminate\Http\Request;

class CardController extends Controller
{
    protected $repository;

    public function __construct(CardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function AddCard(){
        $card_types = $this->repository->getCardTypeForCard();
        return view('layout_admin.cards.create', compact('card_types'));
    }

    public function AddCardCode(){
        $card_types = $this->repository->getCardTypeForCard();
        return view('layout_admin.cards.createcode', compact('card_types'));
    }

    public function StoreCardCode(Request $request){
       $this->repository->storeCardCode($request);
       return redirect()->back()->with('information', 'Thêm mã thẻ thành công!');
    }

    public function deletePrice(Request $request, $id)
    {
        return $this->repository->AjaxDeletePrice($request, $id);
    }

    public function EditCard($id){
        $card = $this->repository->getCardToEdit($id);
        $card_types = $this->repository->getCardTypeForCard();
        return view('layout_admin.cards.edit', compact('card_types', 'card'));
    }

    public function GetCardToIndex()
    {
        $arr = [];
        $arr_price = [];
        $cards = $this->repository->getAllCard();
        foreach($cards as $card) {
           $card_code = CardStore::where('name', strtolower($card->name))
                                ->count();
            $arr[$card->name] = $card_code;
            for($i = 0; $i < count(json_decode($card->price)); $i++) {
                $card_price = CardStore::where('price', json_decode($card->price)[$i])
                                        ->where('name', strtolower($card->name))
                                        ->count();
                $arr_price[json_decode($card->price)[$i].'-'.$card->name] = $card_price; 
            }
        }
        return view('layout_admin.cards.index', compact('cards', 'arr', 'arr_price'));
    }

    public function BuyCard(Request $request)
    {
        dd($request->all());
    }

    public function SaveCard(CardRequest $request){
        $this->repository->store($request);
        return redirect()->back()->with('information', 'Thêm thành công');
    }

    public function UpdateCard(Request $request, $id){
        $this->repository->update($request, $id);
        return redirect()->back()->with('information', 'Cập nhật thành công');
    }
}
