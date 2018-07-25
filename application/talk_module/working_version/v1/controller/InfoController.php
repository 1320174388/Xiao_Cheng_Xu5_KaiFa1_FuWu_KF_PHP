<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  InfoController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/25 14:49
 *  文件描述 :  问题管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\controller;
use think\Controller;
use think\Request;
use app\talk_module\working_version\v1\service\InfoService;

class InfoController extends Controller
{
    /**
     * 名  称 : infoPost()
     * 功  能 : 用户添加问题接口
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['peopleIndex']  = '用户身份标识';
     * 输  入 : (String) $post['peopleName']   = '用户名称';
     * 输  入 : (String) $post['peopleSex']    = '用户性别';
     * 输  入 : (String) $post['leavingTitle'] = '问题标题';
     * 输  入 : (String) $post['messageCont']  = '问题内容';
     * 输  出 : {"errNum":0,"retMsg":"提问成功","retData":true}
     * 创  建 : 2018/07/25 14:54
     */
    public function infoPost(Request $request)
    {
        // 实例化Service逻辑层代码类
        $infoService = new InfoService();
        // 执行添加自动回复信息逻辑,获取逻辑返回值
        $res = $infoService->infoAdd($request->post());
        // 根据逻辑返回值返回数据,返回错误格式
        if($res['msg']=='error') return returnResponse(1,$res['data']);
        // 返回正确数据
        return returnResponse(0,$res['data'],true);
    }

    /**
     * 名  称 : infoGet()
     * 功  能 : 用户获取问题接口
     * 变  量 : --------------------------------------
     * 输  入 : (String) $get['peopleIndex']  = '用户身份标识';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"数据"}
     * 创  建 : 2018/07/25 14:54
     */
    public function infoGet(Request $request)
    {
        // 实例化Service逻辑层代码类
        $infoService = new InfoService();
        // 执行添加自动回复信息逻辑,获取逻辑返回值
        $res = $infoService->infoAll($request->get());
        // 根据逻辑返回值返回数据,返回错误格式
        if($res['msg']=='error') return returnResponse(1,$res['data']);
        // 返回正确数据
        return returnResponse(0,$res['data'],true);
    }

}