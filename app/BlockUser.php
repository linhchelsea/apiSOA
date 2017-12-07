<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockUser extends Model
{
    protected $table = 'BlockUser';
    protected $primaryKey = 'id';
    protected $fillable = ['idUser','reason'];
    public $timestamps = false;
}
