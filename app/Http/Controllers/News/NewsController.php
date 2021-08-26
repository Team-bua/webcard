<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Repositories\News\NewsRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $repository;

    public function __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $news = $this->repository->index();
        return view('layout_admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('layout_admin.news.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'tittle' => 'required|max:150',
                'avatar' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
                'thumbnail' => 'mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'tittle.required' => 'Vui lòng nhập tiêu đề',
                'tittle.max' => 'Giới hạn 150 ký tự',
                'avatar.required' => 'Vui lòng chọn avatar',
                'avatar.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
                'avatar.max' => 'Giới hạn ảnh 2Mb',
                'thumbnail.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
                'thumbnail.max' => 'Giới hạn ảnh 2Mb',
            ]
        );
        $this->repository->store($request);
        return redirect()->back()->with('information', 'Thêm tin tức thành công');
    }

    public function edit($id)
    {
        $news = $this->repository->getEditNews($id);
        return view('layout_admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'tittle' => 'required|max:150',
                'avatar' => 'mimes:jpg,jpeg,png,gif|max:2048',
                'thumbnail' => 'mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'tittle.required' => 'Vui lòng nhập tiêu đề',
                'tittle.max' => 'Giới hạn 150 ký tự',
                'avatar.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
                'avatar.max' => 'Giới hạn ảnh 2Mb',
                'thumbnail.mimes' => 'Chỉ gắn thẻ hình ảnh có đuôi .jpg .jpeg .png .gif',
                'thumbnail.max' => 'Giới hạn ảnh 2Mb',
            ]
        );
        $this->repository->update($request, $id);
        return redirect()->back()->with('information', 'Cập nhật tin tức thành công');
    }

    public function destroy(Request $request)
    {
        $news = News::find($request->id);
        if(file_exists($news->avatar)){
            unlink(public_path($news->avatar));
            if(file_exists($news->thumbnail)){
                unlink(public_path($news->thumbnail));
            }
        } 
        $news->delete();      
            return response()->json([
              'success' => true
          ]);
    }
}
