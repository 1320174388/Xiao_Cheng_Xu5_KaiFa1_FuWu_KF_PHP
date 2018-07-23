<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  MessagesInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/02 15:50
 *  文件描述 :  获取用户所有的留言信息
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;

interface MessagesInterface{

    /**
     * 名  称 : messagesSelect()
     * 功  能 : 声明：获取单个提问的所有数据
     * 输  入 : (string) $leavingIndex => '提问信息标识';
     * 创  建 : 2018/07/05 15:56
     */
    public function messagesSelect($leavingIndex);
}