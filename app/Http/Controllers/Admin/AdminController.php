<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankRequest;
use App\Http\Requests\DiscountRequest;
use App\Models\AdminTransaction;
use App\Models\Card;
use App\Models\CardBill;
use App\Models\CardStore;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserBill;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function getAdmin(Request $request)
    {
        $date =  date('Y-m-d');
        if($request->date == null)
        {
            $first_day = date('Y-m-01', strtotime($date));
            $last_day = date('Y-m-t', strtotime($date));
        }
        else if(isset(explode(' to ', $request->date)[1]) == false)
        {
            $first_day = date('Y-m-d', strtotime(str_replace('/', '-', $request->date)));
            $last_day = date('Y-m-d', strtotime(str_replace('/', '-', $request->date)));
        }
        else
        {
            $first_day = date('Y-m-d', strtotime(str_replace('/', '-', explode(' to ', $request->date)[0])));
            $last_day = date('Y-m-d', strtotime(str_replace('/', '-', explode(' to ', $request->date)[1])));
        }

        $period = CarbonPeriod::create($first_day, $last_day);
        foreach($period as $date)
        {
            $dates[] = $date->format('Y-m-d');
        }
        $card = CardStore::count();
        $user = User::where('role',0)->count();
        $card_bills = CardBill::where('status',1)->count();
        $user_bills = UserBill::where('status',1)->count();
        $revenueMonthDone = UserBill::whereRaw('month(user_point_bills.created_at) BETWEEN "'.date('m', strtotime($first_day)).'" AND "'.date('m', strtotime($last_day)).'"')
            ->select(DB::raw('sum(user_point_bills.point_purchase) as totalMoney'), DB::raw('DATE(user_point_bills.created_at) day'))
            ->where('user_point_bills.status', 1)
            ->groupBy('day')
            ->get()
            ->toArray();
        $revenueMonthPending = UserBill::whereRaw('month(user_point_bills.created_at) BETWEEN "'.date('m', strtotime($first_day)).'" AND "'.date('m', strtotime($last_day)).'"')
            ->select(DB::raw('sum(user_point_bills.point_purchase) as totalMoney'), DB::raw('DATE(user_point_bills.created_at) day'))
            ->where('user_point_bills.status', 1)
            ->groupBy('day')
            ->get()
            ->toArray();

        $arrRevenueMonthDone = [];
        $arrRevenueMonthPending = [];
        foreach ($dates as $day) {
            $total = 0;
            foreach ($revenueMonthDone as $key => $revenue) {

                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }


            $arrRevenueMonthDone[] = (int) $total;
            $total = 0;
            foreach ($revenueMonthPending as $key => $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueMonthPending[] = (int) $total;
        }
        $totalRevenueFromToDate = array_sum($arrRevenueMonthDone);
        $viewData = [
            'card'                      => $card,
            'card_bills'                => $card_bills,
            'user'                      => $user,
            'user_bills'                => $user_bills,
            'first_day'                 => $first_day,
            'last_day'                  => $last_day,
            'dates'                     => $dates,
            'arrRevenueMonthDone'       => $arrRevenueMonthDone,
            'arrRevenueMonthPending'    => json_encode($arrRevenueMonthPending),
            'totalRevenueFromToDate'    => $totalRevenueFromToDate
        ];
        // dd(date('m', strtotime($first_day)));
        return view('layout_admin.index', $viewData);
    }

    public function getAllUsers()
    {
        $users = User::where('role',0)
                    ->orderBy('created_at','desc')->get();
        return view('layout_admin.all_user.index', compact('users'));
    }

    public function showCardBill(Request $request)
    {
        $card_bills = CardBill::where('user_id', $request->id)->orderBy('created_at', 'desc')->get();
        $user_info = User::where('id', $request->id)->first();
        return view('layout_admin.all_user.card_bill', compact('card_bills','user_info'));
    }

    public function showRechargeBill(Request $request)
    {
        $recharge_bills = UserBill::where('user_id', $request->id)->orderBy('created_at', 'desc')->get();
        $user_info = User::where('id', $request->id)->first();
        return view('layout_admin.all_user.recharge_bill', compact('recharge_bills','user_info'));
    }

    public function banned($id)
    {
        $users = User::find($id);
        $users->banned_status = 1;
        $users->save();
        return redirect()->back()->with('information', 'Khóa user thành công');
    }

    public function unBanned($id)
    {
        $users = User::find($id);
        $users->banned_status = 0;
        $users->check_discount_code = 5;
        $users->check_recharge_code = 5;
        $users->reason = '';
        $users->save();
        return redirect()->back()->with('information', 'Mở khóa user thành công');
    }

    public function updatePoint(Request $request, $id)
    {
        $users = User::find($id);
        $users->point = $request->money;
        $users->save();
        return redirect()->back()->with('information', 'Cập nhật tiền thành công');
    }

    public function getBankInfo(Request $request)
    {
        $bank = AdminTransaction::find(1);
        return view('layout_admin.bank_info', compact('bank'));
    }


    public function updateBankInfo(BankRequest $request)
    {
        $bank = AdminTransaction::find(1);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->bank_image;
        if (isset($img)) {
            if($bank->bank_image){
                unlink(public_path($bank->bank_image));
            }
            $img_name = 'upload/bank/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/bank/img/' . $date);
            $img->move($destinationPath, $img_name);

            $bank->bank_image = $img_name;
        }
        $bank->bank_name = $request->bank_name;
        $bank->bank_number = $request->bank_number;
        $bank->save();
        return redirect()->back()->with('information', 'Cập nhật thông tin thành công');
    }

    public function getAdminInfo(Request $request)
    {
        $admin = User::where('role',1)->first();
        return view('layout_admin.change_pass', compact('admin'));
    }

    public function updateInfo(Request $request)
    {
        $admin = User::find(1);
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->save();
        return redirect()->back()->with('information', 'Cập nhật thông tin thành công');
    }

    public function changePass(Request $request)
    {
        $this->validate(
            $request,
            [
                'new_password' => 'required|min:5|max:25',
                'confirm_password' => 'required|same:new_password',
            ],
            [
                'new_password.required' => 'Vui lòng nhập mật khẩu',
                'new_password.min' => 'Thấp nhất 5 ký tự',
                'new_password.max' => 'Giới hạn 25 ký tự',
                'confirm_password.required' => 'Vui lòng nhập lại mật khẩu',
                'confirm_password.same' => 'Xác nhận mật khẩu không chính xác',
            ]
        );
        $admin = User::find(1);
        $admin->password = Hash::make($request->new_password);
        $admin->save();
        return redirect()->back()->with('changepass', 'Cập nhật mật khẩu thành công');
    }

}
