<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = (new Quiz)->allQuiz();
        return view('backend.quiz.index' , compact('quizzes'));
    }

    public function Question($id)
    {                                // id in quiz table = id coming from url
          $quizzes = Quiz::with('questions')->where('id',$id)->get();
          return view('backend.quiz.question' , compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $this->validateForm($request);

       $quiz = (new Quiz)->storeQuiz($data);

       return redirect()->back()->with('message' , 'Quiz Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = (new Quiz)->getQuizId($id);
        return view('backend.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $data = $this->validateForm($request);
         $quiz = (new Quiz)->updateQuiz($data,$id);

         return redirect(route('quiz.index'))->with('message' , 'Quiz Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (new Quiz)->deleteQuiz($id);
        return redirect()->back()->with('message' , 'Quiz Deleted Successfully');
    }



    // func for From Validation
    public function validateForm($request)
    {
        return $this->validate($request , [
            "name" => 'required|string',
            "description" => "required|min:3|max:500",
            "minutes" => "required|integer"
        ]);
    }
}
