<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReplyInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/24 21:52
 *  文件描述 :  自动回复数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;

interface ReplyInterface
{
    /**
     * 名  称 : replyCreate()
     * 功  能 : 添加自动回复数据逻辑
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['sessionName'] = '触发标识';
     * 输  入 : (String) $post['sessionType'] = '信息类型';
     * 输  入 : (String) $post['sessionCont'] = '回复内容';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/07/24 21:54
     */
    public function replyCreate($post);
}