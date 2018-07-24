<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ProblemDao.php
 *  创 建 者 :  Qi Yun Hai
 *  创建日期 :  2018/07/02 14:41
 *  文件描述 :  数据持久层,操作Problem：Model模型处理数据
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;
use think\Db;
use app\talk_module\working_version\v1\model\LeavingModel;
use app\talk_module\working_version\v1\model\MessageModel;
use app\talk_module\working_version\v1\model\PeopleModel;

class ProblemDao implements ProblemInterface
{
    /**
     * 名  称 : problemCreate()
     * 功  能 : 获取留言人提问信息，如果留言人不存在，将留留言人写入数据库。
     * 功  能 : 用户提的问题，写入问题数据库，保存标题，创建时间。
     * 功  能 : 提问问题的内容写入留言信息数据库，信息身份：User/Admin
     * 输  入 : (Array) $data = [
     *     'peopleIndex'    => '留言人主键',
     *     'peopleName'     => '留言人名称',
     *     'peopleSex'      => '留言人性别',
     *     'leavingTitle'   => '留言标题',
     *     'messageContent' => '留言内容',
     * ];
     * 输  出 : [ 'msg'=>'success', 'data'=>true ]
     * 输  出 : [ 'msg'=>'error' , 'data'=>false ]
     * 创  建 : 2018/07/05 09:15
     */
    public function problemCreate($data)
    {
        // 实例化留言人/留言/留言信息model类
        $peopleModel  = new PeopleModel();
        $leavingModel = new LeavingModel();
        $messageModel = new MessageModel();
        // 获取/生成标识
        $peopleIndex  = $data['peopleIndex'];
        $leavingIndex = md5(uniqid());
        // 启动事务
        Db::startTrans();
        try {
            // 查询留言人是否存在
            $res = $peopleModel
                    ->where('people_index',$peopleIndex)
                    ->find();
            // 验证
            if($res){
                $res->people_name   = $data['peopleName'];
                $res->people_sex    = $data['peopleSex'];
                $res->people_status = '1';
            }else{
                // 处理留言人数据
                $peopleModel->people_index  = $peopleIndex;
                $peopleModel->people_name   = $data['peopleName'];
                $peopleModel->people_sex    = $data['peopleSex'];
                $peopleModel->people_status = '1';
                $peopleModel->people_time   = time();
            }
            // 验证数据
            if(!$peopleModel->save())
                return returnData('error',false);
            // 处理留言数据
            $leavingModel->leaving_index  = $leavingIndex;
            $leavingModel->people_index   = $peopleIndex;
            $leavingModel->leaving_title  = $data['leavingTitle'];
            $leavingModel->leaving_status = '1';
            $leavingModel->leaving_time   = time();
            // 验证数据
            if(!$leavingModel->save())
                return returnData('error',false);

            // 处理留言信息数据
            $messageModel->leaving_index    = $leavingIndex;
            $messageModel->message_content  = $data['messageContent'];
            $messageModel->message_identity = 'User';
            $messageModel->message_sort     = '1';
            // 验证数据
            if(!$messageModel->save())
                return returnData('error',false);
            // 提交事务
            Db::commit(); return returnData('success',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback(); return returnData('error',false);
        }
    }

    /**
     * 名  称 : messageCreate()
     * 功  能 : 将用户继续提问的信息保存到数据库。
     * 输  入 : (Array) $data = [
     *     'leavingIndex'     => '留言主键',
     *     'messageIdentity'  => '留言身份',
     *     'messageContent'   => '留言内容',
     * ];
     * 输  出 : ['msg'=>'success','data'=>true]
     * 输  出 : ['msg'=>'error','data'=>false]
     * 创  建 : 2018/07/05 17:54
     */
    public function messageCreate($data)
    {
        // 获取/生成标识
        $leavingIndex  = $data['leavingIndex'];
        // 实例化留言信息/留言人的model类
        $messageModel = new MessageModel();
        // 处理保存留言信息数据
        $messageModel->leaving_index    = $leavingIndex;
        $messageModel->message_content  = $data['messageContent'];
        $messageModel->message_identity = $data['messageIdentity'];
        // 判断数据库里有多少条留言主键然后进行排序
        $countData = MessageModel::count();
        $messageModel->message_sort	    = $countData+1;
        // 保存留言信息并验证数据格式
        if(!$messageModel->save())
            return returnData('error',false);
        // 返回数据格式
        return returnData('success',true);
    }

    /**
     * 名  称 : adminLeaving()
     * 功  能 : 将留言表的留言状态改成2，
     * 功  能 : 将处理人的主键写入留言表的处理人字段中，
     * 功  能 : 判断用户是否有未处理的留言信息，没有的话，将留言人状态改为2
     * 输  入 : (String) $index  => '留言人主键',
     * 输  入 : (String) $leavingIndex => '留言主键',
     * 输  入 : (String) $adminToken   => '处理人主键',
     * 输  出 : ['msg'=>'error',false]
     * 输  出 : ['msg'=>'success',true]
     * 创  建 : 2018/07/02 23:13
     */
    public function adminLeaving($index,$leavingIndex,$adminToken,$type=true)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 实例化留言信息表
            $leavingModel = new LeavingModel();
            $leavingModel->laeving_status = 2;
            $leavingModel->leaving_handel = $adminToken;
            if(!$leavingModel->save()) return returnData('error');
            $data = LeavingModel::where('people_index',$index)
                        ->select();
            foreach($data as $k=>$v)
            {
                if($v['leaving_status']==1) $type = false;
            }
            if($type){
                $peopleModel = new PeopleModel();
                $peopleModel->people_status = 2;
                if(!$peopleModel->save()) return returnData('error');
            }
            // 提交事务
            Db::commit(); return returnData('success',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback(); return returnData('error',false);
        }
        
    }
}