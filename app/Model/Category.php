<?php

namespace App\Model;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use DB;
class Category extends Model
{
    use ModelTree;

    public $table="category";
    public $timestamps=false;
    protected $primaryKey="cate_id";
    public $guarded=[];

    public static function getcateinfo(){
        $cateinfo=DB::table('category')->get();
        $result=self::list_level($cateinfo,$parent_id=0,$level=0);
        return $result;
    }


    public static function list_level($cateinfo,$parent_id,$level){
        static $array =array();
        foreach($cateinfo as $k => $v){
            if($parent_id == $v->parent_id){
                $v->level = $level;

                $array[] = $v;

                self::list_level($cateinfo,$v->cate_id,$level+1);
            }
        }

        return $array;
    }

    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');        //父级分类
        $this->setOrderColumn('cate_id');        //排序字段
        $this->setTitleColumn('cate_name');
    }
}
