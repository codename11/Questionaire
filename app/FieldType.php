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
        return $this->belongsTo("App\User",'user_id');
    }
    
}
