<?php

namespace App\Repositories;

use App\Models\AdminTransaction;
use App\Models\Bill;
use App\Models\PointPurchase;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function updateInfo($request, $id)
    {
        $user = User::find($id);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->avatar;
        if (isset($img)) {
            if ($user->avatar) {
                unlink(public_path($user->avatar));
            }

            $img_name = 'upload/user/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/user/img/' . $date);
            $img->move($destinationPath, $img_name);

            $user->avatar = $img_name;
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();
    }

    public function changePass($request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->new_password);
        $user->save();
    }

    public function pointPurchase($request, $id, $type)
    {
        $point_purchase = new PointPurchase();

        $point_purchase->user_id = $id;
        $point_purchase->point_purchase = $request->amount_dep;
        $point_purchase->description = 'Purchase ' . $request->amount_dep . ' point, ' . $type;
        $point_purchase->order_id = $request->amount_dep . '' . Str::random(4);
        $point_purchase->method = 'Purchase point';
        $point_purchase->save();
    }

    // public function pointWithdraw($request, $id)
    // {
    //     $point_purchase = new PointPurchase();

    //     $point_purchase->user_id = $id;
    //     $point_purchase->point_purchase = $request->amount;
    //     $point_purchase->description = $request->note;
    //     $point_purchase->order_id = $request->amount . '' . Str::random(4);
    //     $point_purchase->method = 'Withdraw point';
    //     $point_purchase->save();
    // }

    public function getAdminInfo()
    {
        $admin_info = User::where('role', '1')->first();
        return $admin_info;
    }

    public function getAdminTrans()
    {
        $admin_trans = AdminTransaction::where('user_id', '1')->first();
        return $admin_trans;
    }

    public function getUserInfo($id)
    {
        $user_id = PointPurchase::where('id', $id)->value('user_id');
        $user_info = User::where('id', $user_id)->first();
        return $user_info;
    }

    public function getPointPurchase($id)
    {
        $point_purchase = PointPurchase::find($id);
        return $point_purchase;
    }
}
