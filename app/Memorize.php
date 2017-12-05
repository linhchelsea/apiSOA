<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memorize extends Model
{
    protected $table = 'Memorize';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id','IdUser','IdVocabulary','Content'];
    public $timestamps = false;
}
