<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use App\User;
use Auth;

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

            $fbSdk->setDefaultAccessToken($accessToken);
            Session::put('facebook_access_token', (string) $accessToken);
            $this->getUserInfo($fbSdk);
            return redirect()->route('home');
        }
    }


    public function getUserInfo(LaravelFacebookSdk $fbSdk)
    {
        try {

           $response = $fbSdk->get('/me?fields=id,last_name,first_name,gender,age_range,email,birthday');

       } catch (Facebook\Exceptions\FacebookSDKException $e) {

           dd($e->getMessage());
       }

       $facebook_user = $response->getGraphUser();

        $current_user = User::updateOrCreate(['email' =>$facebook_user->getEmail()],[
        'last_name'     => $facebook_user->getLastName(),
        'first_name'    => $facebook_user->getFirstName(),
        'email'         => $facebook_user->getEmail(),
        'gender'        => ($facebook_user->getGender()) == 'male' ? 0 : 1,
        'birthday'      =>  $facebook_user->getBirthDay()
        ]);

        Auth::login($current_user);
    }
}
