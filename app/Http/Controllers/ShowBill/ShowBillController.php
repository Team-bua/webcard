<?php

namespace App\Http\Controllers\ShowBill;

use App\Http\Controllers\Controller;
use App\Models\CardBill;
use App\Models\Index;
use App\Models\User;
use App\Models\UserBill;
use Illuminate\Http\Request;

class ShowBillController extends Controller
{
    public function showCardBill(Request $request, $id)
    {
        $index = Index::find(1);
        $user_id = CardBill::where('id', $id)->value('user_id');
        $user_info = User::where('id', $user_id)->first();
        $card_bill = CardBill::find($id);

        return view('user.show_card_bill', compact('index', 'user_info', 'card_bill'));
    }

    public function showRechargeBill(Request $request, $id)
    {
        $index = Index::find(1);
        $user_id = UserBill::where('id', $id)->value('user_id');
        $user_info = User::where('id', $user_id)->first();
        $recharge_bill = UserBill::find($id);

        return view('user.show_recharge_bill', compact('index', 'user_info', 'recharge_bill'));
    }
}
