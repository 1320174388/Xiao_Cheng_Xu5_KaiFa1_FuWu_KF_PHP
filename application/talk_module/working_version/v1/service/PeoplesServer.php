<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PeoplesServer.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/30 22:29
 *  文件描述 :  留言人消息逻辑
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\service;
use app\talk_module\working_version\v1\dao\PeopLeDao;

class PeoplesServer
{
    /**
     * 名  称 : peopleGet()
     * 功  能 : 获取所有管理员提问信息
     * 变  量 : -----------------------------
     * 输  入 : -----------------------------
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/23 15:06
     */
    public function peopleGet()
    {
        // 引入ReplysDao层
        $list = (new PeopLeDao())->peopleSelect();
        //验证
        if($list['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$list['data']);
    }
}