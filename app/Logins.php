<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logins extends Model
{
    protected $table='dl';
    protected $primaryKey='uid'; 
    public $timestamps=false;

    //黑名单
    protected $guarded=[];
} 
