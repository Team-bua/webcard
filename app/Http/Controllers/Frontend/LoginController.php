<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        // $user = $this->createUser($getInfo, $provider);
        $existingUser = User::where('provider_id', $getInfo->id)->orWhere('email', $getInfo->email)->first();

        if($existingUser){
            // log them in
            Auth::login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User();
            $newUser->name            = $getInfo->name;
            $newUser->code_name       = 'NAPTIEN'.rand(100000,999999);
            $newUser->email           = $getInfo->email;
            $newUser->avatar_original = $getInfo->avatar;
            $newUser->password        = Hash::make($getInfo->id);
            $newUser->provider_id     = $getInfo->id;
            $newUser->save();

            Auth::login($newUser, true);
        }
        if(session('link') != null){
            return redirect(session('link'));
        }
        else{
            if(Auth::user()->banned_status == 0){
                return redirect()->route('index')->with('message', '2');
            }else{
                Auth::logout();
                return redirect()->route('index')->with('message', '4');
            }
            
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
