<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table='news';
    protected $primaryKey='n_id'; 
    public $timestamps=false;

    //黑名单
    protected $guarded=[];
}
