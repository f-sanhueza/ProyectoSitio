<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = [
        'names', 'surnames', 'department', 'specialty',
    ];
}
