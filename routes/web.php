<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//首页
Route::get('/','Index\GoodsController@goodsindex')->middleware('CheckMoblie','CheckLogin');
// Route::get('/','Index\GoodsController@goodsindex');
//测试
Route::get('/test','Index\LoginController@test');
//个人中心
Route::prefix("/index")->middleware('CheckLogin')->group(function (){
    //我的订单
    Route::get("/order","Index\MyorderController@order");
    //我的评论
    Route::get("/desc","Index\MyorderController@desc");
    //我的收藏
    Route::get("/collect","Index\MyorderController@collect");
});
//前台用户
Route::prefix("index")->group(function () {
    //登录
    Route::get('/login', 'Index\LoginController@login');
    Route::post('/login_do', 'Index\LoginController@login_do');
    //注册
    Route::get('/reg', 'Index\LoginController@reg');
    Route::any('/reg_do', 'Index\LoginController@reg_do');
});
//前台
//前台商品
Route::prefix('index')->group(function(){

    //商品列表
    Route::get('/goodsshop','Index\GoodsController@goodsshop');
    //详情页
    Route::get('/goodslists/{id}','Index\GoodsController@goodslists');
    //评论
    Route::any('/pinglun','Index\GoodsController@pinglun');
    //收藏变为未收藏
    Route::any('/shoucang','Index\GoodsController@shoucang');
    //未收藏变为收藏
    Route::any('/shoucang2','Index\GoodsController@shoucang2');
    //加入购物车
    Route::any('/addCart','Index\GoodsController@addCart');
});
//前台购物车
Route::prefix("/index")->middleware('CheckLogin')->group(function(){
    Route::any("/gid","Index\CartController@gid");//点击照片存redis
    Route::any("/gids","Index\CartController@gids");//点击照片清除redis
    Route::any("/order","Index\CartController@order");//生成订单
    Route::any("/orderindex","Index\CartController@orderindex");//生成订单
    //购车列表首页
    Route::get('/cart','Index\CartController@cart');
    //单删
    Route::post('/cartDel','Index\CartController@cartDel');
    //测试
    Route::any('/test','Index\CartController@test');
    //重新获取小计
    Route::any('/toPrice','Index\CartController@toPrice');
});



//后台
//后台管理员
Route::prefix("/admin")->group(function (){
    Route::get("/reg","Admin\LoginController@reg");   //注册
    Route::post("/regdo","Admin\LoginController@regdo");   //注册执行
    Route::get("/login","Admin\LoginController@login");     //登录
    Route::post("/logindo","Admin\LoginController@logindo");   // 登录执行
});

//后台商品列表
Route::prefix("/admin")->middleware("islogin")->group(function(){
    //商品列表
    Route::get('/goodsindex','Admin\GoodsController@index');
    Route::get('/goodscreate','Admin\GoodsController@create');
    Route::post('/goodsstore','Admin\GoodsController@store');
    Route::get('/goodsdelete/{id}','Admin\GoodsController@delete');
    Route::get('/goodsedit/{id}','Admin\GoodsController@edit');
    Route::post('/goodsupdate/{id}','Admin\GoodsController@update');
});

//后台商品分类
Route::prefix("/admin")->middleware("islogin")->group(function(){
   Route::get('/category_index','Admin\CategoryController@index');   //展示
   Route::get('/category_create','Admin\CategoryController@create');   //试图
    Route::post('/category_store','Admin\CategoryController@store');   //试图
    Route::get('/category_destory/{id}','Admin\CategoryController@destroy');//删除
    Route::get('/category_edit/{id}','Admin\CategoryController@edit');//修改视图
    Route::post('/category_update/{id}','Admin\CategoryController@update');//修改视图
});
//后台用户
Route::prefix("/admin")->middleware("islogin")->group(function(){
    Route::get('/userindex','Admin\UserController@userindex');//用户展示
    Route::get('delete/{id}','Admin\UserController@delete');//删除
    Route::get('edit/{id}','Admin\UserController@edit');//编辑展示
    Route::post('update/{id}','Admin\UserController@update');//编辑执行
});
Route::get('ks/login','Admin\KsController@login');//登录
Route::post('ks/loginDo','Admin\KsController@loginDo');//登录执行
Route::get('ks/reg','Admin\KsController@reg');//注册
Route::post('ks/regDo','Admin\KsController@regDo');//注册执行
Route::middleware("kslogin")->get('ks/index','Admin\KsController@index');//主页
Route::middleware("kslogin")->get('ks/create','Admin\KsController@create');//发布新闻
Route::middleware("kslogin")->any('ks/store','Admin\KsController@store');//发布新闻执行
Route::middleware("kslogin")->any('ks/stores','Admin\KsController@stores');//发布新闻执行

Route::get('pay/{id}','Index\MyorderController@pay');
Route::get('returnurl','Index\MyorderController@returnurl');
Route::get("index/quit","Index\LoginController@quit");//销毁




Route::get('/reg/sendSMS', 'Index\LoginController@sendSMS'); //发送短信验证码
Route::get('/reg/session', 'Index\LoginController@session'); //发送短信验证码

Route::get("codec","Index\Video@codec");//销毁
Route::any('/codec','Index\Video@codec'); //aaa

Route::any('/githubLogin','Index\LoginController@githubLogin');
Route::any('/git','Index\O@githubLogin');




Route::get('/chat','Chat\IndexController@index');           //聊天室