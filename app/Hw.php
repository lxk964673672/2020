<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hw extends Model
{
    protected $table='hw';
    protected $primaryKey='id'; 
    public $timestamps=false;

    //黑名单
    protected $guarded=[];
}
