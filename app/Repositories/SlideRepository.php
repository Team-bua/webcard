<?php

namespace App\Repositories;

use App\Models\Slide;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SlideRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function getSlides()
    {
         return Slide::orderBy('id', 'asc')->get();
    }

    public function getSlidesById($id)
    {
         return Slide::find($id);
    }

    public function store($request)
    {
     $slide = new Slide();
     $date = Carbon::now()->format('d-m-Y');
     $img = $request->avatar;
     if (isset($img)) {
         $img_name = 'upload/slide/img/' . $date.'/'.Str::random(10).rand().'.'.$img->getClientOriginalExtension();
         $destinationPath = public_path('upload/slide/img/' . $date);
         $img->move($destinationPath, $img_name);

         $slide->images = $img_name;
     }  
     
     $slide->name = $request->name;  
     $slide->description = $request->content;  
     $slide->save();
   
    }
    public function update($request, $id)
    {
     $slide = Slide::find($id);
     $date = Carbon::now()->format('d-m-Y');
     $img = $request->avatar;
     if (isset($img)) {
        unlink(public_path($slide->images));
         $img_name = 'upload/slide/img/' . $date.'/'.Str::random(10).rand().'.'.$img->getClientOriginalExtension();
         $destinationPath = public_path('upload/slide/img/' . $date);
         $img->move($destinationPath, $img_name);

         $slide->images = $img_name;
     }
     
     $slide->name = $request->name;  
     $slide->description = $request->content;  
     $slide->save();
   
    }
    
    public function destroy($request)
    {
          $slide = Slide::find($request->id);
          if(file_exists($slide->images)){
            unlink(public_path($slide->images));
          }
          $slide->delete();

    }
}