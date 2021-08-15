<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Models\Partners;
use App\Repositories\PartnersRepository;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    /**
     * The ProductRepository instance.
     *
     * @var \App\Repositories\front\PartnersRepository
     * 
     */
    protected $repository;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\UserRepository $repository
     *
     */
    public function __construct(PartnersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $partners = $this->repository->getPartner();
        return view('layout_admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('layout_admin.partners.create');
    }

    public function store(Request $request)
    {
        $this->repository->store($request);
        return redirect()->back()->with('information', 'Thêm đối tác thành công');
    }

    public function edit($id)
    {
        $partner = $this->repository->getEditPartner($id);
        return view('layout_admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        return redirect()->back()->with('information', 'Cập nhật đối tác thành công');
    }

    public function destroy(Request $request)
    {
        $partners = Partners::find($request->id);
        if(file_exists($partners->image)){
            unlink(public_path($partners->image));
        } 
        $partners->delete();      
            return response()->json([
              'success' => true
          ]);
    }
}
