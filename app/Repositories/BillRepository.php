<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Models\PointPurchase;
use App\Models\User;
use App\Models\Vip;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BillRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getIndex($request)
    {   
        $date = date('Y-m-d');
        $all_bill = Bill::when(($request->date == null), function ($query) use ($date){
                        $query->where(function ($q) use ($date){
                            $q->whereDate('created_at', '=', $date);
                        });
                    })
                    ->when(($request->date != null), function ($query) use ($request){
                        $query->where(function ($q) use ($request) {
                            $q->whereDate('created_at', date('Y-m-d', strtotime(str_replace('/', '-', $request->date))));
                        });
                    })
                    ->when(($request->all() == null), function ($query) use ($request) {
                        $query->where(function ($q) use ($request){
                            $q->where('status', '0');
                        });
                    })
                    ->when(($request->all() != null), function ($query) use ($request){
                        $query->where(function ($q) use ($request){
                            $q->where('status', $request->status);
                        });
                    })
                    ->when(($request->name != null), function ($query) use ($request){
                        $query->where(function ($q) use ($request){
                            $q->where('order_id', 'LIKE', '%' . $request->name . '%');
                        });
                    })       
                    ->get();
        return $all_bill;
    }

    public function getBillNew()
    {
        return Bill::where('status',0)->orderBy('created_at', 'desc')->get();
    }

    public function billUnpaidPoint()
    {
        return PointPurchase::where('status',0)
                            ->orderBy('created_at', 'desc')
                            ->get();
    }

    public function getIndexPoint($request)
    {   
        $date = date('Y-m-d');
        $point_purchase = PointPurchase::when(($request->date == null), function ($query) use ($date){
                        $query->where(function ($q) use ($date){
                            $q->whereDate('created_at', '=', $date);
                        });
                    })
                    ->when(($request->date != null), function ($query) use ($request){
                        $query->where(function ($q) use ($request) {
                            $q->whereDate('created_at', date('Y-m-d', strtotime(str_replace('/', '-', $request->date))));
                        });
                    })
                    ->when(($request->all() == null), function ($query) use ($request) {
                        $query->where(function ($q) use ($request){
                            $q->where('status', '0');
                        });
                    })
                    ->when(($request->all() != null), function ($query) use ($request){
                        $query->where(function ($q) use ($request){
                            $q->where('status', $request->status);
                        });
                    })
                    ->when(($request->name != null), function ($query) use ($request){
                        $query->where(function ($q) use ($request){
                            $q->where('order_id', 'LIKE', '%' . $request->name . '%');
                        });
                    })       
                    ->get();
        return $point_purchase;
    }

    public function getAdminInfo()
    {     
        $admin_info = User::where('role', '1')->first();
        
        return $admin_info;
    }

    public function getUserInfo($id)
    {     
        $user_id = Bill::where('id', $id)->value('user_id');
        $user_info = User::where('id', $user_id)->first();
        return $user_info;
    }

    public function getBill($id)
    {        
        $bill_info = Bill::Find($id);
        return $bill_info;
    }

    public function BillTransaction($id, $status, $point, $user)
    {
        $bill_perchase = Bill::find($id);
        $user = User::find($user);
        if($status == '1')
        {
            $bill_perchase->status = $status;
            $bill_perchase->save();
        }
        elseif($status == '2'){
            $bill_perchase->status = '2';       
            $bill_perchase->save();
            $user->point = $user->point + $point;
            $user->save();
        }
    }

    public function PointTransaction($id, $status, $point, $user, $method)
    {
        $point_purchase = PointPurchase::find($id);
        $user_purchase = User::find($user);
        $user_vip = $user_purchase->vip;
        $vip = Vip::find(1);
        if($method == 'Purchase point'){
            if($status == '1' && $user_vip == 1)
            {
                $point_purchase->status = $status;              
                $point_purchase->save();
                $user_purchase->point = $user_purchase->point + ($point + ($point * $vip->discount / 100));
                $user_purchase->save();
            }
            elseif($status == '1')
            {
                $point_purchase->status = $status;              
                $point_purchase->save();
                $user_purchase->point = $user_purchase->point + $point;
                $user_purchase->save();
            }
            elseif($status == '2'){
                $point_purchase->status = '2';
                $point_purchase->save();
                $user_purchase->point = $user_purchase->point - $point;
                $user_purchase->save();
            }
        }
        else if ($method == 'Withdraw point'){
            if($status == '1')
            {
                $point_purchase->status = $status;              
                $point_purchase->save();
                $user_purchase->point = $user_purchase->point - $point;
                $user_purchase->save();
            }
            elseif($status == '2'){
                $point_purchase->status = '2';
                $point_purchase->save();
                $user_purchase->point = $user_purchase->point + $point;
                $user_purchase->save();
            }
        }
        
    }

}