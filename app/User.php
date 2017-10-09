<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'Users';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id','Username', 'Password', 'Fullname','Email','Level','TotalPoint'];
    public $timestamps = false;
}
