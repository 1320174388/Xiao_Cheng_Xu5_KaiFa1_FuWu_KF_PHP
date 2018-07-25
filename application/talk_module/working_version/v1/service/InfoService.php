<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  InfoService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/24 21:36
 *  文件描述 :  信息控制器
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\service;
use app\talk_module\working_version\v1\dao\InfoDao;
use app\talk_module\working_version\v1\validator\ProblemValidate;

class InfoService
{
    /**
     * 名  称 : infoAdd()
     * 功  能 : 添加提问信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['peopleIndex']  = '用户身份标识';
     * 输  入 : (String) $post['peopleName']   = '用户名称';
     * 输  入 : (String) $post['peopleSex']    = '用户性别';
     * 输  入 : (String) $post['leavingTitle'] = '问题标题';
     * 输  入 : (String) $post['messageCont']  = '问题内容';
     * 输  出 : ['msg'=>'success','data'=>'返回信息']
     * 创  建 : 2018/07/24 17:58
     */
    public function infoAdd($post)
    {
        // 实例化验证器，验证数据是否正确
        $validate = new ProblemValidate();

        // 判断数据是否正确,返回错误数据
        if(!$validate->check($post))
        {
            return returnData('error',$validate->getError());
        }

        // 实例化ReplyDao层代码
        $replydao = new InfoDao();

        // 执行添加数据逻辑
        $res = $replydao->problemService($post);

        // 判断返回值，返回错误信息
        if($res['msg']=='error') return returnData('error',$res['data']);

        // 返回正确格式
        return returnData('success',$res['data']);

    }
}