<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use \App\Question as Question;
use \App\Category as Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller {
    public function listQuestions(Request $request)
    {
        // search case
        if ($request->isMethod('post'))
        {
            $this->validate($request,[
                'search' => 'required|alpha_num'
            ]);
            $data['questions'] = Question::where('wording_question', 'like', '%'.$request->search.'%')
                ->paginate(5);
        } else {
            $data['questions'] = Question::with('answers','categories')->paginate(1);
        }

        return view('BackOffice.ListQuestions', $data);
    }


    public function addQuestion(Request $request) {
        $question = new Question();
        if($request->isMethod('post')) {
            //dd($request->all());
            $this->validate($request, [
                'wording_question' => 'required|max:255|alpha_num',
                'categories' => 'required|max:255|alpha_num',
                'answer1' => 'required|alpha_num|max:255',
                'answer2' => 'required|alpha_num|max:255',
                'answer3' => 'required|alpha_num|max:255',
                'answer4' => 'required|alpha_num|max:255',
                'good_answer' => 'required|integer'
            ]);

            dd($request->all());
            $question->wording_question = $request->question;
            $question->save();

            $question->categories()->sync($request->categories);

            Session::flash('flash_message', 'Question modifié');
            return redirect()->route('admin_question_list');
        }
        $data['question'] = $question;

        $data['categories'] = DB::table('categories')->lists('wording_category','id_category');
        //dd($data);
        return view('BackOffice.addQuestion', $data);
    }

    public function editQuestion($id, Request $request)
    {

        $aQuestion = Question::where(['id_question' => $id])->get();
        if ($aQuestion->count() != 1) {
            echo 'not found';
            return false;
        }
        $question = $aQuestion->first();

        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'wording_question' => 'required|max:255|alpha_num',
                'categories' => 'required|max:255|alpha_num',
                'answer1' => 'required|alpha_num|max:255',
                'answer2' => 'required|alpha_num|max:255',
                'answer3' => 'required|alpha_num|max:255',
                'answer4' => 'required|alpha_num|max:255',
            ]);

            dd($request->all());

            $question->wording_question = $request->wording_question;
            $question->save();
            $question->categories()->sync($request->categories);

            Session::flash('flash_message', 'Question modifié');
            return redirect()->route('admin_question_list');
        }

        $data['question'] = $question;
        $data['categories'] = DB::table('categories')->lists('wording_category','id_category');
        $data['categoriesSelected'] = $question->getCategoriesIdToArray();
        return view('BackOffice.editQuestion', $data);
    }

    public function deleteQuestion($id)
    {
        $question = Question::findOrFail($id);

        $question->delete();

        Session::flash('flash_message', 'Question supprimé');

        return redirect()->route('admin_quiz_list');

    }
}