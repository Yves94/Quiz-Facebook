<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditQuizRequest;
use \App\Quiz as Quiz;
use Illuminate\Http\Request;
use App\Http\Requests;

class QuizController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function listQuizzes()
    {
        $quizzes = Quiz::with('users')->where(['id_quiz' => 1])->get()->first();
        dd($quizzes->users);
        /*foreach ($quizzes as $quiz) {
            foreach ($quiz->users()->get() as $user) {
                var_dump($user->toArray());
            }
        }*/
        $data['quizzes'] = \App\Quiz::with('users')->get();
        return view('BackOffice.ListQuizzes', $data);

    }

    public function addQuiz()
    {

        $aQuiz = ['title' => 'first Quiz',
            'slug' => 'firstQuiz',
            'nb_question' => 1,
            'summary' => "dzeqf",
            'picture' => "img.jpg"];
        $quiz = \App\Quiz::create($aQuiz);

        die('ok');
        return view('admin.index');
    }

    public function editQuiz($slug, Request $request)
    {

        // if post -> check form
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'slug' => 'required|unique:posts|max:255',
            ]);
        }


        $aQuiz = Quiz::where(['slug' => $slug])->get();
        if ($aQuiz->count() != 1) {
            echo 'not found';
            return false;
        }
        $quiz = $aQuiz->first();

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