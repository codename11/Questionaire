<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PivotQuestionaire extends Model
{

    protected $table = 'pivot_questionaire';
    protected $fillable = [
        "questionaire_id", 
        "question_id", 
    ];

    public function questionaires(){
        return $this->hasMany("App\Questionaire_id", "questionaire_id");
    }

    public function questions(){
        return $this->hasManyThrough("App\Questionaire", "App\Question");
    }

}
