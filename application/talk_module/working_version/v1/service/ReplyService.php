<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReplyService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/24 21:36
 *  文件描述 :  自动回复逻辑
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\service;
use app\talk_module\working_version\v1\dao\ReplyDao;
use app\talk_module\working_version\v1\validator\ReplyValidate;

class ReplyService
{
    /**
     * 名  称 : replyAdd()
     * 功  能 : 添加自动回复信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['sessionName'] = '触发标识';
     * 输  入 : (String) $post['sessionType'] = '信息类型';
     * 输  入 : (String) $post['sessionCont'] = '回复内容';
     * 输  出 : ['msg'=>'success',''=>'']
     * 创  建 : 2018/07/24 17:58
     */
    public function replyAdd($post)
    {
        // 实例化验证器，验证数据是否正确
        $validate = new ReplyValidate();

        // 判断数据是否正确,返回错误数据
        if(!$validate->check($post))
        {
            return returnData('error',$validate->getError());
        }

        // 实例化ReplyDao层代码
        $replydao = new Replydao();

        // 执行添加数据逻辑
        $res = $replydao->replyCreate($post);

        // 判断返回值，返回错误信息
        if($res['msg']=='error') return returnData('error',$res['data']);

        // 返回正确格式
        return returnData('success',$res['data']);

    }
}