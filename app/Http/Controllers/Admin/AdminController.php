<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAdmin()
    {
        return view('layout_admin.index');
    }

    public function getAllUsers()
    {
        $users = User::where('role',0)
                    ->orderBy('created_at','desc')->get();
        return view('layout_admin.all_user.index', compact('users'));
    }

    public function banned($id)
    {
        $users = User::find($id);
        $users->banned_status = 1;
        $users->save();
        return redirect()->back()->with('information', 'Khóa user thành công');
    }

    public function unBanned($id)
    {
        $users = User::find($id);
        $users->banned_status = 0;
        $users->save();
        return redirect()->back()->with('information', 'Mở khóa user thành công');
    }

}
