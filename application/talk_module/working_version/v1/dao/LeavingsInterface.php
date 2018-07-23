<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  LeavingsInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/02 09:15
 *  文件描述 :  获取用户所有的留言信息
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;

interface LeavingsInterface{

    /**
     * 名  称 : leavingsSelect()
     * 功  能 : 声明：获取单个用户的所有提问信息
     * 输  入 : (string) $peopleIndex => '提问人主键标识';
     * 创  建 : 2018/07/05 09:15
     */
    public function leavingsSelect($peopleIndex);
}