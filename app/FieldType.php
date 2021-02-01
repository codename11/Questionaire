<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldType extends Model
{
    protected $table = 'field_type';
    protected $fillable = [
        'name'
    ];

    public function user(){
        return $this->belongsTo("App\User", 'user_id',"id");
    }

    public function question(){
        return $this->belongsTo("App\Question", 'question_id', "field_type_id");
    }
    
}
