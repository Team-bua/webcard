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
        $step = Index::find(1);
        if($request->pack){              
            $img_unlink =  array_diff(json_decode($step->icon_step), $request->pack);  
                foreach($img_unlink as $iu){
                        
                        unlink(public_path($iu));
                }      
        }
        $step->icon_step = json_encode($request->pack);   
        $step->desc_number_step = json_encode($request->content);
        $step->sub_desc_number_step = json_encode($request->description);
        $step->save();

        return response()->json([
            'error' => false,
            'package'  => $step,
        ], 200);
    }

}