<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id';

    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
