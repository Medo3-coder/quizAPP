<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;


class Answer extends Model
{
    protected $fillable = ['question_id' , 'answer' , 'is_correct'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function storeAnswer($data , $question)
    {
        foreach($data['options'] as $key =>$option)
        {
             $is_correct = false ;
             if($key == $data['correct_answer'])
             {
                 $is_correct = true ;
             }
             $answer = Answer::create([
                 'question_id' => $question->id,
                 'answer'      =>$option,      // store the 4 values one by one
                 'is_correct'  =>$is_correct,
             ]);
        }
    }

    public function updateAnswer($data , $question)
    {
        $this->deleteAnswer($question->id);      // answer deleted
        $this->storeAnswer($data , $question);   // to store new answer
    }

    // to delete all 4 options in DB
    public function deleteAnswer($questionId)
    {
        Answer::where('question_id' , $questionId)->delete();
            // compare (in the table) match the request then delete
    }
}
