<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repositories\FrontendRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
     /**
     * The ProductRepository instance.
     *
     * @var \App\Repositories\front\FrontendRepository
     * 
     */
    protected $repository;



    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PageRepository $repository
     *
     */
    public function __construct(FrontendRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getIndex()
    {
        return view('layout_index.index');
    }

    public function signUp()
    {
        return view('layout_index.page.signup');
    }

    public function postSignup(RegisterRequest $request)
    {
        $sign_up = $this->repository->createUser($request);
        if($sign_up == true){
            $credentaials = array('email' => $request->email, 'password' => $request->password);
            if (Auth::attempt($credentaials)) {
                return redirect()->route('index')->with('message');
            } else {
                return redirect()->back();
            }
        }
    }

    public function signIn()
    {
        return view('layout_index.page.signin');
    }
    
    public function getCardToView()
    {
        return view('layout_index.page.card');
    }
}
