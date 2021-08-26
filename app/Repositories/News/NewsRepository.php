<?php

namespace App\Repositories\News;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Str;

class NewsRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function index()
    {
        return News::orderBy('created_at', 'desc')->get();
    }

    public function getEditNews($id)
    {
        return News::find($id);
    }

    public function store($request)
    {
        $news = new News();
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->avatar;
        if (isset($img)) {
            $img_name = 'upload/news/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/news/img/' . $date);
            $img->move($destinationPath, $img_name);

            $news->avatar = $img_name;
        }

        $img_thumbnail = $request->thumbnail;
        if (isset($img_thumbnail)) {
            $img_name_thumbnail = 'upload/news/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img_thumbnail->getClientOriginalExtension();
            $destinationPath = public_path('upload/news/img/' . $date);
            $img_thumbnail->move($destinationPath, $img_name_thumbnail);

            $news->thumbnail = $img_name_thumbnail;
        }

        $news->tittle = $request->tittle;
        $news->content = $request->content;
        $news->save();
    }

    public function update($request, $id)
    {
       
        $news = News::find($id);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->avatar;
        if (isset($img)) {
            if($news->avatar){
                unlink(public_path($news->avatar));
            }
            $img_name = 'upload/news/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/news/img/' . $date);
            $img->move($destinationPath, $img_name);

            $news->avatar = $img_name;
        }

        $img_thumbnail = $request->thumbnail;
        if (isset($img_thumbnail)) {
            if($news->thumbnail){
                unlink(public_path($news->thumbnail));
            }
            $img_name_thumbnail = 'upload/news/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img_thumbnail->getClientOriginalExtension();
            $destinationPath = public_path('upload/news/img/' . $date);
            $img_thumbnail->move($destinationPath, $img_name_thumbnail);

            $news->thumbnail = $img_name_thumbnail;
        }

        $news->tittle = $request->tittle;
        $news->content = $request->content;
        $news->save();
    }
}
