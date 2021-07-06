<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\User;
use App\Result;



class Quiz extends Model
{
    protected $fillable = [ 'name' , 'description' , 'minutes'] ;

    //relation method
    public function questions()
    {
        return $this->hasMany(Question::class);   // quiz hasMany Question
    }

    // i can assign this quiz to many users
   public function users(){
        return $this->belongsTomany(User::class,'quiz_user');
    }



    //To store Quiz
    public function storeQuiz($data)
    {
        return Quiz::create($data);
    }

    //To get All Quiz
    public function allQuiz()
    {
        return Quiz::all();
    }

    //find the quiz i want to update
    public function getQuizId($id)
    {
        return Quiz::find($id);
    }

    //find id and update the data
    public function updateQuiz($data , $id)
    {
        return Quiz::find($id)->update($data);
    }

    //Delete
    public function deleteQuiz($id)
    {
       return Quiz::find($id)->delete();
    }

    //assign exam to user

    public function assignExam($data){
     //   quiz_id is coming from the form
        $quizId = $data['quiz_id'];
        $quiz = Quiz::find($quizId);

    //   user_id is coming from the form
        $userId = $data['user_id'];
        return $quiz->users()->syncWithoutDetaching($userId);  // no duplicate data
    }

    //If you do not want to detach existing IDs, you may use the syncWithoutDetaching method



    // to return all id that exists in result table
    // all quiz that played by user
    public function hasQuizAttempted()
    {
        $attemptQuiz = [];
        $authUser = auth()->user()->id ;
        $user = Result::where('user_id' , $authUser)->get();
        foreach ($user as $u )
        {
            array_push($attemptQuiz , $u->quiz_id);
        }
        return $attemptQuiz ;
    }
}
