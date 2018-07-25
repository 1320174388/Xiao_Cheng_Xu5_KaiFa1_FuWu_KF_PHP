<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  talk_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/29 17:20
 *  文件描述 :  客服功能模块接口路由
 *  历史记录 :  -----------------------
 */

// -------------------------------------------
// : 前台接口，用户提问问题接口，自动回复信息接口
// -------------------------------------------

Route::group('v1/talk_module/', function(){


});


// +------------------------------------------------------
// : 路由分组：v1/talk_module/ 中间件：Right_v3_IsAdmin
// +------------------------------------------------------
Route::group('v1/talk_module/', function(){

    // ---- 自动回复 ----

    /**
     * 路由名称: replys_route
     * 传值方式: POST
     * 路由功能: 添加自动回复信息
     */
    Route::post(
        'replys_route',
        'talk_module/v1.controller.ReplyController/replyPost'
    );
    /**
     * 路由名称: replys_route
     * 传值方式: GET
     * 路由功能: 获取自动回复信息
     */
    Route::post(
        'replys_route',
        'talk_module/v1.controller.ReplyController/replyGet'
    );

})->middleware('Right_v3_IsAdmin');

