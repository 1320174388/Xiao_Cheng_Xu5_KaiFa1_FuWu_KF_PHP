<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  MessagesDao.php
 *  创 建 者 :  ShiRui
 *  创建日期 :  2018/07/02 15:32
 *  文件描述 :
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;
use app\talk_module\working_version\v1\model\MessageModel;
class MessagesDao implements MessagesInterface
{
    /**
     * 名  称 : messagesSelect()
     * 功  能 : 声明：获取单个提问的所有数据
     * 输  入 : (string) $peopleIndex => '提问人主键标识';
     * 输  出 : [ 'msg' => 'success', 'data' => '数据' ]
     * 输  出 : [ 'msg' => 'error', 'data' => false ]
     * 创  建 : 2018/07/02 16:41
     */
    public function  messagesSelect($leavingIndex)
    {
        //获取单个提问的所有数据
        $list = MessageModel::where('leaving_index',$leavingIndex)
            ->order('message_sort', 'asc')
            ->select();
        //验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }
}