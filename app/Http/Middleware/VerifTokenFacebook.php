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
            $response = Facebook::get('/me?fields=id,name,gender,age_range,email,birthday');
            $me = $response->getGraphUser();
           
            $current_user = User::updateOrCreate(['email' =>$me->item['email']],[
            'last_name'     => $me->item['last_name'],
            'first_name'    => $me->item['first_name'],
            'email'         => $me->item['email'],
            'gender'        => ($me->item['gender']) == 'male' ? 0 : 1,
            'birthday'      => $me->item['birthday'],
            'age_rangs'     => $me->item['age_range']['min']
            ]);
             dd($current_user);
            Session::put('name',(string) $me->getName());
            Session::put('facebook_access_token', (string) $token);
            return $next($request);
        }
        else {
           return  redirect()->route('login');
        }

    }
}
