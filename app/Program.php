<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['hash','name','uid','views'];
    protected $table = 'program';
}
