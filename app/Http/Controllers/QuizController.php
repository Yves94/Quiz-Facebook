<?php

namespace App\Http\Controllers;


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

    public function add()
    {
        $aQuiz = ['title' => 'first Quiz',
                    'slug' => 'firstQuiz',
                    'nb_question' => 1,
                    'summary' => "dzeqf",
                    'picture' => "img.jpg",
                    'start_date' => "fzqefqz",
                    'end_start' => 2016-12-12];
        $quiz = \App\Quiz::create($aQuiz);
        var_dump($quiz);
        die('ok');
        return view('admin.index');
    }
}