<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * The ProductRepository instance.
     *
     * @var \App\Repositories\front\UserRepository
     * 
     */
    protected $repository;



    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\UserRepository $repository
     *
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getProfile($id)
    {
        $user = $this->repository->getProfile($id);
        return view('user.profile', compact('user'));
    }

    public function getOrderHistory()
    {
        return view('user.orderhistory');
    }

    public function updateInfo(UserRequest $request, $id)
    {
        $this->repository->updateInfo($request, $id);
        return redirect()->back()->with('information', 'Cập nhật thông tin thành công');
    }

    public function changePass(ChangePassRequest $request, $id)
    {
        // $this->validate(
        //     $request,
        //     [
        //         'new_password' => 'required|min:6|max:20',
        //         'confirm_password' => 'required|same:new_password',
        //     ],
        //     [
        //         'new_password.required' => 'Please enter a new password',              
        //         'new_password.min' => 'Password must be at least 6 characters',
        //         'new_password.max' => 'Password must not exceed 20 characters',
        //         'confirm_password.required' => 'Please enter the confirmation password',
        //         'confirm_password.same' => 'Confirm password is incorrect',
        //     ]
        // );
        $this->repository->changePass($request, $id);
        return redirect()->back()->with('changepass', 'Cập nhật mật khẩu thành công');
    }
    
}
