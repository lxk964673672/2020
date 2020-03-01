<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table='goods';
    protected $primaryKey='id'; 
    public $timestamps=false;

    //黑名单
    protected $guarded=[];
} 
