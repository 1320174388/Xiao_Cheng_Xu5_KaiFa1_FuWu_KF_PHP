<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReplyDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/24 21:52
 *  文件描述 :  自动回复数据逻辑
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;
use app\talk_module\working_version\v1\model\ReplyModel;

class ReplyDao implements ReplyInterface
{
    /**
     * 名  称 : replyCreate()
     * 功  能 : 添加自动回复数据逻辑
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['sessionName'] = '触发标识';
     * 输  入 : (String) $post['sessionType'] = '信息类型';
     * 输  入 : (String) $post['sessionCont'] = '回复内容';
     * 输  出 : ['msg'=>'success','data'=>'返回信息']
     * 创  建 : 2018/07/24 21:54
     */
    public function replyCreate($post)
    {
        // 获取触发标识数据，查看是否存在
        $data = ReplyModel::where(
            'session_name',
            $post['sessionName']
        )->find();
        // 验证数据
        if($data) return returnData('error','问题已经存在');
        // 实例化，数据模型
        $replyModel = new ReplyModel();
        // 处理数据
        $replyModel->session_index   = md5(uniqid());
        $replyModel->session_name    = $post['sessionName'];
        $replyModel->session_type    = $post['sessionType'];
        $replyModel->session_content = $post['sessionCont'];
        $replyModel->session_time    = time();
        // 保存数据
        $res = $replyModel->save();
        // 判断数据是否保存成功
        if($res['msg']) return returnData('error','添加失败');
        // 返回正确数据
        return returnData('success','添加成功');
    }

    /**
     * 名  称 : replySelect()
     * 功  能 : 获取自动回复数据逻辑
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'返回信息']
     * 创  建 : 2018/07/25 10:02
     */
    public function replySelect()
    {
        // 获取所有自动回复信息
        $all = ReplyModel::all();
        // 根据返回数据判断是否获取成功
        if(!$all) return returnData('error','当前没有添加任何自动回复信息');
        // 返回正确数据
        return returnData('success',$all);
    }
}