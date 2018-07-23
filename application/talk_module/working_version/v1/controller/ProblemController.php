<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ProblemController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/02 11:43
 *  文件描述 :  用户提问消息处理控制器
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\controller;
use think\Controller;
use think\Request;
use app\talk_module\working_version\v1\service\ProblemService;
use app\talk_module\working_version\v1\validator\ProblemValidate;

class ProblemController extends Controller
{
    /**
     * 名  称 : problemValue()
     * 功  能 : 处理用户提问信息函数
     * 变  量 : -----------------------------
     * 输  入 : (Array) $data = [
     *     'peopleIndex'    => '留言人主键',
     *     'peopleName'     => '留言人名称',
     *     'peopleSex'      => '留言人性别',
     *     'leavingTitle'   => '留言标题',
     *     'messageContent' => '留言内容',
     * ];
     * 输  出 : {"errNum":0,"retMsg":"提问成功","retData":true}
     * 创  建 : 2018/07/02 11:43
     */
    public function problemValue(Request $request,$data=[])
    {
        // 获取所有传值数据s
        $data['peopleIndex']    = $request->post('peopleIndex');
        $data['peopleName']     = $request->post('peopleName');
        $data['peopleSex']      = $request->post('peopleSex');
        $data['leavingTitle']   = $request->post('leavingTitle');
        $data['messageContent'] = $request->post('messageContent');
        // 验证数据
        $val = (new ProblemValidate())->ProblemVerification($data);
        if($val['msg']=='error') return returnResponse(1,$val['data']);
        // 引入service层代码
        $res = (new ProblemService())->postValue($data);
        // 验证数据
        if($res['msg']=='error') returnResponse(2,$res['data']);
        // 返回成功数据
        return returnResponse(1,'提问成功',true);
    }

    /**
     * 名  称 : problemContent()
     * 功  能 : 处理用户后期继续提问信息函数
     * 变  量 : -----------------------------
     * 输  入 : (Array) $data = [
     *     'leavingIndex'     => '留言主键',
     *     'messageContent'   => '留言内容',
     * ];
     * 输  出 : {"errNum":0,"retMsg":"发送成功","retData":true}
     * 创  建 : 2018/07/02 17:39
     */
    public function problemContent(Request $request,$data=[])
    {
        // 获取所有传值数据
        $data['leavingIndex']    = $request->post('leavingIndex');
        $data['messageIdentity'] = 'User';
        $data['messageContent']  = $request->post('messageContent');
        // 验证数据
        $val = (new ProblemValidate())->ProblemsVerification($data);
        if($val['msg']=='error') return returnResponse(1,$val['data']);
        // 引入service层代码
        $res = (new ProblemService())->postContent($data);
        // 验证数据
        if($res['msg']=='error') returnResponse(1,$res['data']);
        // 返回成功数据
        return returnResponse(1,'发送成功',true);
    }

    /**
     * 名  称 : adminContent()
     * 功  能 : 处理用户后期继续提问信息函数
     * 变  量 : -----------------------------
     * 输  入 : (Array) $data = [
     *     'leavingIndex'     => '留言主键',
     *     'messageContent'   => '留言内容',
     * ];
     * 输  出 : {"errNum":0,"retMsg":"发送成功","retData":true}
     * 创  建 : 2018/07/02 17:39
     */
    public function adminContent(Request $request,$data=[])
    {
        // 获取所有传值数据
        $data['leavingIndex']    = $request->post('leavingIndex');
        $data['messageIdentity'] = 'Admin';
        $data['messageContent']  = $request->post('messageContent');
        // 验证数据
        $val = (new ProblemValidate())->ProblemsVerification($data);
        if($val['msg']=='error') return returnResponse(1,$val['data']);
        // 引入service层代码
        $res = (new ProblemService())->postContent($data);
        // 验证数据
        if($res['msg']=='error') returnResponse(1,$res['data']);
        // 返回成功数据
        return returnResponse(1,'发送成功',true);
    }

    /**
     * 名  称 : acknowledgement()
     * 功  能 : 将留言信表的留言状态改成2，
     * 功  能 : 将处理人的主键写入留言表的处理人字段中，
     * 功  能 : 判断用户是否有未处理的留言信息，没有的话，将留言人状态改为2
     * 变  量 : -----------------------------
     * 输  入 : (String) $peopleIndex  => '留言人主键',
     * 输  入 : (String) $leavingIndex => '留言主键',
     * 输  入 : (String) $adminToken   => '处理人主键',
     * 输  出 : {"errNum":0,"retMsg":"处理成功","retData":true}
     * 创  建 : 2018/07/02 22:15
     */
    public function acknowledgement(Request $request)
    {
        // 获取留言主键，处理人主键
        $peopleIndex  = $request->post('peopleIndex');
        $leavingIndex = $request->post('leavingIndex');
        $adminToken   = $request->post('adminToken');
        // 引入service层代码
        $res = (new ProblemService())->putLeaving(
            $peopleIndex,
            $leavingIndex,
            $adminToken
        );
        // 验证数据
        if($res['msg']=='error') returnResponse(1,$res['data']);
        // 返回成功数据
        return returnResponse(1,'发送成功',true);
    }
}