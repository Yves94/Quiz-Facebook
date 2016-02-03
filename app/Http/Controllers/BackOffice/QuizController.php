<?php

namespace App\Http\Controllers\BackOffice;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EditQuizRequest;
use \App\Quiz as Quiz;
use Illuminate\Http\Request;
use App\Http\Requests;

class QuizController extends Controller
{
    public function listQuizzes(Request $request)
    {
        // search case
        if ($request->isMethod('post'))
        {
            $this->validate($request,[
                'search' => 'required|alpha_num'
            ]);
            $data['quizzes'] = \App\Quiz::where('title', 'like', '%'.$request->search.'%')
                                ->orWhere('summary', 'like', '%'.$request->search.'%')
                                ->paginate(5);
        } else {
            $data['quizzes'] = \App\Quiz::with('creator')->paginate(5);
        }

    }

    public function home() {
        $data['quiz'] = Quiz::all();
        
        return view('welcome', $data);
    }


    public function addQuiz(Request $request)
    {
        $quiz = new Quiz();

        if ($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255|unique:quiz',
                'nb_questions' => 'required|int',
                'summary' => 'required',
                'picture' => 'required',
                'start_date' => 'required',
                'end_date' => 'required'
            ]);
            //dd($request->start_date,strtotime($request->start_date),$request->end_date, strtotime($request->end_date));
            $validator->after(function($validator) use ($request) {

                if( strtotime(str_replace('/','_',$request->start_date)) < strtotime(str_replace('/','_',$request->end_date))) {
                    $validator->errors()->add('Date','La date de début est superieur à la date de fin');
                }
            });

            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();


            $quiz->title = $request->title;
            $quiz->slug = str_slug($request->title);
            $quiz->nb_questions = $request->nb_questions;
            $quiz->summary = $request->summary;
            $quiz->picture = $request->picture;
            $quiz->start_date = \DateTime::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $quiz->end_date = \DateTime::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
            $quiz->title = $request->title;
            $quiz->color = $request->color;
            $quiz->creator = 1;
            $quiz->save();

            Session::flash('flash_message', 'Quiz ajouté');
            return redirect()->route('admin_quiz_list');
        }

        $data['quiz'] = $quiz;

        return view('BackOffice.addQuiz', $data);
    }

    public function editQuiz($slug, Request $request)
    {

        $aQuiz = Quiz::where(['slug' => $slug])->get();
        if ($aQuiz->count() != 1) {
            echo 'not found';
            return false;
        }
        $quiz = $aQuiz->first();
        //dd($quiz);
        if ($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255|unique:quiz,title,'.$quiz->id_quiz.',id_quiz',
                'nb_questions' => 'required|int',
                'summary' => 'required',
                'picture' => 'required',
                'start_date' => 'required',
                'end_date' => 'required'
            ]);


            $validator->after(function($validator) use ($request) {

                if( strtotime($request->start_date) > strtotime($request->end_date)) {
                    $validator->errors()->add('Date','La date de début est superieur à la date de fin');
                }
            });

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $quiz->title = $request->title;
            $quiz->slug = str_slug($request->title);
            $quiz->nb_questions = $request->nb_questions;
            $quiz->summary = $request->summary;
            $quiz->picture = $request->picture;
            $quiz->start_date = \DateTime::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $quiz->end_date = \DateTime::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
            $quiz->title = $request->title;
            $quiz->color = $request->color;
            $quiz->save();

            Session::flash('flash_message', 'Quiz modifié');
            return redirect()->route('admin_quiz_list');
        }
        $data['quiz'] = $quiz;
        return view('BackOffice.editQuiz', $data);
    }

    public function entrants($slug)
    {
        $entrants = Quiz::with('users')->where(['slug' => $slug])->get()->first();
        $data['entrants'] = $entrants->users;
        return view('BackOffice.entrantQuiz', $data);

    }


    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);

        $quiz->delete();

        Session::flash('flash_message', 'Quiz supprimé');

        return redirect()->route('admin_quiz_list');

    }
}