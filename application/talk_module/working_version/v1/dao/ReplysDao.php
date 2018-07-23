<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReplysDao.php
 *  创 建 者 :  Qi Yun Hai
 *  创建日期 :  2018/07/02 09:43
 *  文件描述 :  数据持久层,操作Reply：Model模型处理数据
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\dao;
use app\talk_module\working_version\v1\model\ReplyModel;

class ReplysDao implements ReplysInterface
{
	/**
     * 名  称 : replySelect()
     * 功  能 : 声明：获取单个或所有自动回复数据
     * 输  入 : (string) $index => '自动回复触发主键';
     * 输  出 : [ 'msg' => 'success', 'data' => '数据' ]
     * 输  出 : [ 'msg' => 'error', 'data' => false ]
     * 创  建 : 2018/07/02 10:36
     */
	public function replySelect($index='')
	{
		// 实例化自动回复信息model
		$replyModel = new ReplyModel;
		// 判断查询为单个回复数据还是所有回复数据
		// 如果$index为空字符串,就查询所有
		if($index == ''){
			$list = $replyModel->select();
		}else{
			$list = $replyModel->where('session_index',$index)->find();
		}
		// 验证
		if(!$list){
			return returnData('error',false);
		}
		// 返回数据
		return returnData('success',$list);
	}

	/**
     * 名  称 : replyCreate()
     * 功  能 : 声明：添加自动回复数据
     * 输  入 : (string) $sessionName => '自动回复名称';
     * 输  入 : (string) $sessionType => '自动回复类型';
     * 输  入 : (string) $sessionInfo => '自动回复内容';
     * 输  出 : [ 'msg' => 'success', 'data' => true ]
     * 输  出 : [ 'msg' => 'error',  'data' => false ]
     * 创  建 : 2018/07/02 10:45
     */
	public function replyCreate($sessionName,$sessionType,$sessionInfo)
	{
		// 实例化自动回复信息model
		$replyModel = new ReplyModel;
		// 生成自动回复主键
		$replyModel->session_index	 = md5(uniqid());
		// 获取自动回复名称
		$replyModel->session_name    = $sessionName;
		// 获取自动回复类型
		$replyModel->session_type    = $sessionType;
		// 获取自动回复内容
		$replyModel->session_content = $sessionInfo;
		// 获取自动回复时间
		$replyModel->session_time    = time();
		// 保存数据库
		$data = $replyModel->save();
		// 验证
		if(!$data){
			return returnData('error',false);
		}
		// 返回数据
		return returnData('success',true);
	}

	/**
     * 名  称 : replyUpdate()
     * 功  能 : 声明：修改自动回复数据
     * 输  入 : (string) $index        => '回复信息主键';
     * 输  入 : (string) $sessionName  => '自动回复名称';
     * 输  入 : (string) $sessionType  => '自动回复类型';
     * 输  入 : (string) $sessionInfo  => '自动回复内容';
     * 输  出 : [ 'msg' => 'success', 'data' => true ]
     * 输  出 : [ 'msg' => 'error',  'data' => false ]
     * 创  建 : 2018/07/05 10:52
     */
	public function replyUpdate($index,$sessionName,$sessionType,$sessionInfo)
	{
		// 实例化自动回复信息model
		$replyModel = new ReplyModel;
		
		// 进行修改
		$res = $replyModel->save([
			// 获取自动回复信息名称
			$replyModel->session_name    = $sessionName,
			// 获取自动回复信息类型
			$replyModel->session_type  	 = $sessionType,
			// 获取自动回复信息内容
			$replyModel->session_content = $sessionInfo,
		],['session_index'=>$index]);
		// 验证
		if(!$res){
			return returnData('error',false);
		}
		// 返回数据
		return returnData('success',true);
	}

	/**
     * 名  称 : replyDelete()
     * 功  能 : 声明：删除自动回复数据
     * 输  入 : (string) $index => '自动回复触发主键';
     * 输  出 : [ 'msg' => 'success', 'data' => true ]
     * 输  出 : [ 'msg' => 'error',  'data' => false ]
     * 创  建 : 2018/07/05 11:02
     */
	public function replyDelete($index)
	{
		// 实例化自动回复信息model
		$replyModel = new ReplyModel;
		// 执行删除操作
		$del = $replyModel->where('session_index',$index)->delete();
		// 验证
		if(!$del){
			return returnData('error',false);
		}
		// 返回数据
		return returnData('success',true);
	}
}