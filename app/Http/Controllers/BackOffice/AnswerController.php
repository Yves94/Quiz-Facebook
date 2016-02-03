<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use \App\Answer as Answer;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller {
    public function listAnswers(Request $request)
    {
        // search case
        if ($request->isMethod('post'))
        {
            $this->validate($request,[
                'search' => 'required|alpha_num'
            ]);
            $data['answers'] = Answer::where('wording_answer', 'like', '%'.$request->search.'%')
                ->paginate(5);
        } else {
            $data['answers'] = Answer::paginate(1);
        }

        return view('BackOffice.ListAnswers', $data);
    }

    public function addAnswer(Request $request) {
        $answer = new Answer();
        if($request->isMethod('post')) {
            //dd($request->all());
            $this->validate($request,[
                'wording_answer' => 'required|max:255|unique:answers'
            ]);
            $answer->wording_answer = $request->wording_answer;
            $answer->save();
        }
        $data['answer'] = $answer;

        return view('BackOffice.addAnswer', $data);
    }

    public function editAnswer($id, Request $request)
    {

        $aAnswers = Answer::where(['id_answer' => $id])->get();
        if ($aAnswers->count() != 1) {
            echo 'not found';
            return false;
        }
        $answer = $aAnswers->first();

        if ($request->isMethod('post'))
        {
            $this->validate($request,[
                'wording_answer' => 'required|max:255|unique:answers,wording_answer,'.$answer->id_answer.',id_answer',
            ]);

            $answer->wording_answer = $request->wording_answer;
            $answer->save();

        }
        $data['answer'] = $answer;
        return view('BackOffice.editAnswer', $data);
    }

}