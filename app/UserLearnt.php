<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLearnt extends Model
{
    protected $table = 'UserLearnt';
    protected $fillable =['IdUser','IdLesson','LessonPoint'];
    public $timestamps = false;
}
