<?php

namespace App\Http\Controllers\Recharge;

use App\Http\Controllers\Controller;
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
     * @param  \App\Repositories\UserRepository $repository
     *
     */
    public function __construct(RechargeCodeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewRechargeCode(Request $request)
    {
        $recharge_code = $this->repository->viewRechargeCode();
        return view('layout_admin.recharge.recharge_code', compact('recharge_code'));
    }

    public function createRechargeCode(Request $request)
    {
        $this->repository->createRechargeCode($request);
        return redirect()->back()->with('information', 'Thêm mã nạp tiền thành công');
    }

    public function updateRechargeCode(Request $request, $id)
    {
        $this->repository->updateRechargeCode($request, $id);
        return redirect()->back()->with('information', 'Cập nhật mã nạp tiền thành công');
    }

    public function destroy(Request $request)
    {
        $recharge_code = RechargeCode::find($request->id);
        $recharge_code->delete();      
            return response()->json([
              'success' => true
          ]);
    }
}
