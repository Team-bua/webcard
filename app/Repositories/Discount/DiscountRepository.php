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

   public function getUsed()
    {
        return Discount::where('status', 1)->count();
    }

    public function getNotUse()
    {
        return Discount::where('status', 0)->count();
    }

   public function createDiscount($request)
   {
      $discount_code = explode('  ', preg_replace("/\r|\n/", " ", $request->discount_code));
      for ($i = 0; $i < count($discount_code); $i++) {
         $code = $discount_code[$i];
         $discount = new Discount();
         if ($request->discount_type == 'Cố định') {
            $discount->discount_type = $request->discount_type;
            $discount->code = $code;
            $discount->price = $request->discount;
            $discount->save();
         } else if ($request->discount_type == 'Phần trăm') {
            $discount->discount_type = $request->discount_type;
            $discount->code = $code;
            $discount->price = $request->discount;
            $discount->save();
         }
      }
   }

   public function deleteAll()
   {
       $discount = Discount::where('status', 1 )->get();
       foreach($discount as $discount_code){
           $discount_code->delete();
       }    
       return response()->json([
           'success' => true
       ]);
   }
}
