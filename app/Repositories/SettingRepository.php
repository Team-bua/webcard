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

    public function updateBannerIndex($request)
    {
        $banner_index = Index::find(1);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->img_banner;
        if (isset($img)) {
            if($banner_index->image_banner){
                unlink(public_path($banner_index->image_banner));
            }
            $img_name = 'upload/index/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/index/img/' . $date);
            $img->move($destinationPath, $img_name);

            $banner_index->image_banner = $img_name;

        }
        $banner_index->desc_banner = $request->desc;
        $banner_index->sub_desc_banner = $request->sub_desc;
        $banner_index->save();
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

    public function updateBackground($request)
    {
        $background = Index::find(1);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->img_background;
        if (isset($img)) {
            if($background->image_background){
                unlink(public_path($background->image_background));
            }
            $img_name = 'upload/index/img/' . $date . '/' . Str::random(10) . rand() . '.' . $img->getClientOriginalExtension();
            $destinationPath = public_path('upload/index/img/' . $date);
            $img->move($destinationPath, $img_name);

            $background->image_background = $img_name;

        }
        $background->save();
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
        $date = Carbon::now()->format('d-m-Y');

        $index_serve->title_serve = $request->tittle1;
        $index_serve->desc_serve = json_encode($request->title_serve);

        $img = $request->img_serve;
        $arr_serve = [];
        if($img){
            $arr_icon_serve = array_replace($request->serve, $img);
       }
        if (isset($arr_icon_serve)) {
            // if(json_decode($index_serve->icon_serve) !== null){
            //     for($i = 0; $i < count(json_decode($index_serve->icon_serve)); $i++) {
            //         if(json_decode($index_serve->icon_serve)[$i] !== ''){
            //             unlink(public_path(json_decode($index_serve->icon_serve)[$i]));
            //         }         
            //     }
            // }
            foreach($arr_icon_serve as $ap){  
                if (is_string($ap) == false) {
                     $img_name_package = 'upload/index/img/' . $date.'/'.Str::random(10).rand().'.'.$ap->getClientOriginalExtension();
                     $destinationPath = public_path('upload/index/img/' . $date);
                     $ap->move($destinationPath, $img_name_package);
                     $arr_serve[] = $img_name_package;               
                 }
                 else{
                     $arr_serve[] = $ap; 
                 }  
           }
                $index_serve->icon_serve = json_encode($arr_serve);
        }
        else {
            $index_serve->icon_serve = json_encode($request->serve);
       }
        $index_serve->save();
    }
    public function updateStep($request, $id)
    {
        $step = Index::find($id);
        $date = Carbon::now()->format('d-m-Y');
        $img = $request->image_step;
        if (isset($img)) {
            if($step->image_step){
                unlink(public_path($step->image_step));
            }      
            $img_name = 'upload/index/img/' . $date.'/'.Str::random(10).rand().'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path('upload/index/img/' . $date);
            $img->move($destinationPath, $img_name);

            $step->image_step = $img_name;
        }
        $step->desc_step = $request->tittle;
        $step->sub_desc_step = $request->desc;

        if($request->icon){
            $arr_packgame = array_replace($request->pack, $request->icon);
        }
        if(isset($arr_packgame)){           
            foreach($arr_packgame as $ap){  
                if (is_string($ap) == false) {
                        $img_name_package = 'upload/index/img/' . $date.'/'.Str::random(10).rand().'.'.$ap->getClientOriginalExtension();
                        $destinationPath = public_path('upload/index/img/' . $date);
                        $ap->move($destinationPath, $img_name_package);
                        $arr[] = $img_name_package;               
                    }
                    else{
                        $arr[] = $ap; 
                    }  
            }
                $step->icon_step = json_encode($arr);
        }
        else {
            $step->icon_step = json_encode($request->pack);
        }

        $step->desc_number_step = json_encode($request->content);
        $step->sub_desc_number_step = json_encode($request->description);    
        
        $step->save();
    }

    public function AjaxDeleteIcon($request, $id)
    {
        $step = Index::find($id);
        $arr_icon_step = json_decode($step->icon_step);
        $arr_desc_step = json_decode($step->desc_number_step);
        $arr_sub_desc_step = json_decode($step->sub_desc_number_step);
        if($arr_icon_step[$request->id_step]){
            unlink(public_path($arr_icon_step[$request->id_step]));
        }
        array_splice($arr_icon_step, $request->id_step, 1);
        array_splice($arr_desc_step, $request->id_step, 1);
        array_splice($arr_sub_desc_step, $request->id_step, 1);
        $step->icon_step = $arr_icon_step;   
        $step->desc_number_step =  $arr_desc_step;
        $step->sub_desc_number_step = $arr_sub_desc_step;
        $step->save();

        return response()->json([
            'error' => false,
            'package'  => $step,
        ], 200);
    }

    public function AjaxDeleteIconServe($request, $id)
    {
       
        $serve = Index::find($id);
        $arr_icon_serve_unlink = json_decode($serve->icon_serve);
        $arr_desc_serve_unlink = json_decode($serve->desc_serve);
        if($arr_icon_serve_unlink[$request->id_serve_delected]){
            unlink(public_path($arr_icon_serve_unlink[$request->id_serve_delected]));
        }
        array_splice($arr_icon_serve_unlink, $request->id_serve_delected, 1);
        array_splice($arr_desc_serve_unlink, $request->id_serve_delected, 1);
        $serve->icon_serve = $arr_icon_serve_unlink;
        $serve->desc_serve = $arr_desc_serve_unlink;
        $serve->save();

        return response()->json([
            'error' => false,
            'package'  => $serve,
        ], 200);
    }

}