<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CardBillExport;
use App\Exports\RechargeBillExport;
use App\Http\Controllers\Controller;
use App\Models\CardBill;
use App\Repositories\BillRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BillController extends Controller
{
    /**
     * The ProductRepository instance.
     *
     * @var \App\Repositories\front\BillRepository
     * 
     */
    protected $repository;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\BillRepository $repository
     *
     */
    public function __construct(BillRepository $repository)
    {
        $this->repository = $repository;
    }
    public function cardBill(Request $request)
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
        $count = CardBill::where('status', 0)->count();
        $status = $request->status;
        return view('layout_admin.bills.cardbill', compact('bills','first_day','last_day','status','count'));
    }

    public function rechargeBill(Request $request)
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
        return view('layout_admin.bills.rechargebill', compact('recharge_bills','first_day','last_day'));
    }

    public function exportCardBill(Request $request)
    {
        $date = str_replace('/', '-', str_replace('to','đến',$request->date_export));
        return Excel::download(new CardBillExport( $date), 'Thông tin đơn hàng ngày '. $date.'.xlsx');
    }

    public function exportRechargeBill(Request $request)
    {
        $date = str_replace('/', '-', str_replace('to','đến',$request->date_export));
        return Excel::download(new RechargeBillExport( $date), 'Thông tin đơn nạp ngày '. $date.'.xlsx');
    }

    public function updateStatus(Request $request)
    {
        $card_bill = CardBill::findOrFail($request->id);
        $card_bill->status = $request->status;
        if($card_bill->save()){
            return 1;
        }
        return 0;
    }

    public function updateStatusAll(Request $request)
    {
       return $this->repository->updateStatusAll($request);
    }

    public function deleteCardBill(Request $request)
    {
        return $this->repository->deleteCardBill($request);
    }
}
