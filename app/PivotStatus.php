<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PivotStatus extends Model
{
    protected $table = 'pivot_status';
    protected $fillable = [
        'name'
    ];
}
