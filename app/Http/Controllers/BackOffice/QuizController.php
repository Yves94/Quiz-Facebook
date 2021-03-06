<?php

namespace App\Http\Controllers\BackOffice;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EditQuizRequest;
use \App\Quiz as Quiz;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

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

        return view('BackOffice.ListQuizzes',$data);
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
                'picture' => 'image',
                'start_date' => 'required',
                'end_date' => 'required'
            ]);
            //dd($request->all());
            //dd($request->start_date,strtotime($request->start_date),$request->end_date, strtotime($request->end_date));
            $validator->after(function($validator) use ($request, &$quiz) {
                // check date start < date end
                if( strtotime(str_replace('/','-',$request->start_date)) < strtotime(str_replace('/','-',$request->end_date))) {
                    $validator->errors()->add('Date','La date de début est superieur à la date de fin');
                }
                // save image
                if(!empty($request->picture) && !$request->picture->isValid()) {
                    $validator->errors()->add('Picture','L\'image n\'est pas valide');
                } else {
                    $destinationPath = base_path() . '/public/images/logo_quiz'; // upload path
                    // getting image extension
                    $extension = $request->file('picture')->getClientOriginalExtension();
                    // generate file name
                    $fileName = str_slug($request->title).'.'.$extension; // renameing image
                    // assign file name to the quiz
                    $quiz->picture = $fileName;
                    // move tmp for good path
                    $request->file('picture')->move($destinationPath, $fileName);
                }
            });

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = Auth::user(); //get user logged
            $quiz->title = $request->title;
            $quiz->slug = str_slug($request->title);
            $quiz->nb_questions = $request->nb_questions;
            $quiz->summary = $request->summary;
            $quiz->start_date = \DateTime::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $quiz->end_date = \DateTime::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
            $quiz->color = $request->color;
            $quiz->creator = $user->id_user;
            $quiz->save();

            Session::flash('flash_message', 'Quiz ajouté');
            return redirect()->route('admin_quiz_list');
        }

        $data['quiz'] = $quiz;

        return view('BackOffice.addQuiz', $data);
    }

    public function editQuiz($slug, Request $request)
    {
        $destinationPath = base_path() . '/public/images/logo_quiz'; // upload path

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
                'start_date' => 'required',
                'end_date' => 'required',
                'picture' => 'image',
            ]);

            $validator->after(function($validator) use ($request, &$quiz, $destinationPath) {
                // check date start < date end
                if( strtotime(str_replace('/','_',$request->start_date)) < strtotime(str_replace('/','_',$request->end_date))) {
                    $validator->errors()->add('Date','La date de début est superieur à la date de fin');
                }
                // save image
                if(!empty($request->picture) && $request->picture->isValid()) {
                    // getting image extension
                    $extension = $request->file('picture')->getClientOriginalExtension();
                    // generate file name
                    $fileName = str_slug($request->title).'.'.$extension; // renameing image
                    // assign file name to the quiz
                    $quiz->picture = $fileName;
                    // move tmp for good path
                    $request->file('picture')->move($destinationPath, $fileName);
                }
            });

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            /*
             * If the quiz have a picture
             * and we update the title
             * without the picture, we need to update the title file
             * because title file == slug
             */
            if($request->title != $quiz->title // if change title
                && empty($request->picture) // and no picture in update form
                && !empty($quiz->picture)) { // and quiz have an old picture
                $array = explode('.',$quiz->picture);
                $newFileName = str_slug($request->title).'.'.end($array);
                File::move($destinationPath.'/'.$quiz->picture, $destinationPath.'/'.$newFileName);
                $quiz->picture = $newFileName;

            }
            $quiz->title = $request->title;
            $quiz->slug = str_slug($request->title);
            $quiz->nb_questions = $request->nb_questions;
            $quiz->summary = $request->summary;
            $quiz->start_date = \DateTime::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $quiz->end_date = \DateTime::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
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