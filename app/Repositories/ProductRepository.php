<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Models\Operating;
use App\Models\Package;
use App\Models\Product;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ProductRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getProducts()
    {
         return Product::orderBy('created_at', 'desc')->get();
    }

    public function getOSType()
    {
         return Operating::orderBy('id', 'asc')->get();
    }

    public function getType()
    {
         return Operating::all();
    }

    public function getTypeProduct()
    {
         return ProductType::all();
    }

    public function getProductById($id)
    {
         return Product::find($id);
    }

    public function getPackageByIdProduct($id_product)
    {
         return Package::where('product_id', $id_product)->first();
    }

    public function store($request)
    {
     $product = new Product();
     $package = new Package();
     $date = Carbon::now()->format('d-m-Y');
     $img = $request->avatar;
     if (isset($img)) {
         $img_name = 'upload/product/img/' . $date.'/'.Str::random(10).rand().'.'.$img->getClientOriginalExtension();
         $destinationPath = public_path('upload/product/img/' . $date);
         $img->move($destinationPath, $img_name);

         $product->image = $img_name;
     }
     $img_thumbnail = $request->thumbnail;
     if (isset($img_thumbnail)) {
         $img_name_thumbnail = 'upload/product/thumbnail/' . $date.'/'.Str::random(10).rand().'.'.$img_thumbnail->getClientOriginalExtension();
         $destinationPath = public_path('upload/product/thumbnail/' . $date);
         $img_thumbnail->move($destinationPath, $img_name_thumbnail);

         $product->thumbnail = $img_name_thumbnail;
     }    
     $product->short_des = $request->short_des;
     $product->name = $request->name;
     $product->product_type = $request->game_type;
     $product->os_supported = $request->game_opt;
  
     $product->content_1 = $request->content;
     $product->save();
   
     $package->product_id = $product->id;   
     $img_package = $request->packgame;
     if(isset($img_package)){
     foreach($img_package as $img){
          if (isset($img)) {
               $img_name_package = 'upload/package/img/' . $date.'/'.Str::random(10).rand().'.'.$img->getClientOriginalExtension();
               $destinationPath = public_path('upload/package/img/' . $date);
               $img->move($destinationPath, $img_name_package);
               $arr[] = $img_name_package;               
           }  
     }
          $package->package_image = json_encode($arr);  
} 
          $package->package_name = json_encode($request->package);
          $package->package_price = json_encode($request->value);
          $package->point_number = json_encode($request->point);
          $package->save();
    }

    public function update($request, $id)
    {
     $product = Product::find($id);
     $package = Package::where('product_id', $id)->first();
     if(!$package){
          $package = new Package();
          $package->product_id = $id;
     }
     $date = Carbon::now()->format('d-m-Y');
     $img = $request->avatar;
     if (isset($img)) {
         unlink(public_path($product->image));
         $img_name = 'upload/product/img/' . $date.'/'.Str::random(10).rand().'.'.$img->getClientOriginalExtension();
         $destinationPath = public_path('upload/product/img/' . $date);
         $img->move($destinationPath, $img_name);

         $product->image = $img_name;
     }

      $img_thumbnail = $request->thumbnail;
     if (isset($img_thumbnail)) {
         unlink(public_path($product->thumbnail));
         $img_name_thumbnail = 'upload/product/thumbnail/' . $date.'/'.Str::random(10).rand().'.'.$img_thumbnail->getClientOriginalExtension();
         $destinationPath = public_path('upload/product/thumbnail/' . $date);
         $img_thumbnail->move($destinationPath, $img_name_thumbnail);

         $product->thumbnail = $img_name_thumbnail;
     }    

     $product->short_des = $request->short_des;
     $product->name = $request->name;
     $product->product_type = $request->game_type;
     $product->os_supported = $request->game_opt;

     $product->content_1 = $request->content;
     $product->save();
     if($request->packgame){
          $arr_packgame = array_replace($request->pack, $request->packgame);
     }
     if(isset($arr_packgame)){
          foreach($arr_packgame as $ap){  
               if (is_string($ap) == false) {
                    $img_name_package = 'upload/package/img/' . $date.'/'.Str::random(10).rand().'.'.$ap->getClientOriginalExtension();
                    $destinationPath = public_path('upload/package/img/' . $date);
                    $ap->move($destinationPath, $img_name_package);
                    $arr[] = $img_name_package;               
                }
                else{
                    $arr[] = $ap; 
                }  
          }
               $package->package_image = json_encode($arr);
     }
     else {
          $package->package_image = json_encode($request->pack);
     }

     if ($request->package) {
               $package->package_name = json_encode($request->package);
               $package->package_price = json_encode($request->value);
               $package->point_number = json_encode($request->point);       
     }
     
     $package->save();
    }

    public function AjaxDeletePackage($request, $id)
    {
          $package = Package::where('product_id', $id)->first();
          if($request->pack){              
               $img_unlink =  array_diff(json_decode($package->package_image), $request->pack);  
                    foreach($img_unlink as $iu){
                         
                         unlink(public_path($iu));
                    }      
          }
          $package->package_image = json_encode($request->pack);   
          $package->package_name = json_encode($request->package);
          $package->package_price = json_encode($request->value);
          $package->point_number = json_encode($request->point);
          $package->save();

          return response()->json([
               'error' => false,
               'package'  => $package,
           ], 200);
    }

    public function productdestroy($request)
    {
          $product = Product::find($request->id);
          $package = Package::where('product_id', $product->id)->first();
          $bill = Bill::where('product_id', $request->id)->get();
          if(file_exists($product->image) && file_exists($product->thumbnail)){
               unlink(public_path($product->image));
               unlink(public_path($product->thumbnail));
          } 
          foreach ($bill as $b){
               $bill_to_delete = Bill::find($b->id);
               $bill_to_delete->delete();
          }      
          $product->delete();
          $package->delete();

         
          
          
    }

}