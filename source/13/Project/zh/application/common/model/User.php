<?php 
namespace app\common\model;
use think\Model;

class User extends Model 
{
	protected $pk = 'id';  //默认主键
	protected $table = 'zh_user';  //默认数据表

	protected $autoWriteTimestamp = true; //开启自动时间戳
	//定义时间戳字段名:默认为create_time和create_time,如果一致可省略
	//如果想关闭某个时间戳字段,将值设置为false即可:$create_time = false
	protected $createTime = 'create_time'; //创建时间字段
	protected $updateTime = 'update_time'; //更新时间字段
	protected $dateFormat = 'Y年m月d日'; //时间字段取出后的默认时间格式

	//用户状态获取器
	public function getStatusAttr($value)
	{
		$status = ['1'=>'启用', '0'=>'禁用'];
		return $status[$value];
	}

	//用户类型获取器
	// public function getIsAdminAttr($value)
	// {
	// 	$status = ['1'=>'管理员', '0'=>'注册会员'];
	// 	return $status[$value];
	// }

	//用户密码修改器
	public function setPasswordAttr($value)
	{
		return sha1($value);
	}
	
}