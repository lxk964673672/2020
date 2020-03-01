<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected  $table = 'users';
    protected $primaryKey='id';
    public $timestamps=false;
    //黑名单
    protected $guarded=[];
}
