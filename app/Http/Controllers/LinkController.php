<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\DiscountType;
use App\Models\Link;
use App\Models\RechargeCode;
use App\Models\SubjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{

    public function index()
    {
        $types = DiscountType::all();
        $subject_types = SubjectType::all();
        $subject_links = Link::all();
        return view('layout_admin.link.index', compact('subject_types', 'subject_links', 'types'));
    }

    public function linkSubjectIndex($link)
    {
        $subject = Link::where('link_subject', $link)->first();
        return view('layout_index.page.subject', compact('subject'));
    }

    public function store(Request $request)
    {
        $subject_json = explode('  ', preg_replace("/\r|\n/", " ", $request->subject));
        for ($i = 0; $i < count($subject_json); $i++) {
            $code = $subject_json[$i];
            $subject = new Link();
            if($request->subject_type == 'Thẻ'){               
                $subject->type_subject = $request->subject_type;
                $subject->link_subject = Str::random(40);
                $subject->subject = json_encode($code);
                $subject->save();
            }
            elseif($request->subject_type == 'Mã giảm giá')
            {
                $subject->type_subject = $request->subject_type;
                $subject->link_subject = Str::random(40);
                $subject->subject = $code;
                $subject->save();

                $discount = new Discount();
                $discount->discount_type = $request->discount_type;
                $discount->code = $code;
                $discount->price = $request->discount;
                $discount->save();
            }           
            elseif($request->subject_type == 'Mã nạp tiền')
            {
                $subject->type_subject = $request->subject_type;
                $subject->link_subject = Str::random(40);
                $subject->subject = $code;
                $subject->save();

                $recharge = new RechargeCode();
                $recharge->code = $code;
                $recharge->price = $request->discount;
                $recharge->save();
            }             
        }
        return redirect()->back()->with('information', 'Thêm mới thành công!');
        
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            $link_delete = Link::find($request->id);
            $recharge = RechargeCode::where('code', $link_delete->subject)->first();
            $discount = Discount::where('code', $link_delete->subject)->first();
            $link_delete->delete();
            if($discount != null){
                $discount->delete();
            }
            if($recharge != null){
                $recharge->delete();
            }                  
            return response()->json([
                'success' => true,
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
            ]);
        }
    }
}
