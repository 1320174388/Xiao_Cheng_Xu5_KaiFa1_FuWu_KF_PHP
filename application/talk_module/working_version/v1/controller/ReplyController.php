<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReplyController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 15:12
 *  文件描述 :  自动回复控制器
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\controller;
use think\Controller;

class ReplyController extends Controller
{
    /**
     * 名  称 : replyPost()
     * 功  能 : 添加自动回复信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $sessionName = '触发标识';
     * 输  入 : (String) $sessionType = '信息类型';
     * 输  入 : (String) $sessionName = '回复内容';
     * 输  出 : {"errNum":0,"retMsg":"添加成功","retData":true}
     * 创  建 : 2018/07/24 17:58
     */
    public function replyPost()
    {
        return "<h1>replysPost</h1>";
    }
}