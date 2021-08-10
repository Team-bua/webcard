<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\RechargeRequest;
use App\Http\Requests\UserRequest;
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
        if($request->payment == 2){
            $money = $request->money;
            return view('vnpay.index', compact('money'));
        }
        $point_purchase = UserBill::where('status', 0)->distinct()->count();
        if($point_purchase > 3){
            return redirect()->back()->with('information', 'Vui lòng thanh toán hóa đơn cũ');
        }
        else{
            $this->repository->rechargeMoney($request, $id);
            return redirect()->back();
        }    
    }
    
    public function createPayment(Request $request)
    {
        $vnp_TxnRef = Str::random(10); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount *100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => env('VNP_TMN_CODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('vnpay.return'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASHSECRECT')) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
               $vnpSecureHash = hash('sha256', env('VNP_HASHSECRECT') . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
        
    }

    public function vnpayReturn(Request $request)
    {
        if($request->vnp_ResponseCode == '00'){
            $vnpayData = $request->all();
            $dataPayment = [
                'p_transaction_id' => Str::random(10),
                'p_transaction_code' => $request->vnp_TxnRef,
                'p_user_id' => Auth::user()->id,
                'p_money' => $request->vnp_Amount / 100,
                'p_note' => $request->vnp_OrderInfo,
                'p_vnp_response_code' => $request->vnp_ResponseCode,
                'p_code_vnpay' => $request->vnp_TransactionNo,
                'p_code_bank' => $request->vnp_BankCode,
                'P_time' => date('Y-m-d H:i', strtotime($request->vnp_PayDate)),
            ];
            Payment::insert($dataPayment);
            return view('vnpay.vnpay_return', compact('vnpayData'))->with('message','Thanh toán thành công');
        }else{
            return redirect()->to('/');
        }
       
    }
}
