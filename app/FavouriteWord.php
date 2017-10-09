<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavouriteWord extends Model
{
    protected $table = 'FavoriteWords';
    protected $fillable = ['IdUser','IdVocabulary'];
    public $timestamps = false;
}
