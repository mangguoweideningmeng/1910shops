<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Xw extends Model
{
    //表名
    protected $table = 'xw';
    //主键
    protected $primaryKey = 'xw_id';
    //黑名单  用create添加的时候加黑名单
    protected $guarded = [];
}
