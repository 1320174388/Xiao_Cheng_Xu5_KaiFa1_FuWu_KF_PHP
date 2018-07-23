<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  LeavingsDao.php
 *  创 建 者 :  ShiRui
 *  创建日期 :  2018/07/02 15:32
 *  文件描述 :
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;
use app\talk_module\working_version\v1\model\LeavingModel;
class LeavingsDao implements LeavingsInterface
{

    /**
     * 名  称 : leavingsSelect()
     * 功  能 : 声明：获取单个用户的所有提问信息
     * 输  入 : (string) $peopleIndex => '提问人主键标识';
     * 输  出 : [ 'msg' => 'success', 'data' => '数据' ]
     * 输  出 : [ 'msg' => 'error', 'data' => false ]
     * 创  建 : 2018/07/02 10:36
     */
    public function leavingsSelect($peopleIndex)
    {
        // 实例化自动model
        $LeavingModel = new LeavingModel;
        // 获取配置信息表名
        $admin = config('v1_tableName.AdminTable');
        $leavi = config('v1_tableName.LeavingTable');
        // 处理field数据
        $string = "{$leavi}.leaving_index,";
        $string.= "{$leavi}.people_index,";
        $string.= "{$leavi}.leaving_title,";
        $string.= "{$leavi}.leaving_status,";
        $string.= "{$leavi}.leaving_time,";
        $string.= "{$admin}.admin_name";
        // 获取单个用户的所有提问信息
        $list = $LeavingModel->field($string)
            ->leftJoin($admin)
            ->where('people_index',$peopleIndex)
            ->select();
        //验证
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);

    }
}