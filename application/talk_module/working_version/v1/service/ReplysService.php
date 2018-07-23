<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReplysService.php
 *  创 建 者 :  Shi Guang　Yu
 *  创建日期 :  2018/07/02 11:00
 *  文件描述 :  处理客服信息逻辑
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\service;
use app\talk_module\working_version\v1\dao\ReplysDao;

class ReplysService
{
    /**
     * 名  称 : getReplys()
     * 功  能 : 获取回复信息
     * 变  量 : --------------------------------------
     * 输  入 : (string) $sessionIndex => '回复信息主键';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/02 11:00
     */
    public function getReplys($sessionIndex='')
    {
        // 引入ReplysDao层
        $list = (new ReplysDao())->replySelect($sessionIndex);
        // 判断是否有数据
        if($list['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$list['data']);
    }

    /**
     * 名  称 : postReplys()
     * 功  能 : 添加回复信息
     * 变  量 : --------------------------------------
     * 输  入 : (string) $sessionName => '自动回复名称';
     * 输  入 : (string) $sessionType => '自动回复类型';
     * 输  入 : (string) $sessionInfo => '自动回复内容';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/07/02 11:00
     */
    public function postReplys($sessionName,$sessionType,$sessionInfo)
    {
        // 引入Replysdao层
        $data = (new ReplysDao())->replyCreate(
            $sessionName,
            $sessionType,
            $sessionInfo
        );
        // 判断是否添加成功
        if($data['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$data['data']);
    }

    /**
     * 名  称 : putReplys()
     * 功  能 : 修改回复信息
     * 变  量 : --------------------------------------
     * 输  入 : (string) $index        => '回复信息主键';
     * 输  入 : (string) $sessionName  => '自动回复名称';
     * 输  入 : (string) $sessionType  => '自动回复类型';
     * 输  入 : (string) $sessionInfo  => '自动回复内容';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/07/02 11:00
     */
    public function putReplys($index,$sessionName,$sessionType,$sessionInfo)
    {
        // 引入Replysdao层
        $res = (new ReplysDao())->replyUpdate(
            $index,
            $sessionName,
            $sessionType,
            $sessionInfo
        );
        // 判断是否修改成功
        if($res['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : putReplys()
     * 功  能 : 删除回复信息
     * 变  量 : --------------------------------------
     * 输  入 : (string) $index        => '回复信息主键';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/07/02 11:00
     */
    public function deleteReplys($index)
    {
        // 引入Replysdao层
        $del = (new ReplysDao())->replyDelete($index);
        // 判断是否删除成功
        if($del['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$del['data']);
    }
}