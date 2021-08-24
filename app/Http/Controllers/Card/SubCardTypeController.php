<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\SubCardType;
use App\Repositories\Card\SubCardTypeRepository;
use Illuminate\Http\Request;

class SubCardTypeController extends Controller
{
    protected $repository;

    public function __construct(SubCardTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $sub_card_type = $this->repository->getSubCardType($request);
        return view('layout_admin.sub_card.index', compact('sub_card_type'));
    }

    public function create(Request $request)
    {
        $card_types = $this->repository->getCardType($request);
        return view('layout_admin.sub_card.create', compact('card_types'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên thương hiệu',
            ]
        );
        $this->repository->store($request);
        return redirect()->back()->with('information', 'Thêm thương hiệu thành công');
    }
    
    public function edit(Request $request, $id)
    {
        $card_types = $this->repository->getCardType($request);
        $sub_card_type = $this->repository->getEditSubCardType($id);
        return view('layout_admin.sub_card.edit', compact('sub_card_type', 'card_types'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên thương hiệu',
            ]
        );
        $this->repository->update($request, $id);
       return redirect()->back()->with('information', 'Cập nhật thương hiệu thành công');
    }

    public function destroy(Request $request)
     {
         $card = Card::where('sub_card_type_id', $request->id)->count();
         if($card == 0){
            $sub_card = SubCardType::find($request->id);
            $sub_card->delete();      
                return response()->json([
                  'success' => true
              ]);
         }else{
            return response()->json([
                'success' => false
            ]);
         }       
     }
}
