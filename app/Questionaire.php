<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionaire extends Model
{
    protected $table = 'questionaires';
    protected $fillable = [
        "name", 
        "description", 
        "user_id",
        "status_id"
    ];

    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }

    public function status(){
        return $this->belongsTo("App\PivotStatus",'status_id');
    }

    public function questions(){
        return $this->hasMany("App\PivotQuestionaire");
    }

}
