<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'studname', 'surname1', 'surname2', 'region', 'city',
    ];
}
