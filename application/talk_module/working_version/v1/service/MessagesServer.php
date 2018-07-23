<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  MessagesServer.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/30 22:29
 *  文件描述 :  留言人消息逻辑
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\service;

use app\talk_module\working_version\v1\model\MessageModel;

class MessagesServer
{
    /**
     * 名  称 : getMessages()
     * 功  能 : 获取单个提问的所有数据
     * 变  量 : -----------------------------
     * 输  入 : (string) $leavingIndex => '提问信息标识';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/02 15:52
     */
    public function getMessages($leavingIndex)
    {
        // 引入ReplysDao层
        $list = (new MessageModel())->MessagesDao($leavingIndex);
        //验证
        if($list['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$list['data']);
    }
}