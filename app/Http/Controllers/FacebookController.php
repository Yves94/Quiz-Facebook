<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;

class FacebookController extends Controller
{
    /**
    *   Redirige l'utilisateur vers la connexion avec Facebook
    */
    public function loginWithFacebook(LaravelFacebookSdk $fbSdk)
    {
        $helper = $fbSdk->getRedirectLoginHelper();
        $permissions = ['email']; // optional
        $callback = 'https://quizfb.herokuapp.com/callback/';
        $loginUrl = $helper->getLoginUrl($callback, $permissions);
        return Redirect::to($loginUrl);
    }

    /**
    *  Fonction de retour , permet de récupérer le Token
    */
    public function callbackFromFacebook(LaravelFacebookSdk $fbSdk)
    {
        $helper = $fbSdk->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken('https://quizfb.herokuapp.com/callback/');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {

            dd($e->getMessage());
        }

        if($accessToken) {

            Session::put('facebook_access_token', (string) $accessToken);
            return redirect()->route('home');
        }
    }
}
