<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PeoplesController.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/30 22:11
 *  文件描述 :  留言人消息控制器
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\controller;
use think\Controller;
use think\Request;
use app\talk_module\working_version\v1\library\PeoplesLibrary;
use app\talk_module\working_version\v1\service\PeoplesServer;

class PeoplesController extends Controller
{
    /**
     * 名  称 : peopleList()
     * 功  能 : 获取所有用户提问数据
     * 变  量 : -----------------------------
     * 输  入 : (string) $leavingIndex => '提问信息标识';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"数据"}
     * 创  建 : 2018/07/23 15:04
     */
    public function peopleList()
    {
        // 引入Service层代码
        $res = (new PeoplesServer)->peopleGet();
        // 验证数据结构
        if($res['msg']=='error') return returnResponse(1,'当前没有人提问问题');
        // 返回数据
        return returnResponse(0,'请求成功',$res['data']);
    }
}