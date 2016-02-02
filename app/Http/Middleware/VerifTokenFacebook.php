<?php

namespace App\Http\Middleware;

use Closure;
use Facebook;

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

            $token = Facebook::getCanvasHelper()->getAccessToken();

        } catch (Facebook\Exceptions\FacebookSDKException $e) {

            // Failed to obtain access token
            dd($e->getMessage());
        }

        if(isset($token)) {
        
            Facebook::setDefaultAccessToken($token);
            $response = Facebook::get('/me');
            $me = $response->getGraphUser();
            Session::put('name',(string) $me->getName());
            Session::put('facebook_access_token', (string) $token);
            return $next($request);
        }
        else {
           return  redirect()->route('login');
        }

    }
}
