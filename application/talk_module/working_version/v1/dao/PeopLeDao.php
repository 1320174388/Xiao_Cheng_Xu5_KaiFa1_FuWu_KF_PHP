<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PeopLeDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/02 14:41
 *  文件描述 :  数据持久层,操作Problem：Model模型处理数据
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;
use app\talk_module\working_version\v1\model\PeopleModel;

class PeopLeDao implements PeopLeInterface
{
    /**
     * 名  称 : peopleSelect()
     * 功  能 : 声明：获取所有留言人信息
     * 输  入 : (string) $peopleIndex => '提问人主键标识';
     * 创  建 : 2018/07/23 15:09
     */
    public function peopleSelect()
    {
        // 获取所有留言人信息
        $list = PeopleModel::order('people_status','asc')->select();
        // 判断是否有数据
        if(!$list) return returnData('error');
        // 返回正确数据
        return returnData('success',$list);
    }
}