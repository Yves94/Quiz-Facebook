<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use App\Quiz as Quiz;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
   public function home() {
        $data['quiz'] = Quiz::all();
        
        return view('welcome', $data);
    }
}
