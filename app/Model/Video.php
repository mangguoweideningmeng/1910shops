<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table="p_video";
    protected $primaryKey="id";
    public $timestamps=false;
    protected $guarded=[];
}
