<?php

namespace App\Repositories\Recharge;

use App\Models\RechargeCode;

class RechargeCodeRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function viewRechargeCode()
    {
        return RechargeCode::orderBy('created_at', 'desc')->get();
    }

    public function createRechargeCode($request)
    {
        $recharge_code = new RechargeCode();
        $recharge_code->code = $request->recharge_code;
        $recharge_code->price = $request->price;
        $recharge_code->save();
    }

    public function updateRechargeCode($request, $id)
    {
        $recharge_code = RechargeCode::find($id);
        $recharge_code->code = $request->recharge_edit_code;
        $recharge_code->price = $request->price_edit;
        $recharge_code->save();
    }

}