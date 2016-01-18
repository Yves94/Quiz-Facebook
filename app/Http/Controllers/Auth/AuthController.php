<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function facebook()
    {
       return Socialite::driver('facebook')->fields([
                'first_name', 'last_name', 'email', 'gender', 'birthday','age_range'
            ])->scopes([
                'email', 'user_birthday'
            ])->redirect();
    }

    public function callback()
    {
        //get the user information with facebook's driver
        $user = Socialite::driver('facebook')->fields(['first_name', 'last_name', 'email', 'gender', 'birthday','age_range'])->user();

        //create or update current_user
        $current_user = User::updateOrCreate(['email' =>$user->user['email']],[
        'last_name'     => $user->user['last_name'],
        'first_name'    => $user->user['first_name'],
        'email'         => $user->user['email'],
        'gender'        => ($user->user['gender']) == 'male' ? 0 : 1,
        'birthday'      => $user->user['birthday'],
        'age_rangs'     => $user->user['age_range']['min']
        ]);
         
        //attach Role to user   
        $admin = new Role();
        $admin = Role::where('name','=','Admin')->first();
        $current_user->attachRole($admin);
    }
}
