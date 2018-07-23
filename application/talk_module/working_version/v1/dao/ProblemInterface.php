<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ProblemInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/02 14:29
 *  文件描述 :  用户提问信息处理接口
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;

interface ProblemInterface
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
     * 创  建 : 2018/07/05 09:15
     */
    public function problemCreate($data);

    /**
     * 名  称 : messageCreate()
     * 功  能 : 将用户继续提问的信息保存到数据库。
     * 输  入 : (Array) $data = [
     *     'leavingIndex'     => '留言主键',
     *     'messageIdentity'  => '留言身份',
     *     'messageContent'   => '留言内容',
     * ];
     * 创  建 : 2018/07/05 17:54
     */
    public function messageCreate($data);

    /**
     * 名  称 : adminLeaving()
     * 功  能 : 将留言信表的留言状态改成2，
     * 功  能 : 将处理人的主键写入留言表的处理人字段中，
     * 功  能 : 判断用户是否有未处理的留言信息，没有的话，将留言人状态改为2
     * 输  入 : (String) $peopleIndex  => '留言人主键',
     * 输  入 : (String) $leavingIndex => '留言主键',
     * 输  入 : (String) $adminToken   => '处理人主键',
     * 创  建 : 2018/07/02 22:15
     */
    public function adminLeaving($peopleIndex,$leavingIndex,$adminToken);
}