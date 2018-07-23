<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReplysValidate.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/07/02 10:40
 *  文件描述 :  验证获取数据的逻辑
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\validator;
class ReplysValidate
{
    /**
     * 名  称 : replysVerification()
     * 功  能 : 验证回复信息接口
     * 变  量 : --------------------------------------
     * 输  入 : (string) $sessionName => '自动回复名称';
     * 输  入 : (string) $sessionType => '自动回复类型';
     * 输  入 : (string) $sessionInfo => '自动回复内容';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 输  出 : ['msg'=>'error','data'=>'错误信息']
     * 创  建 : 2018/07/02 10:40
     */
    public function replysVerification($sessionName,$sessionType,$sessionInfo)
    {
        // 判断是否为空
        if(!$sessionName) return returnDate('error','请输入自动回复问题');
        if(!$sessionType) return returnDate('error','请发送数据类型');
        if(!$sessionInfo) return returnDate('error','请输入自动回复内容');

        // 判断名称长度是不是大于10个字符
        if(strlen($sessionName) > 10)
            return returnDate('error','问题不能超过10个字符');
        // 判断类型
        if(($sessionType != 'text') and ($sessionType != 'image'))
            return returnDate('error','数据类型不存在');
        //  判断内容
        if(strlen($sessionName > 2000))
            return returnDate('error','内容长度太大');
        // 返回正确格式
        return returnDate('success',true);

    }
}