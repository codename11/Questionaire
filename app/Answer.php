<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $fillable = [
        "name", 
        "question_id", 
    ];

    public function question(){
        return $this->belongsTo("App\Question", "question_id", "id");
    }

}
