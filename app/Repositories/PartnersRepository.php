<?php

namespace App\Repositories;

use App\Models\Partners;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PartnersRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function getPartner()
    {
        return Partners::orderBy('created_at', 'desc')->get();       
    }

    public function getEditPartner($id)
    {
        return Partners::find($id);       
    }

    public function store($request)
    {
        $partners = new Partners();
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->avatar;
        if (isset($img)) {
            $img_name = 'upload/partners/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/partners/img/' . $date);
            $img->move($destinationPath, $img_name);

            $partners->image = $img_name;
        }

        $partners->link = $request->link;
        $partners->save();
    }

    public function update($request, $id)
    {
        $partners = Partners::find($id);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->avatar;
        if (isset($img)) {
            if($partners->image){
                unlink(public_path($partners->image));
            }
            $img_name = 'upload/partners/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/partners/img/' . $date);
            $img->move($destinationPath, $img_name);

            $partners->image = $img_name;
        }

        $partners->link = $request->link;
        $partners->save();
    }

}