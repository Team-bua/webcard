<?php

namespace App\Repositories;

use App\Models\Index;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SettingRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    
    public function getAllIndex()
    {
        return Index::find(1);
    }

    public function updateLogo($request)
    {
        $logo = Index::find(1);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->img_logo;
        if (isset($img)) {
            if(json_decode($logo->image_logo)[0]){
                unlink(public_path(json_decode($logo->image_logo)[0]));
            }
            $img_name = 'upload/index/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/index/img/' . $date);
            $img->move($destinationPath, $img_name);

        }else{
            $img_name = json_decode($logo->image_logo)[0];
        }
        $arr = [ $img_name, $request->width, $request->height ];
        $logo->image_logo = json_encode($arr);
        $logo->save();
    }

    public function updateBannerCard($request)
    {
        $banner_card = Index::find(1);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->img_buy_card;
        if (isset($img)) {
            if($banner_card->banner_buy_card){
                unlink(public_path($banner_card->banner_buy_card));
            }
            $img_name = 'upload/index/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/index/img/' . $date);
            $img->move($destinationPath, $img_name);

            $banner_card->banner_buy_card = $img_name;

        }
        $banner_card->save();
    }

    public function updateContact($request)
    {
        $contact = Index::find(1);
        $contact->desc_contact = $request->tittle;
        $contact->phone_contact = $request->phone;
        $contact->address_contact = $request->address;
        $contact->email_contact = $request->email;
        $contact->map_contact = $request->maps;
        $contact->save();
    }

}