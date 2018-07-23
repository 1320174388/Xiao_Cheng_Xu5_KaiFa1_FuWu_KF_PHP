<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  MessagesController.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/06/30 22:11
 *  文件描述 :  保存所有的留言信息控制器
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\controller;
use think\Controller;
use think\Request;
use app\talk_module\working_version\v1\library\MessagesLibrary;
use app\talk_module\working_version\v1\service\MessagesServer;

class MessagesController extends Controller
{
    /**
     * 名  称 : messageList()
     * 功  能 : 获取单个提问的所有数据。
     * 变  量 : -----------------------------
     * 输  入 : (string) $leavingIndex => '提问信息标识';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":true}
     * 创  建 : 2018/07/02 15:21
     */
    public function messageList(Request $request)
    {
        // 获取提问信息标识
        $leavingIndex = $request->get('leavingIndex');
        // 引入Service层代码
        $res = (new MessagesServer())->getMessages($leavingIndex);
        // 验证数据结构
        if($res['msg']=='error') return returnResponse(0,'请求失败');
        // 返回数据
        return returnResponse(0,'请求成功',$res['data']);
    }
}