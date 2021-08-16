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

    public function updateServe($request, $id)
    {
        // dd($request->all(), $id);
        $index_serve = Index::find($id);
        $index_serve->title_serve = $request->tittle1;
        $index_serve->desc_serve = json_encode($request->title_serve);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->img_serve;
        $img_request = [];
        if (isset($img)) {
            if(json_decode($index_serve->icon_serve) !== null){
                for($i = 0; $i < count(json_decode($index_serve->icon_serve)); $i++) {
                    if(json_decode($index_serve->icon_serve)[$i] !== ''){
                        unlink(public_path(json_decode($index_serve->icon_serve)[$i]));
                    }         
                }
            }
            for($j = 0; $j < count($img); $j++){
                $img_name = 'upload/index/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img[$j]->getClientOriginalExtension();
                $destinationPath = public_path('upload/index/img/' . $date);
                $img[$j]->move($destinationPath, $img_name);
                $img_request[] = $img_name;
            }
        $index_serve->icon_serve = json_encode($img_request);            
        }
        $index_serve->save();
    }

}