<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
   protected $table = 'Sentence';
   protected $primaryKey = 'Id';
   protected $fillable = ['EngSentence','VieSentence'];
   public $timestamps = false;
}
