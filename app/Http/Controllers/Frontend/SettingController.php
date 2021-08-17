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
                'img_logo' => 'mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'img_logo.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
                'img_logo.max' => 'Giới hạn ảnh 2Mb',
            ]
        );
        $this->repository->updateLogo($request);
        return redirect()->back()->with('information', 'Cập nhật thành công');
     }

    public function updateBannerIndex(Request $request)
    {
        $this->validate(
            $request,
            [
                'img_banner' => 'mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'img_banner.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
                'img_banner.max' => 'Giới hạn ảnh 2Mb',
            ]
        );
        $this->repository->updateBannerIndex($request);
        return redirect()->back()->with('information', 'Cập nhật thành công');
    }

    public function updateBackground(Request $request)
    {
        $this->validate(
            $request,
            [
                'img_background' => 'mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'img_background.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
                'img_background.max' => 'Giới hạn ảnh 2Mb',
            ]
        );
        $this->repository->updateBackground($request);
        return redirect()->back()->with('information', 'Cập nhật thành công');
    }

    public function updateBannerCard(Request $request)
    {
        $this->validate(
            $request,
            [
                'img_buy_card' => 'mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
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

    public function updateServe(Request $request, $id)
    {
    $this->repository->updateServe($request, $id);
    return redirect()->back()->with('information', 'Cập nhật thành công');
    }
    public function updateStep(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'image_step' => 'mimes:jpg,jpeg,png,gif|max:2048',
                'icon' => 'mimes:svg|max:2048',
            ],
            [
                'icon.mimes' => 'Icon chỉ nhận hình ảnh có đuôi .svg',
                'icon.max' => 'Giới hạn ảnh 2Mb',
                'image_step.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
                'image_step.max' => 'Giới hạn ảnh 2Mb',
            ]
        );
        $this->repository->updateStep($request, $id);
        return redirect()->back()->with('information', 'Cập nhật thành công');
    }

    public function deleteIcon(Request $request, $id)
    {
        return $this->repository->AjaxDeleteIcon($request, $id);
    }

    public function deleteIconServe(Request $request, $id)
    {
        return $this->repository->AjaxDeleteIconServe($request, $id);
    }

}
