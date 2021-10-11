<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use Illuminate\Auth\Events\Registered;


use Auth;

class SocialsController extends Controller
{
    public function auth(){
        return Socialite::driver('github')->redirect();
    }

    public function callback(){

        $user = Socialite::driver('github')->user();

        $users = User::where(['email' => $user->getEmail()])->first();

        if($users){
            Auth::login($users);
            return redirect()->route('dashboard');
        }else{
            $user = User::firstOrCreate([
                'name'          => $user->getName(),
                'email'         => $user->getEmail(),
                'avatar'         => $user->getAvatar(),
                // 'provider_id'   => $user->getId(),
                // 'provider'      => 'github',
                'password'      => 'password',
            ]);
            $user->save();
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        return redirect()->route('dashboard');

    }
}
