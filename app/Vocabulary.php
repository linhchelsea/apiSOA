<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    protected $table = 'Vocabulary';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id','VocaCategory','VocaExample','VocaExplain','LessonNumber',
                        'VocaPath','VocaPronouce','VocaRemind','VocaEn','VocaVi'];
}
