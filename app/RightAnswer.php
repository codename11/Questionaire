<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RightAnswer extends Model
{
    protected $table = 'right_answers';
    protected $fillable = [
        "answer_id",
        "user_id"
    ];

    public function question(){
        return $this->belongsTo("App\Question", "question_id", "id");
    }

    public function user(){
        return $this->belongsTo("App\User",'user_id');
    }

}
