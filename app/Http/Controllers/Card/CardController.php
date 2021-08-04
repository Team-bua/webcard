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
        $cards = $this->repository->getAllCard();
        return view('layout_admin.cards.index', compact('cards'));
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
