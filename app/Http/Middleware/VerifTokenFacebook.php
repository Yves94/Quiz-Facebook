<?php

namespace App\Http\Middleware;

use Closure;
use Facebook;
use Session;
class VerifTokenFacebook
{
   
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {
            if(Session::has('facebook_access_token') != null)
            {
                $token = Session::get('facebook_access_token');
            }
            else
            {
              $token = Facebook::getCanvasHelper()->getAccessToken();
            }       

        } catch (Facebook\Exceptions\FacebookSDKException $e) {

            // Failed to obtain access token
            dd($e->getMessage());
        }

        if(isset($token)) {
        
            Facebook::setDefaultAccessToken($token);
            $response = Facebook::get('/me?fields=id,name,gender,age_range,email,birthday,is_verified');
            $me = $response->getGraphUser();
            dd($me);
            Session::put('name',(string) $me->getName());
            Session::put('facebook_access_token', (string) $token);
            return $next($request);
        }
        else {
           return  redirect()->route('login');
        }

    }
}
