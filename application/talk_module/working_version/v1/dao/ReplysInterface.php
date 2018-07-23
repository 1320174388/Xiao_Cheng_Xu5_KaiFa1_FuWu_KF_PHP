<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReplysInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/02 09:15
 *  文件描述 :  获取、添加、修改、自动回复信息
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;

interface ReplysInterface{

    /**
     * 名  称 : replySelect()
     * 功  能 : 声明：获取单个或所有自动回复数据
     * 输  入 : (string) $index => '自动回复触发主键';
     * 创  建 : 2018/07/05 09:15
     */
    public function replySelect($index='');

    /**
     * 名  称 : replyCreate()
     * 功  能 : 声明：添加自动回复数据
     * 输  入 : (string) $sessionName => '自动回复名称';
     * 输  入 : (string) $sessionType => '自动回复类型';
     * 输  入 : (string) $sessionInfo => '自动回复内容';
     * 创  建 : 22018/07/05 09:15
     */
    public function replyCreate($sessionName,$sessionType,$sessionInfo);

    /**
     * 名  称 : replyUpdate()
     * 功  能 : 声明：修改自动回复数据
     * 输  入 : (string) $index        => '回复信息主键';
     * 输  入 : (string) $sessionName  => '自动回复名称';
     * 输  入 : (string) $sessionType  => '自动回复类型';
     * 输  入 : (string) $sessionInfo  => '自动回复内容';
     * 创  建 : 2018/07/05 09:15
     */
    public function replyUpdate($index,$sessionName,$sessionType,$sessionInfo);

    /**
     * 名  称 : replyDelete()
     * 功  能 : 声明：删除自动回复数据
     * 输  入 : (string) $index => '自动回复触发主键';
     * 创  建 : 2018/07/05 09:15
     */
    public function replyDelete($index);
}