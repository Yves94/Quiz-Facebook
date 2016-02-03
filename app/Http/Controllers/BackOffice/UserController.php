<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use \App\User as User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    public function listUsers(Request $request)
    {
        // search case
        if ($request->isMethod('post'))
        {
            $this->validate($request,[
                'search' => 'required|alpha_num'
            ]);
            $data['users'] = User::where('last_name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%')
                ->orWhere('first_name', 'like', '%'.$request->search.'%')
                ->orWhere('id_user', 'like', '%'.$request->search.'%')
                ->paginate(5);
        } else {
            $data['users'] = User::paginate(1);
        }

        return view('BackOffice.ListUsers', $data);
    }

    public function addUser(Request $request) {
        $user = new User();
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'first_name' => 'required|max:255|alpha',
                'last_name' => 'required|max:255|alpha',
                'email' => 'required|max:255|unique:users,email,'.$user->id_user.',id_user',
                'gender' => 'required|integer',
                'birthday' => 'required|date_format:d/m/Y'
            ]);
            $birthday_date = date("Y-m-d",strtotime(str_replace('/', '-', $request->birthday)));
            $age = $this->getDiffDateWithNow($birthday_date)->y;
            // call back
            $validator->after(function($validator) use ($age) {
                // check age
                if($age < 18 ) {
                    $validator->errors()->add('birthday', 'Vous n\'avez pas 18 ans');
                }
            });
            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();
            
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name ;
            $user->email = $request->email ;
            $user->age_rangs = $age ;
            $user->gender = $request->gender ;
            $user->birthday = \DateTime::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');

            $user->save();
            return redirect()->back()->withErrors($validator);


        }
        $data['user'] = $user;

        return view('BackOffice.addUser', $data);
    }

    public function editUser($id, Request $request)
    {

        $aUsers = User::where(['id_user' => $id])->get();
        if ($aUsers->count() != 1) {
            echo 'not found';
            return false;
        }
        $user = $aUsers->first();

        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'first_name' => 'required|max:255|alpha',
                'last_name' => 'required|max:255|alpha',
                'email' => 'required|max:255|unique:users,email,'.$user->id_user.',id_user',
                'gender' => 'required|integer',
                'birthday' => 'required|date_format:d/m/Y'
            ]);
            $birthday_date = date("Y-m-d",strtotime(str_replace('/', '-', $request->birthday)));
            $age = $this->getDiffDateWithNow($birthday_date)->y;
            // call back
            $validator->after(function($validator) use ($age) {
                // check age
                if($age < 18 ) {
                    $validator->errors()->add('birthday', 'Vous n\'avez pas 18 ans');
                }
            });
            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name ;
            $user->email = $request->email ;
            $user->age_rangs = $age ;
            $user->gender = $request->gender ;
            $user->birthday = \DateTime::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');


            $user->save();
            return redirect()->back()->withErrors($validator);


        }
        $data['user'] = $user;
        return view('BackOffice.editUser', $data);
    }

    public function getDiffDateWithNow($date) {
        $date1 = new \DateTime($date);
        $date2 = new \DateTime();
        $diff = $date1->diff($date2);

        return $diff;
    }


}