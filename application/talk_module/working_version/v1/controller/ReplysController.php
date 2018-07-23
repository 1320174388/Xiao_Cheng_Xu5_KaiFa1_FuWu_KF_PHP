<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReplysController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/26 09:50
 *  文件描述 :  自动回复信息控制器
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\controller;
use think\Controller;
use think\Request;
use app\talk_module\working_version\v1\validator\ReplysValidate;
use app\talk_module\working_version\v1\service\ReplysService;

class ReplysController extends Controller
{
    /**
     * 名  称 : replysValue()
     * 功  能 : 获取回复信息接口
     * 变  量 : --------------------------------------
     * 输  入 : (string) $sessionIndex => '回复信息主键';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":{"数据"}}
     * 创  建 : 2018/06/30 21:26
     */
    public function replysValue(Request $request)
    {
        // 获取回复信息
        $sessionIndex = $request->get('sessionIndex');
        // 引入Service层处理逻辑
        $res = (new ReplysService())->getReplys($sessionIndex);
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(1,'没有这条回复信息');
        // 返回数据
        return returnResponse(0,'请求成功',$res['data']);
    }

    /**
     * 名  称 : replysAdd()
     * 功  能 : 添加自动回复信息接口
     * 变  量 : --------------------------------------
     * 输  入 : (string) $sessionName => '自动回复名称';
     * 输  入 : (string) $sessionType => '自动回复类型';
     * 输  入 : (string) $sessionInfo => '自动回复内容';
     * 输  出 : {"errNum":0,"retMsg":"添加成功","retData":true}
     * 创  建 : 2018/06/30 21:26
     */
    public function replysAdd(Request $request)
    {
        // 获取数据信息
        $sessionName = $request->get('sessionName');
        $sessionType = $request->get('sessionType');
        $sessionInfo = $request->get('sessionInfo');
        // 验证回复信息
        $val = (new ReplysValidate())->replysVerification(
            $sessionName,
            $sessionType,
            $sessionInfo
        );
        // 判断数据是否正确
        if($val['msg']=='error') return returnResponse(1,$val['data']);
        // 引入Service层处理逻辑
        $res = (new ReplysService())->postReplys(
            $sessionName,
            $sessionType,
            $sessionInfo
        );
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(2,'添加失败');
        // 返回数据
        return returnResponse(0,'添加成功',$res['data']);
    }

    /**
     * 名  称 : replysList()
     * 功  能 : 获取所有自动回复信息接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":{"数据"}}
     * 创  建 : 2018/06/30 21:26
     */
    public function replysList()
    {
        // 引入Service层处理逻辑
        $res = (new ReplysService())->getReplys();
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(1,'请求失败');
        // 返回数据
        return returnResponse(0,'请求成功',$res['data']);
    }

    /**
     * 名  称 : replysEdit()
     * 功  能 : 修改自动回复信息接口
     * 变  量 : --------------------------------------
     * 输  入 : (string) $sessionIndex => '回复信息主键';
     * 输  入 : (string) $sessionName  => '自动回复名称';
     * 输  入 : (string) $sessionType  => '自动回复类型';
     * 输  入 : (string) $sessionInfo  => '自动回复内容';
     * 输  出 : {"errNum":0,"retMsg":"修改成功","retData":true}
     * 创  建 : 2018/06/30 21:26
     */
    public function replysEdit(Request $request)
    {
        // 获取数据信息
        $sessionIndex = $request->get('sessionIndex');
        $sessionName  = $request->get('sessionName');
        $sessionType  = $request->get('sessionType');
        $sessionInfo  = $request->get('sessionInfo');
        // 验证回复信息
        $val = (new ReplysValidate())->replysVerification(
            $sessionName,
            $sessionType,
            $sessionInfo
        );
        // 判断数据是否正确
        if($val['msg']=='error') return returnResponse(1,$val['data']);
        // 引入Service层处理逻辑
        $res = (new ReplysService())->putReplys(
            $sessionIndex,
            $sessionName,
            $sessionType,
            $sessionInfo
        );
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(1,'修改失败');
        // 返回数据
        return returnResponse(0,'修改成功',true);
    }

    /**
     * 名  称 : replysDel()
     * 功  能 : 删除自动回复信息接口
     * 变  量 : --------------------------------------
     * 输  入 : (string) $sessionIndex => '回复信息主键';
     * 输  出 :  {"errNum":0,"retMsg":"删除成功","retData":true}
     * 创  建 : 2018/06/30 21:26
     */
    public function replysDel(Request $request)
    {
        // 获取回复信息
        $sessionIndex = $request->get('sessionIndex');
        // 引入Service层处理逻辑
        $res = (new ReplysService())->deleteReplys($sessionIndex);
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(1,'删除失败');
        // 返回数据
        return returnResponse(0,'删除成功',true);
    }
}