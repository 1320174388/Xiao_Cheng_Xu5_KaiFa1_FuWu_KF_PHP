<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  LeavingsController.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/30 22:11
 *  文件描述 :  保存所有留言控制器
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\controller;
use think\Controller;
use think\Request;
use app\talk_module\working_version\v1\library\LeavingsLibrary;
use app\talk_module\working_version\v1\service\LeavingsServer;

class LeavingsController extends Controller
{
    /**
     * 名  称 : leavingsList()
     * 功  能 : 获取单个用户所有的提问信息。
     * 变  量 : -----------------------------
     * 输  入 : (string) $peopleIndex => '提问人主键标识';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":true}
     * 创  建 : 2018/07/02 15:21
     */
    public function leavingsList(Request $request)
    {
        // 获取提问人标识
        $peopleIndex = $request->get('peopleIndex');
        // 引入Service层代码
        $res = (new LeavingsServer())->getLeavings($peopleIndex);
        // 验证数据结构
        if($res['msg']=='error') return returnResponse(0,'请求失败');
        // 返回数据
        return returnResponse(0,'请求成功',$res['data']);
    }
}