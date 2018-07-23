<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  LeavingModel.php
 *  创 建 者 :  Qi Yun Hai
 *  创建日期 :  2018/06/30 22:16
 *  文件描述 :  保存所有的留言信息数据表模型
 *  历史记录 :  -----------------------
 */

namespace app\talk_module\working_version\v1\model;
use think\Model;

class MessageModel extends Model
{
	// 设置当前模型对应的完整数据表名称
	protected $table = '';

	// 设置当前模型对应数据表的主键
	protected $pk = 'leaving_index';

	// 加载配置数据表名
	protected function initialize()
	{
		parent::initialize();
		$this->table = config('v1_tableName.MessageTable');
	}
}