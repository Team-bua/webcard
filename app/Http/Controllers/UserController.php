<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\RechargeRequest;
use App\Http\Requests\UserRequest;
use App\Models\AdminTransaction;
use App\Models\Payment;
use App\Models\UserBill;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * The ProductRepository instance.
     *
     * @var \App\Repositories\front\UserRepository
     * 
     */
    protected $repository;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\UserRepository $repository
     *
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getProfile($id)
    {
        $user = $this->repository->getProfile($id);
        return view('user.profile', compact('user'));
    }

    public function getOrderHistory(Request $request)
    {
        $date =  date('Y-m-d');
        if($request->date == null)
        {
            $first_day = date('Y-m-d', strtotime($date));
            $last_day = date('Y-m-d', strtotime($date));            
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
        
        $bills = $this->repository->getCardBill($request);
        return view('user.orderhistory', compact('bills', 'first_day', 'last_day'));
    }

    public function getRechargeHistory(Request $request)
    {
        $date =  date('Y-m-d');
        if($request->date == null)
        {
            $first_day = date('Y-m-d', strtotime($date));
            $last_day = date('Y-m-d', strtotime($date));            
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
        
        $recharge_bills = $this->repository->getRechargeBill($request);
        return view('user.rechargehistory', compact('recharge_bills', 'first_day', 'last_day'));
    }

    public function recharge()
    {   
        $admin = AdminTransaction::find(1);
        $admin_str = $this->repository->utf8convert($admin->bank_name);
        return view('user.recharge', compact('admin','admin_str'));
    }

    public function updateInfo(UserRequest $request, $id)
    {
        $this->repository->updateInfo($request, $id);
        return redirect()->back()->with('information', 'Cập nhật thông tin thành công');
    }

    public function changePass(ChangePassRequest $request, $id)
    {
        $this->repository->changePass($request, $id);
        return redirect()->back()->with('changepass', 'Cập nhật mật khẩu thành công');
    }

    // public function rechargeMoney(RechargeRequest $request, $id)
    // {
    //     $point_purchase = UserBill::where('status', 0)->distinct()->count();
    //     if($point_purchase > 3){
    //         return redirect()->back()->with('information', 'Vui lòng thanh toán hóa đơn cũ');
    //     }
    //     else{
    //         $this->repository->rechargeMoney($request, $id);
    //         return redirect()->route('rechargehistory');
    //     }    
    // }
}
