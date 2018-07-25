<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  InfoInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/24 21:52
 *  文件描述 :  处理信息数据逻辑声明
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;

interface InfoInterface
{
    /**
     * 名  称 : problemCreate()
     * 功  能 : 添加提问信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['peopleIndex']  = '用户身份标识';
     * 输  入 : (String) $post['peopleFormid'] = '用户提交表单id';
     * 输  入 : (String) $post['peopleName']   = '用户名称';
     * 输  入 : (String) $post['peopleSex']    = '用户性别';
     * 输  入 : (String) $post['leavingTitle'] = '问题标题';
     * 输  入 : (String) $post['messageCont']  = '问题内容';
     * 输  出 : ['msg'=>'success','data'=>'返回信息']
     * 创  建 : 2018/07/24 17:58
     */
    public function problemCreate($post);

    /**
     * 名  称 : leavingSelect()
     * 功  能 : 获取提问信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : (String) $get['peopleIndex']  = '用户身份标识';
     * 输  出 : ['msg'=>'success','data'=>'返回信息']
     * 创  建 : 2018/07/24 17:58
     */
    public function leavingSelect($get);

    /**
     * 名  称 : adminCreate()
     * 功  能 : 获取管理员formid
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['adminFormid'] = '管理员formid';
     * 输  出 : ['msg'=>'success','data'=>'返回信息']
     * 创  建 : 2018/07/24 17:58
     */
    public function adminCreate($post);
}