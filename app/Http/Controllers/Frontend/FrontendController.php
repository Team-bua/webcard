<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function getIndex()
    {
        return view('layout_index.index');
    }

    public function signUp()
    {
        return view('layout_index.page.signup');
    }

    public function signIn()
    {
        return view('layout_index.page.signin');
    }
    
    public function getCard()
    {
        return view('layout_index.page.card');
    }
}
