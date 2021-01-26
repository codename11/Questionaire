<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        "name", 
        "description", 
        "status_id",
        "field_type_id"
    ];

    public function status(){
        return $this->belongsTo("App\PivotStatus",'status_id');
    }

    public function fieldType(){
        return $this->belongsTo("App\FieldType",'field_type_id');
    }

    public function answer(){
        return $this->hasMany("App\Answer", "question_id","id");
    }

}
