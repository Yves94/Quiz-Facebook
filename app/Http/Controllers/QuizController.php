<?php

namespace App\Http\Controllers;

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
        $quizzes = Quiz::with('users')->get()->toArray();

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

    public function showQuiz($slug)
    {

        $aQuiz = Quiz::where(['slug' => 'test'])->get();
        if ($aQuiz->count() != 1) {
            echo 'not found';
            return false;
        }
        $quiz = $aQuiz->first();
        echo $quiz;

        die;
    }

    public function participants()
    {

    }


    public function deleteQuiz()
    {

    }
}