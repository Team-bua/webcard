<?php

namespace App\Repositories;

use App\Models\CardBill;
use App\Models\UserBill;

class BillRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCardBill($request)
    {          
        $date = date('Y-m-d');
        $all_bill = CardBill::when(($request->date == null), function ($query) use ($date){
                        $query->where(function ($q) use ($date){
                            $q->whereDate('created_at', '=', $date);
                        });
                    })
                    ->when(($request->date != null && isset(explode(' to ',$request->date)[1]) == true), function ($query) use ($request){
                        $query->where(function ($q) use ($request) {
                            $q->whereRaw('DATE(card_bills.created_at) BETWEEN "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' to ', $request->date)[0]))).'" 
                            AND "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' to ', $request->date)[1]))).'"');
                        });
                    })
                    ->when(($request->date != null && isset(explode(' to ',$request->date)[1]) == false), function ($query) use ($request){
                        $query->whereDate('created_at', '=', date('Y-m-d', strtotime(str_replace('/', '-',$request->date))));
                    })
                    ->when(($request->name != null), function ($query) use ($request){
                        $query->where(function ($q) use ($request){
                            $q->where('order_id', 'LIKE', '%' . $request->name . '%');
                        });
                    }) 
                    ->when(($request->status == 0 && isset(explode(' to ',$request->date)[1]) == true), function ($query) use ($request){
                        $query->where(function ($q) use ($request){
                            $q->whereRaw('DATE(card_bills.created_at) BETWEEN "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' to ', $request->date)[0]))).'" 
                            AND "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' to ', $request->date)[1]))).'"');
                        });
                    })
                    ->when(($request->status == 2), function ($query) use ($request){
                        $query->where(function ($q) use ($request){
                            $q->where('status', 1);
                        });
                    }) 
                    ->when(($request->status == 1), function ($query) use ($request){
                        $query->where(function ($q) use ($request){
                            $q->where('status', 0);
                        });
                    }) 
                    ->orderBy('created_at', 'desc')      
                    ->get();
        return $all_bill;
    }

    public function getRechargeBill($request)
    {          
        $date = date('Y-m-d');
        $all_bill = UserBill::when(($request->date == null), function ($query) use ($date){
                        $query->where(function ($q) use ($date){
                            $q->whereDate('created_at', '=', $date);
                        });
                    })
                    ->when(($request->date != null && isset(explode(' to ',$request->date)[1]) == true), function ($query) use ($request){
                        $query->where(function ($q) use ($request) {
                            $q->whereRaw('DATE(user_point_bills.created_at) BETWEEN "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' to ', $request->date)[0]))).'" 
                            AND "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' to ', $request->date)[1]))).'"');
                        });
                    })
                    ->when(($request->date != null && isset(explode(' to ',$request->date)[1]) == false), function ($query) use ($request){
                        $query->whereDate('created_at', '=', date('Y-m-d', strtotime(str_replace('/', '-',$request->date))));
                    })
                    ->when(($request->name != null), function ($query) use ($request){
                        $query->where(function ($q) use ($request){
                            $q->where('order_id', 'LIKE', '%' . $request->name . '%');
                        });
                    })     
                    ->orderBy('created_at', 'desc')  
                    ->get();
        return $all_bill;
    }
    
    public function updateStatusAll($request)
    {   
        $card_bill = CardBill::where('status', 0)
                            ->when(($request->date_check != null && isset(explode(' to ',$request->date_check)[1]) == true), function ($query) use ($request){
                                $query->where(function ($q) use ($request) {
                                    $q->whereRaw('DATE(card_bills.created_at) BETWEEN "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' to ', $request->date_check)[0]))).'" 
                                    AND "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' to ', $request->date_check)[1]))).'"');
                                });
                            })
                            ->when(($request->date_check != null && isset(explode(' to ',$request->date_check)[1]) == false), function ($query) use ($request){
                                $query->whereDate('card_bills.created_at', '=', date('Y-m-d', strtotime(str_replace('/', '-',$request->date_check))));
                            })
                            ->get();
        foreach($card_bill as $bill){
            $bill->status = 1;
            $bill->save();
        }
        return redirect()->back()->with('information', 'Duyệt tất cả đơn hàng thành công');
    }
}