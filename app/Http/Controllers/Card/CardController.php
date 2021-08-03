<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
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

    public function EditCard(){
        $card_types = $this->repository->getCardTypeForCard();
        return view('layout_admin.cards.create', compact('card_types'));
    }

    public function GetCardToIndex()
    {
        $cards = $this->repository->getAllCard();
        return view('layout_admin.cards.index', compact('cards'));
    }

    public function SaveCard(CardRequest $request){
        $this->repository->store($request);
        return redirect()->back()->with('information', 'Thêm thành công');
    }
}
