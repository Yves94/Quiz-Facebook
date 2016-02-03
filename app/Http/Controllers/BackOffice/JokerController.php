<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use \App\Joker as Joker;
use Illuminate\Support\Facades\DB;

class JokerController extends Controller {
    public function listJokers(Request $request)
    {
        // search case
        if ($request->isMethod('post'))
        {
            $this->validate($request,[
                'search' => 'required|alpha_num'
            ]);
            $data['joker'] = Joker::where('wording_joker', 'like', '%'.$request->search.'%')
                ->paginate(5);
        } else {
            $data['jokers'] = Joker::paginate(1);
        }

        return view('BackOffice.ListJokers', $data);
    }
}