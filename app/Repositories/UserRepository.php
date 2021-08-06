<?php

namespace App\Repositories;

use App\Models\AdminTransaction;
use App\Models\Bill;
use App\Models\PointPurchase;
use App\Models\User;
use App\Models\UserBill;
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

    public function getProfile($id)
    {
        return User::find($id);       
    }

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

    public function rechargeMoney($request, $id)
    {
        $point_purchase = new UserBill();
        $point_purchase->user_id = $id;
        $point_purchase->point_purchase = $request->money;
        $point_purchase->description = 'Nạp ' . $request->money . ' VNĐ ';
        $point_purchase->order_id = $request->money . '' . Str::random(4);
        $point_purchase->method = 'Nạp tiền';
        $point_purchase->save();
    }

    public static function utf8convert($str) {
        
        if(!$str) return false;
        
        $utf8 = array(
            
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            
            'd'=>'đ|Đ',
            
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            
        );
        
        foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
        
        return $str;
        
    }

}
