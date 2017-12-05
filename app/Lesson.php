<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'Lesson';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id','LessonPathImage','LessonNameEn','LessonNameVi'];
    public $timestamps = false;
}
