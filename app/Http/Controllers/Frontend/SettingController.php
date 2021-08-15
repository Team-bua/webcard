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
        $this->repository->updateLogo($request);
        return redirect()->back()->with('information', 'Cập nhật thành công');
     }

    public function updateBannerCard(Request $request)
    {
        $this->repository->updateBannerCard($request);
        return redirect()->back()->with('information', 'Cập nhật thành công');
    }

    public function updateContact(Request $request)
    {
    $this->repository->updateContact($request);
    return redirect()->back()->with('information', 'Cập nhật thành công');
    }
}
