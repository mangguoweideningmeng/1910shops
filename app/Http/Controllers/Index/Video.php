<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Video as video_model;
 
class Video extends Controller
{
    public function codec()
    {
        //获取状态为 0 的视频
        $list = video_model::where(['status'=>0])->orderBy("id","desc")->get();
       // echo '<pre>';print_r($list);
        echo " 开始转码 ： ". date("Y-m-d H:i:s");echo '</br>';

        if($list)
        {
            foreach($list as $k=>$v)
            {
                $goods_id = $v->goods_id;       //商品id

                //开始转码
                video_model::where(['goods_id'=>$goods_id])->update(['status'=>1]);      //更新转码状态为 1  开始转码


                //fastcgi_finish_request();       // ???
                //转码
                $video_file = $v->path;                 // 原视频文件
                $video_out_path = 'm3u8/';      
                $m3u8_file = $video_out_path.$goods_id.'.m3u8';         
                $ts_file = $video_out_path.$goods_id.'_%03d.ts';   
                $ts_second = 20;                   

                $cmd = "cd storage && ffmpeg -i {$video_file} -codec:v libx264 -codec:a mp3 -map 0 -f ssegment -segment_format mpegts -segment_list $m3u8_file -segment_time $ts_second $ts_file";

                shell_exec($cmd);
                video_model::where(['goods_id'=>$goods_id])->update(['status'=>2,'m3u8'=>$m3u8_file]);  //更新转码状态为完成

            }
        }

    }
}
