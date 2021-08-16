<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * The ProductRepository instance.
     *
     * @var \App\Repositories\front\SettingRepository
     * 
     */
    protected $repository;



    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\SettingRepository $repository
     *
     */
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewSetting()
    {
        $index = $this->repository->getAllIndex();
        return view('layout_admin.setting_index', compact('index'));
    }
    
    public function updateLogo(Request $request)
     {
        $this->validate(
            $request,
            [
                'img_logo' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'img_logo.required' => 'Vui lòng chọn logo',
                'img_logo.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
                'img_logo.max' => 'Giới hạn ảnh 2Mb',
            ]
        );
        $this->repository->updateLogo($request);
        return redirect()->back()->with('information', 'Cập nhật thành công');
     }

    public function updateBannerCard(Request $request)
    {
        $this->validate(
            $request,
            [
                'img_buy_card' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'img_buy_card.required' => 'Vui lòng chọn logo',
                'img_buy_card.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
                'img_buy_card.max' => 'Giới hạn ảnh 2Mb',
            ]
        );
        $this->repository->updateBannerCard($request);
        return redirect()->back()->with('information', 'Cập nhật thành công');
    }

    public function updateContact(Request $request)
    {
    $this->repository->updateContact($request);
    return redirect()->back()->with('information', 'Cập nhật thành công');
    }
}
