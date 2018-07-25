<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  InfoDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/24 21:52
 *  文件描述 :  处理信息数据逻辑
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;
use think\Db;
use app\talk_module\working_version\v1\model\PeopleModel;
use app\talk_module\working_version\v1\model\LeavingModel;
use app\talk_module\working_version\v1\model\MessageModel;

class InfoDao implements InfoInterface
{
    /**
     * 名  称 : problemService()
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
    public function problemService($post)
    {
        // 启动事务
        Db::startTrans();
        try{

            // 判断留言人是否已有留言
            $user = PeopleModel::where('people_index',$post['peopleIndex'])
                ->find();

            // 执行留言人处理逻辑
            if($user) {
                // 处理数据格式
                $user->people_name   = $post['peopleName'];
                $user->people_sex    = $post['peopleSex'];
                $user->people_status = 1;
                // 执行写入数据
                $user->save();
            } else {
                // 实例化模型
                $peopleModel = new PeopleModel();
                // 处理数据
                $peopleModel->people_index  = $post['peopleIndex'];
                $peopleModel->people_name   = $post['peopleName'];
                $peopleModel->people_sex    = $post['peopleSex'];
                $peopleModel->people_status = 1;
                $peopleModel->people_time   = time();
                // 保存数据
                $peopleModel->save();
            }

            // 实例化留言信息模型
            $leavingModel = new LeavingModel();
            // 生成信息主键信息
            $leavingIndex = md5(uniqid().mt_rand(1,999999));
            // 处理数据
            $leavingModel->leaving_index  = $leavingIndex;
            $leavingModel->people_index   = $post['peopleIndex'];
            $leavingModel->leaving_title  = $post['leavingTitle'];
            $leavingModel->leaving_status = 1;
            $leavingModel->leaving_time   = time();
            // 保存数据
            $leavingModel->save();

            // 实例化留言信息内容模型
            $messageModel = new MessageModel();
            // 生成信息内容主键信息
            $messageIndex = md5(uniqid().mt_rand(1,999999));
            // 处理数据
            $messageModel->message_index    = $messageIndex;
            $messageModel->leaving_index    = $leavingIndex;
            $messageModel->message_content  = $post['messageCont'];
            $messageModel->message_identity = 'User';
            $messageModel->message_sort     = 1;
            // 保存数据
            $messageModel->save();

            // 提交事务
            Db::commit();
            return returnData('success','提问成功');
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return returnData('error','提问失败');
        }
    }
}