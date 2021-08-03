<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
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
        return view('layout_admin.cards.create');
    }

    public function GetCardToIndex()
    {
        return view('layout_admin.cards.index');
    }

    public function SaveCard(Request $request){
        $this->repository->store($request);
        return redirect()->back()->with('information', 'Thêm thành công');
    }
}
