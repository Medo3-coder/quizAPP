<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $questions = (new Question)->getQuestions();
      return view('backend.question.index' , compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizes = (new Quiz)->allQuiz();
        return view('backend.question.create', compact('quizes'));
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
        $question = (new Question)->storeQuestion($data);
        $Answer = (new Answer)->storeAnswer($data , $question);
        return redirect()->route('question.create')->with('message','Question Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = (new Question)->getQuestionById($id);
        return view('backend.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = (new Question)->findQuestion($id);
        return view('backend.question.edit' , compact('question'));
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
        $question = (new Question)->updateQuestion($id , $request);
        $answer =  (new Answer)->updateAnswer($request , $question);
        return redirect()->route('question.show',$id)->with('message' , 'Question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (new Answer)->deleteAnswer($id);
        (new Question)->deleteQuestion($id);
        return redirect()->route('question.index')->with('message', 'Question Deleted Successfully');
    }

    //from validation
    public function validateForm($request)
    {
       return $this->validate($request , [
           'quiz'=>'required',
           'question'=>'required|min:3',
           'options'=>'bail|required|array|min:3',     // bail: if first requriemnt not satisfy then ignore the rest of condition
           'options.*'=>'bail|required|string|distinct',  // * : for all 4 options
           'correct_answer'=>'required'
       ]);
    }

}
