<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ReplyModel.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/24 21:52
 *  文件描述 :  自动回复信息表
 *  历史记录 :  -----------------------
 */
namespace app\talk_module\working_version\v1\ReplyModel;
use think\Model;

class ReplyModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'session_index';

    // 加载配置数据表名
    public function initialize()
    {
        $this->table = config('v1_tableName.ReplyTable');
    }
}