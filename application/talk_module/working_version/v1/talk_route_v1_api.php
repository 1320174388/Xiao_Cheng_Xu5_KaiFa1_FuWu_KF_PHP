<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  talk_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/29 17:20
 *  文件描述 :  客服功能模块接口路由
 *  历史记录 :  -----------------------
 */

// +------------------------------------------------------
// : 前台接口，传值方式：GET，功能：返回自动回复信息接口。
// +------------------------------------------------------
Route::get(
    'v1/talk_module/replys_route',
    'talk_module/v1.controller.ReplysController/replysValue'
);

// +------------------------------------------------------
// : 前台接口，传值方式：POST，功能：用户发起提问信息的接口。
// : 前台接口，传值方式：GET， 功能：用户获取自己所有的提问信息。
// : 前台接口，传值方式：GET， 功能：用户获取自己提问信息的内容。
// : 前台接口，传值方式：POST，功能：用户后续发送提问信息的接口。
// +------------------------------------------------------
Route::post(
    'v1/talk_module/problem_value',
    'talk_module/v1.controller.ProblemController/problemValue'
);
Route::get(
    'v1/talk_module/leaving_route',
    'talk_module/v1.controller.LeavingsController/leavingsList'
);
Route::get(
    'v1/talk_module/message_route',
    'talk_module/v1.controller.MessagesController/messageList'
);
Route::post(
    'v1/talk_module/problem_content',
    'talk_module/v1.controller.ProblemController/problemContent'
);

// +------------------------------------------------------
// : 路由分组：v1/talk_module/ 中间件：Right_v3_IsAdmin
// +------------------------------------------------------
Route::group('v1/talk_module/', function(){
    /**
     * 传值方式：POST，  功能：添加自动回复信息接口。
     * 传值方式：GET，   功能：获取所有自动回复信息接口。
     * 传值方式：PUT，   功能：修改自动回复信息接口。
     * 传值方式：DELETE，功能：删除自动回复信息接口。
     * 传值方式：POST，  功能：客服回复信息接口。
     * 传值方式：PUT，   功能：确定处理信息接口。
     */
    Route::post(
        'replys_route/:token',
        'talk_module/v1.controller.ReplysController/replysAdd'
    );
    Route::get(
        'replys_route/:token',
        'talk_module/v1.controller.ReplysController/replysList'
    );
    Route::put(
        'replys_route/:token',
        'talk_module/v1.controller.ReplysController/replysEdit'
    );
    Route::delete(
        'replys_route/:token',
        'talk_module/v1.controller.ReplysController/replysDel'
    );
    Route::post(
        'admin_content/:token',
        'talk_module/v1.controller.ProblemController/adminContent'
    );
    Route::put(
        'acknowledgement/:token',
        'talk_module/v1.controller.ProblemController/acknowledgement'
    );
})->middleware('Right_v3_IsAdmin');

