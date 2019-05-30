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

    // login And Redirect To App With Send Token
    public function login($domainName)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $token = $user->createToken($domainName)->accessToken;
        return redirect("https://".$domainName ."?token=".$token);
    }

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
        return redirect('/app');
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

            $emailDuplicate = User::where('email', $userProvider->email)->first();

            $newUserId = null;

            if(!$emailDuplicate){
                $newUser = new User;
                $newUser->name =  $userProvider->name;
                $newUser->email    = !empty($userProvider->email)? $userProvider->email : '' ;
                $newUser->save();
                $newUserId = $newUser->id;
            }else{
                $newUserId = $emailDuplicate->id;
            }
            $newProvider = new provider;
            $newProvider->provider = $providerName;
            $newProvider->user_id = $newUserId;
            $newProvider->token = $userProvider->id;
            $newProvider->save();

            if(!$emailDuplicate){
                return $newUser;
            }else{
                return $emailDuplicate;
            }
            
        }
    }

}
