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
        $arr_code = explode('  ',preg_replace("/\r|\n/", " ", $request->recharge_code));
        for($i = 0; $i < count($arr_code); $i++){
            $recharge_code = new RechargeCode();
            $code = $arr_code[$i];
            $recharge_code->price = $request->price;
            $recharge_code->code = $code;
            $recharge_code->save();
            
        }
    }

    public function deleteAll()
    {
        $recharge_code_all = RechargeCode::where('status', 1 )->get();
        foreach($recharge_code_all as $recharge_code){
            $recharge_code->delete();
        }    
        return response()->json([
            'success' => true
        ]);
    }

}