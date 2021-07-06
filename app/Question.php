<?php

namespace App;
use App\Answer;
use App\Quiz;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   protected $fillable = [ 'question' , 'quiz_id' ];

   private $limit = 10 ;   // limit to pagiantion

   private $order = 'DESC';  // to order the question

   public function answers()
   {
       return $this->hasMany(Answer::class);
   }

   public function quiz()
   {
       return $this->belongsTo(Quiz::class);
   }

   public function storeQuestion($data)
   {
   // database branch = data from the form
     $data['quiz_id'] = $data['quiz'];
     return Question::create($data);
   }

   //get all Questions

   public function getQuestions()
   {
        return Question::orderBy('created_at',$this->order)->with('quiz')->paginate($this->limit);
   }

   //find Questions by Id

   public function getQuestionById($id)
   {
       return Question::find($id);
   }



    //find Questions by Id to Edit

    public function findQuestion($id)
    {
        return Question::find($id);
    }

    public function updateQuestion($id,$data)
    {
        $question = Question::find($id);
        $question->question = $data['question'];
        $question->quiz_id  = $data['quiz'];
        $question->save();
        return $question;
    }


    //to delete Questions
    public function deleteQuestion($id)
    {
           Question::find($id)->delete();
           //or
           //Question::where('id',$id)->delete();
    }


}
