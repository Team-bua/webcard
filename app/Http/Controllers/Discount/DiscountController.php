<?php

namespace App\Http\Controllers\Discount;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Repositories\Discount\DiscountRepository;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * The ProductRepository instance.
     *
     * @var \App\Repositories\Discount\DiscountRepository
     * 
     */
    protected $repository;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\DiscountRepository $repository
     *
     */
    public function __construct(DiscountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewDiscount(Request $request)
    {
        $types = $this->repository->getDiscountType();
        $discount = $this->repository->getDiscount();
        $used = $this->repository->getUsed();
        $not_use = $this->repository->getNotUse();
        return view('layout_admin.discount.discount', compact('types','discount','used','not_use'));
    }

    public function createDiscount(Request $request)
    {
        $this->repository->createDiscount($request);
        return redirect()->back()->with('information', 'Thêm mã giảm giá thành công');
    }

    public function destroy(Request $request)
    {
        $discount_code = Discount::find($request->id);
        $discount_code->delete();      
            return response()->json([
              'success' => true
          ]);
    }

    public function deleteAll(Request $request)
    {
        return $this->repository->deleteAll();
    }
}
