<?php

namespace App\Http\Controllers;

use App\User;
use App\provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // Redirect Provider
    public function redirectToProvider($providerName)
    {
        return Socialite::driver($providerName)->redirect();
    }

     // Handle Provider
    public function handleProviderCallback($providerName)
    {
        $userProvider = Socialite::driver($providerName)->user();
        $authUser = $this->findOrCreateUser($userProvider, $providerName);
        Auth::login($authUser, true);
        return redirect('/');
    }
    
    // Find Or Create User
    public function findOrCreateUser($userProvider, $providerName)
    {
        $providerRegistered = provider::where('token', $userProvider->token)
                                        ->where('provider', $providerName)
                                        ->first();
        if($providerRegistered){
            $authUser = User::where('id', $providerRegistered->user_id)->first();
            return $authUser;
        }
        else{

            $newUser = new User;
            $newUser->name =  $userProvider->name;
            $newUser->email    = !empty($userProvider->email)? $userProvider->email : '' ;
            $newUser->save();

            $newProvider = new provider;
            $newProvider->provider = $providerName;
            $newProvider->token = $userProvider->id;
            $newProvider->user();

            return $newUser;
        }
    }

}
