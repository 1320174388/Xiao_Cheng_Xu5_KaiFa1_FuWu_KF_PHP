<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  LeavingsServer.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/30 22:29
 *  文件描述 :  保存留言逻辑
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\service;
use app\talk_module\working_version\v1\dao\LeavingsDao;
class LeavingsServer
{
    /**
     * 名  称 : getLeavings()
     * 功  能 : 获取单个用户所有的提问信息
     * 变  量 : -----------------------------
     * 输  入 : (string) $peopleIndex => '提问人主键标识';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/02 15:21
     */
    public function getLeavings($peopleIndex)
    {
        // 引入ReplysDao层
        $list = (new LeavingsDao())->leavingsSelect($peopleIndex);
        //验证
        if($list['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$list['data']);
    }
}