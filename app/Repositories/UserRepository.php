<?php

namespace App\Repositories;

use App\Models\CardBill;
use App\Models\RechargeCode;
use App\Models\User;
use App\Models\UserBill;
use Carbon\Carbon;
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

    public function rechargeMoneyCode($request)
    {
        $user = User::find(Auth::user()->id);
        $recharge_code = RechargeCode::all();
        foreach($recharge_code as $recharge){
            $arr[] = $recharge->code;
            $money[$recharge->code] = $recharge->price;
            $status[$recharge->code] = $recharge->status;
        }

        if(in_array($request->money, $arr) == true){
            if($status[$request->money] == 0){
                $recharge_code_status = RechargeCode::where('code', $request->money)->first();
                $recharge_code_status->status = 1;
                $recharge_code_status->save();

                $user->point = $user->point + $money[$request->money];
                $user->check_recharge_code = 5;
                $user->save();
    
                $user_bill = new UserBill();
                $user_bill->user_id = $user->id;
                $user_bill->order_id = $money[$request->money] . '' . Str::random(4);
                $user_bill->point_purchase = $money[$request->money];
                $user_bill->description = 'N???p b???ng m??'.' '.$request->money;
                $user_bill->method = "N???p ti???n";
                $user_bill->status = 1;
                $user_bill->save();
                return redirect()->route('rechargehistory');
            }else{
                return redirect()->back()->with('information', 'M?? n???p ???? h???t h???n');
            }
           
        }else{
            if($user->check_recharge_code != 1 ){
                $user->check_recharge_code -= 1;
                $user->save();
                return redirect()->back()->with('information', 'Sai m?? n???p. B???n ch??? c??n l???i ' .$user->check_recharge_code. ' l???n nh???p sai');
            }else{
                $user->check_recharge_code -= 1;
                $user->banned_status = 1;
                $user->reason = 'Nh???p sai m?? n???p ti???n';
                $user->save();
                Auth::logout();                
                return redirect()->route('index')->with('message', '4');
            }
        }
    }

    public function getCardBill($request)
    {          
        $date = date('Y-m-d');
        $all_bill = CardBill::where('user_id', Auth::user()->id)
                    ->when(($request->date == null), function ($query) use ($date){
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
                    ->orderBy('created_at', 'desc')     
                    ->get();
        return $all_bill;
    }
    
    public function getRechargeBill($request)
    {          
        $date = date('Y-m-d');
        $all_bill = UserBill::where('user_id', Auth::user()->id)
                    ->when(($request->date == null), function ($query) use ($date){
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

    public static function utf8convert($str) {
        
        if(!$str) return false;
        
        $utf8 = array(
            
            'a'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???|??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
            
            'd'=>'??|??',
            
            'e'=>'??|??|???|???|???|??|???|???|???|???|???|??|??|???|???|???|??|???|???|???|???|???',
            
            'i'=>'??|??|???|??|???|??|??|???|??|???',
            
            'o'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???|??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
            
            'u'=>'??|??|???|??|???|??|???|???|???|???|???|??|??|???|??|???|??|???|???|???|???|???',
            
            'y'=>'??|???|???|???|???|??|???|???|???|???',
            
        );
        
        foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
        
        return $str;
        
    }

}
