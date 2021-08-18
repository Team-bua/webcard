<?php

namespace App\Http\Controllers\Discount;

use App\Http\Controllers\Controller;
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
        return view('layout_admin.discount.discount', compact('types','discount'));
    }

    public function createDiscount(Request $request)
    {
        $this->repository->createDiscount($request);
        return redirect()->back()->with('information', 'Thêm mã giảm giá thành công');
    }

    public function updateDiscount(Request $request, $id)
    {
        $this->repository->updateDiscount($request, $id);
        return redirect()->back()->with('information', 'Cập nhật mã giảm giá thành công');
    }
}
