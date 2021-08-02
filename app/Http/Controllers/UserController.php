<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getProfile()
    {
        return view('user.profile');
    }

    public function getOrderHistory()
    {
        return view('user.orderhistory');
    }
}
