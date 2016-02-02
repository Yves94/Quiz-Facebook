<?php

namespace App\Http\Controllers\BackOffice;

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
            $data['quizzes'] = \App\Quiz::with('creator')->paginate(1);
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
            $this->validate($request, [
                'title' => 'required|max:255|unique:quiz',
                'slug' => 'required|unique:quiz,id_quiz|max:255',
                'nb_questions' => 'required|int',
                'summary' => 'required',
                'picture' => 'required',
                'start_date' => 'required',
                'end_start' => 'required'
            ]);

            $quiz->title = $request->title;
            $quiz->slug = $request->slug;
            $quiz->nb_questions = $request->nb_questions;
            $quiz->summary = $request->summary;
            $quiz->picture = $request->picture;
            $quiz->start_date = $request->start_date;
            $quiz->end_start = $request->end_start;
            $quiz->title = $request->title;
            $quiz->color = $request->color;
            $quiz->save();
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

        if ($request->isMethod('post'))
        {


            $this->validate($request, [
                'title' => 'required|max:255|unique:quiz,title,'.$quiz->id_quiz.',id_quiz',
                'slug' => 'required|unique:quiz,slug,'.$quiz->id_quiz.',id_quiz|max:255',
                'nb_questions' => 'required|int',
                'summary' => 'required',
                'picture' => 'required',
                'start_date' => 'required',
                'end_start' => 'required'
            ]);

            $quiz->title = $request->title;
            $quiz->slug = $request->slug;
            $quiz->nb_questions = $request->nb_questions;
            $quiz->summary = $request->summary;
            $quiz->picture = $request->picture;


            $quiz->start_date = \DateTime::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $quiz->end_start = \DateTime::createFromFormat('d/m/Y', $request->end_start)->format('Y-m-d');
            $quiz->title = $request->title;
            $quiz->color = $request->color;
            $quiz->save();

        }

        $data['quiz'] = $quiz;
        return view('BackOffice.editQuiz', $data);
    }

    public function participants()
    {

    }


    public function deleteQuiz()
    {

    }
}