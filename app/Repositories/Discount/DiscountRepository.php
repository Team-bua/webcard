<?php

namespace App\Repositories\Discount;

use App\Models\Discount;
use App\Models\DiscountType;
use Illuminate\Support\Str;

class DiscountRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

     public function getDiscountType()
     {
        return DiscountType::all();
     }

     public function getDiscount()
     {
        return Discount::orderBy('created_at', 'desc')->get();
     }

     public function createDiscount($request)
     {
        $discount = new Discount();
        $discount->discount_type = $request->discount_type;
        $discount->code = $request->discount_code;
        $discount->price = $request->discount;
        $discount->save();
     }

     public function updateDiscount($request, $id)
     {
        $discount = Discount::find($id);
        $discount->discount_type = $request->discount_type;
        $discount->code = $request->discount_edit__code;
        $discount->price = $request->discount_edit;
        $discount->save();
     }

}