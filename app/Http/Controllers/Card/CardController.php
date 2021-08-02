<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function AddCard(){
        return view('layout_admin.cards.create');
    }

    public function GetCardToIndex()
    {
        return view('layout_admin.cards.index');
    }
}
