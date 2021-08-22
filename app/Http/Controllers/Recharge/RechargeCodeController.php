<?php

namespace App\Http\Controllers\Recharge;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\RechargeCode;
use App\Repositories\Recharge\RechargeCodeRepository;
use Illuminate\Http\Request;

class RechargeCodeController extends Controller
{
   /**
     * The ProductRepository instance.
     *
     * @var \App\Repositories\front\RechargeCodeRepository
     * 
     */
    protected $repository;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\RechargeCodeRepository $repository
     *
     */
    public function __construct(RechargeCodeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewRechargeCode(Request $request)
    {
        $recharge_code = $this->repository->viewRechargeCode();
        $used = $this->repository->getUsed();
        $not_use = $this->repository->getNotUse();
        return view('layout_admin.recharge.recharge_code', compact('recharge_code','used','not_use'));
    }

    public function createRechargeCode(Request $request)
    {
        $this->repository->createRechargeCode($request);
        return redirect()->back()->with('information', 'Thêm mã nạp tiền thành công');
    }

    // public function updateStatus(Request $request)
    // {
    //     $recharge_code = RechargeCode::find($request->id);
    //     $recharge_code->status = $request->status;
    //     if($recharge_code->save()){
    //         return 1;
    //     }
    //     return 0;
    // }

    public function destroy(Request $request)
    {
        $recharge_code = RechargeCode::find($request->id);
        $recharge_code->delete();      
            return response()->json([
              'success' => true
          ]);
    }

    public function deleteAll(Request $request)
    {
        return $this->repository->deleteAll();
    }
}
