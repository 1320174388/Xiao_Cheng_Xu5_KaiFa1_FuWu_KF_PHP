<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ProblemService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/02 14:10
 *  文件描述 :  用户提问消息处理逻辑
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\service;

use app\talk_module\working_version\v1\dao\ProblemDao;

class ProblemService
{
    /**
     * 名  称 : postValue()
     * 功  能 : 处理用户提问信息函数
     * 变  量 : --------------------------------------
     * 输  入 : (Array) $data = [
     *     'peopleName'     => '留言人名称',
     *     'peopleSex'      => '留言人性别',
     *     'leavingTitle'   => '留言标题',
     *     'messageContent' => '留言内容',
     * ];
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/07/02 11:43
     */
    public function postValue($data)
    {
        // 实例化ProblemDao.php
        $problemDao = (new ProblemDao())->problemCreate($data);
        // 验证数据格式
        if($problemDao['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$problemDao['data']);
    }

    /**
     * 名  称 : postContent()
     * 功  能 : 处理用户后期继续提问信息函数
     * 变  量 : --------------------------------------
     * 输  入 : (Array) $data = [
     *     'leavingIndex'     => '留言主键',
     *     'messageIdentity'  => '留言身份',
     *     'messageContent'   => '留言内容',
     * ];
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/07/02 15:57
     */
    public function postContent($data)
    {
        // 实例化ProblemDao.php
        $problemDao = (new ProblemDao())->messageCreate($data);
        // 验证数据格式
        if($problemDao['msg']=='error') return returnData('error');
        // 返回数据格式
        return returnData('success',$problemDao['data']);
    }

    /**
     * 名  称 : putLeaving()
     * 功  能 : 将留言信表的留言状态改成2，
     * 功  能 : 将处理人的主键写入留言表的处理人字段中，
     * 功  能 : 判断用户是否有未处理的留言信息，没有的话，将留言人状态改为2
     * 变  量 : --------------------------------------
     * 输  入 : (String) $peopleIndex  => '留言人主键',
     * 输  入 : (String) $leavingIndex => '留言主键',
     * 输  入 : (String) $adminToken   => '处理人主键',
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/07/02 22:15
     */
    public function putLeaving($peopleIndex,$leavingIndex,$adminToken)
    {

    }
}