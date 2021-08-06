<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\RechargeRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\UserBill;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getOrderHistory()
    {
        return view('user.orderhistory');
    }

    public function recharge()
    {     
        $user = Auth::user()->name;
        $str = $this->repository->utf8convert($user);
        return view('user.recharge',compact('str'));
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

    public function rechargeMoney(RechargeRequest $request, $id)
    {
        $point_purchase = UserBill::where('status', 0)->distinct()->count();
        if($point_purchase > 3){
            return redirect()->back()->with('information', 'Vui lòng thanh toán hóa đơn cũ');
        }
        else{
            $this->repository->rechargeMoney($request, $id);
            return redirect()->back();
        }    
    }
    
}
