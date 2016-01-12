<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;

class FacebookController extends Controller
{
   public function facebook()
    {
        return Socialite::driver('facebook')
        ->scopes(['user_likes'])
        ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function callback()
    {
        $user = Socialite::driver('facebook')->user();
        return '<img src="'.$user->getAvatar().'"/><h3>'.$user->getName().'<h3>';

        // $user->token;
    }
}
