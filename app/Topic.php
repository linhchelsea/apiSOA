<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'Topic';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id','EngName','VieName'];
    public $timestamps = false;
}
